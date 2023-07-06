<?php
/**
 * 后台管理各接口，需要验证token
 */

namespace app\controller;

use app\BaseController;
use think\facade\Db;
use app\validate\Adminlogin;
use think\exception\ValidateException;

class Admin extends BaseController
{
    protected $middleware = [
        'auth'
    ];

    // 分类列表
    public function catelist()
    {
        $data = Db::name('categorys')->column('*', 'id');

        $d = [];
        $booknums = Db::name('books')->group('cid')->field('count(id) as nums,cid')->select()->toArray();
        foreach ($booknums as $v) {
            $data[$v['cid']]['booknums'] = $v['nums'];
        }


        return okjson([
            'list' => array_values($data),
            "count" => Db::name('categorys')->count(),
            "token" => $this->request->token
        ]);
    }

    // 添加新分类
    public function addcate()
    {
        $data = $this->request->param();
        try {
            validate(Adminlogin::class)->scene('addcate')->check($data);
            if (Db::name('categorys')->where('name', $data['catename'])->count() > 0) {
                return errorjson(200, "已存在同名分类，不可重复添加");
            }
            $res = Db::name('categorys')->insert([
                "name" => $data['catename']
            ]);
            if (!$res) {
                return errorjson(201, "添加分类失败了，请重试");
            }
            return okjson([
                "token" => $this->request->token
            ]);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            // exit($e->getMessage());
            return errorjson(202, $e->getMessage());
        }
    }

    // 删除已有分类
    public function removecate()
    {
        $data = $this->request->param();
        try {
            validate(Adminlogin::class)->scene('removecate')->check($data);
            $res = Db::name('categorys')->limit(1)->delete($data['cateid']);
            if (!$res) {
                return errorjson(203, "删除分类失败了，请重试");
            }
            return okjson([
                "token" => $this->request->token
            ]);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            // exit($e->getMessage());
            return errorjson(204, $e->getMessage());
        }
    }

    // 修改分类名字
    public function editcate()
    {
        $data = $this->request->param();
        try {
            validate(Adminlogin::class)->scene('addcate')->check($data);
            if (empty($data['cid']) || empty($data['catename'])) {
                return errorjson(205, "确实cid或catename参数");
            }
            $res = Db::name('categorys')->update([
                "name" => $data['catename'],
                "id" => $data['cid']
            ]);
            if (!$res) {
                return errorjson(206, "更新分类失败了，请重试");
            }
            return okjson([
                "token" => $this->request->token
            ]);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return errorjson(207, $e->getMessage());
        }
    }

    // 小说列表
    public function booklist()
    {
        $page = (int)$this->request->param('page', 1);
        $limit = (int)$this->request->param('limit', 20);
        $keyword = $this->request->param('keyword', '');
        if ($keyword) {
            $count = Db::name('books')->where('name', 'like', '%' . $keyword . '%')->count();
            $data = Db::name('books')->where('name', 'like', '%' . $keyword . '%')->order('id desc')->limit(($page - 1) * $limit, $limit)->select()->toArray();
        } else {
            $count = Db::name('books')->count();
            $data = Db::name('books')->order('id desc')->limit(($page - 1) * $limit, $limit)->select()->toArray();
        }
        $allcate = Db::name('categorys')->column('id,name', 'id');
        foreach ($data as $k => $v) {
            $data[$k]['c_name'] = $allcate[$v['cid']]['name'];
        }
        return okjson([
            "list" => $data,
            "token" => $this->request->token,
            "count" => $count,
            "allcate" => array_values($allcate)
        ]);
    }

    // 修改图书 连载状态或分类
    public function editbook()
    {
        $data = $this->request->param();
        if (empty($data['field']) || empty($data['bookid'])) {
            return errorjson(208, '参数错误');
        }
        $res = Db::name('books')->where('id', $data['bookid'])->update([
            $data['field'] => $data['value']
        ]);
        if (!$res) {
            return errorjson(209, '更新出错');
        }
        return okjson();
    }

