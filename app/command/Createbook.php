<?php

declare(strict_types=1);

namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\facade\Db;
ini_set('memory_limit','512M');


class Createbook extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('makebook')
            ->setDescription('the makebook command');
    }

    protected function execute(Input $input, Output $output)
    {
        // 在 runtime/oldbook/书名.txt
        $list =(array) glob(app()->getRootPath() . "runtime/oldbook/*.txt");
        $list2=(array)glob(app()->getRootPath() . "runtime/oldbook/*/*.txt");
        if($list2){
            array_push($list,...$list2);
        }
        
        
        while($list){
            $this->chuli(array_pop($list));
        }
        // foreach ($list as $v) {
            
        // }
        // 指令输出
       // $output->writeln('makebook');
    }
    
        protected function chuli($txt)
    {
        // 获取书名
        $name = trim(explode('.', basename($txt), 2)[0]);
        $content=file_get_contents($txt);
        // 获取 第一个章节前的图书信息，作者、分类、图片、简介
        
        
        $pos=mb_strpos($content,"【【");
        $metainfo=$pos<=0?'':mb_substr($content,0,$pos);
        // 移除第一个章节前的基础信息
        if(mb_strlen($metainfo)>0){
            $content=mb_substr($content,$pos);
        }
        
        // 如果不存在图书，则获取基本信息后插入
        $book_id = Db::name('books')->where('name', $name)->value('id');
        if (!$book_id) {
            preg_match("/作者.\s*?(\S+)\s*?/",$metainfo,$zuozhe);
            preg_match("/图片.*?(http.*\.(?:jpg|png|jpeg))\s*?/",$metainfo,$tupian);
            preg_match("/简介.\s*?(.+)/",$metainfo,$jianjie);
            preg_match("/(?:分类|类别).\s*?(.+)/",$metainfo,$fenlei);
            $book_id=Db::name('books')->insertGetId([
                "name"=>$name,
                "author"=>isset($zuozhe[1])?$zuozhe[1]:"",
                "pic"=>isset($tupian[1])?$tupian[1]:"",
                "summary"=>isset($jianjie[1])?$jianjie[1]:"",
                "c_name"=>isset($fenlei[1])?str_replace('小说','',$fenlei[1]):"",
                "length"=>mb_strlen($content)
            ]);
            if($book_id<1){
                print_r("插入图书出错了");
                return "出错了";
            }
        }

        echo "\nname={$name}";
        echo "\nbook_id={$book_id}";
        echo "\nmetainfo={$metainfo}";


        $txtpath=app()->getRootPath()."runtime/txt/{$book_id}/";
        if(!is_dir($txtpath)){
            mkdir($txtpath,0777);
        }
        $content=trim($content);
        $contentarr=preg_split("/【【.*?】】/ism",$content);
        preg_match_all("/【【(.*?)】】/ism",$content,$subjectarr);
        if(!isset($subjectarr[1])){
            return '没有找到章节分节符';
        }
        if(trim($contentarr[0])==''){
        	unset($contentarr[0]);
        	$contentarr=array_values($contentarr);
        }
        
        
        
        foreach($subjectarr[1] as $k=>$v){
            $v=trim($v);
                    file_put_contents($txtpath."mulu.txt",$v."\n",FILE_APPEND);
        			file_put_contents($txtpath.($k+1).".txt","{$v}\n".$contentarr[$k]);
        			
        }
        rename($txt,$txt."bak");
        // 处理完毕后更新 章节数量 zjnums 和 字数
        Db::name('books')->update(['id'=>$book_id,'zjnums'=>count($subjectarr[1])]);
    }


    protected function chuliold($txt)
    {
        // 获取书名
        $name = trim(explode('.', basename($txt), 2)[0]);
        $content=file_get_contents($txt);
        // 获取 第一个章节前的图书信息，作者、分类、图片、简介
        $pos=mb_strpos($content,"【【");
        $metainfo=$pos<=0?'':mb_substr($content,0,$pos-1);
        // 移除第一个章节前的基础信息
        if(mb_strlen($metainfo)>0){
            $content=mb_substr($content,$pos-1);
        }
        // 如果不存在图书，则获取基本信息后插入
        $book_id = Db::name('books')->where('name', $name)->value('id');
        if (!$book_id) {
            preg_match("/作者.\s*?(\S+)\s*?/",$metainfo,$zuozhe);
            preg_match("/图片.*?(http.*\.(?:jpg|png|jpeg))\s*?/",$metainfo,$tupian);
            preg_match("/简介.\s*?(.+)/",$metainfo,$jianjie);
            preg_match("/(?:分类|类别).\s*?(.+)/",$metainfo,$fenlei);
            $book_id=Db::name('books')->insertGetId([
                "name"=>$name,
                "author"=>isset($zuozhe[1])?$zuozhe[1]:"",
                "pic"=>isset($tupian[1])?$tupian[1]:"",
                "summary"=>isset($jianjie[1])?$jianjie[1]:"",
                "c_name"=>isset($fenlei[1])?str_replace('小说','',$fenlei[1]):"",
                "length"=>mb_strlen($content)
            ]);
            if($book_id<1){
                print_r("插入图书出错了");
                return "出错了";
            }
        }

        echo "\nname={$name}";
        echo "\nbook_id={$book_id}";
        echo "\nmetainfo={$metainfo}";

        
        // 按行获取数组
        $content=explode("\n",$content);
        $index=0;
        $str='';
        $txtpath=app()->getRootPath()."runtime/txt/{$book_id}/";
        if(!is_dir($txtpath)){
            mkdir($txtpath,0777);
        }
        // print_r($content);exit;
        echo "\n0=".$content[0];
        echo "\n1=".$content[1];
        // echo preg_match('/【/',$content[0]);
        foreach($content as $k=>$v){
            if(!trim($v)){
                continue;
            }
            // echo "$v";
            // 匹配章节符
            if( preg_match("/^\s*?【【.+?】】\s*?$/",trim($v)) ){
                $v=trim($v);
                // 一开始 str==''
                $v=preg_replace('/【|】/ism','',$v);
                // break;
                if($str==''){
                    $str=$v."\n";
                    file_put_contents($txtpath."mulu.txt",$v."\n",FILE_APPEND);
                    continue;
                }
                    
                $index++;
                // 否则是一章的结束，保存
                file_put_contents($txtpath."{$index}.txt",$str);
                file_put_contents($txtpath."mulu.txt",$v."\n",FILE_APPEND);
                $str=$v."\n";
            }else{
                $str.=$v;
            }
        }
        rename($txt,$txt."bak");
        // 处理完毕后更新 章节数量 zjnums 和 字数
        Db::name('books')->update(['id'=>$book_id,'zjnums'=>$index]);
    }
}
