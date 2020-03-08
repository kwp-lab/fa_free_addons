<?php

namespace addons\paypal;

use app\common\library\Menu;
use think\Addons;

/**
 * PayPal按钮
 * 基于PayPal Payments Standard，定制化html form (Buy Now Button)
 * HTML Variables for PayPal Payments Standard:
 * https://developer.paypal.com/docs/classic/paypal-payments-standard/integration-guide/Appx_websitestandard_htmlvariables/
 *
 *
 * @author Kelvin Poon <1710080593@qq.com>
 */
class Paypal extends Addons
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
     * 钩子方法， 渲染PayPal按钮的html
     * @return mixed
     */
    public function ppButtonInit(&$param = [])
    {
        $addonCfg = $this->getConfig();

        if(!isset($addonCfg['email']) || empty($addonCfg['email'])){
            return '';
        }

        $formData = [
            'action'        => $addonCfg['is_sandbox'] ? "https://www.sandbox.paypal.com/cgi-bin/webscr" : "https://www.paypal.com/cgi-bin/webscr",
            'business'      => $addonCfg['email'],
            'paymentaction' => isset($addonCfg['transaction_method']) ? $addonCfg['transaction_method'] : 'sale',
            'currency_code' => 'USD',
            'custom'        => '',  //optional，用于传递自定义参数，在IPN信息中原样返回
            'invoice'       => '', //optional
            'lc'            => '', //optional，跳转至paypal后的默认显示语言
            'products'      => [
                [
                    'item_name' => 'Testing Service',
                    'amount'    => 0.02,
                    'quantity'  => 1
                ]
            ],
            'handling_cart' => 0, //optional，手续费
            'image_url'     => '', //显示在PayPal Checkout页面的商家logo（The URL of the 150x50-pixel image）
            'rm'            => '2', //当设置了return变量的时候才会生效， “2”表示支付完成后以POST方式返回return变量指定的url
            'return'        => addon_url('paypal/index/payment_success', [], true, true),
            'cancel_return' => addon_url('paypal/index/index', [], true, true),
            'notify_url'    => addon_url('paypal/callback/ipn', [], true, true),
            'btn_checkout'  => 'PayPal Checkout'
        ];
        $formData = array_merge($formData, $param);

        $this->assign($formData);
        return $this->fetch('view/payment_button');
    }

}
