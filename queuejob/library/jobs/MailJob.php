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