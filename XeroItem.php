<?php
class XeroItem {
	
	//ATTRIBUTES
	public $_title = 'Items';
	public $_pk = 'xeroItemID';  //our primary key title 
	protected $_table = 'xeroitem'; //MySQL table name
	
	//OUR FIELDS
	public $xeroItemID = ''; //Our primary Key
	public $userID = 0;  
	
	//XERO Fields
	public $ItemID; //Xero's primary key
	public $Code;
	public $Description;
	
	
	public $PurchaseDetails_UnitPrice;
	public $PurchaseDetails_AccountCode;
	public $SalesDetails_UnitPrice;
	public $SalesDetails_AccountCode;
	
	
	function __construct($dataarray,$userID)
    {
       // Intitlize all the variable 
	  // print_r($dataarray);
	   foreach($dataarray->Item as $row)
	   {
		   $this->ItemID=$row->ItemID;
		   $this->Code=$row->Code;
		   $this->Description=$row->Description;
		   
		   
		   if(isset($row->PurchaseDetails->UnitPrice))
		   {
			   $this->PurchaseDetails_UnitPrice=$row->PurchaseDetails->UnitPrice;
		   }
		   if(isset($row->PurchaseDetails->AccountCode))
		   {
			   $this->PurchaseDetails_AccountCode=$row->PurchaseDetails->AccountCode;
		   }
		   if(isset($row->SalesDetails->UnitPrice))
		   {
			   $this->SalesDetails_UnitPrice=$row->SalesDetails->UnitPrice;
		   }
		   if(isset($row->SalesDetails->AccountCode))
		   {
			   $this->SalesDetails_AccountCode=$row->SalesDetails->AccountCode;
		   }
		   
		   //echo $this->AccountID."<br> sdfsdsd ";
		   $this->insert();
	   }
	   return true;
	   
    }
	
	//CRUD
	public function insert(){
	
		$insert = sprintf("INSERT INTO ".$this->_table." 
			(userID, ItemID, Code, Description , PurchaseDetails_UnitPrice,PurchaseDetails_AccountCode,SalesDetails_UnitPrice,SalesDetails_AccountCode)
			VALUES
			('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
			mysql_real_escape_string($this->userID),
			mysql_real_escape_string($this->ItemID),
			mysql_real_escape_string($this->Code),
			mysql_real_escape_string($this->Description),
			mysql_real_escape_string($this->PurchaseDetails_UnitPrice),
			mysql_real_escape_string($this->PurchaseDetails_AccountCode),
			mysql_real_escape_string($this->SalesDetails_UnitPrice),
			mysql_real_escape_string($this->SalesDetails_AccountCode)
			);

		$result = mysql_query($insert);
		
	}
	
	/*
	Any other utilities you need here
	*/
	
}
?>