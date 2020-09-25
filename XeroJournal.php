<?php
class XeroJournal {
	
	//ATTRIBUTES
	public $_title = 'Journal';
	public $_pk = 'xeroJournalID';  //our primary key title 
	protected $_table = 'xerojournal'; //MySQL table name
	
	//OUR FIELDS
	public $xeroJournalID = ''; //Our primary Key
	public $userID = 0;  
	
	//XERO Fields
	public $JournalID; //Xero's primary key
	public $JournalNumber;
	public $Reference;
	public $JournalDate;


	
	
	
	function __construct($dataarray,$userID)
    {
       // Intitlize all the variable 
	  // print_r($dataarray);
	   foreach($dataarray->Journal as $row)
	   {
		   $this->JournalID=$row->JournalID;
		   $this->JournalNumber=$row->JournalNumber;
		   $this->Reference=$row->Reference;
		   $this->JournalDate=$row->JournalDate;
		   
		   
		   //echo $this->AccountID."<br> sdfsdsd ";
		   $this->insert();
	   }
	   return true;
	   
    }
	
	//CRUD
	public function insert(){
	
		$insert = sprintf("INSERT INTO ".$this->_table." 
			(userID, JournalID, JournalNumber, Reference ,JournalDate)
			VALUES
			('%d', '%s', '%s', '%s', '%s');",
			mysql_real_escape_string($this->userID),
			mysql_real_escape_string($this->JournalID),
			mysql_real_escape_string($this->JournalNumber),
			mysql_real_escape_string($this->Reference),
			mysql_real_escape_string($this->JournalDate)
			);

		$result = mysql_query($insert);
		
	}
	
	/*
	Any other utilities you need here
	*/
	
}


?>