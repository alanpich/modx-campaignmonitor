<?php 
class McmCampaignScheduleProcessor extends modProcessor {
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
				
	//	$this->MCM->setCampaignList($props['recipientList']);

		$result = $this->MCM->scheduleCampaign($props['campaignid'],$props['date']);
		
		if($result != "SUCCESS"){
			return $this->failure('ERROR'.print_r($result,true) );
		};
			
		return $this->success('Campaign has been scheduled');
	}//
}
return 'McmCampaignScheduleProcessor';
?>