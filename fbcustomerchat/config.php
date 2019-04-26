<?php

return array (
  0 => 
  array (
    'name' => 'page_id',
    'title' => '主页ID',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '',
    'rule' => 'required',
    'msg' => '',
    'tip' => 'Facebook主页ID',
    'ok' => '',
    'extend' => '',
  ),
  1 => 
  array (
    'name' => 'theme_color',
    'title' => '主题颜色',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '#0084ff',
    'rule' => 'required',
    'msg' => '',
    'tip' => '(选填)支持任何带前导数字符号的十六进制颜色代码（如 #0084FF），白色除外',
    'ok' => '',
    'extend' => '',
  ),
  2 => 
  array (
    'name' => 'logged_in_greeting',
    'title' => '对已登录 Facebook 的用户显示的欢迎语',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => 'Hi! How can we help you?',
    'rule' => '',
    'msg' => '',
    'tip' => '(选填)不超过 80 个字符',
    'ok' => '',
    'extend' => '',
  ),
  3 => 
  array (
    'name' => 'logged_out_greeting',
    'title' => '对未登录 Facebook 的用户显示的欢迎语',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => 'Hi! we\'re here to answe any questions you may have.',
    'rule' => '',
    'msg' => '',
    'tip' => '(选填)不超过 80 个字符',
    'ok' => '',
    'extend' => '',
  ),
  4 => 
  array (
    'name' => 'greeting_dialog_display',
    'title' => '欢迎对话框的显示方式',
    'type' => 'radio',
    'content' => 
    array (
      'show' => 'show',
      'hide' => 'hide',
      'fade' => 'fade',
    ),
    'value' => 'fade',
    'rule' => '',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  5 => 
  array (
    'name' => 'greeting_dialog_delay',
    'title' => '欢迎对话框延迟出现的时间',
    'type' => 'number',
    'content' => 
    array (
    ),
    'value' => '5',
    'rule' => '',
    'msg' => '',
    'tip' => '设置插件加载后延迟多少秒才显示欢迎对话框',
    'ok' => '',
    'extend' => '',
  ),
  6 => 
  array (
    'name' => 'localization',
    'title' => '区域和语言',
    'type' => 'select',
    'content' => 
    array (
      'en_US' => '英文（美国）',
      'zh_CN' => '简体中文',
      'zh_HK' => '繁体中文（香港）',
    ),
    'value' => 'zh_CN',
    'rule' => '',
    'msg' => '',
    'tip' => '预设英文和简繁中文',
    'ok' => '',
    'extend' => '',
  ),
);
