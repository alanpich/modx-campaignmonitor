<?php 
define('MCM_API_PATH', $modx->getOption('core_path').'components/mcm/lib/campaignmonitor-createsend/');

require_once MCM_API_PATH.'csrest_clients.php';
require_once MCM_API_PATH.'csrest_general.php';
require_once MCM_API_PATH.'csrest_campaigns.php';


class ModxCampaignMonitor {


function __construct(){
	global $modx;
	$this->api_key = $modx->getOption('mcm.api_key',null,'');
	$this->client_id = $modx->getOption('mcm.client_id',null,'');
	
	$this->apiPath = MCM_CORE.'lib/campaignmonitor-createsend/';
	
	$this->maxListLength = $modx->getOption('mcm.max_list_length',null,50);
}//



//=============================================================================	
//== G E T   C A M P A I G N  L I S T =========================================	
//=============================================================================	
private function _getCampaigns(){
		$wrap = new CS_REST_Clients( $this->client_id, $this->api_key );
		$result = $wrap->get_campaigns();
		if($result->was_successful()) {
			return $result->response;
		} else {
			echo 'Failed with code '.$result->http_status_code."\n<br /><pre>";
			var_dump($result->response);
		}
	}//
private function _getDraftCampaigns(){
		$wrap = new CS_REST_Clients( $this->client_id, $this->api_key );
		$result = $wrap->get_drafts();
		if($result->was_successful()) {
			return $result->response;
		} else {
			echo 'Failed with code '.$result->http_status_code."\n<br /><pre>";
			var_dump($result->response);
		}
	}//
private function _getScheduledCampaigns(){
		$wrap = new CS_REST_Clients( $this->client_id, $this->api_key );
		$result = $wrap->get_scheduled();
		if($result->was_successful()) {
			return $result->response;
		} else {
			echo 'Failed with code '.$result->http_status_code."\n<br /><pre>";
			var_dump($result->response);
		}
	}//
	
	
	
//-----------------------------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------
public function getCampaignList( $limit = -1, $start = 0 ){
		$done = $this->_getCampaigns();
		$data = array();
		
		$stop = $start + $limit;
		if($stop > count($done)){ $stop = count($done); }
		
		// Prepare drage objects
		for($count = $start; $count < $stop; $count+=1){
			
			$campaign = $done[$count];
						
			$summary = $this->getCampaignOpens($campaign->CampaignID);
			
			$obj = new stdClass();
			$obj->id = $campaign->CampaignID;
			$obj->title = $campaign->Name;
			$obj->preview = $campaign->WebVersionURL;
			$obj->subject = $campaign->Subject;
			$obj->recipients = $campaign->TotalRecipients;
			$obj->last_sent =  $campaign->SentDate;
			$obj->opens =  $summary->TotalOpened;
			$obj->unsubscribes = $summary->Unsubscribed;
			$obj->bounces = $summary->Bounced;
			$obj->uniqueOpens = $summary->UniqueOpened;
			$data[] = $obj;
		};
		
		$response = new stdClass();
		$response->data = $data;
		$response->total = count($done);
		return $response;
	}//
	
//-----------------------------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------
public function getDraftCampaignList( $limit = -1, $start = 0 ){
		$draft = $this->_getDraftCampaigns();
		$data = array();
		
		$stop = $start + $limit;
		if($stop > count($draft)){ $stop = count($draft); }
		
		
		// Prepare drage objects
		for($count = $start; $count < $stop; $count+=1){
			$campaign = $draft[$count];	
			
			$lists = $this->getCampaignRecipientList($campaign->CampaignID)->response->Lists;
			if(count($lists)>0){
				$list = $lists[0]->ListID;
			} else {
				$list = '0';
			};
			
			$obj = new stdClass();
			$obj->id = $campaign->CampaignID;
			$obj->title = $campaign->Name;
			$obj->subject = $campaign->Subject;
			$obj->created = $campaign->DateCreated;
			$obj->preview = $campaign->PreviewURL;
			$obj->listID = $list;
			$data[] = $obj;
		};
		
		$response = new stdClass();
		$response->data = $data;
		$response->total = count($draft);
		return $response;
	}//
	
//-----------------------------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------
public function getScheduledCampaignList( $limit = 9999, $start = 0 ){
		$scheduled = $this->_getScheduledCampaigns();
		$data = array();

		$stop = $start + $limit;
		if($stop > count($scheduled)){ $stop = count($scheduled); }

		// Prepare drage objects
		for($count = $start; $count < $stop; $count+=1){
			$campaign = $scheduled[$count];
			$obj = new stdClass();
			$obj->id = $campaign->CampaignID;
			$obj->title = $campaign->Name;
			$obj->subject = $campaign->Subject;
			$obj->preview = $campaign->PreviewURL;
			$obj->created = $campaign->DateCreated;
			$obj->send_date =  $campaign->DateScheduled;
			$data[] = $obj;
		};
		
		$response = new stdClass();
		$response->data = $data;
		$response->total = count($scheduled);
		
		return $response;
	}//


//=============================================================================	
//== G E T   C A M P A I G N   S T A T S ======================================
//=============================================================================	
private function getCampaignOpens( $campaignID ){
		$wrap = new CS_REST_Campaigns($campaignID, $this->api_key);
		$result = $wrap->get_summary();
		return $result->response;	
	}//


	
//=============================================================================	
//== C R E A T E   A   C A M P A I G N ========================================	
//=============================================================================	
private function _createCampaign( $emailData ){
		$wrap = new CS_REST_Campaigns(NULL, $this->api_key);
		$result = $wrap->create($this->client_id, $emailData);	
		if($result->was_successful()) {
			return "SUCCESS";
		} else {
			return $result->response;
		}	
	}//
public function createCampaign($data){
		return $this->_createCampaign($data);
	}//


//=============================================================================	
//== D E L E T E   A   C A M P A I G N ========================================
//=============================================================================	
private function _deleteCampaign( $campaignID ){
		$wrap = new CS_REST_Campaigns($campaignID, $this->api_key);
		$result = $wrap->delete();
		if($result->was_successful()) {
			return 'SUCCESS';
		} else {
			return $result->response;
		};
	}//
public function deleteCampaign( $campaignID ){
		return $this->_deleteCampaign($campaignID);
	}//

//=============================================================================	
//== S C H E D U L E   A   C A M P A I G N ====================================	
//=============================================================================	
private function _scheduleCampaign( $campaignID, $dateStr ){
		global $modx;
		$wrap = new CS_REST_Campaigns($campaignID, $this->api_key);
		$result = $wrap->send(array(
			'ConfirmationEmail' => $modx->getOption('mcm.notify_email_address'),
			'SendDate' => $dateStr
		));
		if($result->was_successful()){
			return 'SUCCESS';
		};
		return $result;
	}//
public function scheduleCampaign( $campaignID, $dateStr ){
		return $this->_scheduleCampaign($campaignID, $dateStr);
	}//
	
//=============================================================================	
//==  U N S C H E D U L E   A   C A M P A I G N ===============================	
//=============================================================================	
private function _unscheduleCampaign( $campaignID ){
		global $modx;
		$wrap = new CS_REST_Campaigns($campaignID, $this->api_key);
		$result = $wrap->unschedule();
		if($result->was_successful()){
			return 'SUCCESS';
		};
		return $result;
	}//
public function unscheduleCampaign( $campaignID ){
		return $this->_unscheduleCampaign($campaignID);
	}//

//=============================================================================	
//== G E T   C A M P A I G N   R E C I P I E N T   L I S T ====================	
//=============================================================================	
private function _getCampaignRecipientList($campaignID){
		$wrap = new CS_REST_Campaigns($campaignID, $this->api_key);
		$result = $wrap->get_lists_and_segments();
		return $result;	
	}//
public function getCampaignRecipientList($campaignID){
		$res = $this->_getCampaignRecipientList($campaignID);		
		return $res;
	}//

//=============================================================================	
//==  S E N D   A   T E S T   E M A I L  ======================================	
//=============================================================================	
private function _sendCampaignTest($campaignID,$emails = array()){
		$wrap = new CS_REST_Campaigns($campaignID, $this->api_key);
		$result = $wrap->send_preview($emails, 'Fallback');
		if($result->was_successful()){return 'SUCCESS';};
		return $result;	
	}//
public function sendCampaignTest($campaignID, $emails){
		$res = $this->_sendCampaignTest($campaignID, $emails);
		
		return $res;
	}//


/***********************************************************************************************************************************************
 ***********************************************************************************************************************************************
 ***  R E C I P I E N T   L I S T S   **********************************************************************************************************
 ***********************************************************************************************************************************************
 ***********************************************************************************************************************************************/


//=============================================================================	
//== G E T   R E C I P I E N T S   L I S T S ==================================	
//=============================================================================	
private function _getLists(){
		$wrap = new CS_REST_Clients($this->client_id,$this->api_key);
		$result = $wrap->get_lists();
		if($result->was_successful()) {
			return $result->response;
		} else {
			echo 'Failed with code '.$result->http_status_code."\n<br /><pre>";
			return $result->response;
		}
	}//
public function getRecipientLists( $limit = 9999, $start = 0 ){
		$lists = $this->_getLists();
		$data = array();
		
		
		$stop = $start + $limit;
		if($stop > count($lists)){ $stop = count($lists); }

		for($count = $start; $count < $stop; $count+=1){
			$list = $lists[$count];
			$obj = new stdClass();
			$obj->id = $list->ListID;
			$obj->title = $list->Name;
			$data[] = $obj;
		};
		
		$response = new stdClass();
		$response->data = $data;
		$response->total = count($lists);
		
		return $response;
	}//


//=============================================================================	
//== G E T   C L I E N T S   L I S T ==========================================	
//=============================================================================	

private function _getClients(){
		$wrap = new CS_REST_General($this->api_key);
		$result = $wrap->get_clients();
		if($result->was_successful()) {
			return $result->response;
		} else {
			echo 'Failed with code '.$result->http_status_code."\n<br /><pre>";
			var_dump($result->response);
		}		
	}//
public function getClientList(){
		return $this->_getClients();
	}//	
	
	
	

};// end class ModxCampaignMonitor
