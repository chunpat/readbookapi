<?php
namespace app\validate;

use think\Validate;

class Adminlogin extends Validate
{
    protected $rule =   [
        'username'  => 'require|length:3,12',
        'password'   => 'require',
        'token'=>'require',
        'userid'=>'require|number',
        'catename'=>'require',
        'cateid'=>'require|number'
        
    ];
    
    protected $message  =   [
        'username.require' => '必须填写用户名',
        'username.length'     => '用户名长度在3-12之间',
        'password.require'   => '必须填写密码' ,
        'token'=>"缺少参数",
        'userid.require'=>'不存在userid参数',
        'userid.number'=>"userid参数必须为数字",
        'catename'=>'必须填写分类名字',
        'cateid.require'=>'必须填写分类id',
        'cateid.number'=>'分类id必须是数字'
        
    ];
    
    protected $scene = [
        'login'  =>  ['username','password'],
        'check'=>['token','userid'],
        'addcate'=>['catename'],
        'removecate'=>['cateid']
    ];    


}