<?php
$settings = array();


$settings['mcm.api_key']= $modx->newObject('modSystemSetting');
$settings['mcm.api_key']->fromArray(array(
    'key' => 'mcm.api_key',
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => 'mcm',
),'',true,true);


$settings['mcm.client_id']= $modx->newObject('modSystemSetting');
$settings['mcm.client_id']->fromArray(array(
    'key' => 'mcm.client_id',
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => 'mcm',
),'',true,true);


$settings['mcm.notify_email_address']= $modx->newObject('modSystemSetting');
$settings['mcm.notify_email_address']->fromArray(array(
    'key' => 'mcm.notify_email_address',
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => 'mcm',
),'',true,true);


$settings['mcm.default_email_from_name']= $modx->newObject('modSystemSetting');
$settings['mcm.default_email_from_name']->fromArray(array(
    'key' => 'mcm.default_email_from_name',
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => 'mcm',
),'',true,true);


$settings['mcm.default_email_from_address']= $modx->newObject('modSystemSetting');
$settings['mcm.default_email_from_address']->fromArray(array(
    'key' => 'mcm.default_email_from_address',
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => 'mcm',
),'',true,true);


$settings['mcm.default_email_replyto']= $modx->newObject('modSystemSetting');
$settings['mcm.default_email_replyto']->fromArray(array(
    'key' => 'mcm.default_email_replyto',
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => 'mcm',
),'',true,true);



return $settings;
