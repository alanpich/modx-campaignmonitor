<?php
class McmCampaignGetListProcessor extends modObjectGetListProcessor {
    public $languageTopics = array('mcm:default');
    public $defaultSortField = 'last_sent';
    public $defaultSortDirection = 'DESC';
    public $classKey = 'MCMCampaign';
    public $objectType = 'mcm.campaign';
    
public function initialize(){
			return parent::initialize(); 
	}//


public function process() {
		    
	    $limit = intval($this->getProperty('limit'));
	    $start = intval($this->getProperty('start'));
	    $sort = $this->getProperty('sort');
	    $dir = $this->getProperty('dir'); 

		$row = array();
		$row['title'] = 'My row title';
		$row['subject'] = 'E-mail subject line goes here';
		$row['last_sent'] = '12/2/2012';
		$row['recipients'] = 1234;
		$data_array = array($row);
		$total = 1;
	     
/*        if ($data_array = $yourApi->getData($start,$limit,$sort,$dir)){
	        $total = $yourApi->getTotal;  
	    }
	     else{
	        return $this->failure('Error');
	    }           
*/ 
	    return $this->outputArray($data_array,$total);
	}//
		
};// end class McmCampaignGetListProcessor
return 'McmCampaignGetListProcessor';
