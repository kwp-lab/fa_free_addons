<?php

return array (
  0 => 
  array (
    'name' => 'accessKeyId',
    'title' => 'accessKeyID',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '(accessKeyId Value)',
    'rule' => 'required',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  1 => 
  array (
    'name' => 'accessKeySecret',
    'title' => 'accessKeySecret',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '(accessKeySecret Value)',
    'rule' => 'required',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  2 => 
  array (
    'name' => 'endPoint',
    'title' => '内网访问的地域节点',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => 'oss-us-west-1-internal.aliyuncs.com',
    'rule' => '',
    'msg' => '',
    'tip' => 'EndPoint (Internal)',
    'ok' => '',
    'extend' => '',
  ),
  3 => 
  array (
    'name' => 'externalEndPoint',
    'title' => '外网访问的地域节点',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => 'oss-us-west-1.aliyuncs.com',
    'rule' => '',
    'msg' => '',
    'tip' => 'EndPoint (External)',
    'ok' => '',
    'extend' => '',
  ),
  4 => 
  array (
    'name' => 'defaultBucket',
    'title' => 'Default Bucket',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '(Your bucket name)',
    'rule' => '',
    'msg' => '',
    'tip' => '默认选用的Bucket名称',
    'ok' => '',
    'extend' => '',
  ),
  5 => 
  array (
    'name' => 'isInternal',
    'title' => '选择地域节点',
    'type' => 'radio',
    'content' => 
    array (
      1 => '内网访问',
      0 => '外网访问',
    ),
    'value' => '0',
    'rule' => '',
    'msg' => '',
    'tip' => '使用外网或者内网的地域节点',
    'ok' => '',
    'extend' => '',
  ),
  6 => 
  array (
    'name' => 'useSSL',
    'title' => '是否使用SSL',
    'type' => 'radio',
    'content' => 
    array (
      1 => '是 (https)',
      0 => '否 (http)',
    ),
    'value' => '1',
    'rule' => '',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
);
