<?php

namespace addons\queuejob;

use app\common\library\Menu;
use think\Addons;
use think\Queue;

/**
 * 插件
 */
class Queuejob extends Addons
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
     * 实现钩子方法-发送邮件
     * $param['mail']['to']可以是array或者string，array表示多个收件人
     * @return mixed
     */
    public function sendMail($param)
    {
        $delay = 3;
        $job = "addons\queuejob\library\jobs\MailJob";
        $isValid = true;
        
        //验证数据合法性
        if(!isset($param['mail']) || !isset($param['mail']['to'])){
            $isValid = false;
        }else if(!isset($param['mail']['subject']) || !isset($param['mail']['body'])){
            $isValid = false;
        }else if(!is_string($param['mail']['to']) && !is_array($param['mail']['to'])){
            $isValid = false;
        }
        
        if($isValid && is_array($param['mail']['to'])){
            $addresses = $param['mail']['to'];
            foreach($addresses as $address){
                $address = trim($address);
                if(!empty($address)){
                    $param['mail']['to'] = $address;
                    Queue::later($delay, $job, $param);
                }
            }
        }else if($isValid){
            Queue::later($delay, $job, $param);
        }
        
        return true;
    }

}
