<?php
/**
app接口文件
*/
namespace app\controller;

use app\BaseController;
use app\model\Books;
use think\facade\Db;
use think\facade\Cache;
use think\Request;
use think\Response;

class Api extends BaseController
{
    // 获取 banner
    public function getbanner(){
        $data=Db::name('banners')->select()->toArray();
        return responsedata($data);
    }
    
    // 获取分类
    /**
    */
    public function categorylistold()
    {
        $data = (new Books())->field("c_name as name,count(id) as count")
            ->group("c_name")
            ->select()
            ->toArray();
//        $data=Db::name('books')->group("c_name")->field("c_name as name,count(id) as count")->select()->toArray();
        return responsedata($data);
    }
    public function categorylist()
    {
        try {
            $cates=$this->getallcates();
            $data=Db::name('books')->group("cid")->field("cid,count(id) as count")->select()->toArray();
            foreach ($data as $k=>$v){
                $data[$k]['name']=$cates[$v['cid']];
            }
        } catch (\Exception $e) {
            return responsedata(1, '获取分类数据出错了');
        }
        
        return responsedata($data);
    }
    // 获取分类数据，或者根据cid获取分类名字
    private function getallcates($cid=0){
        if(!$cates=Cache::get('allcategorys')){
            $cates=Db::name('categorys')->column('name','id');
            Cache::set('allcategorys', $cates, 86400);
        }
        return $cid>0?$cates[$cid]:$cates;
    }
    
    // 获取最新图书
    public function getbooklistbytime($page=1,$size=20){
        $data=Db::name('books')->order('update_time desc')->limit(($page-1)*$size, $size)->select()->toArray();
        foreach ($data as $k=>$v){
            $data[$k]['c_name']=$this->getallcates($v['cid']);
        }
        return responsedata($data);
    }
    // 获取排行
    public function getbooklistbyrank($type='create_time',$page=1,$size=20){
        if($type=='status'){
            $data=Db::name('books')->where('status', $type)->order('views desc')->limit(($page-1)*$size, $size)->select()->toArray();
        }else{
            $data=Db::name('books')->order($type.' desc')->limit(($page-1)*$size, $size)->select()->toArray();
        }
        foreach ($data as $k=>$v){
            $data[$k]['c_name']=$this->getallcates($v['cid']);
        }
        return responsedata($data);
    }
    
    // 根据分类名字获取图书列表
    public function getbooklistbycategory($c_name='', $page=1, $size=20)
    {
        try {
            if(preg_match('/^\d+$/',$c_name)){
                $cid=$c_name;
            }else{
                $cid=Db::name('categorys')->where('name','like','%'.mb_substr($c_name,0,2).'%')->value('id');
            }
            
            if(!$cid){
                return errorjson(1001,'没有小说了');
            }
            
            $data=Db::name('books')->where('cid', $cid)->order('views desc')->limit(($page-1)*$size, $size)->select()->toArray();
            foreach ($data as $k=>$v){
                $data[$k]['c_name']=$this->getallcates($v['cid']);
            }
        } catch (\Exception $e) {
            return responsedata(1, '获取图书数据出错了');
        }
        
        return responsedata($data);
    }
    // 根据分类id
    public function getbooklistbycid($cid=0, $page=1, $size=20)
    {
        try {
            $page=(int)$page;
            $data=Db::name('books')->where('cid', $cid)->order('views desc')->limit(($page-1)*$size, $size)->select()->toArray();
            foreach ($data as $k=>$v){
                $data[$k]['c_name']=$this->getallcates($v['cid']);
            }
        } catch (\Exception $e) {
            return responsedata(1, '获取图书数据出错了'.$e->getMessage());
        }
        
        return responsedata($data);
    }
    
    // 获取阅读量倒序的图书列表
    public function getbooklistbyviews($page=1, $size=20)
    {
        try {
            $data=Db::name('books')->order('views desc')->limit(($page-1)*$size, $size)->select()->toArray();
            foreach ($data as $k=>$v){
                $data[$k]['c_name']=$this->getallcates($v['cid']);
            }
        } catch (\Exception $e) {
            return responsedata(1, '获取图书数据出错了');
        }
        
        return responsedata($data);
    }
    // 更新阅读量
    public function updateviews(){
        $book_id=(int)$this->request->param('book_id',0);
        if($book_id>0){
            Db::name('books')->where('id',$book_id)->inc('views')->update();
        }
        return okjson();
    }
    
