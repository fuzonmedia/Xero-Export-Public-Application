<?php
class XeroManualJournal {
	
	//ATTRIBUTES
	public $_title = 'ManualJournal';
	public $_pk = 'xeroManualJournalID';  //our primary key title 
	protected $_table = 'xeromanualjournal'; //MySQL table name
	
	//OUR FIELDS
	public $xeroManualJournalID = ''; //Our primary Key
	public $userID = 0;  
	
	//XERO Fields
	public $ManualJournalID; //Xero's primary key
	public $LineAmountTypes;
	public $Narration;
	public $Status;
	public $Date;


	
	
	
	function __construct($dataarray,$userID)
    {
       // Intitlize all the variable 
	  // print_r($dataarray);
	   foreach($dataarray->ManualJournal as $row)
	   {
		   $this->ManualJournalID=$row->ManualJournalID;
		   $this->LineAmountTypes=$row->LineAmountTypes;
		   $this->Narration=$row->Narration;
		   $this->Status=$row->Status;
		   $this->Date=$row->Date;
		   
		   
		   //echo $this->AccountID."<br> sdfsdsd ";
		   $this->insert();
	   }
	   return true;
	   
    }
	
	//CRUD
	public function insert(){
	
		$insert = sprintf("INSERT INTO ".$this->_table." 
			(userID, ManualJournalID, LineAmountTypes, Narration ,Status,Date)
			VALUES
			('%d', '%s', '%s', '%s', '%s', '%s');",
			mysql_real_escape_string($this->userID),
			mysql_real_escape_string($this->ManualJournalID),
			mysql_real_escape_string($this->LineAmountTypes),
			mysql_real_escape_string($this->Narration),
			mysql_real_escape_string($this->Status),
			mysql_real_escape_string($this->Date)
			);

		$result = mysql_query($insert);
		
	}
	
	/*
	Any other utilities you need here
	*/
	
}


?>