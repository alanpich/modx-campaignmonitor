<?php // MCM controllers/index 

class McmMainManagerController extends MCMManagerController {

public function getPageTitle() { return $this->modx->lexicon('mcm.CampaignMonitor'); }
   
public function getTemplateFile() { return MCM_CONTROLLERS.'tpl/index.tpl'; }

};

/*
define('MCM_ASSETS',$modx->getOption('assets_url').'components/mcm/');
define('MCM_CORE',$modx->getOption('core_path').'components/mcm/');
define('MCM_CONTROLLERS',MCM_CORE.'controllers/');

$modx->regClientStartupScript(MCM_ASSETS.'mgr/js/index.controller.js');

$modx->lexicon->load('mcm');


$modx->smarty->assign( 'mcm', $this->modx->lexicon->fetch('mcm') );
return $modx->smarty->fetch( MCM_CONTROLLERS.'tpl/index.tpl' );

*/
