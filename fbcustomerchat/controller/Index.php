<?php

namespace addons\fbcustomerchat\controller;

use think\addons\Controller;

class Index extends Controller
{

    public function index()
    {
        //$this->error("当前插件暂无前台页面");
        $config = get_addon_config("fbcustomerchat");
        $this->assign('addon_config', $config);
        return $this->fetch();
    }

}
