<?php
// 应用公共文件

function responsedata($data = [], $status = 0, $msg = 'ok')
{
    if (!is_array($data)) {
        return json(["status" => $data === null ? 999 : $data, "msg" => $status]);
    }
    return json(
        [
            "status" => $status,
            "msg" => $msg,
            "data" => $data ?? []
        ]
    );
}

// 失败响应
function errorjson($status, $msg)
{
    return json(
        [
            "status" => $status,
            "msg" => $msg
        ]
    );
}

// 成功响应
function okjson($data = [], $status = 0, $msg = 'ok')
{
    if (isset($data['extra'])) {
        unset($data['extra']);
        $data['status'] = $status;
        $data['msg'] = $msg;
        return json($data);
    }
    return json(
        [
            "status" => $status,
            "msg" => $msg,
            "data" => $data
        ]
    );
}

//后端admin登录 生成token
function createJwt($userid)
{
    $key = md5('adsga#@!'); //jwt的签发密钥，验证token的时候需要用到
    $time = time(); //签发时间
    $expire = $time + 86400; //过期时间
    $token = array(
        "userid" => $userid,
        "iss" => "http://bapp.wonyes.org",//签发组织
        "aud" => "admin", //签发作者
        "iat" => $time,
        "nbf" => $time,
        "exp" => $expire
    );
    $jwt = \Firebase\JWT\JWT::encode($token, $key, 'HS256');
    return $jwt;
}

function verifyJwt($jwt = '')
{
    $key = md5('adsga#@!');
    try {
        $jwtAuth = json_encode(\Firebase\JWT\JWT::decode($jwt, new \Firebase\JWT\Key($key, 'HS256')));
        $authInfo = json_decode($jwtAuth, true);

        $msg = [];
        if (!empty($authInfo['userid'])) {
            return $authInfo;
        }


        return 'Token验证不通过,用户不存在';

    } catch (\Firebase\JWT\ExpiredException $e) {
        return 'Token过期';


    } catch (\Exception $e) {
        return 'Token无效';

    }
}

// app登录
function createJwtMember($userid)
{
    $key = md5('234aef1$ae#@!'); //jwt的签发密钥，验证token的时候需要用到
    $time = time(); //签发时间
    $expire = $time + 86400; //过期时间
    $token = array(
        "userid" => $userid,
        "iss" => "http://bapp.wonyes.org",//签发组织
        "aud" => "admin", //签发作者
        "iat" => $time,
        "nbf" => $time,
        "exp" => $expire
    );
    $jwt = \Firebase\JWT\JWT::encode($token, $key, 'HS256');
    return $jwt;
}

//校验jwt权限API
function verifyJwtMember($jwt = '')
{
    $key = md5('234aef1$ae#@!');
    try {
        $jwtAuth = json_encode(\Firebase\JWT\JWT::decode($jwt, new \Firebase\JWT\Key($key, 'HS256')));
        $authInfo = json_decode($jwtAuth, true);

        $msg = [];
        if (!empty($authInfo['userid'])) {
            return $authInfo;
        }


        return 'Token验证不通过,用户不存在';

    } catch (\Firebase\JWT\ExpiredException $e) {
        return 'Token过期';


    } catch (\Exception $e) {
        return 'Token无效';

    }
}

function getpassstr($code)
{
    return sha1(md5($code) . sha1($code));
}