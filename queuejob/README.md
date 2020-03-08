# 基于think-queue的消息队列管理

## 功能介绍
> 集成think-queue至FastAdmin，让FastAdmin支持执行异步任务，同时起到一定的削峰填谷的作用。

## 安装
```
composer require topthink/think-queue
```
安装后在`application/extra`下将产生一个queue.php配置文件

配置说明可参考：
[think-queue官网](https://github.com/top-think/think-queue)

在`addons/queuejob/library/jobs/`下创建任务类，本插件已集成**邮件发送任务类**

```php
<?php

namespace addons\queuejob\library\jobs;

use think\queue\Job;
use think\Log;

class MailJob {
    protected $debug = true;

    /**
     * fire方法是消息队列默认调用的方法
     * @param Job            $job      当前的任务对象
     * @param array|mixed    $data     发布任务时自定义的数据
     */
    public function fire(Job $job, $data) {
        $this->debuglog($data);
        
        //扩展初始化配置参数
        $params = (isset($data['params']) && is_array($data['params'])) ? $data['params'] : [];
        
        $email = new \app\common\library\Email($params);
        
        $addresses = [];
        $mail_data = $data['mail'];
        
        if(is_string($mail_data['to'])){
            $addresses[] = $mail_data['to'];
        }else{
            $addresses = $mail_data['to'];
        }
        
        $ishtml = isset($mail_data['ishtml']) ? $mail_data['ishtml'] : false;
        
        $from_name = isset($mail_data['from_name']) ? $mail_data['from_name'] : '';
        if(isset($mail_data['from'])){
            $email->from($mail_data['from'], $from_name);
        }
        
        $this->debuglog("Sending mail to: " . $mail_data['to']);
        $result = $email->to($mail_data['to'])->subject($mail_data['subject'])->message($mail_data['body'], $ishtml)->send();  
        $this->debuglog("Result of send mail: ". $email->getError());
        
        if ($result) {
            $job->delete();
        }else{
            Log::write(['data'=>$data, 'error_msg'=>$email->getError()]);
            if ($job->attempts() > 3) {
                //任务已经重试3次后，放弃发送
                $job->delete();
             }
        }
        return;
    }
    
    protected function debuglog($msg){
        if($this->debug){
            Log::write($msg, 'DEBUG');
        }
    }

}
```

# 启动队列
- 方式1：通过命令行指令，可查询think-queue支持的命令（适合测试）
```bash
//执行队列里的第一个任务
php think queue:work
```

- 方式2：使用提供的脚本`watchdog.sh`, 常驻后台监听队列的任务

# 添加任务至队列的原理
1. 基于thinkphp的hooks机制，以发送邮件的任务为例，修改`addons/queuejob/Queuejob.php`,添加钩子方法「sendMail」
```php
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
```

2. 手动更新`application/extra/addons.php`或通过后台启停插件的方式刷新addons.php，达到钩子注册并监听的目的。

3. 触发钩子
```php
hook("send_mail", $mail_data);
```