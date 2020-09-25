<?php
error_reporting(0);
//error_reporting(E_ALL);
date_default_timezone_set('Asia/Singapore');
function TrialBalance($dataarray,$userID)
    {
       // Intitlize all the variable 
	  // print_r($dataarray);
	  
	  try
	  {
	  
	  $my_std_class = json_decode(json_encode($dataarray));
	  $data = $my_std_class;
//print_r($my_std_class);
$output_data='';
//echo $data->$data->Reports[0];
$output_data.='"'.$data->Reports[0]->ReportTitles[0].'","'.$data->Reports[0]->ReportTitles[1].'","'.$data->Reports[0]->ReportTitles[2].'"'."\n";


$col_count=0;

foreach ($data->Reports[0]->Rows as $SingleRow)
{
	// header extarct
	/*if($SingleRow->RowType=="Header")
	{
		//$output_data.='<tr>';
		foreach($SingleRow->Cells as $cellVal)
		{
			$output_data.='"'.$cellVal->Value.'"'.",";
			$col_count++;
		}
		$output_data.="\n";
	}*/
	
	// Body of the table 
	
	if($SingleRow->RowType=="Section")
	{
		$output_data.='"'.$SingleRow->Title.'"'."\n";
		
		foreach($SingleRow->Rows as $rows)
		{
			//$output_data.='<tr>';
			foreach($rows->Cells as $Cells)
		{
			$output_data.='"'.$Cells->Value.'"'.",";
		}
		$output_data.="\n";
		}
		
	}

}
//$output_data.='</table>';

//echo $output_data;
		   
		   
		 
	
		 
		   
		   
		   //echo $this->AccountID."<br> sdfsdsd ";
		  // $this->insert();
		  
		  // Generate Datafile
		  // Create Html

	
	


		$file_name="TrialBalance.csv";

	

//rename($file_name,"STATEMENTS/".$file_name);

$fp=fopen("STATEMENTS/".$_SESSION['orgFolderName']."/".$file_name,'w');
fputs($fp,$output_data);
fclose($fp);


return $file_name;

//echo $output_data;
		  
		  //return $this->collect();
		  
	
	 
	   //return true;
	  }
	  catch (Exception $e)
	  {
		return "Error" ;
	  }
	   
    }


?>