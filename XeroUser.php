<?php
class XeroUser {
	
	//ATTRIBUTES
	public $_title = 'User';
	public $_pk = 'xeroXUserID';  //our primary key title 
	protected $_table = 'xerouser'; //MySQL table name
	
	//OUR FIELDS
	public $xeroXUserID = ''; //Our primary Key
	public $userID = 0;  
	
	//XERO Fields
	public $XUserID; //Xero's primary key
	public $FirstName;
	public $LastName;
	public $OrganisationRole;


	
	
	
	function __construct($dataarray,$userID)
    {
       // Intitlize all the variable 
	  // print_r($dataarray);
	   foreach($dataarray->User as $row)
	   {
		   $this->XUserID=$row->UserID;
		   $this->FirstName=$row->FirstName;
		   $this->LastName=$row->LastName;
		   $this->OrganisationRole=$row->OrganisationRole;
		  
		   
		   
		   //echo $this->AccountID."<br> sdfsdsd ";
		   $this->insert();
	   }
	   return true;
	   
    }
	
	//CRUD
	public function insert(){
	
		$insert = sprintf("INSERT INTO ".$this->_table." 
			(userID, XUserID, FirstName, LastName ,OrganisationRole)
			VALUES
			('%d', '%s', '%s', '%s', '%s');",
			mysql_real_escape_string($this->userID),
			mysql_real_escape_string($this->XUserID),
			mysql_real_escape_string($this->FirstName),
			mysql_real_escape_string($this->LastName),
			mysql_real_escape_string($this->OrganisationRole)
			);

		$result = mysql_query($insert);
		
	}
	
	/*
	Any other utilities you need here
	*/
	
}


?>