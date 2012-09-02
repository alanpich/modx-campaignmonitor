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
    'key' => 'mcm.mcm.default_email_from_address',
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



$vehicle = $builder->createVehicle($settings,array (
    xPDOTransport::PRESERVE_KEYS => true,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::UNIQUE_KEY => 'text',
    xPDOTransport::RELATED_OBJECTS => true,
    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
        'Setting' => array (
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => array ('namespace','key'),
        ),
    ),
));
$modx->log(modX::LOG_LEVEL_INFO,'Menu & Action added to package');

## Add vehicle to builder #################################################################
$builder->putVehicle($vehicle);





