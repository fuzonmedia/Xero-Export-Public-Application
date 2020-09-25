<?php
class XeroPayment {
	
	//ATTRIBUTES
	public $_title = 'Payment';
	public $_pk = 'xeroPaymentID';  //our primary key title 
	protected $_table = 'xeropayment'; //MySQL table name
	
	//OUR FIELDS
	public $xeroPaymentID = ''; //Our primary Key
	public $userID = 0;  
	
	//XERO Fields
	public $PaymentID; //Xero's primary key
	public $Date;
	public $Amount;
	public $PaymentType;
	public $Status;
	public $InvoiceID;
	
	public $AccountID;


	
	
	
	function __construct($dataarray,$userID)
    {
       // Intitlize all the variable 
	  // print_r($dataarray);
	   foreach($dataarray->Payment as $row)
	   {
		   $this->PaymentID=$row->PaymentID;
		   $this->Date=$row->Date;
		   $this->Amount=$row->Amount;
		   $this->PaymentType=$row->PaymentType;
		   $this->Status=$row->Status;
		   
		   $this->InvoiceID=$row->Invoice->InvoiceID;
		   
		   
		    if(isset($row->Account->AccountID))
		   {
			   $this->AccountID=$row->Account->AccountID;
		   }
		   
		   //echo $this->AccountID."<br> sdfsdsd ";
		   $this->insert();
	   }
	   return true;
	   
    }
	
	//CRUD
	public function insert(){
	
		$insert = sprintf("INSERT INTO ".$this->_table." 
			(userID, PaymentID, Date, Amount ,PaymentType,Status,InvoiceID,AccountID)
			VALUES
			('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
			mysql_real_escape_string($this->userID),
			mysql_real_escape_string($this->PaymentID),
			mysql_real_escape_string($this->Date),
			mysql_real_escape_string($this->Amount),
			mysql_real_escape_string($this->PaymentType),
			mysql_real_escape_string($this->Status),
			mysql_real_escape_string($this->InvoiceID),
			mysql_real_escape_string($this->AccountID)
			);

		$result = mysql_query($insert);
		
	}
	
	/*
	Any other utilities you need here
	*/
	
}


?>