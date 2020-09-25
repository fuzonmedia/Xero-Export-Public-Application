<?php
error_reporting(0);
//include("dbcon.php");
//include("XeroAccount.php");
//include("XeroItem.php");
//include("XeroContact.php");
//include("XeroCreditNote.php");

//include("XeroEmployee.php");
//include("XeroInvoice.php");
//include("XeroJournal.php");
//include("XeroManualJournal.php");
include("XeroOrganisation.php");
//include("XeroPayment.php");
//include("XeroReceipt.php");
//include("XeroUser.php");
include("XeroBalanceSheet.php");
include("XeroBalanceSheet1.php");
include("ProfitAndLoss.php");
include("ProfitAndLoss1.php");
include("BankStatement.php");
include("TrialBalance.php");
include("ExecutiveSummary.php");



// The user ID need to be assigned through session .... session is already working in that page 
$userID=0;
if (isset($_REQUEST)){
	if (!isset($_REQUEST['where'])) $_REQUEST['where'] = "";
}
	
if ( isset($_REQUEST['wipe'])) {
  session_destroy();
  header("Location: xeroauthorisation.php");

// already got some credentials stored?
} elseif(isset($_REQUEST['refresh'])) {
    $response = $XeroOAuth->refreshToken($oauthSession['oauth_token'], $oauthSession['oauth_session_handle']);
    if ($XeroOAuth->response['code'] == 200) {
        $session = persistSession($response);
        $oauthSession = retrieveSession();
    } else {
        outputError($XeroOAuth);
        if ($XeroOAuth->response['helper'] == "TokenExpired") $XeroOAuth->refreshToken($oauthSession['oauth_token'], $oauthSession['session_handle']);
    }

} elseif ( isset($oauthSession['oauth_token']) && isset($_REQUEST) ) {

    $XeroOAuth->config['access_token']  = $oauthSession['oauth_token'];
    $XeroOAuth->config['access_token_secret'] = $oauthSession['oauth_token_secret'];
    $XeroOAuth->config['session_handle'] = $oauthSession['oauth_session_handle'];


/*
/// NIL EDIT / ADD start 

    if (isset($_REQUEST['accounts'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('Accounts', 'core'), array('Where' => $_REQUEST['where']));
        if ($XeroOAuth->response['code'] == 200) {
            $accounts = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
          //  echo "There are " . count($accounts->Accounts[0]). " accounts in this Xero organisation, the first one is: </br>";
           // pr($accounts->Accounts[0]->Account);
		  // print_r($accounts->Accounts[0]);
		  
		  
		  /// Call Account method to insert into db 
		  
		  $output_result=new XeroAccount($accounts->Accounts[0],$userID);
		  echo "success";
		  
        } else {
            outputError($XeroOAuth);
        }
		
		
    }
	
	  if (isset($_REQUEST['items'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('Items', 'core'), array('Where' => $_REQUEST['where']));
        if ($XeroOAuth->response['code'] == 200) {
            $items = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
           // echo "There are " . count($currencies->Currencies[0]). " accounts in this Xero organisation, the first one is: </br>";
           // pr($accounts->Accounts[0]->Account);
		    $output_result=new XeroItem($items->Items[0],$userID);
		   echo "success";
        } else {
            outputError($XeroOAuth);
        }
    }
	
	
	  if (isset($_REQUEST['contacts'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('Contacts', 'core'), array('Where' => $_REQUEST['where']));
        if ($XeroOAuth->response['code'] == 200) {
            $contacts = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
           // echo "There are " . count($currencies->Currencies[0]). " accounts in this Xero organisation, the first one is: </br>";
           // pr($accounts->Accounts[0]->Account);
		    $output_result=new XeroContact($contacts->Contacts[0],$userID);
		   echo "success";
        } else {
            outputError($XeroOAuth);
        }
    }
	
	
		  if (isset($_REQUEST['creditnotes'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('CreditNotes', 'core'), array('Where' => $_REQUEST['where']));
        if ($XeroOAuth->response['code'] == 200) {
            $creditnotes = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
           // echo "There are " . count($currencies->Currencies[0]). " accounts in this Xero organisation, the first one is: </br>";
           // pr($accounts->Accounts[0]->Account);
		    $output_result=new XeroCreditNote($creditnotes->CreditNotes[0],$userID);
		   echo "success";
        } else {
            outputError($XeroOAuth);
        }
    }
	
	
	  if (isset($_REQUEST['employees'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('Employees', 'core'), array('Where' => $_REQUEST['where']));
        if ($XeroOAuth->response['code'] == 200) {
            $employees = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
           // echo "There are " . count($currencies->Currencies[0]). " accounts in this Xero organisation, the first one is: </br>";
           // pr($accounts->Accounts[0]->Account);
		    $output_result=new XeroEmployee($employees->Employees[0],$userID);
		   echo "success";
        } else {
            outputError($XeroOAuth);
        }
    }
	
	
	
	  if (isset($_REQUEST['invoices'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('Invoices', 'core'), array('Where' => $_REQUEST['where']));
        if ($XeroOAuth->response['code'] == 200) {
            $invoices = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
           // echo "There are " . count($currencies->Currencies[0]). " accounts in this Xero organisation, the first one is: </br>";
           // pr($accounts->Accounts[0]->Account);
		    $output_result=new XeroInvoice($invoices->Invoices[0],$userID);
		   echo "success";
        } else {
            outputError($XeroOAuth);
        }
    }
	
	
	  if (isset($_REQUEST['journals'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('Journals', 'core'), array('Where' => $_REQUEST['where']));
        if ($XeroOAuth->response['code'] == 200) {
            $journals = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
           // echo "There are " . count($currencies->Currencies[0]). " accounts in this Xero organisation, the first one is: </br>";
           // pr($accounts->Accounts[0]->Account);
		    $output_result=new XeroJournal($journals->Journals[0],$userID);
		   echo "success";
        } else {
            outputError($XeroOAuth);
        }
    }
	
	
	  if (isset($_REQUEST['manualjournals'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('ManualJournals', 'core'), array('Where' => $_REQUEST['where']));
        if ($XeroOAuth->response['code'] == 200) {
            $manualjournals = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
           // echo "There are " . count($currencies->Currencies[0]). " accounts in this Xero organisation, the first one is: </br>";
           // pr($accounts->Accounts[0]->Account);
		    $output_result=new XeroManualJournal($manualjournals->ManualJournals[0],$userID);
		   echo "success";
        } else {
            outputError($XeroOAuth);
        }
    }
	
	
	  
	
	  if (isset($_REQUEST['payments'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('Payments', 'core'), array('Where' => $_REQUEST['where']));
        if ($XeroOAuth->response['code'] == 200) {
            $payments = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
           // echo "There are " . count($currencies->Currencies[0]). " accounts in this Xero organisation, the first one is: </br>";
           // pr($accounts->Accounts[0]->Account);
		    $output_result=new XeroPayment($payments->Payments[0],$userID);
		   echo "success";
        } else {
            outputError($XeroOAuth);
        }
    }
	
	  if (isset($_REQUEST['receipts'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('Receipts', 'core'), array('Where' => $_REQUEST['where']));
        if ($XeroOAuth->response['code'] == 200) {
            $receipts = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
           // echo "There are " . count($currencies->Currencies[0]). " accounts in this Xero organisation, the first one is: </br>";
           // pr($accounts->Accounts[0]->Account);
		    $output_result=new XeroReceipt($receipts->Receipts[0],$userID);
		   echo "success";
        } else {
            outputError($XeroOAuth);
        }
    }
	
	  if (isset($_REQUEST['users'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('Users', 'core'), array('Where' => $_REQUEST['where']));
        if ($XeroOAuth->response['code'] == 200) {
            $users = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
           // echo "There are " . count($currencies->Currencies[0]). " accounts in this Xero organisation, the first one is: </br>";
           // pr($accounts->Accounts[0]->Account);
		    $output_result=new XeroUser($users->Users[0],$userID);
		   echo "success";
        } else {
            outputError($XeroOAuth);
        }
    }
	
	
	
	///// NIL EDIT/ ADD END 
	
	
	
	
	

    if (isset($_REQUEST['accountsfilter'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('Accounts', 'core'), array('Where' => 'Type=="BANK"'));
        if ($XeroOAuth->response['code'] == 200) {
            $accounts = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
            echo "There are " . count($accounts->Accounts[0]). " accounts in this Xero organisation, the first one is: </br>";
            pr($accounts->Accounts[0]->Account);
        } else {
            outputError($XeroOAuth);
        }
    }
    if (isset($_REQUEST['payrollemployees'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('Employees', 'payroll'), array());
        if ($XeroOAuth->response['code'] == 200) {
            $employees = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
            echo "There are " . count($employees->Employees[0]). " employees in this Xero organisation, the first one is: </br>";
            pr($employees->Employees[0]->Employee);
        } else {
            outputError($XeroOAuth);
        }
    }
    if (isset($_REQUEST['payruns'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('PayRuns', 'payroll'), array('Where' => $_REQUEST['where']));
        if ($XeroOAuth->response['code'] == 200) {
            $accounts = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
            echo "There are " . count($accounts->PayRuns[0]). " PayRuns in this Xero organisation, the first one is: </br>";
            pr($accounts->PayRuns[0]->PayRun);
        } else {
            outputError($XeroOAuth);
        }
    }
    if (isset($_REQUEST['superfundproducts'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('SuperFundProducts', 'payroll'), array('ABN' => $_REQUEST['where']));
        if ($XeroOAuth->response['code'] == 200) {
            $accounts = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
            echo "There are " . count($accounts->SuperFundProducts[0]). " SuperFundProducts in this Xero organisation, the first one is: </br>";
            pr($accounts->SuperFundProducts[0]->SuperFundProduct[0]);
        } else {
            outputError($XeroOAuth);
        }
    }
	
    if (isset($_REQUEST['invoice'])) {
        if (!isset($_REQUEST['method'])) {
            $response = $XeroOAuth->request('GET', $XeroOAuth->url('Invoices', 'core'), array());
            if ($XeroOAuth->response['code'] == 200) {
                $invoices = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
                echo "There are " . count($invoices->Invoices[0]). " invoices in this Xero organisation, the first one is: </br>";
                pr($invoices->Invoices[0]->Invoice);
                if ($_REQUEST['invoice']=="pdf") {
                    $response = $XeroOAuth->request('GET', $XeroOAuth->url('Invoice/'.$invoices->Invoices[0]->Invoice->InvoiceID, 'core'), array(), "", 'pdf');
                    if ($XeroOAuth->response['code'] == 200) {
                        $myFile = $invoices->Invoices[0]->Invoice->InvoiceID.".pdf";
                        $fh = fopen($myFile, 'w') or die("can't open file");
                        fwrite($fh, $XeroOAuth->response['response']);
                        fclose($fh);
                        echo "PDF copy downloaded, check your the directory of this script.</br>";
                    } else {
                        outputError($XeroOAuth);
                    }
                }
            } else {
                outputError($XeroOAuth);
            }
        } elseif (isset($_REQUEST['method']) && $_REQUEST['method'] == "put" && $_REQUEST['invoice']== 1 ) {
            $xml = "<Invoices>
                      <Invoice>
                        <Type>ACCREC</Type>
                        <Contact>
                          <Name>Martin Hudson</Name>
                        </Contact>
                        <Date>2013-05-13T00:00:00</Date>
                        <DueDate>2013-05-20T00:00:00</DueDate>
                        <LineAmountTypes>Exclusive</LineAmountTypes>
                        <LineItems>
                          <LineItem>
                            <Description>Monthly rental for property at 56a Wilkins Avenue</Description>
                            <Quantity>4.3400</Quantity>
                            <UnitAmount>395.00</UnitAmount>
                            <AccountCode>200</AccountCode>
                          </LineItem>
                        </LineItems>
                      </Invoice>
                    </Invoices>";
            $response = $XeroOAuth->request('PUT', $XeroOAuth->url('Invoices', 'core'), array(), $xml);
            if ($XeroOAuth->response['code'] == 200) {
                $invoice = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
                echo "" . count($invoice->Invoices[0]). " invoice created in this Xero organisation.";
                if (count($invoice->Invoices[0])>0) {
                    echo "The first one is: </br>";
                    pr($invoice->Invoices[0]->Invoice);
                }
            } else {
                outputError($XeroOAuth);
            }
        } elseif (isset($_REQUEST['method']) && $_REQUEST['method'] == "post" ) {
            $xml = "<Invoices>
                      <Invoice>
                        <Type>ACCREC</Type>
                        <Contact>
                          <Name>Martin Hudson</Name>
                        </Contact>
                        <Date>2013-05-13T00:00:00</Date>
                        <DueDate>2013-05-20T00:00:00</DueDate>
                        <LineAmountTypes>Exclusive</LineAmountTypes>
                        <LineItems>
                          <LineItem>
                            <Description>Monthly rental for property at 56a Wilkins Avenue</Description>
                            <Quantity>4.3400</Quantity>
                            <UnitAmount>395.00</UnitAmount>
                            <AccountCode>200</AccountCode>
                          </LineItem>
                       </LineItems>
                     </Invoice>
                   </Invoices>";
            $response = $XeroOAuth->request('POST', $XeroOAuth->url('Invoices', 'core'), array(), $xml);
            if ($XeroOAuth->response['code'] == 200) {
                $invoice = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
                echo "" . count($invoice->Invoices[0]). " invoice created in this Xero organisation.";
                if (count($invoice->Invoices[0])>0) {
                    echo "The first one is: </br>";
                    pr($invoice->Invoices[0]->Invoice);
                    outputError($XeroOAuth);
                }
            } else {
                outputError($XeroOAuth);
            }
        }elseif (isset($_REQUEST['method']) && $_REQUEST['method'] == "put" && $_REQUEST['invoice']=="attachment" ) {
	        $response = $XeroOAuth->request('GET', $XeroOAuth->url('Invoices', 'core'), array('Where' => 'Status=="DRAFT"'));
	            if ($XeroOAuth->response['code'] == 200) {
	                $invoices = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
	                echo "There are " . count($invoices->Invoices[0]). " draft invoices in this Xero organisation, the first one is: </br>";
	                pr($invoices->Invoices[0]->Invoice);
	                if ($_REQUEST['invoice']=="attachment") {
	                	$attachmentFile = file_get_contents('http://i.imgur.com/mkDFLf2.png');

	                    $response = $XeroOAuth->request('PUT', $XeroOAuth->url('Invoice/'.$invoices->Invoices[0]->Invoice->InvoiceID.'/Attachments/image.png', 'core'), array(), $attachmentFile, 'file');
	                		if ($XeroOAuth->response['code'] == 200) {
                				$invoice = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
                					echo "" . count($invoice->Invoices[0]). " invoice created in this Xero organisation.";
                						if (count($invoice->Invoices[0])>0) {
                    					echo "The first one is: </br>";
                    					pr($invoice->Invoices[0]->Invoice);
                						}
				            } else {
				                outputError($XeroOAuth);
				            }
	                    echo "PDF copy downloaded, check the directory of this script for the file.</br>";
	                }
	            } else {
	                outputError($XeroOAuth);
	            }
           
        }


    }  
	
    if (isset($_REQUEST['invoicesfilter'])) {
       $response = $XeroOAuth->request('GET', $XeroOAuth->url('Invoices', 'core'), array('Where' => 'Contact.Name.Contains("Martin")'));
       if ($XeroOAuth->response['code'] == 200) {
           $accounts = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
           echo "There are " . count($accounts->Invoices[0]). " matching invoices in this Xero organisation, the first one is: </br>";
           pr($accounts->Invoices[0]->Invoice);
       } else {
           outputError($XeroOAuth);
       }
   }
if (isset($_REQUEST['invoicesmodified'])) {
       $response = $XeroOAuth->request('GET', $XeroOAuth->url('Invoices', 'core'), array('If-Modified-Since' => gmdate("M d Y H:i:s",(time() - (1 * 24 * 60 * 60)))));
       if ($XeroOAuth->response['code'] == 200) {
           $accounts = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
           echo "There are " . count($accounts->Invoices[0]). " matching invoices in this Xero organisation, the first one is: </br>";
           pr($accounts->Invoices[0]->Invoice);
       } else {
           outputError($XeroOAuth);
       }
   }
  
   if (isset($_REQUEST['banktransactions'])) {
       if (!isset($_REQUEST['method'])) {
           $response = $XeroOAuth->request('GET', $XeroOAuth->url('BankTransactions', 'core'), array(), "", "xml");
           if ($XeroOAuth->response['code'] == 200) {
               $banktransactions = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
               echo "There are " . count($banktransactions->BankTransactions[0]). " bank transactions in this Xero organisation.";
               if (count($banktransactions->BankTransactions[0])>0) {
                   echo "The first one is: </br>";
                   pr($banktransactions->BankTransactions[0]->BankTransaction);
               }
           } else {
               outputError($XeroOAuth);
           }
       } elseif (isset($_REQUEST['method']) && $_REQUEST['method'] == "put" ) {
           $xml = "<BankTransactions>
                     <BankTransaction>
                     <Type>SPEND</Type>
                     <Contact>
                       <Name>Westpac</Name>
                     </Contact>
                     <Date>2013-04-16T00:00:00</Date>
                     <LineItems>
                       <LineItem>
                         <Description>Yearly Bank &amp; Account Fee</Description>
                         <Quantity>1.0000</Quantity>
                         <UnitAmount>20.00</UnitAmount>
                         <AccountCode>400</AccountCode>
                      </LineItem>
                    </LineItems>
                    <BankAccount>
                      <Code>090</Code>
                    </BankAccount>
                  </BankTransaction>
                </BankTransactions>";
           $response = $XeroOAuth->request('PUT', $XeroOAuth->url('BankTransactions', 'core'), array(), $xml);
           if ($XeroOAuth->response['code'] == 200) {
               $banktransactions = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
               echo "There are " . count($banktransactions->BankTransactions[0]). " successful bank transaction(s) created in this Xero organisation.";
               if (count($banktransactions->BankTransactions[0])>0) {
                   echo "The first one is: </br>";
                   pr($banktransactions->BankTransactions[0]->BankTransaction);
               }
           } else {
               outputError($XeroOAuth);
           }
       }
   }

  if( isset($_REQUEST['contacts'])) {
       if (!isset($_REQUEST['method'])) {
           $response = $XeroOAuth->request('GET', $XeroOAuth->url('Contacts', 'core'), array());
           if ($XeroOAuth->response['code'] == 200) {
               $contacts = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
               echo "There are " . count($contacts->Contacts[0]). " contacts in this Xero organisation, the first one is: </br>";
               pr($contacts->Contacts[0]->Contact);

           } else {
               outputError($XeroOAuth);
           }
       } elseif(isset($_REQUEST['method']) && $_REQUEST['method'] == "post" ){
           $xml = "<Contacts>
                     <Contact>
                       <Name>Matthew and son</Name>
                       <EmailAddress>emailaddress@yourdomain.com</EmailAddress>
                       <SkypeUserName>matthewson_test99</SkypeUserName>
                       <FirstName>Matthew</FirstName>
                       <LastName>Masters</LastName>
                     </Contact>
                   </Contacts>
                   ";
           $response = $XeroOAuth->request('POST', $XeroOAuth->url('Contacts', 'core'), array(), $xml);
           if ($XeroOAuth->response['code'] == 200) {
               $contact = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
               echo "" . count($contact->Contacts[0]). " contact created/updated in this Xero organisation.";
               if (count($contact->Contacts[0])>0) {
                   echo "The first one is: </br>";
                   pr($contact->Contacts[0]->Contact);
               }
           } else {
               outputError($XeroOAuth);
           }
       }elseif(isset($_REQUEST['method']) && $_REQUEST['method'] == "put" ){
    $xml = "<Contacts>
            <Contact>
              <Name>Orlena Greenville</Name>
            </Contact>
          </Contacts>";
    $response = $XeroOAuth->request('PUT', $XeroOAuth->url('Contacts', 'core'), array(), $xml);
      if ($XeroOAuth->response['code'] == 200) {
        $contacts = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
        echo "There are " . count($contacts->Contacts[0]). " successful contact(s) created in this Xero organisation.";
        if(count($contacts->Contacts[0])>0){
          echo "The first one is: </br>";
          pr($contacts->Contacts[0]->Contact);
        }
      } else {
        outputError($XeroOAuth); 
      }
  }
   }


   if (isset($_REQUEST['organisation'])) {
       $response = $XeroOAuth->request('GET', $XeroOAuth->url('Organisation', 'core'), array('page' => 0));
       if ($XeroOAuth->response['code'] == 200) {
           $organisation = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
           echo "Organisation name: " . $organisation->Organisations[0]->Organisation->Name;
       } else {
           outputError($XeroOAuth);
       }
   }


   
*/

if (isset($_REQUEST['organisation'])) {
        $response = $XeroOAuth->request('GET', $XeroOAuth->url('Organisation', 'core'), array('Where' => $_REQUEST['where']));
        if ($XeroOAuth->response['code'] == 200) {
            $organisation = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
           // echo "There are " . count($currencies->Currencies[0]). " accounts in this Xero organisation, the first one is: </br>";
           // pr($accounts->Accounts[0]->Account);
		   
		   //print_r($organisation->Organisations[0]);
		    $output_result=XeroOrganisation($organisation->Organisations[0],$userID);
		   echo $output_result;
        } else {
           // outputError($XeroOAuth);
		   echo "Error";
        }
    }
	

   if (isset($_REQUEST['balancesheet'])) {
	   
	   
	   //1. 30th June 2014 
	   
	    $mnth_now=date('n');
		  $mnth_for_calculation_from=$mnth_now+1;
		  
		  $year_now=date('Y');
		  $year_for_calculation_from=$year_now-2;
		  
		   $year_for_calculation_to=$year_for_calculation_from+1;
		  
		 if($mnth_now<10)
		  {
		  $calculation_to = $year_for_calculation_to."-0".$mnth_now."-".date('t');
		  }
		  else
		  {
			  $calculation_to = $year_for_calculation_to."-".$mnth_now."-".date('t');
		  }
		  
		  
		  //echo $calculation_to;
	   
       $response = $XeroOAuth->request('GET', $XeroOAuth->url('Reports/BalanceSheet', 'core'), array('page' => 0,'date'=> $calculation_to),"",'json');
       if ($XeroOAuth->response['code'] == 200) {
           $report = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
         //  echo "Organisation name: " . $report->Organisations[0]->Organisation->Name;
		 
		  $output_result=XeroBalanceSheet($report,$userID);
		   //session_destroy();
		   echo $output_result;
       } else {
           //outputError($XeroOAuth);
		   echo "Error";
       }
   }
   
     if (isset($_REQUEST['balancesheet1'])) {
	   
	   
	   //2. 31st May 2015
	   
	     $end_mnth_now=date('Y-m-d');
		  
		  $dd=date('j');
		  
		  $lastmnth_endDate=date('Y-m-d',strtotime($end_mnth_now."-".$dd." days"));
		 // echo  $lastmnth_endDate;
		  
		  
		  //echo $calculation_to;
	   
       $response = $XeroOAuth->request('GET', $XeroOAuth->url('Reports/BalanceSheet', 'core'), array('page' => 0,'date'=> $lastmnth_endDate),"",'json');
       if ($XeroOAuth->response['code'] == 200) {
           $report = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
         //  echo "Organisation name: " . $report->Organisations[0]->Organisation->Name;
		 
		  $output_result=XeroBalanceSheet1($report,$userID);
		   //session_destroy();
		   echo $output_result;
       } else {
           //outputError($XeroOAuth);
		   echo "Error";
       }
   }
   ////////Start
   
     if (isset($_REQUEST['executivesummary'])) {
	   
	   
	   // pull executive summary
	   
	     $end_mnth_now=date('Y-m-d');
		  
		  $dd=date('j');
		  
		  $lastmnth_endDate=date('Y-m-d',strtotime($end_mnth_now."-".$dd." days"));
		 // echo  $lastmnth_endDate;
		  
		  
		  //echo $calculation_to;
	   
       $response = $XeroOAuth->request('GET', $XeroOAuth->url('Reports/ExecutiveSummary', 'core'), array('page' => 0),"",'json');
       if ($XeroOAuth->response['code'] == 200) {
           $report = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
         //  echo "Organisation name: " . $report->Organisations[0]->Organisation->Name;
		 
		  $output_result=ExecutiveSummary($report,$userID);
		   //session_destroy();
		   echo $output_result;
       } else {
           //outputError($XeroOAuth);
		   echo "Error";
       }
   }
   
   

   
   //////////////End
   
      if (isset($_REQUEST['profitandloss'])) {
		  
		  //so first data pull is date range 01/07/13 to 30/6/14 and second is date range 01/07/2012 to 30/6/2013
		  
		  $mnth_now=date('n');
		  $mnth_for_calculation_from=$mnth_now+1;
		  
		  $year_now=date('Y');
		  $year_for_calculation_from=$year_now-2;
		  if($mnth_for_calculation_from<10)
		  {
		  $calculation_from=$year_for_calculation_from."-0".$mnth_for_calculation_from."-01";
		  }
		  else
		  {
			$calculation_from=$year_for_calculation_from."-".$mnth_for_calculation_from."-01";  
		  }
		  
		  //echo  $calculation_from;
		  
		  $year_for_calculation_to=$year_for_calculation_from+1;
		  
		 if($mnth_now<10)
		  {
		  $calculation_to = $year_for_calculation_to."-0".$mnth_now."-".date('t');
		  }
		  else
		  {
			  $calculation_to = $year_for_calculation_to."-".$mnth_now."-".date('t');
		  }
		  
		 // echo  "<br>".$calculation_to;
		  
		//  $toDate=date('Y-m-d');
//		  $fromDate_time=strtotime($toDate." -1 year");
//		  $fromDate=date('Y-m-d',$fromDate_time);
//		  $bank_statement_arrs=array();
       $response = $XeroOAuth->request('GET', $XeroOAuth->url('Reports/ProfitAndLoss', 'core'), array('page' => 0,'fromDate'=>$calculation_from,'toDate'=>$calculation_to),"",'json');
       if ($XeroOAuth->response['code'] == 200) {
           $report = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
         //  echo "Organisation name: " . $report->Organisations[0]->Organisation->Name;
		 
		// print_r($report);
		 
		  $output_result=ProfitAndLoss($report,$userID);
		   //session_destroy();
		   echo $output_result;
       } else {
          // outputError($XeroOAuth);
		   echo "Error";
       }
   }
   
      if (isset($_REQUEST['profitandloss1'])) {
		  
		  //so first data pull is date range 01/07/13 to 30/6/14 and second is date range 01/07/2012 to 30/6/2013
		  
		  $mnth_now=date('n');
		  $mnth_for_calculation_from=$mnth_now+1;
		  
		  $year_now=date('Y');
		  $year_for_calculation_from=$year_now-3;
		  if($mnth_for_calculation_from<10)
		  {
		  $calculation_from=$year_for_calculation_from."-0".$mnth_for_calculation_from."-01";
		  }
		  else
		  {
			$calculation_from=$year_for_calculation_from."-".$mnth_for_calculation_from."-01";  
		  }
		  
		  //echo  $calculation_from;
		  
		  $year_for_calculation_to=$year_for_calculation_from+1;
		  
		 if($mnth_now<10)
		  {
		  $calculation_to = $year_for_calculation_to."-0".$mnth_now."-".date('t');
		  }
		  else
		  {
			  $calculation_to = $year_for_calculation_to."-".$mnth_now."-".date('t');
		  }
		  
		 // echo  "<br>".$calculation_to;
		  
		//  $toDate=date('Y-m-d');
//		  $fromDate_time=strtotime($toDate." -1 year");
//		  $fromDate=date('Y-m-d',$fromDate_time);
//		  $bank_statement_arrs=array();
       $response = $XeroOAuth->request('GET', $XeroOAuth->url('Reports/ProfitAndLoss', 'core'), array('page' => 0,'fromDate'=>$calculation_from,'toDate'=>$calculation_to),"",'json');
       if ($XeroOAuth->response['code'] == 200) {
           $report = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
         //  echo "Organisation name: " . $report->Organisations[0]->Organisation->Name;
		 
		// print_r($report);
		 
		  $output_result=ProfitAndLoss1($report,$userID);
		   //session_destroy();
		   echo $output_result;
       } else {
          // outputError($XeroOAuth);
		   echo "Error";
       }
   }
   
         if (isset($_REQUEST['trialbalance'])) {
		  $toDate=date('Y-m-d');
		  $fromDate_time=strtotime($toDate." -1 year");
		  $fromDate=date('Y-m-d',$fromDate_time);
		  $bank_statement_arrs=array();
      //$response = $XeroOAuth->request('GET', $XeroOAuth->url('Reports/TrialBalance', 'core'), array('page' => 0,'fromDate'=>$fromDate,'toDate'=>$toDate),"",'json');
	  
	     $response = $XeroOAuth->request('GET', $XeroOAuth->url('Reports/TrialBalance', 'core'), array('page' => 0),"",'json');
	  
       if ($XeroOAuth->response['code'] == 200) {
           $report = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
         //  echo "Organisation name: " . $report->Organisations[0]->Organisation->Name;
		 
		// print_r($report);
		 
		  $output_result=TrialBalance($report,$userID);
		   //session_destroy();
		   echo $output_result;
       } else {
           //outputError($XeroOAuth);
		   echo "Error";
       }
   }
   
     if (isset($_REQUEST['bankstatement'])) {
		  $toDate=date('Y-m-d');
		  $fromDate_time=strtotime($toDate." -12 months");
		  $fromDate=date('Y-m-d',$fromDate_time);
		  $response_accounts = $XeroOAuth->request('GET', $XeroOAuth->url('Accounts', 'core'), array('page' => 0,'Where'=>'Type="BANK"'),"",'json'); 
		  
		  if ($XeroOAuth->response['code'] == 200) {
           $report_accounts = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
		   
		   // Extract Bank  Account ID 
		   $j=0;
		   $my_std_class_accounts = json_decode(json_encode($report_accounts));
		   foreach ($my_std_class_accounts->Accounts as $SingleRow)
{
	$accountID=$SingleRow->AccountID;
	
	$response_bankstatements = $XeroOAuth->request('GET', $XeroOAuth->url('Reports/BankStatement', 'core'), array('page' => 0,'fromDate'=>$fromDate,'toDate'=>$toDate,'bankAccountID'=>$accountID),"",'json');
	
	 if ($XeroOAuth->response['code'] == 200) {
           $report_bank = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
         //  echo "Organisation name: " . $report->Organisations[0]->Organisation->Name;
		 
		$report_bank_array=json_decode(json_encode($report_bank),true);
		
		//print_r($report_bank_array);
		
		//array_push($bank_statement_arrs,$report_bank_array);
		$bank_statement_arrs[$j]=$report_bank_array;
		 $j++;
		 
       } else {
           //outputError($XeroOAuth);
		   echo "Error";
       }
	
	
}
		 if(!empty($bank_statement_arrs))  
		 {
		  $output_result=BankStatement($bank_statement_arrs,$userID);
		  
		   echo $output_result;  
		 }
		 else
		 {
			 echo "empty.jpg";
		 }
		   
		  }
		  else
		  {
			   echo "Error";
		  }
		  
       
       session_destroy();
   }
   

}
