<?php

namespace addons\fbcustomerchat;

use app\common\library\Menu;
use think\Addons;

/**
 * 插件
 */
class Fbcustomerchat extends Addons
{

    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
        
        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {
        
        return true;
    }

    /**
     * 插件启用方法
     * @return bool
     */
    public function enable()
    {
        
        return true;
    }

    /**
     * 插件禁用方法
     * @return bool
     */
    public function disable()
    {
        
        return true;
    }

    /**
     * 实现钩子方法
     * @return mixed
     */
    public function fbchatInit($param)
    {
        //print_r($this->getConfig());
        $config = $this->getConfig();
        
        if(is_array($config) ){
            $data['fbchat'] = $config;
        }
        
        if(isset($param['config']) && is_array($param['config'])){
            $data['fbchat'] = array_merge($data['fbchat'], $param['config']);
        }
        
        return $this->fetch('view/customer_chat_script', $data);
    }

}
