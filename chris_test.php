<?php
/*************************************************************************************************
*	Writen By:		- Rachael Bran	- rachael.bran@flashtalking.com
*	Description:	- Test Jira
*	Date Created:	- 29/07/2016
*	Modifications:	- 
*
*************************************************************************************************/

// error_reporting(E_ALL);
// ini_set("display_errors","on");
// ini_set("display_startup_errors", "on");
// ini_set("ignore_repeated_errors", "on");
//set_time_limit(1000);
//ignore_user_abort(true);


class feedclass{

	function __construct(){
	
	}

	function init(){

		$url = "https://flashtalkingus.atlassian.net/rest/api/2/search?jql=project=CTSD%20AND%20status!=resolved&maxResults=200";

		$jira_username = '##username##';
		$jira_password = '##password##';

		$CTSDInitial = $this->get_from($url, $jira_username, $jira_password);

		// $fullUrl = "https://flashtalkingus.atlassian.net/rest/api/2/search?jql=project=CTSD&maxResults=" . $CTSDInitial->total;

		// $CTSD = $this->get_from($fullUrl, $jira_username, $jira_password);

		$strippedCTSDIssues = $this->stripCTSD($CTSDInitial->issues);

		return $strippedCTSDIssues;
	}

	function stripCTSD($issue){

		$open = 0;
		$workingOnIt = 0;
		$waitingOn = 0;
		$waitingOnAdBuilder = 0;
		$waitingOnJSDev = 0;
		$waitingOnCreativeManager = 0;

		if($issue){
			foreach ($issue as $k => $v) {
				if(strtolower($v->fields->status->name) === "open"){
					$open += 1;
				}else if(strtolower(@$v->fields->assignee->key) == "jsdev"){
					$waitingOnJSDev += 1;
				}else if(strtolower($v->fields->status->name) === "working on it" && strtolower(@$v->fields->assignee->key) !== "philwhitely" && strtolower(@$v->fields->assignee->key) !== "jsdev"){
					$workingOnIt += 1;
				}else if(strtolower(@$v->fields->labels[0]) === "adbuilder" && strtolower(@$v->fields->assignee->key) === "philwhitely"){
					$waitingOnAdBuilder += 1;
				}else if(strtolower(@$v->fields->labels[0]) === "creativemanager" && strtolower(@$v->fields->assignee->key) === "philwhitely"){
					$waitingOnCreativeManager += 1;
				}else if(strtolower($v->fields->status->name) === "waiting on..." && strtolower(@$v->fields->assignee->key) !== "philwhitely" && strtolower(@$v->fields->assignee->key) !== "jsdev"){
					$waitingOn += 1;
				}
			}

			$organisedData = array("open" => $open, "workingOnIt" => $workingOnIt, "waitingOn..." => $waitingOn, "waitingOnAdBuilder" => $waitingOnAdBuilder, "waitingOnjsDev" => $waitingOnJSDev, "waitingOnCreativeManager" => $waitingOnCreativeManager);
		}else{
			$organisedData = array("open" => 0, "workingOnIt" => 0, "waitingOn..." => 0, "waitingOnAdBuilder" => 0, "waitingOnjsDev" => 0, "waitingOnCreativeManager" => 0);
		}

		return $organisedData;
	}

	function get_from($url, $jira_username, $jira_password) {

		$ch = curl_init();

		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_USERPWD =>  $jira_username . ':' . $jira_password,
			CURLOPT_HTTPHEADER => array('Content-type: application/json'),
			CURLOPT_RETURNTRANSFER => true
		));

		$result = curl_exec($ch);
		curl_close($ch);

		return json_decode($result);
	}

	
}

?>