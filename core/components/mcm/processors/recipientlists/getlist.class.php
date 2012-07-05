<?php

class McmRecipientsGetListProcessor extends modObjectGetListProcessor {
    public $languageTopics = array('mcm:default');
    public $defaultSortField = 'last_sent';
    public $defaultSortDirection = 'DESC';
    public $classKey = 'MCMCampaign';
    public $objectType = 'mcm.campaign';
     
public function initialize(){
		global $modx;
		
		$modx->addPackage('mcm',$modx->getOption('core_path').'components/mcm/'.'processors/campaigns/','');
		require_once $modx->getOption('core_path').'components/mcm/lib/mcm/ModxCampaignMonitor.class.php';

		$this->MCM = new ModxCampaignMonitor();

        return parent::initialize(); 
    }//
 
 
public function process() {
         
        $limit = intval($this->getProperty('limit'));
        $start = intval($this->getProperty('start'));
        $sort = $this->getProperty('sort');
        $dir = $this->getProperty('dir'); 
        
        $response = $this->MCM->getRecipientLists( $limit, $start );
        
        
        return $this->outputArray($response->data,$response->total);


       if ($data_array = $yourApi->getData($start,$limit,$sort,$dir)){
            $total = $yourApi->getTotal;  
        }
         else{
            return $this->failure('Error');
        }           
  
        return $this->outputArray($data_array,$total);
    }//
         
};// end class McmCampaignGetListProcessor
return 'McmRecipientsGetListProcessor';
