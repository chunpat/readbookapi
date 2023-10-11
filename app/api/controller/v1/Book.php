<?php

namespace app\api\controller\v1;

use app\BaseController;
use app\model\Books;
use app\model\Categorys;
use think\facade\Cache;
use think\Request;

class Book extends BaseController
{
    public function getListByTime($page = 1, $size = 20)
    {
        $data = Books::order('update_time desc')->limit(($page - 1) * $size, $size)->select()->toArray();
        foreach ($data as $k => $v) {
            $data[$k]['c_name'] = $this->getAllcates($v['cid']);
        }
        return responsedata($data);
    }

    // 获取分类数据，或者根据cid获取分类名字
    private function getAllcates($cid = 0)
    {
        if (!$cates = Cache::get('allcategorys')) {
            Cache::set('allcategorys', Categorys::column('name', 'id'), 86400);
        }
        return $cid > 0 ? $cates[$cid] : $cates;
    }

    // 获取排行
    public function getListByRank($type = 'create_time', $page = 1, $size = 20)
    {
        if ($type == 'status') {
            $data = Books::where('status', $type)->order('views desc')->limit(($page - 1) * $size, $size)->select()->toArray();
        } else {
            $data = Books::order($type . ' desc')->limit(($page - 1) * $size, $size)->select()->toArray();
        }
        foreach ($data as $k => $v) {
            $data[$k]['c_name'] = $this->getAllcates($v['cid']);
        }
        return responsedata($data);
    }

    // 根据分类名字获取图书列表
    public function getListByCategory($c_name = '', $page = 1, $size = 20)
    {
        if (preg_match('/^\d+$/', $c_name)) {
            $cid = $c_name;
        } else {
            $cid = Categorys::where('name', 'like', '%' . mb_substr($c_name, 0, 2) . '%')->value('id');
        }

        if (!$cid) {
            return errorjson(1001, '没有小说了');
        }

        $data = Books::where('cid', $cid)->order('views desc')->limit(($page - 1) * $size, $size)->select()->toArray();
        foreach ($data as $k => $v) {
            $data[$k]['c_name'] = $this->getAllcates($v['cid']);
        }
        return responsedata($data);
    }

    // 根据分类id
    public function getListByCid($cid = 0, $page = 1, $size = 20)
    {
        $page = (int)$page;
        $data = Books::where('cid', $cid)->order('views desc')->limit(($page - 1) * $size, $size)->select()->toArray();
        foreach ($data as $k => $v) {
            $data[$k]['c_name'] = $this->getAllcates($v['cid']);
        }
        return responsedata($data);
    }

    // 获取阅读量倒序的图书列表
    public function getListByViews($page = 1, $size = 20)
    {
        $data = Books::order('views desc')->limit(($page - 1) * $size, $size)->select()->toArray();
        foreach ($data as $k => $v) {
            $data[$k]['c_name'] = $this->getAllcates($v['cid']);
        }
        return responsedata($data);
    }

    // 更新阅读量
    public function updateViews()
    {
        $book_id = (int)$this->request->param('book_id', 0);
        if ($book_id > 0) {
            Books::where('id', $book_id)->inc('views')->update();
        }
        return okjson();
    }

    // 根据连载 完结状态获取图书列表
    public function getListByStatus($status = 0, $page = 1, $size = 20)
    {
        $data = Books::where('status', $status)->order('views desc')->limit(($page - 1) * $size, $size)->select()->toArray();
        foreach ($data as $k => $v) {
            $data[$k]['c_name'] = $this->getAllcates($v['cid']);
        }
        return responsedata($data);
    }

    // 搜索 完结状态获取图书列表
    public function search($keyword = 0, $page = 1, $size = 20)
    {
        $data = Books::where('name', 'like', '%' . $keyword . '%')->order('views desc')->limit(($page - 1) * $size, $size)->select()->toArray();
        if (!$data) {
            return responsedata(202, '没找到相关小说');
        }
        foreach ($data as $k => $v) {
            $data[$k]['c_name'] = $this->getAllcates($v['cid']);
        }
        return responsedata(['books' => $data, 'count' => count($data)]);
    }

    // 根据id， 获取单本图书的信息
    public function getInfo($book_id = 0)
    {
        $data = Books::find($book_id);
        // 存在数据，则再去获取章节目录列表
        if (!$data) {
            return responsedata(201, '不存在该图书');
        }
        $mulu = app()->getRootPath() . "runtime/txt/{$book_id}/mulu.txt";
        if (is_file($mulu)) {
            $data['zjlist'] = explode("\n", trim(file_get_contents($mulu)));
        }
        $data['c_name'] = $this->getAllcates($data['cid']);
        return responsedata($data);
    }

    // 根据 book_id 和 article_id 获取章节正文数据
    public function getContent(Request $request)
    {
        $bookId = $request->post('book_id');
        $index = $request->post('index');
        $txt = app()->getRootPath() . "runtime/txt/{$bookId}/{$index}.txt";
        if (!is_file($txt)) {
            return responsedata(202, "不存在该章节");
        }
        return responsedata(["content" => nl2br(trim(file_get_contents($txt)))]);
    }

    // 解析gbk文件
    public function parse()
    {
        $file = request()->file('file');
        // echo $file->extension();
        if ($file->extension() != 'txt') {
            return json(["status" => 400, "msg" => "只可上传txt文件"]);
        }
        $name = substr($file->getOriginalName(), 0, "-4");

        $obj = $file->openFile();
        $d = $obj->fread(300);
        $string = "";
        if (mb_detect_encoding($d, "UTF-8, ISO-8859-1, GBK") != 'UTF-8') {
            while (!$obj->eof()) {
                $string .= mb_convert_encoding($obj->fgets(), "UTF-8", ["GB2312", "GBK"]);
            }
        } else {
            $string = file_get_contents($file->getRealPath());
        }
        return $this->chuli($name, $string);
        // var_dump($obj);
        // echo $file->fread(300);
        // dd($file);
    }

    private function chuli($name, $content)
    {
        // 按行获取数组
        $content = explode("\n", trim($content));
        $index = 0;
        $str = '';
        $data = [
            "subject" => [],
            "content" => []
        ];

        foreach ($content as $k => $v) {
            if (!trim($v)) {
                continue;
            }
            // 匹配章节符
            if (preg_match("/^\s*?【.*?第.*?章.*】\s*?$/is", $v)) {
                // 一开始 str==''
                $v = preg_replace('/【|】/', '', $v);

                if ($k == 0) {
                    $data['content'][$index] = $v;
                    $data['subject'][$index] = trim($v);
                    //file_put_contents($txtpath."mulu.txt",trim($v)."\n",FILE_APPEND);
                } else {
                    $index++;
                    $data['subject'][$index] = trim($v);
                    $data['content'][$index] = $v;
                }

            } else {
                $data['content'][$index] .= $v;
            }
        }
        return responsedata($data);
        // 处理完毕后更新 章节数量 zjnums 和 字数
    }
}