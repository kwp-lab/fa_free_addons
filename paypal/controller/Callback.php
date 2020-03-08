<?php
namespace addons\paypal\controller;

use think\addons\Controller;
use think\Log;
use think\Hook;
use addons\paypal\library\PaypalIPN;

class Callback extends Controller
{

    /**
     * 接收即时付款通知(Instant Payment Notification)
     * notify_url默认填写此处url
     */
    public function ipn(){
        $addonCfg = get_addon_config('paypal');
        $isSanbox = isset($addonCfg['is_sandbox']) ? (int)$addonCfg['is_sandbox'] : 0;
        $isDebug = isset($addonCfg['is_debug']) ? (int)$addonCfg['is_debug'] : 0;
        $post = $this->request->post();
        
        if(!$this->request->isPost()){
            return '';
        }
        
        if(!isset($post['payment_status']) || 'Completed'!==$post['payment_status']){
            //每次付款，可能会接收到多个不同支付状态的IPN信息，非Completed状态的信息全部跳过
            return '';
        }
        
        if($isDebug){
            Log::record($post, 'debug');
        }
        
        $ipn = new PaypalIPN();
        
        if($isSanbox){
            $ipn->useSandbox();
        }
        
        try {
            $verified = $ipn->verifyIPN();
            if ($verified && 'Completed'===$post['payment_status']) {
                /**
                 * IPN信息验证通过，并支付状态为Completed。
                 * 注意：基于安全因素，开发者仍需自行在Behavior中验证下列3项：
                 * 1. check that $post['txn_id'] has not been previously processed
                 * 2. check that $post['receiver_email'] is your Primary PayPal email
                 * 3. check that $post['mc_gross']/$post['mc_currency'] are correct
                 */
                
                # 调用钩子进行下一步的业务处理
                $passData = [$post, $addonCfg];
                Hook::listen("pp_ipn_verified", $passData);
            }else if($isDebug){
                Log::record($post, 'debug');
            }
        } catch (Exception $e) {
            Log::record($e->getMessage(), 'error');
        }
 
        
        //返回空的HTTP 200
        return '';
    }
}
