<?php
/**
 * survey_view.php is a page to demonstrate the proof of concept of the 
 * initial SurveySez objects.
 *
 * Objects in this version are the Survey, Question & Answer objects
 * 
 * @package Sports
 * @author Jesse Hernandez
 * @version 1.0 2018/06/06
 * @link http://jesseh-codes.com 
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see Feed.php
 * @see Category.php
 * 
 */
 
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials
spl_autoload_register('MyAutoLoader::NamespaceLoader');//required to load SurveySez namespace objects
$config->metaRobots = 'no index, no follow';#never index survey pages

# check variable of item passed in - if invalid data, forcibly redirect back to demo_list.php page
if(isset($_GET['id']) && (int)$_GET['id'] > 0){#proper data must be on querystring
	 $myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
}else{
	myRedirect(VIRTUAL_PATH . "news/index.php");
}

$myFeed = new Sports\Feed($myID); //MY_Survey extends survey class so methods can be added
if($myFeed->isValid)
{
	$config->titleTag = "'" . $myFeed->Title . "' Feed!";
}else{
	$config->titleTag = smartTitle(); //use constant 
}
#END CONFIG AREA ---------------------------------------------------------- 

get_header(); #defaults to theme header or header_inc.php
?>
<h3><?=$myFeed->Title;?></h3>

<?php

if($myFeed->isValid)
{ #check to see if we have a valid SurveyID
	echo '<p>' . $myFeed->Description . '</p>';
	echo $myFeed->showQuestions();
}else{
	echo "Sorry, no such survey!";	
}

get_footer(); #defaults to theme footer or footer_inc.php


