<?php

namespace app\api\controller\v1;

use app\BaseController;
use app\model\Banners;

class Banner extends BaseController
{
    // 获取 banner
    public function get()
    {
        return responsedata(Banners::select()->toArray());
    }
}