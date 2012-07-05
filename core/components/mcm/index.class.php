<?php
global $modx;
define('MCM_ASSETS',$modx->getOption('assets_url').'components/mcm/');
define('MCM_CORE',$modx->getOption('core_path').'components/mcm/');
define('MCM_CONTROLLERS',MCM_CORE.'controllers/');


abstract class MCMManagerController extends modExtraManagerController {
    /** @var Doodles $doodles */
    public $doodles;
    public function initialize() {
    	global $modx;
        
        $this->addJavascript($modx->getOption('manager_url').'assets/modext/util/datetime.js');
        $this->addJavascript(MCM_ASSETS.'mgr/js/index.controller.js');
        $this->addJavascript(MCM_ASSETS.'mgr/js/mcm.panel.main.js');
        $this->addJavascript(MCM_ASSETS.'mgr/js/mcm.combo.resource.js');
        $this->addJavascript(MCM_ASSETS.'mgr/js/mcm.combo.recipientlists.js');
        $this->addJavascript(MCM_ASSETS.'mgr/js/mcm.grid.campaigns.js');
        $this->addJavascript(MCM_ASSETS.'mgr/js/mcm.grid.draftcampaigns.js');
        $this->addJavascript(MCM_ASSETS.'mgr/js/mcm.grid.scheduledcampaigns.js');
        $this->addJavascript(MCM_ASSETS.'mgr/js/mcm.grid.recipients.js');
        $this->addJavascript(MCM_ASSETS.'mgr/js/mcm.window.newcampaign.js');
        $this->addJavascript(MCM_ASSETS.'mgr/js/mcm.window.schedulecampaign.js');
        $this->addJavascript(MCM_ASSETS.'mgr/js/mcm.window.testcampaign.js');
		$this->addHTML('<link rel="stylesheet" type="text/css" href="'.MCM_ASSETS.'mgr/css/mcm.mgr.css" />');
		$this->addHTML('<script type="text/javascript">'
			.'MCM_CONNECTORS = "'.MCM_ASSETS.'mgr/connectors/";'
			.'MCM_ASSETS = "'.MCM_ASSETS.'";'
			.'MCM_DEFAULT_FROM_NAME = "'.$modx->getOption('mcm.default_email_from_name').'";'
			.'MCM_DEFAULT_FROM_ADDRESS = "'.$modx->getOption('mcm.default_email_from_address').'";'
			.'MCM_DEFAULT_REPLYTO = "'.$modx->getOption('mcm.default_email_replyto').'";'
			.'</script>');
			
			
		// Load lightbox Extension	
		$this->addJavascript(MCM_ASSETS.'lib/jquery.js');
		$this->addJavascript(MCM_ASSETS.'lib/jquery.fancybox/source/jquery.fancybox.js');
		$this->addHTML('<link rel="stylesheet" type="text/css" href="'.MCM_ASSETS.'lib/jquery.fancybox/source/jquery.fancybox.css" />');
		$this->addJavascript(MCM_ASSETS.'mgr/js/fancybox.loader.js');
			
        return parent::initialize();
    }
    public function getLanguageTopics() {
        return array('mcm:default');
    }
    public function checkPermissions() { return true;}
}
class IndexManagerController extends MCMManagerController {
    public static function getDefaultController() { return 'main'; }
};//
