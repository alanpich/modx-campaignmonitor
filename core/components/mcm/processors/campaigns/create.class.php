<?php 
class McmCampaignCreateProcessor extends modObjectCreateProcessor {
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
		
		$URL = $modx->getOption('site_url'). $modx->makeUrl( (int)$props['resourceID'] );
		
		$result = $this->MCM->createCampaign(array(
			'Subject' => $props['subject'],
			'Name' => $props['title'],
			'FromName' => $props['from_name'],
			'FromEmail' => $props['from_address'],
			'ReplyTo' => $props['reply_to'],
			'HtmlUrl' => $URL,
			'TextUrl' => $URL,
			'ListIDs' => array($props['recipientList']),
		));
		
		if($result != "SUCCESS"){
			return $this->failure('ERROR '.print_r($result,true).' - Unknown');
		};
		
		
		return $this->success('Campaign has been created');
	}//
}
return 'McmCampaignCreateProcessor';