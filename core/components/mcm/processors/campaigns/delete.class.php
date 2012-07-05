<?php 
class McmCampaignRemoveProcessor extends modObjectRemoveProcessor {
    public $languageTopics = array('mcm:default');
    public $classKey = 'McmCampaign';
    public $objectType = 'mcm.campaign';
    public $primaryKeyField = 'id';


//-----------------------------------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------------------------------	
public function initialize(){
		global $modx;
		
		$modx->addPackage('delete',$modx->getOption('core_path').'components/mcm/'.'processors/campaigns/','');

		require_once $modx->getOption('core_path').'components/mcm/lib/mcm/ModxCampaignMonitor.class.php';
		$this->MCM = new ModxCampaignMonitor();
		
		return true;
        return parent::initialize(); 
    }//

//-----------------------------------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------------------------------	
public function process(){
		global $modx;
		$props = $this->getProperties();
		
		$fh = fopen('/home/mmm/public_html/dump.txt','w+');
		fwrite($fh, print_r($props,true));
		fclose($fh);
				
		$result = $this->MCM->deleteCampaign($props['campaignID']);
		
		if($result != "SUCCESS"){
			return $this->failure('ERROR '.print_r($result,true).' - Unknown');
		};
		
		
		return $this->success('Campaign has been deleted');
	}//
}
return 'McmCampaignRemoveProcessor';
