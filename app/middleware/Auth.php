<?php
namespace app\middleware;


class Auth
{
    public function handle($request, \Closure $next)
    {
        $token=$request->param('token','');
        if(!$token || !is_array($res=verifyJwt($token))){
            echo json_encode([
               "status"=>2001,
               "msg"=>"登录失效，请重新登录"
            ]);
            exit;
        }
                
        $request->userid =$res['userid'];
        $request->token=createJwt($res['userid']);
        
        return $next($request);
    }
        

}