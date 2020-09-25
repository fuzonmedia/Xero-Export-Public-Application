<?php
class XeroAccount {
	
	//ATTRIBUTES
	public $_title = 'Account';
	public $_pk = 'xeroAccountID';  //our primary key title 
	protected $_table = 'xeroaccount'; //MySQL table name
	
	//OUR FIELDS
	public $xeroAccountID = ''; //Our primary Key
	public $userID = 0;  
	
	//XERO Fields
	public $AccountID; //Xero's primary key
	public $Name;
	public $Type;
	public $TaxType;
	public $Description;
	public $EnablePaymentsToAccount;
	public $Status;
	
	
	
	function __construct($dataarray,$userID)
    {
       // Intitlize all the variable 
	  // print_r($dataarray);
	   foreach($dataarray->Account as $row)
	   {
		   $this->AccountID=$row->AccountID;
		   $this->Name=$row->Name;
		   $this->Type=$row->Type;
		   
		   $this->TaxType=$row->TaxType;
		   $this->Description=$row->Description;
		   $this->EnablePaymentsToAccount=$row->EnablePaymentsToAccount;
		   $this->Status=$row->Status;
		   
		   //echo $this->AccountID."<br> sdfsdsd ";
		   $this->insert();
	   }
	   return true;
	   
    }
	
	//CRUD
	public function insert(){
	
		$insert = sprintf("INSERT INTO ".$this->_table." 
			(userID, AccountID, Name, Type,TaxType,Description, EnablePaymentsToAccount,Status )
			VALUES
			('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
			mysql_real_escape_string($this->userID),
			mysql_real_escape_string($this->AccountID),
			mysql_real_escape_string($this->Name),
			mysql_real_escape_string($this->Type),
			mysql_real_escape_string($this->TaxType),
			mysql_real_escape_string($this->Description),
			mysql_real_escape_string($this->EnablePaymentsToAccount),
			mysql_real_escape_string($this->Status)
			
			);

		$result = mysql_query($insert);
		
	}
	
	/*
	Any other utilities you need here
	*/
	
}


?>