<?php
error_reporting(0);
date_default_timezone_set('Asia/Singapore');
function XeroOrganisation($dataarray,$userID)
{
	//print_r($dataarray);
	try
	  {
	   foreach($dataarray->Organisation as $row)
	   {
		    
		   if(isset($row->LegalName))
		   {
			 // print_r($row);
		  
		  $APIKey="N/A";
		  if(isset($row->APIKey))
		  {
			 $APIKey=$row->APIKey;  
		  }
		   $Name=$row->Name;
		   $LegalName=$row->LegalName;
		   $BaseCurrency=$row->BaseCurrency;
		  
		   
		   $OrganisationStatus=$row->OrganisationStatus;
		   $PeriodLockDate=$row->PeriodLockDate;
		   
		   
		    if(isset($row->OrganisationType))
		   {
			   $OrganisationType=$row->OrganisationType;
		   }
		   if(isset($row->TaxNumber))
		   {
			   $TaxNumber=$row->TaxNumber;
		   }
		   
		   if(isset($row->CreatedDateUTC))
		   {
			   $CreatedDateUTC=$row->CreatedDateUTC;
		   }
	
	  if(isset($row->OrganisationEntityType))
		   {
			   $OrganisationEntityType=$row->OrganisationEntityType;
		   }
		   
		    $CountryCode=$row->CountryCode;
			
		      if(isset($row->Addresses->Address[0]->AddressType))
		   {
			   $Addresses_1_AddressType=$row->Addresses->Address[0]->AddressType;
		   }
		    if(isset($row->Addresses->Address[0]->AddressLine1))
		   {
			   $Addresses_1_AddressLine1=$row->Addresses->Address[0]->AddressLine1;
		   }
		    if(isset($row->Addresses->Address[0]->AddressLine2))
		   {
			   $Addresses_1_AddressLine2=$row->Addresses->Address[0]->AddressLine2;
		   }
		     if(isset($row->Addresses->Address[0]->City))
		   {
			   $Addresses_1_City=$row->Addresses->Address[0]->City;
		   }
		    if(isset($row->Addresses->Address[0]->PostalCode))
		   {
			    $Addresses_1_PostalCode=$row->Addresses->Address[0]->PostalCode;
		   }
		   
		   
		      if(isset($row->Addresses->Address[1]->AddressType))
		   {
			   $Addresses_2_AddressType=$row->Addresses->Address[1]->AddressType;
		   }
		    if(isset($row->Addresses->Address[1]->AddressLine1))
		   {
			   $Addresses_2_AddressLine1=$row->Addresses->Address[1]->AddressLine1;
		   }
		    if(isset($row->Addresses->Address[1]->AddressLine2))
		   {
			   $Addresses_2_AddressLine2=$row->Addresses->Address[1]->AddressLine2;
		   }
		     if(isset($row->Addresses->Address[1]->City))
		   {
			   $Addresses_2_City=$row->Addresses->Address[1]->City;
		   }
		    if(isset($row->Addresses->Address[1]->PostalCode))
		   {
			    $Addresses_2_PostalCode=$row->Addresses->Address[1]->PostalCode;
		   }
		   
		   	     
			   
		 if(isset($row->Phones->Phone[0]->PhoneType))
		   {
			    $Phones_1_PhoneType=$row->Phones->Phone[0]->PhoneType;
		   }	
		    if(isset($row->Phones->Phone[0]->PhoneNumber))
		   {
			    $Phones_1_PhoneNumber=$row->Phones->Phone[0]->PhoneNumber;
		   }
		    if(isset($row->Phones->Phone[0]->PhoneAreaCode))
		   {
			    $Phones_1_PhoneAreaCode=$row->Phones->Phone[0]->PhoneAreaCode;
		   }
			  
			  
			  	 if(isset($row->Phones->Phone[1]->PhoneType))
		   {
			    $Phones_2_PhoneType=$row->Phones->Phone[1]->PhoneType;
		   }	
		    if(isset($row->Phones->Phone[1]->PhoneNumber))
		   {
			    $Phones_2_PhoneNumber=$row->Phones->Phone[1]->PhoneNumber;
		   }
		    if(isset($row->Phones->Phone[1]->PhoneAreaCode))
		   {
			    $Phones_2_PhoneAreaCode=$row->Phones->Phone[1]->PhoneAreaCode;
		   }
		   
		   	  	 if(isset($row->Phones->Phone[2]->PhoneType))
		   {
			    $Phones_3_PhoneType=$row->Phones->Phone[2]->PhoneType;
		   }	
		    if(isset($row->Phones->Phone[2]->PhoneNumber))
		   {
			    $Phones_3_PhoneNumber=$row->Phones->Phone[2]->PhoneNumber;
		   }
		    if(isset($row->Phones->Phone[2]->PhoneAreaCode))
		   {
			    $Phones_3_PhoneAreaCode=$row->Phones->Phone[2]->PhoneAreaCode;
		   }
		   
		      	  	 if(isset($row->Phones->Phone[3]->PhoneType))
		   {
			    $Phones_4_PhoneType=$row->Phones->Phone[3]->PhoneType;
		   }	
		    if(isset($row->Phones->Phone[3]->PhoneNumber))
		   {
			    $Phones_4_PhoneNumber=$row->Phones->Phone[3]->PhoneNumber;
		   }

		    if(isset($row->Phones->Phone[3]->PhoneAreaCode))
		   {
			    $Phones_4_PhoneAreaCode=$row->Phones->Phone[3]->PhoneAreaCode;
		   }
			 
		   
		   
		   //echo $AccountID."<br> sdfsdsd ";
		  // $insert();
		  
		  // Generate Datafile
		  // Create Html

	
	


		$file_name="Org-Details.csv";

		// $html='<div  align="center">Organization Details</div>';
		// $html.='<table width="100%">';
		 $html.='Name,"'.$Name."\"\n"; 
		 $html.='APIKey,"'.$APIKey."\"\n"; 
		 $html.='LegalName,"'.$LegalName."\"\n"; 
		 $html.='BaseCurrency,"'.$BaseCurrency."\"\n"; 
		 $html.='PeriodLockDate,"'.$PeriodLockDate."\"\n"; 
		 $html.='OrganisationType,"'.$OrganisationType."\"\n"; 
		 $html.='TaxNumber,"'.$TaxNumber."\"\n"; 
		 $html.='CreatedDateUTC,"'.$CreatedDateUTC."\"\n"; 
		 $html.='OrganisationEntityType,"'.$OrganisationEntityType."\"\n"; 
		 $html.='CountryCode,"'.$CountryCode."\"\n"; 
		 $html.='Addresses_1_AddressType,"'.$Addresses_1_AddressType."\"\n"; 
		 $html.='Addresses_1_AddressLine1,"'.$Addresses_1_AddressLine1."\"\n"; 
		// $html.='</table>'; 
		
		$replaced_char = array("/", "\\");
	
		
		$folder_name= str_replace($replaced_char, "", $LegalName);
		
		$_SESSION['orgFolderName']=substr($folder_name,0,4)."_".date('Y-m-d- H_i_s');
		mkdir("STATEMENTS/".$_SESSION['orgFolderName']);
		  

$fp=fopen("STATEMENTS/".$_SESSION['orgFolderName']."/".$file_name,'w');
fputs($fp, $html);
fclose($fp);

//rename($file_name,"STATEMENTS/".$file_name);

//echo $html;

return $file_name;
		  
		  //return $collect();
		  
		   }
	   }
	  }
	   catch (Exception $e)
	  {
		return "Error" ;
	  }
	
}
?>