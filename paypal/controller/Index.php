<?php
namespace addons\paypal\controller;

use think\addons\Controller;

class Index extends Controller
{

    public function index()
    {
        $addon_paypal_config = get_addon_config('paypal');
        $ppForm = [
            'currency_code' => 'USD',
            'custom'        => 4123, //传参，支付成功后原样返回
            'products'      => [
                [
                    'item_name' => '测试费',
                    'amount'    => 0.02,
                    'quantity'  => 1
                ],
                [
                    'item_name' => '开发费',
                    'amount'    => 2.02,
                    'quantity'  => 1
                ]
            ],
            'return'  => addon_url('paypal/index/payment_success', [], true, true),
            'cancel_return' => $this->request->url(true),
            'btn_checkout'  => 'Step2: 前往PayPal支付'
        ];
        $this->assign('addon_config', $addon_paypal_config);
        $this->assign('ppForm', $ppForm);
        return $this->fetch();
    }

    public function payment_success(){
        return $this->fetch();
    }

}
