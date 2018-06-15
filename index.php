<?php
/**
 * index.php along with feed_view.php provides a list/view application
 * and a start to our news app
 *
 * The difference between demo_list.php and demo_list_pager.php is the reference to the 
 * Pager class which processes a mysqli SQL statement and spans records across multiple  
 * pages. 
 *
 * The associated view page, survey_view.php is virtually identical to demo_view.php. 
 * The only difference is the pager version links to the list pager version to create a 
 * separate application from the original list/view. 
 * 
 * @package RSS-News Feed
 * @author Jesse Hernandez <jesse@jesseh-codes.com>
 * @version 0.2 2018/05/18
 * @link http://www.jesseh-codes.com/
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @see feed_view.php
 * @see Pager.php 
 * @todo none
 */

# '../' works for a sub-folder.  use './' for the root  
require 'inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials 
 
# SQL statement
/*
$sql = "SELECT * from p4_feeds";

$mysqli_query = "SELECT CategoryID, Category, Description";
$mysqli_query. = "FROM p4-categories";
$mysqli_query. = "WHERE ownerid = '$userID'";
$mysqli_query. = "ORDER BY `CategoryID`, `Category` ASC";
*/


$sql = "SELECT s.FeedID, s.Title, s.FeedURL, s.Description, a.Category, 
date_format(s.PubDate, '%W %D %M %Y %H:%i') 'DateAdded' FROM "
. PREFIX . "feeds s, " . PREFIX . "categories a WHERE s.CategoryID=a.CategoryID order by s.CategoryID desc";

#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php  
$config->titleTag = 'RSS News Feeds';

#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = 'RSS News Feeds ' . $config->metaDescription;
$config->metaKeywords = 'RSS,XML,PHP,Fun,'. $config->metaKeywords;

//adds font awesome icons for arrows on pager
//loads extra styles etc. for specific pages (not uploaded to all pages)
$config->loadhead .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';

# END CONFIG AREA ---------------------------------------------------------- 

get_header(); #defaults to theme header or header_inc.php

echo '<h3 align="center">RSS Feed Topics</h3>';

#images in this case are from font awesome
$prev = '<i class="fa fa-chevron-circle-left"></i>';
$next = '<i class="fa fa-chevron-circle-right"></i>';

# Create instance of new 'pager' class
$myPager = new Pager(10,'',$prev,$next,'');
$sql = $myPager->loadSQL($sql);  #load SQL, add offset

# connection comes first in mysqli (improved) function
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
    
if(mysqli_num_rows($result) > 0)
{#records exist - process
	
	if($myPager->showTotal()==1){$itemz = "article";}else{$itemz = "articles";}  //deal with plural
	echo '<div align="center">We have ' . $myPager->showTotal() . ' ' . $itemz . '!</div>';
	
	// echo '
		
		
	// ';

	while($row = mysqli_fetch_assoc($result))
	{# process each row
		echo '
			<div class="list-group" style="margin: auto; width: 50%;">
				<a href="' . VIRTUAL_PATH . '/feed_view.php?id=' . (int)$row['FeedID'] . '" class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">' . dbOut($row['Title']) . '</h5>
						<small>' . dbOut($row['Category']) . '</small>
					</div>
					<p class="mb-1">' . dbOut($row['Description']) . '</p>
					<small>Click here for all the news!</small>
				</a>
			</div>
			<br/>
		';
	}

	echo $myPager->showNAV(); # show paging nav, only if enough records	 
}else{#no records
    echo "<div align=center>There are currently no feeds.</div>";	
}
@mysqli_free_result($result);

get_footer(); #defaults to theme footer or footer_inc.php
?>


<!-- <table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">Topic</th>
					<th scope="col">Category</th>
					<th scope="col">Description</th>
				</tr>
			</thead>
			<tbody> -->

<!-- <tr class="table-light">
				<th scope="row"><a href="' . VIRTUAL_PATH . dbOut($row['Category']) . '/feed_view.php?id=' . (int)$row['FeedID'] . '">' . dbOut($row['Title']) . '</a></th>
				<td>' . dbOut($row['Category']) . '</td>
				<td>' . dbOut($row['Description']) . '</td>
			</tr> -->