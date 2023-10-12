<?php

namespace app\middleware;

class MemberAuth
{
    public function handle($request, \Closure $next)
    {
        $token = $request->param('token', '');
        if (!$token || !is_array($res = verifyJwtMember($token))) {
            echo json_encode([
                "status" => 2001,
                "msg" => "登录失效，请重新登录"
            ]);
            exit;
        }

        $request->userid = $res['userid'];
        $request->token = createJwtMember($res['userid']);

        return $next($request);
    }


}