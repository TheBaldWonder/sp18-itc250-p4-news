<?php 
/**
 * feed.php
 * 
 * Class created to display all pieces of the "feed" module when feed is ran
 *
 * @package ITC250
 * @author Jesse Hernandez <jesse.hernandez2@seattlecentral.edu>
 * @version 1.0 2018/06/05
 * @link http://www.jesseh-codes.com/
 * 
 */

Class Feed
{
    public $CategoryID = '';
    public $FeedID = 0;
    public $Title = '';
    public $URL = '';
    public $ImageURL = '';
    public $Description = '';
    public $PubDate = '';
    
    public function __construct($CategoryID, $FeedID, $Title, $URL, $ImageURL, $Description, $PubDate)
    {
        $this->CategoryID = $CategoryID;
        $this->FeedID = $FeedID;
        $this->Title = $Title;
        $this->URL = $URL;
        $this->ImageURL = $ImageURL;
        $this->Description = $Description;
        $this->PubDate = $PubDate;
        
    }

    // displays each feed on page
    public function display()
    {
        echo '
        <h2>' . $this->CategoryID . '</h2>
    
            <tr>
                <th scope="row"><a href="' . $this->URL . '">' . $this->Title . '</a></th>
                <td><small>Published: ' . $this->PubDate . '</small></td>
            </tr>
       
            <tr>
                <td><img src="' . $this->ImageURL . '"heigh="200" width="200"</td>
            </tr>
            
            <tr>
                <td><p>' . $this->Description . '</p></td></tr>
        ';
    }
}