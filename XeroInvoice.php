<?php
class XeroInvoice {
	
	//ATTRIBUTES
	public $_title = 'Invoice';
	public $_pk = 'xeroInvoiceID';  //our primary key title 
	protected $_table = 'xeroinvoice'; //MySQL table name
	
	//OUR FIELDS
	public $xeroInvoiceID = ''; //Our primary Key
	public $userID = 0;  
	
	//XERO Fields
	public $InvoiceID; //Xero's primary key
	public $InvoiceNumber;
	public $Reference;
	public $CurrencyCode;
	public $Date;
	public $Status;
	public $Total;
	
	public $SubTotal;
	public $TotalTax;
	public $AmountDue;
	public $AmountPaid;
	
	
	
	public $ContactID;
	public $Name;
	public $DueDate;
	public $Type;
	public $CreditNoteID;
	public $AppliedAmount;

	
	
	
	function __construct($dataarray,$userID)
    {
       // Intitlize all the variable 
	  // print_r($dataarray);
	   foreach($dataarray->Invoice as $row)
	   {
		   $this->InvoiceID=$row->InvoiceID;
		   $this->InvoiceNumber=$row->InvoiceNumber;
		   $this->Reference=$row->Reference;
		   
		   $this->CurrencyCode=$row->CurrencyCode;
		   $this->Date=$row->Date;
		   $this->Status=$row->Status;
		   $this->Total=$row->Total;
		   
		    $this->SubTotal=$row->SubTotal;
			$this->TotalTax=$row->TotalTax;
			$this->AmountDue=$row->AmountDue;
			$this->AmountPaid=$row->AmountPaid;
			
			
			
			
			  if(isset($row->Contact->ContactID))
		   {
			   $this->ContactID=$row->Contact->ContactID;
		   }
		     if(isset($row->Contact->Name))
		   {
			   $this->Name=$row->Contact->Name;
		   }
		   
		       if(isset($row->DueDate))
		   {
			   $this->DueDate=$row->DueDate;
		   }
		        if(isset($row->Type))
		   {
			   $this->Type=$row->Type;
		   }
		          if(isset($row->CreditNotes->CreditNote->CreditNoteID))
		   {
			   $this->CreditNoteID=$row->CreditNotes->CreditNote->CreditNoteID;
		   }
		          if(isset($row->CreditNotes->CreditNote->AppliedAmount))
		   {
			   $this->AppliedAmount=$row->CreditNotes->CreditNote->AppliedAmount;
		   }
		   
		   //echo $this->AccountID."<br> sdfsdsd ";
		   $this->insert();
	   }
	   return true;
	   
    }
	
	//CRUD
	public function insert(){
		
	
		$insert = sprintf("INSERT INTO ".$this->_table." 
			(userID, InvoiceID, InvoiceNumber, Reference ,CurrencyCode, Date,Status,Total,SubTotal,TotalTax,AmountDue,AmountPaid,ContactID,Name,DueDate,Type,CreditNoteID, AppliedAmount)
			VALUES
			('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
			mysql_real_escape_string($this->userID),
			mysql_real_escape_string($this->InvoiceID),
			mysql_real_escape_string($this->InvoiceNumber),
			mysql_real_escape_string($this->Reference),
			mysql_real_escape_string($this->CurrencyCode),
			mysql_real_escape_string($this->Date),
			mysql_real_escape_string($this->Status),
			mysql_real_escape_string($this->Total),
			mysql_real_escape_string($this->SubTotal),
			mysql_real_escape_string($this->TotalTax),
			mysql_real_escape_string($this->AmountDue),
			mysql_real_escape_string($this->AmountPaid),
			
			mysql_real_escape_string($this->ContactID),
			mysql_real_escape_string($this->Name),
			mysql_real_escape_string($this->DueDate),
			mysql_real_escape_string($this->Type),
			mysql_real_escape_string($this->CreditNoteID),
			mysql_real_escape_string($this->AppliedAmount)
			
			);

		$result = mysql_query($insert);
		
	}
	
	/*
	Any other utilities you need here
	*/
	
}


?>