    // 上传封面
    public function uploadpic()
    {
        $file = request()->file('pic');
        if (!in_array($file->extension(), ['jpg', 'jpeg', 'png', 'gif'])) {
            return errorjson(210, "只可上传图片形式");
        }
        $savename = \think\facade\Filesystem::disk('public')->putFile('topic', $file);

        return okjson(['src' => $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/storage/' . $savename]);
    }

    // 删除小说
    public function removebook()
    {
        $data = $this->request->param();
        if (empty($data['book_id'])) {
            return errorjson(211, "参数错误");
        }
        $res = Db::name('books')->limit(1)->delete($data['book_id']);
        if ($res) {
            $txtpath = app()->getRootPath() . "runtime/txt/{$data['book_id']}/";
            foreach (glob($txtpath . '*.txt') as $v) {
                @unlink($v);
            }
            @rmdir($txtpath);
            return okjson();
        }
        return errorjson(212, '删除失败');
    }

    // 添加一本新书
    public function addbook()
    {
        $data = $this->request->param();
        if (empty($data['name'])) {
            return errorjson(213, "已有同名小说，不允许重复");
        }
        $res = Db::name('books')->insertGetId([
            "name" => $data['name'],
            "pic" => $data['pic'],
            "cid" => $data['cid'],
            "author" => $data['author'],
            "status" => $data['status'],
            "summary" => $data['summary']
        ]);
        if (!$res) {
            return errorjson(214, '添加新书失败');
        }
        if (isset($_FILES['txt'])) {
            return $this->uploadtxt($res);
        }
        return okjson(['id' => $res]);
    }

    // 添加图书后的上传txt
    private function uploadtxt($book_id)
    {
        try {
            $file = request()->file('txt');
        } catch (\Exception $e) {
            return errorjson(215, '上传txt失败');
        }
        // 如果不存在图书，则获取基本信息后插入
        // $book_id = $this->request->param('book_id');
        if ($book_id < 1) {
            return errorjson(216, 'bookid错误');
        }

        $content = file_get_contents($file->getRealPath());
        $pos = mb_strpos($content, "【【");
        $metainfo = $pos <= 0 ? '' : mb_substr($content, 0, $pos);
        // 移除第一个章节前的基础信息
        if (mb_strlen($metainfo) > 0) {
            $content = mb_substr($content, $pos);
        }

        $txtpath = app()->getRootPath() . "runtime/txt/{$book_id}/";
        if (!is_dir($txtpath)) {
            mkdir($txtpath, 0777);
        }
        $content = trim($content);
        $contentarr = preg_split("/【【.*?】】/ism", $content);
        preg_match_all("/【【(.*?)】】/ism", $content, $subjectarr);
        if (!isset($subjectarr[1]) || empty($subjectarr[1])) {
            $contentarr = preg_split("/^\s*?.*?第.*?章.*?$/im", $content);
            preg_match_all("/^\s*?.*?第.*?章.*?$/im", $content, $subjectarr);
            return errorjson(217, '没有找到章节分节符');
        }
        if (!isset($subjectarr[1]) || empty($subjectarr[1])) {
            return errorjson(228, '没有找到章节分节符');
        }
        if (trim($contentarr[0]) == '') {
            unset($contentarr[0]);
            $contentarr = array_values($contentarr);
        }

        foreach ($subjectarr[1] as $k => $v) {
            $v = trim($v);
            file_put_contents($txtpath . "mulu.txt", $v . "\n", FILE_APPEND);
            file_put_contents($txtpath . ($k + 1) . ".txt", "{$v}\n" . $contentarr[$k]);
        }
        // rename($txt,$txt."bak");
        // 处理完毕后更新 章节数量 zjnums 和 字数
        $book = Db::name('books')->field('length,zjnums')->find($book_id);

        Db::name('books')->update(['id' => $book_id,
            'zjnums' => count($subjectarr[1]) + $book['zjnums'],
            'length' => mb_strlen($content) + $book['length']
        ]);
        return okjson();
    }

    // 章节列表
    public function zjlist()
    {
        $data = $this->request->param();
        $book_id = $data['book_id'] ?? 0;
        if ($book_id < 1 || !($bookinfo = Db::name('books')->find($book_id))) {
            return errorjson(218, '不存在该图书');
        }
        $mulufile = app()->getRootPath() . "runtime/txt/{$book_id}/mulu.txt";
        if (!is_file($mulufile)) {
            return errorjson(219, '尚无章节');
        }

        $page = (int)$data['page'] ?? 1;
        $limit = (int)$data['limit'] ?? 10;

        $start = ($page - 1) * $limit;

        $end = $start + $limit;


        $tmp = explode("\n", trim(file_get_contents($mulufile)));
        $zjlist = [];
        foreach ($tmp as $k => $v) {
            if ($k >= $start && $k < $end) {
                $zjlist[] = ['id' => $k + 1, 'name' => $v];
            }
        }
        return okjson([
            "count" => count($tmp),
            "bookinfo" => $bookinfo,
            "list" => $zjlist
        ]);
    }

    // 删除章节
    public function removezj()
    {
        $data = $this->request->param();
        if (empty($data['book_id']) || empty($data['zjid'])) {
            return errorjson(220, '参数错误');
        }
        $filepath = app()->getRootPath() . "runtime/txt/{$data['book_id']}/";
        if (!is_file($filepath . 'mulu.txt')) {
            return errorjson(221, '尚无章节,无需删除');
        }
        if (!is_file($filepath . $data['zjid'] . '.txt')) {
            return errorjson(222, '无此章节');
        }
        $tmp = explode("\n", trim(file_get_contents($filepath . 'mulu.txt')));

        foreach ($tmp as $k => $v) {
            if ($k + 1 == $data['zjid']) {
                unset($tmp[$k]);
                break;
            }
        }
        file_put_contents($filepath . 'mulu.txt', implode("\n", $tmp));
        @unlink($filepath . $data['zjid'] . '.txt');
        return okjson();
    }

    // 查看章节内容
    public function viewzj()
    {
        $data = $this->request->param();
        if (empty($data['book_id']) || empty($data['zjid'])) {
            return errorjson(223, '参数错误');
        }
        $filepath = app()->getRootPath() . "runtime/txt/{$data['book_id']}/{$data['zjid']}.txt";


        if (!is_file($filepath)) {
            return errorjson(224, '此章节未添加内容');
        }
        $txt = nl2br(file_get_contents($filepath));
        return okjson(['content' => $txt]);
    }

    // 添加章节
    public function addzj()
    {
        $data = $this->request->param();
        if (empty($data['name']) || empty($data['content']) || empty($data['book_id'])) {
            return errorjson(225, '必须填写章节名和正文内容');
        }
        $filepath = app()->getRootPath() . "runtime/txt/{$data['book_id']}/";
        if (!is_dir($filepath)) {
            mkdir($filepath, 0777);
        }
        $mulufile = $filepath . 'mulu.txt';
        if (!is_file($mulufile)) {
            touch($mulufile);
        }
        $mulu = explode("\n", trim(file_get_contents($mulufile)));
        if (count($mulu) == 1 && !trim($mulu[0])) {
            $mulu = [];
        }
        $txtfile = $filepath . (count($mulu) + 1) . '.txt';
        $mulu[] = $data['name'];
        file_put_contents($txtfile, $data['content']);
        file_put_contents($mulufile, implode("\n", $mulu));

        $bookinfo = Db::name('books')->field('zjnums,length')->find($data['book_id']);

        Db::name('books')
            ->where('id', $data['book_id'])
            ->update([
                'zjnums' => count($mulu),
                'length' => $bookinfo['length'] + mb_strlen($data['content'])
            ]);

        return okjson();
    }

    // 管理员列表
    public function adminlist()
    {
        $data = Db::name('admin')->select()->toArray();
        return okjson($data);
    }

    // 修改管理员密码
    public function editpass()
    {
        $data = $this->request->param();
        if (empty($data['id']) || empty($data['pass'])) {
            return errorjson(226, '参数错误');
        }
        $new = getpassstr($data['pass']);
        Db::name('admin')->where([
            'id' => $data['id'],
            "pass" => $new,
            'update_time' => time()
        ]);
        return okjson();

    }

    // index 首页信息
    public function getindex()
    {
        $data = [];
        $data['catenums'] = Db::name('categorys')->count();
        $data['booknums'] = Db::name('books')->count();
        $data['authornums'] = count(Db::name('books')->group('author')->field('count(id)')->select()->toArray());
        $data['zjnums'] = $this->hunman(Db::name('books')->sum('zjnums'));
        $data['zongzishu'] = $this->hunman(Db::name('books')->sum('length'));
        $data['yueduliang'] = Db::name('books')->sum('views');
        return okjson($data);
    }

    // banner list
    public function bannerlist()
    {
        $data = Db::name('banners')->select()->toArray();
        return okjson([
            "list" => $data,
            "count" => count($data)
        ]);
    }

    // 修改跳转地址
    public function editbanner()
    {
        $data = $this->request->param();
        if (empty($data['id']) || empty($data['url'])) {
            return errorjson(400, '必须填写跳转地址');
        }
        Db::name('banners')->update([
            'id' => $data['id'],
            'url' => $data['url']
        ]);
        return okjson();
    }

    // 添加一个轮播
    public function addbanner()
    {
        $data = $this->request->param();
        if (empty($data['src']) || empty($data['url'])) {
            return errorjson(400, '必须填写跳转地址和图片地址');
        }
        $id = Db::name('banners')->insertGetId([
            'pic' => $data['src'],
            'url' => $data['url']
        ]);
        if (!$id) {
            return errorjson(401, '添加轮播图失败');
        }
        return okjson();
    }

    // 删除
    public function removebanner()
    {
        $data = $this->request->param();
        if (empty($data['id'])) {
            return errorjson(400, '参数不正确');
        }
        Db::name('banners')->limit(1)->delete($data['id']);
        return okjson();
    }


    // 导入整本
    public function importtxt()
    {
        set_time_limit(0);
        try {
            $file = request()->file('txt');
        } catch (\Exception $e) {
            return errorjson(300, $e->getMessage());
        }
        if (!$file) {
            return errorjson(301, '上传失败');
        }
        $txt = $file->getOriginalName();


        // 获取书名
        $name = trim(explode('.', basename($txt), 2)[0]);
        $content = file_get_contents($file->getRealPath());
        // 获取 第一个章节前的图书信息，作者、分类、图片、简介


        $pos = mb_strpos($content, "【【");
        $metainfo = $pos <= 0 ? '' : mb_substr($content, 0, $pos);
        // 移除第一个章节前的基础信息
        if (mb_strlen($metainfo) > 0) {
            $content = mb_substr($content, $pos);
        }

        // 如果不存在图书，则获取基本信息后插入
        $book_id = Db::name('books')->where('name', $name)->value('id');
        if (!$book_id) {
            $cid = 1;

            preg_match("/作者.\s*?(\S+)\s*?/", $metainfo, $zuozhe);
            preg_match("/图片.*?(http.*\.(?:jpg|png|jpeg))\s*?/", $metainfo, $tupian);
            preg_match("/简介.\s*?(.+)/", $metainfo, $jianjie);
            preg_match("/(?:分类|类别).\s*?(.+)/", $metainfo, $fenlei);
            $fenlei = isset($fenlei[1]) ? str_replace('小说', '', $fenlei[1]) : "";
            if ($fenlei) {
                // 搜索是否有相同的分类
                $cids = (int)Db::name('categorys')->where('name', 'like', '%' . $fenlei . '%')->value('id');
                if ($cids < 1) {
                    $cids = (int)Db::name('categorys')->where('name', 'like', '%' . mb_substr($fenlei, 0, 2) . '%')->value('id');
                }
                // if($cids>0){
                $cid = $cids > 0 ? $cids : $cid;
                // }
            }

            $book_id = Db::name('books')->insertGetId([
                "name" => $name,
                "author" => isset($zuozhe[1]) ? $zuozhe[1] : "",
                "pic" => isset($tupian[1]) ? $tupian[1] : "",
                "summary" => isset($jianjie[1]) ? $jianjie[1] : "",
                "c_name" => '',
                "cid" => $cid ?? 1,
                "length" => 0
            ]);
            if ($book_id < 1) {

                return errorjson(227, "出错了");
            }
        }


        $txtpath = app()->getRootPath() . "runtime/txt/{$book_id}/";
        if (!is_dir($txtpath)) {
            mkdir($txtpath, 0777);
        }
        $content = trim($content);
        $contentarr = preg_split("/【【.*?】】/ism", $content);
        preg_match_all("/【【(.*?)】】/ism", $content, $subjectarr);
        if (!isset($subjectarr[1])) {
            $contentarr = preg_split("/^\s*?.*?第.*?章.*?$/im", $content);
            preg_match_all("/^\s*?.*?第.*?章.*?$/im", $content, $subjectarr);
        }
        if (!isset($subjectarr[1])) {
            return errorjson(228, '没有找到章节分节符');
        }
        if (trim($contentarr[0]) == '') {
            unset($contentarr[0]);
            $contentarr = array_values($contentarr);
        }
        // 先清空目录
        file_put_contents($txtpath . "mulu.txt", "");
        foreach ($subjectarr[1] as $k => $v) {
            $v = trim($v);
            file_put_contents($txtpath . "mulu.txt", $v . "\n", FILE_APPEND);
            file_put_contents($txtpath . ($k + 1) . ".txt", "{$v}\n" . $contentarr[$k]);

        }
        // 处理完毕后更新 章节数量 zjnums 和 字数
        Db::name('books')->update(['id' => $book_id, 'length' => mb_strlen($content), 'zjnums' => count($subjectarr[1])]);
        return okjson();
    }


    private function hunman($num)
    {
        if ($num < 10000) {
            return $num;
        }
        if ($num < 100000000) {
            return round($num / 10000, 2) . "万";
        }
        return round($num / 100000000, 2) . '亿';
    }


}
