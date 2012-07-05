<?php 
class McmCampaignUnscheduleProcessor extends modProcessor {
    public $languageTopics = array('mcm:default');
    public $classKey = 'McmCampaign';
    public $objectType = 'mcm.campaign';


//-----------------------------------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------------------------------	
public function initialize(){
		global $modx;
		$modx->addPackage('McmCampaign',$modx->getOption('core_path').'components/mcm/processors/campaigns/','');

		require_once $modx->getOption('core_path').'components/mcm/lib/mcm/ModxCampaignMonitor.class.php';
		$this->MCM = new ModxCampaignMonitor();

        return true; 
    }//

//-----------------------------------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------------------------------	
public function process(){
		global $modx;
		$props = $this->getProperties();
		
		$result = $this->MCM->unscheduleCampaign($props['campaignID']);
		
		if($result != "SUCCESS"){
			return $this->failure('ERROR'.print_r($result,true) );
		};
			
		return $this->success();
	}//
}
return 'McmCampaignUnscheduleProcessor';
?>