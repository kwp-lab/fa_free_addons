<?php

return array (
  0 => 
  array (
    'name' => 'email',
    'title' => 'PayPal Account E-mail',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '(Your PayPal Account E-mail)',
    'rule' => 'required',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  1 => 
  array (
    'name' => 'is_sandbox',
    'title' => 'Sandbox Mode',
    'type' => 'radio',
    'content' => 
    array (
      1 => 'Yes',
      0 => 'No',
    ),
    'value' => '1',
    'rule' => 'required',
    'msg' => '',
    'tip' => 'Use the live or testing (sandbox) gateway server to process transactions?',
    'ok' => '',
    'extend' => '',
  ),
  2 => 
  array (
    'name' => 'is_debug',
    'title' => 'Debug Mode',
    'type' => 'radio',
    'content' => 
    array (
      1 => 'Enabled',
      0 => 'Disabled',
    ),
    'value' => '1',
    'rule' => 'required',
    'msg' => '',
    'tip' => 'Logs additional information to the system log?',
    'ok' => '',
    'extend' => '',
  ),
  3 => 
  array (
    'name' => 'transaction_method',
    'title' => 'Transaction Method',
    'type' => 'radio',
    'content' => 
    array (
      'sale' => 'Sale',
      'authorization' => 'Authorization',
    ),
    'value' => 'sale',
    'rule' => 'required',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
);
