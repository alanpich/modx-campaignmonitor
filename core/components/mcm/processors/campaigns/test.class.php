<?php 
class McmCampaignTestProcessor extends modProcessor {
    public $languageTopics = array('mcm:default');
    public $classKey = 'McmCampaign';
    public $objectType = 'mcm.campaign';


//-----------------------------------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------------------------------	
public function initialize(){
		global $modx;
		
		$modx->addPackage('mcm',$modx->getOption('core_path').'components/mcm/'.'processors/campaigns/','');

		require_once $modx->getOption('core_path').'components/mcm/lib/mcm/ModxCampaignMonitor.class.php';
		$this->MCM = new ModxCampaignMonitor();

        return parent::initialize(); 
    }//

//-----------------------------------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------------------------------	
public function process(){
		global $modx;
		$props = $this->getProperties();
		
		$emails = explode(';',$props['send_to']);
		
		$result = $this->MCM->sendCampaignTest($props['campaignid'],$emails);
		
		if($result != "SUCCESS"){
			return $this->failure('ERROR '.print_r($result,true).' - Unknown');
		};
		
		
		
		return $this->success($emails);
	}//
}
return 'McmCampaignTestProcessor';