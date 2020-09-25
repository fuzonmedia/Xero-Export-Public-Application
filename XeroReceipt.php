<?php
class XeroReceipt {
	
	//ATTRIBUTES
	public $_title = 'Receipt';
	public $_pk = 'xeroReceiptID';  //our primary key title 
	protected $_table = 'xeroreceipt'; //MySQL table name
	
	//OUR FIELDS
	public $xeroReceiptID = ''; //Our primary Key
	public $userID = 0;  
	
	//XERO Fields
	public $ReceiptID; //Xero's primary key
	public $ReceiptNumber;
	public $Status;
	public $Date;
	public $SubTotal;
	public $TotalTax;
	public $Total;


	
	
	
	function __construct($dataarray,$userID)
    {
       // Intitlize all the variable 
	  // print_r($dataarray);
	   foreach($dataarray->Receipt as $row)
	   {
		   $this->ReceiptID=$row->ReceiptID;
		   $this->ReceiptNumber=$row->ReceiptNumber;
		   $this->Status=$row->Status;
		   $this->Date=$row->Date;
		   $this->SubTotal=$row->SubTotal;
		   
		   $this->TotalTax=$row->TotalTax;
		   $this->Total=$row->Total;
		   
		   
		   //echo $this->AccountID."<br> sdfsdsd ";
		   $this->insert();
	   }
	   return true;
	   
    }
	
	//CRUD
	public function insert(){
	
		$insert = sprintf("INSERT INTO ".$this->_table." 
			(userID, ReceiptID, ReceiptNumber, Status ,Date,SubTotal,TotalTax,Total)
			VALUES
			('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
			mysql_real_escape_string($this->userID),
			mysql_real_escape_string($this->ReceiptID),
			mysql_real_escape_string($this->ReceiptNumber),
			mysql_real_escape_string($this->Status),
			mysql_real_escape_string($this->Date),
			mysql_real_escape_string($this->SubTotal),
			mysql_real_escape_string($this->TotalTax),
			mysql_real_escape_string($this->Total)
			);

		$result = mysql_query($insert);
		
	}
	
	/*
	Any other utilities you need here
	*/
	
}


?>