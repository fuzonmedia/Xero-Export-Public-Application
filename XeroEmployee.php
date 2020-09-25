<?php
class XeroEmployee {
	
	//ATTRIBUTES
	public $_title = 'Employee';
	public $_pk = 'xeroEmployeeID';  //our primary key title 
	protected $_table = 'xeroemployee'; //MySQL table name
	
	//OUR FIELDS
	public $xeroEmployeeID = ''; //Our primary Key
	public $userID = 0;  
	
	//XERO Fields
	public $EmployeeID; //Xero's primary key
	public $FirstName;
	public $LastName;


	
	
	
	function __construct($dataarray,$userID)
    {
       // Intitlize all the variable 
	  // print_r($dataarray);
	   foreach($dataarray->Employee as $row)
	   {
		   $this->EmployeeID=$row->EmployeeID;
		   $this->FirstName=$row->FirstName;
		   $this->LastName=$row->LastName;
		   

		   $this->insert();
	   }
	   return true;
	   
    }
	
	//CRUD
	public function insert(){
	
		$insert = sprintf("INSERT INTO ".$this->_table." 
			(userID, EmployeeID, FirstName, LastName )
			VALUES
			('%d', '%s', '%s', '%s');",
			mysql_real_escape_string($this->userID),
			mysql_real_escape_string($this->EmployeeID),
			mysql_real_escape_string($this->FirstName),
			mysql_real_escape_string($this->LastName)
			
			);

		$result = mysql_query($insert);
		
	}
	
	/*
	Any other utilities you need here
	*/
	
}


?>