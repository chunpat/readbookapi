<?php
/**
后台管理员登录
*/
namespace app\controller;

use app\BaseController;
use think\facade\Db;



class Member extends BaseController
{
    protected $middleware = [ 
    	'memberauth' 	=> ['except' 	=> ['login'] ]
    ];
    // 这个无需token验证，其他都需要
    public function login(){
        $data=$this->request->param();
       
        if(empty($data['username']) || empty($data['password'])){
            return errorjson(103,'必须填写用户名和密码');    
        }
        $has=Db::name('members')->where('username',$data['username'])->find();
        
        if(!$has){
            $has=["username"=>$data['username']];
            $has['id']=Db::name('members')->insertGetId([
                "username"=>$data['username'],
                "password"=>getpassstr($data['password'])
            ]);
            if(!$has['id']){
                return errorjson(101,'不存在该用户，自动注册失败');
            }
        }else if($has['password']!=getpassstr($data['password'])){
            return errorjson(102,'密码不正确');
        }
        
        // $userid=$has['id'];
        unset($has['password']);
        $jwt=createJwtMember($has['id']);
        return okjson([
            "userinfo"=>$has,
            "token"=>$jwt
        ]);
    }
    
    // 上传头像
    public function uploadavatar(){
        $file=request()->file('file');
        $data=request()->param();
        if(!in_array($file->extension(),['jpg','jpeg','png','gif'])){
            return errorjson(210,"只可上传图片形式");
        }
        $savename=\think\facade\Filesystem::disk('public')->putFile( 'topic', $file);
        $src=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/storage/'.$savename;
        if($data['userid']){
            Db::name('members')->update([
               "id"=>$data['userid'],
               "avatar"=>$src
            ]);
        }
        return okjson(['src'=>$src]);
    }
    // 修改密码
    public function editpass(){
        $data=$this->request->param();
        if(!$data['oldpass']||!$data['newpass']){
            return errorjson(201,'新旧密码均需要填写');
        }
        if($data['oldpass']==$data['newpass']){
            return errorjson(202,'新旧密码相同');
            
        }
        $has=Db::name('members')->find($data['userid']);
        
        if(!$has){
            return errorjson(203,'该用户不存在或已删除');
        }
        if($has['password']!=getpassstr($data['oldpass'])){
            return errorjson(204,'旧密码不正确');
        }
        Db::name('members')->update([
           'id'=>$data['userid'],
           "password"=>getpassstr($data['newpass']),
           "update_time"=>date('Y-m-d H:i:s')
        ]);
        return okjson();
    }
}
