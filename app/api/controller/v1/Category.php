<?php

namespace app\api\controller\v1;

use app\BaseController;
use app\model\Books;
use app\model\Categorys;
use think\facade\Cache;

class Category extends BaseController
{
    public function listOld()
    {
        return responsedata(Books::field("c_name as name,count(id) as count")
            ->group("c_name")
            ->select()
            ->toArray());
    }

    public function list()
    {
        $cates = $this->getAllcates();
        $data = Books::field("cid,count(id) as count")
            ->group("cid")->select()->toArray();
        foreach ($data as $k => $v) {
            $data[$k]['name'] = $cates[$v['cid']];
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
}