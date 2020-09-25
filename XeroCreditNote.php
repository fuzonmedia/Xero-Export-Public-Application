<?php
class XeroCreditNote {
	
	//ATTRIBUTES
	public $_title = 'CreditNote';
	public $_pk = 'xeroCreditNoteID';  //our primary key title 
	protected $_table = 'xerocreditnote'; //MySQL table name
	
	//OUR FIELDS
	public $xeroCreditNoteID = ''; //Our primary Key
	public $userID = 0;  
	
	//XERO Fields
	public $CreditNoteID; //Xero's primary key
	public $Date;
	public $Total;
	public $Type;
	public $CreditNoteNumber;
	public $Status;
	public $CurrencyCode;
	
	
	public $ContactID;
	public $Name;
	public $FullyPaidOnDate;

	
	
	
	function __construct($dataarray,$userID)
    {
       // Intitlize all the variable 
	  // print_r($dataarray);
	   foreach($dataarray->CreditNote as $row)
	   {
		   $this->CreditNoteID=$row->CreditNoteID;
		   $this->Date=$row->Date;
		   $this->Total=$row->Total;
		   
		   $this->Type=$row->Type;
		   $this->CreditNoteNumber=$row->CreditNoteNumber;
		   $this->Status=$row->Status;
		   $this->CurrencyCode=$row->CurrencyCode;
		   
		   
		     if(isset($row->Contact->ContactID))
		   {
			   $this->ContactID=$row->Contact->ContactID;
		   }
		     if(isset($row->Contact->Name))
		   {
			   $this->Name=$row->Contact->Name;
		   }
		     if(isset($row->FullyPaidOnDate))
		   {
			   $this->FullyPaidOnDate=$row->FullyPaidOnDate;
		   }
		   
		   
		   //echo $this->AccountID."<br> sdfsdsd ";
		   $this->insert();
	   }
	   return true;
	   
    }
	
	//CRUD
	public function insert(){
	
		$insert = sprintf("INSERT INTO ".$this->_table." 
			(userID, CreditNoteID, Date, Total ,Type, CreditNoteNumber,Status,CurrencyCode,ContactID,Name,FullyPaidOnDate )
			VALUES
			('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
			mysql_real_escape_string($this->userID),
			mysql_real_escape_string($this->CreditNoteID),
			mysql_real_escape_string($this->Date),
			mysql_real_escape_string($this->Total),
			mysql_real_escape_string($this->Type),
			mysql_real_escape_string($this->CreditNoteNumber),
			mysql_real_escape_string($this->Status),
			mysql_real_escape_string($this->CurrencyCode),
			
			mysql_real_escape_string($this->ContactID),
			mysql_real_escape_string($this->Name),
			mysql_real_escape_string($this->FullyPaidOnDate)
			
			);

		$result = mysql_query($insert);
		
	}
	
	/*
	Any other utilities you need here
	*/
	
}


?>