    // 根据连载 完结状态获取图书列表
    public function getbooklistbystatus($status=0, $page=1, $size=20)
    {
        try {
            $data=Db::name('books')->where('status', $status)->order('views desc')->limit(($page-1)*$size, $size)->select()->toArray();
            foreach ($data as $k=>$v){
                $data[$k]['c_name']=$this->getallcates($v['cid']);
            }
        } catch (\Exception $e) {
            return responsedata(1, '获取图书数据出错了');
        }
        
        return responsedata($data);
    }
    
    // 搜索 完结状态获取图书列表
    public function search($keyword=0, $page=1, $size=20)
    {
        try {
            $data=Db::name('books')->where('name','like', '%'.$keyword.'%')->order('views desc')->limit(($page-1)*$size, $size)->select()->toArray();
            if(!$data){
                return responsedata(202,'没找到相关小说');
            }
            foreach ($data as $k=>$v){
                $data[$k]['c_name']=$this->getallcates($v['cid']);
            }
        } catch (\Exception $e) {
            return responsedata(1, '获取图书数据出错了');
        }
        
        return responsedata(['books'=>$data,'count'=>count($data)]);
    }
    // 根据id， 获取单本图书的信息
    public function getbookinfo($book_id=0)
    {
        try {
            $data=Db::name('books')->find($book_id);
            // 存在数据，则再去获取章节目录列表
            if (!$data) {
                return responsedata(201, '不存在该图书');
            }
            $mulu=app()->getRootPath()."runtime/txt/{$book_id}/mulu.txt";
            if(is_file($mulu)){
                $data['zjlist']=explode("\n",trim(file_get_contents($mulu)));
            }
            $data['c_name']=$this->getallcates($data['cid']);
        } catch (\Exception $e) {
            return responsedata(1, '获取图书数据出错了'.$e->getMessage());
        }
        
        return responsedata($data);
    }
    
    // 根据 book_id 和 article_id 获取章节正文数据
    public function getcontent(Request $request)
    {
        $bookId = $request->post('book_id');
        $index = $request->post('index');
        $txt=app()->getRootPath()."runtime/txt/{$bookId}/{$index}.txt";
        if (!is_file($txt)) {
            return responsedata(202, "不存在该章节");
        }
        return responsedata(["content"=>nl2br(trim(file_get_contents($txt)))]);
    }

    // 解析gbk文件
    public function bookparse(){
        $file=request()->file('file');
        // echo $file->extension();
        if($file->extension()!='txt'){
            return json(["status"=>400,"msg"=>"只可上传txt文件"]);
        }
        $name=substr($file->getOriginalName(),0,"-4");
        
        $obj= $file->openFile();
        $d=$obj->fread(300);
        $string="";
        if(mb_detect_encoding($d,"UTF-8, ISO-8859-1, GBK")!='UTF-8'){
            while (!$obj->eof()) {
                $string.=mb_convert_encoding($obj->fgets(),"UTF-8",["GB2312","GBK"]);
            }
        }else{
            $string=file_get_contents($file->getRealPath());
        }
        return $this->chuli($name,$string);
        // var_dump($obj);
        // echo $file->fread(300);
        // dd($file);
    }
    
    private function chuli($name,$content)
    {
        // 按行获取数组
        $content=explode("\n",trim($content));
        $index=0;
        $str='';
        $data=[
            "subject"=>[],
            "content"=>[]
        ];
       
        foreach($content as $k=>$v){
            if(!trim($v)){
                continue;
            }
            // 匹配章节符
            if(preg_match("/^\s*?【.*?第.*?章.*】\s*?$/is",$v)){
                // 一开始 str==''
                $v=preg_replace('/【|】/','',$v);
                
                if($k==0){
                    $data['content'][$index]=$v;
                    $data['subject'][$index]=trim($v);
                    //file_put_contents($txtpath."mulu.txt",trim($v)."\n",FILE_APPEND);
                }else{
                    $index++;
                    $data['subject'][$index]=trim($v);
                    $data['content'][$index]=$v;
                }
               
            }else{
                $data['content'][$index].=$v;
            }
        }
        return responsedata($data);
        // 处理完毕后更新 章节数量 zjnums 和 字数
        //Db::name('books')->update(['id'=>$book_id,'zjnums'=>$index]);
    }
    
}
