<?php
class XeroContact {
	
	//ATTRIBUTES
	public $_title = 'Contact';
	public $_pk = 'xeroContactID';  //our primary key title 
	protected $_table = 'xerocontact'; //MySQL table name
	
	//OUR FIELDS
	public $xeroContactID = ''; //Our primary Key
	public $userID = 0;  
	
	//XERO Fields
	public $ContactID; //Xero's primary key
	public $Name;
	public $FirstName;
	public $LastName;
	public $EmailAddress;
	public $ContactStatus;
	public $Status;
	
	public $AccountsReceivable_Outstanding;
	public $AccountsReceivable_Overdue;
	public $AccountsPayable_Outstanding;
	public $AccountsPayable_Overdue;
	public $IsSupplier;
	public $IsCustomer;
	
	
	
	function __construct($dataarray,$userID)
    {
       // Intitlize all the variable 
	  // print_r($dataarray);
	   foreach($dataarray->Contact as $row)
	   {
		   $this->ContactID=$row->ContactID;
		   $this->Name=$row->Name;
		   
		   $this->FirstName=$row->FirstName;
		   $this->LastName=$row->LastName;
		   $this->EmailAddress=$row->EmailAddress;
		   $this->ContactStatus=$row->ContactStatus;
		   
		   if(isset($row->Balances->AccountsReceivable->Outstanding))
		   {
			   $this->AccountsReceivable_Outstanding=$row->Balances->AccountsReceivable->Outstanding;
		   }
		    if(isset($row->Balances->AccountsReceivable->Overdue))
		   {
			   $this->AccountsReceivable_Overdue=$row->Balances->AccountsReceivable->Overdue;
		   }
		   
		   
		    if(isset($row->Balances->AccountsPayable->Outstanding))
		   {
			   $this->AccountsPayable_Outstanding=$row->Balances->AccountsPayable->Outstanding;
		   }
		    if(isset($row->Balances->AccountsPayable->Overdue))
		   {
			   $this->AccountsPayable_Overdue=$row->Balances->AccountsPayable->Overdue;
		   }
		   
		   /* if(isset($row->IsSupplier))
		   {
			   if($row->IsSupplier==true)
			   {
			   $this->IsSupplier="true";
			   }
			   else
			   {
				   $this->IsSupplier="false";
			   }
		   }
		   
		       if(isset($row->IsCustomer))
		   {
			   if($row->IsCustomer==true)
			   {
			   $this->IsCustomer="true";
			   }
			   else
			   {
				   $this->IsCustomer="false";
			   }
		   }*/
		   if(isset($row->IsCustomer))
		   {
			   $this->IsCustomer=$row->IsCustomer;
		   }
		   if(isset($row->IsSupplier))
		   {
			   $this->IsSupplier=$row->IsSupplier;
		   }
		  
		   
		   //echo $this->AccountID."<br> sdfsdsd ";
		   $this->insert();
	   }
	   return true;
	   
    }
	
	//CRUD
	public function insert(){
		
	
		$insert = sprintf("INSERT INTO ".$this->_table." 
			(userID, ContactID, Name ,FirstName, LastName,EmailAddress,ContactStatus,AccountsReceivable_Outstanding,AccountsReceivable_Overdue,AccountsPayable_Outstanding,AccountsPayable_Overdue,IsSupplier,IsCustomer )
			VALUES
			('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
			mysql_real_escape_string($this->userID),
			mysql_real_escape_string($this->ContactID),
			mysql_real_escape_string($this->Name),
			mysql_real_escape_string($this->FirstName),
			mysql_real_escape_string($this->LastName),
			mysql_real_escape_string($this->EmailAddress),
			mysql_real_escape_string($this->ContactStatus),
			
			mysql_real_escape_string($this->AccountsReceivable_Outstanding),
			mysql_real_escape_string($this->AccountsReceivable_Overdue),
			mysql_real_escape_string($this->AccountsPayable_Outstanding),
			mysql_real_escape_string($this->AccountsPayable_Overdue),
			mysql_real_escape_string($this->IsSupplier),
			mysql_real_escape_string($this->IsCustomer)
			
			);

		$result = mysql_query($insert);
		
	}
	
	/*
	Any other utilities you need here
	*/
	
}


?>