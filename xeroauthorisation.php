<?php
error_reporting(0);
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Xero Authorisation</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<script language="javascript">
//var xero_methods=new Array("organisation","balancesheet","agedpayablesbycontact");
var xero_methods=new Array("organisation","balancesheet","balancesheet1","profitandloss","profitandloss1","bankstatement","executivesummary");
function process_action(process_id)
{
	$('#processing').html('<img src="ajax-loader.gif">Please wait..');
	 $.ajax({url:"public.php?"+xero_methods[process_id]+"=1",beforeSend: function(){  },
    complete: function(){  },success:function(result){
      //$("#div1").html(result);
	 // alert(result);
	  if(result!='Error')
	  {
	//$('#output_notification').append('<div>'+xero_methods[process_id] +' data Exported <a href="STATEMENTS/'+result+'" target="_blank">View CSV</a></div>'); 
	
	$('#output_notification').append('<div>'+xero_methods[process_id] +' data Exported </div>'); 
	
	  process_id++;
	  //alert(xero_methods.length);
	 
	  if(xero_methods.length>process_id)
	  {
		   //alert(process_id);
		 $('#processing').html('Process Completed');  
		 process_action(process_id); 
		
	  }
	  else
	  {
		  $('#processing').html('Process Completed'); 
		  alert('Thank you, your data has now been successfully exported.');  
	  }
	  }
	  else
	  {
		  
		  //alert(result);
		  $('#processing').html(result);
	  }
    }});
}
</script>

<?php
if($_GET['authorize']=='success')
{
	?>
    <script>
	$( document ).ready(function() {
    //console.log( "ready!" );
	$('#output_notification').append('<div>Your Xero Account Has Been Successfully Authorised, Thank you</div>'); 
	process_action(0);
});
	</script>
<?php
}
?>
</head>

<body>
<div><a href="xeroauthorisation.php"><img src="logo1.png" width="25%" height="25%" /></a></div>
<br />
<br />
<br />

<div><h3>Please click on following link to authorise access to your Xero account data</h3></div>
<?php
if(!isset($_GET['authorize']))
{
	?>
    <div style=" font-size:20px; font-weight:bold"><a href="public.php?authenticate=1">Authorise Xero Account</a></div>
    <?php
}
?>

<div id="processing" style=" width:150px; float:left"></div>
<div id="output_notification" style=" width:600px; float:left"></div>
<div><a href="public.php?wipe=1" style=" width:300px; float:left; display:none">Destroy Session</a></div>
<div style="clear:both"></div>
</body>
</html>
