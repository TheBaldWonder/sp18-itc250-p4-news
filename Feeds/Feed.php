<?php
//Feed.php
namespace Feeds;

/**
 * Feed Class retrieves data info for an individual Article
 * 
 *<code>
 *$mySurvey = new Sports\Feed(1);
 *</code>
 *
 * In which one is the number of a valid Feed in the database. 
 *
 * The forward slash in front of IDB picks up the global namespace, which is required 
 * now that we're here inside the Sports namespace: \IDB::conn()
 *
 * @todo none
 */
 
class Feed
{
	 public $FeedID = 0;
	 public $FeedURL = "";
	 public $Title = "";
	 public $Description = "";
	 public $PubDate = "";
	 public $TotalArticles= 0;
	 public $aFeed = Array();
	
	/**
	 * Constructor for Survey class. 
	 *
	 * @param integer $id The unique ID number of the Feed
	 * @return void 
	 * @todo none
	 */ 
    function __construct($id)
	{#constructor sets stage by adding data to an instance of the object
		$this->FeedID = (int)$id;
		if($this->FeedID == 0){return FALSE;} //if no Feed cut the database export / kill
		
		#get Survey data from DB
		$sql = sprintf("SELECT Title, FeedURL, PubDate, Description from " . PREFIX . "feeds Where FeedID =%d",$this->FeedID);
		
		#in mysqli, connection and query are reversed!  connection comes first
		$result = mysqli_query(\IDB::conn(),$sql) or die(trigger_error(mysqli_error(\IDB::conn()), E_USER_ERROR));
		if (mysqli_num_rows($result) > 0)
		{#Must be a valid survey!
			$this->isValid = TRUE;
			while ($row = mysqli_fetch_assoc($result))
			{#dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
			     $this->Title = dbOut($row['Title']);
			     $this->FeedURL = dbOut($row['FeedURL']);
			     $this->Description = dbOut($row['Description']);
			     $this->PubDate = dbOut($row['PubDate']);
			}
		}
		@mysqli_free_result($result); #free resources
		
		if(!$this->isValid){return;}  #exit, as Feed is not valid
		
	}# end Feed() constructor
	
	/**
	 * Reveals Feed  
	 *
	 * @param none
	 * @todo none
	 */ 
	function showFeeds()
	{
		if($this->FeedID > 0)
        {#be certain there are articles
			$myReturn = '';
			$contents = file_get_contents($this->FeedURL);
            
			foreach($this->aFeed as $article)
            {#print data for each 
				$myReturn = '<pre>';

				$contents = file_get_contents($this->FeedURL);
				echo $contents;
				
                '</pre>';

				// echo $question->QuestionID . " ";
				// echo $question->Text . " ";
				// echo $question->Description . "<br />";
				// #call showAnswers() method to display array of Answer objects
				// $question->showAnswers() . "<br />";
			}
		}else{
			echo "There are currently no questions for this survey.";	
        }
        return $myReturn;
    }# end showQuestions() method
    
}# end Survey class

// <div class="panel panel-default">
					// 	<div class="panel-heading">                             
					// 	<h3 class="panel-title">' . $article->Title . ' ' . $article->contents . '</h3>
                    //      </div>
                    //  <div class="panel-body">' .
                    //      $article->PubDate . '<br />
                    //  </div>
                    //  </div>