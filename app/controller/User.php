<?php
/**
后台管理员登录
*/
namespace app\controller;

use app\BaseController;
use think\facade\Db;
use app\validate\Adminlogin;
use think\exception\ValidateException;



class User extends BaseController
{
    public function login(){
        $data=$this->request->param();
        try {
            validate(Adminlogin::class)->scene('login')->check($data);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            // exit($e->getMessage());
            return errorjson(100, $e->getMessage());
        }
        $has=Db::name('admin')->where('name',$data['username'])->find();
        if(!$has){
            return errorjson(101,'不存在该用户');
        }
        if($has['pass']!=getpassstr($data['password'])){
            return errorjson(102,'密码不正确');
        }
        $userid=$has['id'];
        $jwt=createJwt($userid);
        return okjson([
            "userid"=>$userid,
            "token"=>$jwt
        ]);
    }
    
    public function check(){
        $data=$this->request->param();
        try {
            validate(Adminlogin::class)->scene('check')->check($data);
            $res=verifyJwt($data['token']);
            if(!is_array($res)){
                return errorjson(103,$res);
            }
            $userid=$data['userid'];
            $jwt=createJwt($userid);
            return okjson([
                "userid"=>$userid,
                "token"=>$jwt
            ]);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            // exit($e->getMessage());
            return errorjson(104, $e->getMessage());
        }
        
    }
    
}
