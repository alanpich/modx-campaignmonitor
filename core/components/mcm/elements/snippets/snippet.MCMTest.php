<?php
require_once MCM_core.'ModxCampaignMonitor.class.php';
$MCM = new ModxCampaignMonitor();
echo "<h2>creating new campaign</h2>";

$lists = $MCM->getLists();
if($lists == false){
 echo "ERROR: ".$MCM->error."<br />";
} else {
	dump($lists);
};


if($MCM->createNewCampaign(2, array('74a5cf69d75eb1eaaf441d54804cb3ad')) == false){
	echo "Error :( -> ";
	dump($MCM->error);
} else {
 	echo "Campaign Created";
};


