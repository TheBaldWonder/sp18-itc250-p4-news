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
 * @see survey_view.php
 * @see Pager.php 
 * @todo none
 */

# '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials 
 
# SQL statement
$sql = "SELECT * from p4_feed";
// $sql = "select CONCAT(a.FirstName, ' ', a.LastName) AdminName, f.CategoryID, f.Title, f.Description, date_format(f.DateAdded, '%W %D %M %Y %H:%i') 'DateAdded' from " . PREFIX . "feed f, " . PREFIX . "Admin a where f.AdminID=a.AdminID order by f.DateAdded desc";

#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php  
$config->titleTag = 'RSS News Feed';

#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = 'RSS News Feeds' . $config->metaDescription;
$config->metaKeywords = 'RSS,XML,PHP,Fun,'. $config->metaKeywords;

//adds font awesome icons for arrows on pager
//loads extra styles etc. for specific pages (not uploaded to all pages)
$config->loadhead .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';

# END CONFIG AREA ---------------------------------------------------------- 

get_header(); #defaults to theme header or header_inc.php

echo '<h3 align="center">Tech</h3>';

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
	// if($myPager->showTotal()==1){$itemz = "article";}else{$itemz = "articles";}  //deal with plural
	// echo '<div align="center">We have ' . $myPager->showTotal() . ' ' . $itemz . '!</div>';
	
	while($row = mysqli_fetch_assoc($result))
	{# process each row

		echo '
		<div class="row" style="flex-direction: row;">
			<div class="col-lg-4 card mb-3" style="width: 25%; display:flex; justify-content: space-between;">
				<h3 class="card-header"><a href="' . VIRTUAL_PATH . 'tech/gear/feed_view.php?id=' . (int)$row['FeedID'] . '">Gear</h3>
				<div class="card-body">
					<h5 class="card-title">Special title treatment</h5>
					<h6 class="card-subtitle text-muted">Support card subtitle</h6>
				</div>
				<img style="height: 200px; width: 100%; display: block;" src="../images/gear.jpg" alt="gear image">
				<div class="card-body">
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
				</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><a href="' . dbOut($row['URL']) . '">' . dbOut($row['Title']) . '</li>
						<li class="list-group-item"><a href="' . dbOut($row['URL']) . '">' . dbOut($row['Title']) . '</li>
						<li class="list-group-item"><a href="' . dbOut($row['URL']) . '">' . dbOut($row['Title']) . '</li>
					</ul>
			</div>


			<div class="col-lg-4 card mb-3" style="width: 25%; display: flex; justify-content: space-between;">
				<h3 class="card-header"><a href="' . VIRTUAL_PATH . 'tech/developer/feed_view.php?id=' . (int)$row['FeedID'] . '">Developer</h3>
				<div class="card-body">
					<h5 class="card-title">Special title treatment</h5>
					<h6 class="card-subtitle text-muted">Support card subtitle</h6>
				</div>
				<img style="height: 200px; width: 100%; display: block;" src="../images/developer.jpeg" alt="developer image">
				<div class="card-body">
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
				</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><a href="' . dbOut($row['URL']) . '">' . dbOut($row['Title']) . '</li>
						<li class="list-group-item"><a href="' . dbOut($row['URL']) . '">' . dbOut($row['Title']) . '</li>
						<li class="list-group-item"><a href="' . dbOut($row['URL']) . '">' . dbOut($row['Title']) . '</li>
					</ul>
			</div>


			<div class="col-lg-4 card mb-3" style="width: 25%; display: flex; justify-content: space-between;">
				<h3 class="card-header"><a href="' . VIRTUAL_PATH . 'tech/tech-industry/feed_view.php?id=' . (int)$row['FeedID'] . '">Tech Industry</h3>
				<div class="card-body">
					<h5 class="card-title">Special title treatment</h5>
					<h6 class="card-subtitle text-muted">Support card subtitle</h6>
				</div>
				<img style="height: 200px; width: 100%; display: block;" src="../images/tech-industry.png" alt="tech-industry image">
				<div class="card-body">
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
				</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><a href="' . dbOut($row['URL']) . '">' . dbOut($row['Title']) . '</li>
						<li class="list-group-item"><a href="' . dbOut($row['URL']) . '">' . dbOut($row['Title']) . '</li>
						<li class="list-group-item"><a href="' . dbOut($row['URL']) . '">' . dbOut($row['Title']) . '</li>
					</ul>
			</div>
		</div>
		';
	}

	echo $myPager->showNAV(); # show paging nav, only if enough records	 
}else{#no records
    echo "<div align=center>There are currently no articles.</div>";	
}
@mysqli_free_result($result);

get_footer(); #defaults to theme footer or footer_inc.php
?>
