<?php

// Reads the variables sent via POST from our gateway
///$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

date_default_timezone_set("Africa/Nairobi");
$date_time= date("Y-m-d H:i:s");




//$pieces = explode("*",$text);
//$epin=pieces[4];
$pin="1000";
//$max_pin="9999";
$merchant_no="1000";
//$max_merchant_no="9999";
$amount="10";
$len=strlen("$text");
$phone_no=ltrim($phoneNumber,'+');
$d_account_no="0700000000";
$pieces = explode("*",$text);

if ($pieces[1]==1){
$balance_check=$s;
}
else if ($pieces[1]==1 And $pieces[2]==1){
$balance_check=$m;
}



if ( $text == "" ) {

  // This is the first request. Note how we start the response with CON
  //$response  = "CON Welcome to M-Afya please select your language".$len."\n";
  
  $response  = "CON Welcome to M-Afya please select your language \n";
  $response .= "1. English\n";
  $response .= "2. Kiswahili\n";

} 
else if ( $text == "1" ) {
//$pieces = explode("*",$text);
// echo $pieces[0];
 //echo $pieces[1];




  $response  = "CON  Select user type  \n";
 // $response  = "CON  Select user type".$len." \n";
  $response .= "1. Subscriber \n";
  $response .= "2. Service provider \n";
  
 
  
  }


//else if ($text !="") c
 

if ($text == "1*1" ){
 $response  = "CON M-Afya Subscriber services \n";
 // $response  = "CON M-Afya Subscriber services ".$len."\n";
 $response .= "1. Register for M-Afya \n";
 $response .= "2. Check vouchers \n";
 $response .= "3. Redeem voucher\n";
 $response .= "4. Save voucher \n";
 $response .= "5. Share voucher \n";
 $response .= "6. Add a M-AfyaCard \n";



}

//subscriber registration
else if ($text == "1*1*1" ){

$pieces = explode("*",$text);
// echo $pieces[0];
 //echo $pieces[1];





$password=rand(1000,9999);
$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("cardplan_mafyatest", $con);


//insert the variables in the database 
//$sql = "INSERT INTO mpesa_transaction_log //(system_id,mp_transaction_id,transaction_type,transaction_id,transaction_date,transaction_time,phone_no,first_name,middle_name,last_name,account_n//umber,amount,currency) VALUES //('$system_id','$mp_transaction_id','$transaction_type','$transaction_id','$transaction_date','$transaction_time','$phone_no','$first_name','$middl//e_name','$last_name','$account_number','$amount','$currency')";
//echo $sql;

//mysql_query($sql) or die(mysql_error());

$result = mysql_query("SELECT * FROM voucher_maternity
                 WHERE account_no=$phone_no");


if(mysql_num_rows($result) == 0){



$sql = "INSERT INTO main_accounts (account_no,password) VALUES ('$phone_no','$password')";
//echo $sql;
 mysql_query($sql) or die(mysql_error());

  $sql_one = "INSERT INTO voucher_maternity (account_no,balance) VALUES ('$phone_no','0')";
  mysql_query($sql_one) or die(mysql_error());
 $sql_two = "INSERT INTO voucher_malaria (account_no,balance) VALUES ('$phone_no','0')";
  mysql_query($sql_two) or die(mysql_error());
 $sql_three = "INSERT INTO voucher_insurance (account_no,balance) VALUES ('$phone_no','0')";
   mysql_query($sql_three) or die(mysql_error());


mysql_close($con);


$response  = "END Registration successful!\n";

$message="You have successfully registered on M-Afya.Your secret PIN is ".$password." To start, buy your M-Afya e-wallet by sending Ksh.30 M-PESA Buy Goods till number 304719";
//Sensd SMS
 // Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');

// Specify your login credentials
$username    = "Mafya";
$apiKey      = "c9b737169af39b7001f5410bf3b5a289469f0ecee19cfa48e51759b68ca4cd0e"; 
$from="M-Afya";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254726209286,+254736342930";


    $recipients=$phoneNumber;

 
//$recipients = "+2547771234567,+2547771234568,+2547771234569";
// And of course we want our recipients to know what we really do
//$message = "You have redeemed ".$amount." of voucher at Healthwise clinic ";

// Create a new instance of our awesome gateway class
$gateway  = new AfricaStalkingGateway($username, $apiKey);

// Thats it, hit send and we'll take care of the rest
$results  = $gateway->sendMessage($recipients, $message,$from);
if ( count($results) ) {
  // These are the results if the request is well formed
  foreach($results as $result) {
	//echo " Number: " .$result->number;
	//echo " Status: " .$result->status;
	//echo " Cost: "   .$result->cost."\n";
  }
} else {
	// We only get here if we cannot process your request at all
	// (usually due to wrong username/apikey combinations)
  	echo "Oops, No messages were sent. ErrorMessage: ".$gateway->getErrorMessage();
}
}
else {

$response  = "END Sorry! Registration failed.You had  already  registered on M-Afya!\n";



}






}//end of subscriber registration
//check  subscriber balance 
//else if ($text == "1*1*2" And $len ==5 ){
else if ($pieces[0]=="1" And $pieces[2]=="2"){
//$response  = "CON HIV voucher: Enter merchant number".$len." !\n";
$response  = "CON Enter M-Afya PIN:\n";
}



//else if ($text >= "1*1*2*".$pin and $len==10 ){
else if ($pieces[2]==1 And $pieces[0]==1){
$pieces = explode("*",$text);
$s_password= $pieces[3];
 //echo $pieces[1];


$phone_no=ltrim($phoneNumber,'+');



$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("cardplan_mafyatest", $con);





$result = mysql_query("SELECT * FROM main_accounts
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $main_balance =$row['balance'];
          $password =$row['password'];
               }
     $result1 = mysql_query("SELECT * FROM voucher_maternity
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result1))
               {
         $v_maternity_balance =$row['balance'];
         // $password =$row['password'];
               }          
         $result2 = mysql_query("SELECT * FROM voucher_malaria
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result2))
               {
         $v_malaria_balance =$row['balance'];
         // $password =$row['password'];
               }          
        //       $result3 = mysql_query("SELECT * FROM voucher_insurance
       //          WHERE account_no='$phone_no'");
          
               
       //       while($row = mysql_fetch_array($result3))
       //        {
      //   $v_insurance_balance =$row['balance'];
         // $password =$row['password'];
       //        }          
               
               
                     
             
   mysql_close($con);
 
if($s_password==$password){ 

$response  = "END Your vouchers' value: \n1. Open voucher Ksh.".$main_balance."\n2. Afya voucher Ksh.".$v_maternity_balance;


}

else{ 

$response  = "END Voucher check failed.You enterred Wrong PIN ".$s_password."\n Please try again";
}




}
//new code for listing voucher types
//else if ($text == "1*1*3" And $len >=5 ){
//$response  = "CON Select pocket type ".$len." !\n";
//$response  = "CON Select voucher type \n";
 //$response .= "1. Afya voucher \n";
 //$response .= "2. Restricted  voucher\n";
 //$response .= "3. Group   voucher\n";

//}



//end of code for listing voucher 

//start of afya voucher  pocket redemption
else if ($text == "1*1*3" And $len ==5 ){
$response  = "CON Redeem Afya voucher:\nEnter Service provider number\n";
//$response  = "CON General voucher: Enter merchant number".$len." !\n";
}
else if ($pieces[2]==3 And $len == 11){
$response  = "CON Enter your subscriber  M-Afya PIN\n";
//$response  = "CON Enter M-Afya PIN ".$len."\n";
}
else if ($pieces[2]==3  And $len ==16 ){
$response  = "CON Enter Amount to redeem \n";
//$response  = "CON Enter Amount ".$len."\n";
}


//else if ($text >= "1*1*3*1*".$merchant_no."*".$pin."*".$amount And $len >=19){








//$pieces = explode("*",$text);
//if ($pieces[3]==1){
else if ($pieces[2]==3 and $len>=17){
$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("cardplan_mafyatest", $con);

$result = mysql_query("SELECT * FROM main_accounts
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $password=$row['password'];
        $balance=$row['balance'];
               }

//get maternity voucher balance 
$result = mysql_query("SELECT * FROM voucher_maternity
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
        
        $v_balance=$row['balance'];
               }
//end of get maternity voucher 
//assign  the exploded text string
$epin=$pieces[4];
$m_no=$pieces[3];
$eamount=$pieces[5];
//$pocket_type=$pieces[3];
//end of assigning the exploded string 
//get merchant name and balance 
$mer_result = mysql_query("SELECT * FROM merchants
                 WHERE business_no='$m_no'");
          
               
              while($row = mysql_fetch_array($mer_result))
               {
         $m_name=$row['bs_name'];
        $m_balance=$row['balance'];
               }




//end of get merchant  name and balance
if ($epin ==$password){
if($v_balance>=$eamount And mysql_num_rows($mer_result) > 0){
$new_v_balance=$v_balance-$eamount;
$m_new_balance=$m_balance+$eamount;


//start deposit into merchants voucher 
//$sql_one = "INSERT INTO voucher_maternity (account_no,balance) VALUES ('$phone_no','$eamount')";

//mysql_query($sql_one) or die(mysql_error());
//end of deposit into merchnants voucher
//update the new balance 
$sql="UPDATE voucher_maternity SET balance=$new_v_balance
WHERE account_no='$phone_no'";

mysql_query($sql) or die(mysql_error());
//update merchnats balance
$sql_two="UPDATE merchants  SET balance=$m_new_balance
WHERE business_no='$m_no'";

mysql_query($sql_two) or die(mysql_error());


//end of update 
}
//end of pendahealth
$response  = "END You have redeemed  Afya voucher valued Ksh.".$eamount." at ".$m_name.". Your remainder Afya voucher value is Ksh.".$new_v_balance;

}
$sql = "INSERT INTO merchant_transactions(debit,amount,account_no,business_no,voucher) VALUES ('1','$eamount','$phone_no','$m_no','afya')";
//echo $sql;
mysql_query($sql) or die(mysql_error());

//$response  = "END Transaction Succesful!".$balance;

mysql_close($con);



}

else if ($v_balance<$eamount And mysql_num_rows($mer_result) > 0 ) {$response  = "END Redeem voucher failed. Low value. Your Afya voucher value is Ksh.".$v_balance;}

else if ($v_balance>$eamount And mysql_num_rows($mer_result) == 0 ) {$response  = "END Redeem voucher failed. Inexsitent service provider number ";}
//}
//else if ($v_balance>=$eamount) {$response  = "END Transaction failed.In existent service provider ";}


else if ($epin!=$password){

$response  = "END Afya voucher redeem failed, you enterred wrong PIN or wrong Service provider number\n";
///$response  = "END Redeem Failed,you enterred wrong PIN is".$epin." \n";
}

//}
//}
//end of maternity voucher redemption
 
 //start of malaria voucher redemption
 

//start of the insurance  pocket redemption



//start of loading voucher 


//enter PIN for own account and maretnity voucher
else if ($text == "1*1*4" And $len ==5 ){
//$response  = "CON Load own General voucher: Enter Enter M-Afya PIN".$len." !\n";
$response  = "CON Save open voucher as Afya voucher:\nEnter M-Afya PIN \n";
}
//enter PIN for own account and Malaria  voucher



//enter amount  for own account and general voucher  
else if ($pieces[2]==4 And $len == 10){

if($pieces[0]==1){
$response  = "CON Save open voucher Enter amount \n";
}

//$response  = "CON Enter amount   ".$len."\n";
}
//enter amount for own account and malaria  voucher

//enter amount for own account and malaria  voucher

//code to select the type of other voucher 


//if the selected other walley pocket   is maternity 


//enter PIN  number to load other maternity pocket  

//enter amount   to load other malaria pocket 

//start of load own maternity pocket
else if ($pieces[2]==4 And $len >10){
$pieces = explode("*",$text);
if($pieces[0]==1){
$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("cardplan_mafyatest", $con);

$result = mysql_query("SELECT * FROM main_accounts
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $spon_balance =$row['balance'];
         $password  =$row['password'];
               }

   //$transaction_charge=10; 

 //$new_pin=$pieces[4];
$epin=$pieces[3];
//$m_no=$pieces[4];
$eamount=$pieces[4];

//$raw_ben_account_no=$pieces[5];

//$phoneNumber=ltrim($raw_ben_account_no,0);

//$ben_account_no="254$phoneNumber";



if ($epin ==$password){
if($spon_balance>=$eamount){
$result = mysql_query("SELECT * FROM voucher_maternity
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $ben_balance =$row['balance'];
       //  $password  =$row['password'];
               }
     //$transaction_charge=10;          
               
               
$new_ben_balance=$ben_balance+$eamount;
$new_spon_balance=$spon_balance-$eamount;

$sql="UPDATE main_accounts SET balance=$new_spon_balance
WHERE account_no='$phone_no'";

mysql_query($sql) or die(mysql_error());

$sql_three="UPDATE voucher_maternity SET balance=$new_ben_balance
WHERE account_no='$phone_no'";

mysql_query($sql_three) or die(mysql_error());

//$sql = "INSERT INTO voucher_maternity (account_no,balance) VALUES ('$phone_no','$eamount')";

$response  = "END You have saved open voucher Ksh.".$eamount." to own wallet as  Afya voucher.Your current Afya voucher value is Ksh.".$new_ben_balance."\n";

$sql = "INSERT INTO voucher_transfers(voucher_type,account_from,account_to,amount) VALUES ('afya','$phone_no','$phone_no','$eamount')";

//$transaction_type="Transfer";


//$user_type="Subscriber";

//$sql2="INSERT INTO transaction_billing (account_number,user_type,amount, transaction_type) VALUES ('$phone_no', '$user_type','$transaction_charge','$transaction_type')";

//mysql_query($sql2) or die(mysql_error());



mysql_query($sql) or die(mysql_error());
mysql_close($con);



//Send SMS 

// Be sure to include the file you've just downloaded
//require_once('AfricasTalkingGateway.php');

// Specify your login credentials
//$username    = "Mafya";
//$apiKey      = "c9b737169af39b7001f5410bf3b5a289469f0ecee19cfa48e51759b68ca4cd0e"; 
//$from="M-Afya";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254726209286,+254736342930";


    //$recipients=$phoneNumber;

 
//$recipients = "+2547771234567,+2547771234568,+2547771234569";
// And of course we want our recipients to know what we really do
//$message = "You have saved open voucher Ksh.".$eamount." to own wallet as  Afya voucher.Your current Afya voucher value Ksh.".$new_ben_balance;

// Create a new instance of our awesome gateway class
//$gateway  = new AfricaStalkingGateway($username, $apiKey);

// Thats it, hit send and we'll take care of the rest
//$results  = $gateway->sendMessage($recipients, $message,$from);
//if ( count($results) ) {
  // These are the results if the request is well formed
 // foreach($results as $result) {
	//echo " Number: " .$result->number;
	//echo " Status: " .$result->status;
	//echo " Cost: "   .$result->cost."\n";
 // }
//} else {
	// We only get here if we cannot process your request at all
	// (usually due to wrong username/apikey combinations)
  //	echo "Oops, No messages were sent. ErrorMessage: ".$gateway->getErrorMessage();
//}




}

else {$response  = "END Voucher Save failed. Low value. Your Open voucher value is Ksh.".$spon_balance."\n";}


}


else if ($epin!=$password){

$response  = "END Save voucher failed.You enterred wrong PIN ".$epin." \n";

}

}
}

//end of load own maternity pocket 


else if ($text == "1*1*5" And $len ==5 ){
//$response  = "CON Load own General voucher: Enter Enter M-Afya PIN".$len." !\n";
$response  = "CON Share Open Voucher:\nEnter beneficiary wallet number \n";
}
else if ($pieces[2]==5 And $len ==16 ){
//$response  = "CON Load own General voucher: Enter Enter M-Afya PIN".$len." !\n";
$response  = "CON Share Open Voucher:\nEnter PIN  \n";
}
//else if ($text >= "1*1*5*".$d_account_no."*".$pin And $len ==21 ){
else if ($pieces[2]==5 And $len ==21 ){

//$response  = "CON Load own General voucher: Enter Enter M-Afya PIN".$len." !\n";
$response  = "CON Share Open Voucher:\nEnter amount \n";
}


else if ($pieces[2]==5 And $len >21){
$pieces = explode("*",$text);

$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("cardplan_mafyatest", $con);

$result = mysql_query("SELECT * FROM main_accounts
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $spon_balance =$row['balance'];
         $password  =$row['password'];
               }

   $transaction_charge=10;

 //$new_pin=$pieces[4];
$epin=$pieces[4];
//$m_no=$pieces[4];
$eamount=$pieces[5]+$transaction_charge;

$raw_ben_account_no=$pieces[3];

$phoneNumber=ltrim($raw_ben_account_no,0);

$ben_account_no="254$phoneNumber";
//get beneficiary name 
$ben_result = mysql_query("SELECT * FROM main_accounts
                 WHERE account_no='$ben_account_no'");
          
               
              while($row = mysql_fetch_array($ben_result))
               {
         $ben_first_name=$row['fname'];
         $ben_last_name=$row['lname'];
               }


//end of get beneficiary name
if ($epin==$password){
if($spon_balance>=$eamount  and mysql_num_rows($ben_result) > 0){
$result = mysql_query("SELECT * FROM voucher_maternity
                 WHERE account_no='$ben_account_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $ben_balance =$row['balance'];
         //$ben_first_name=$row['fname'];
         //$ben_last_name=$row['lname'];
       //  $password  =$row['password'];
               }
$eamount_uncharged=$eamount-$transaction_charge;
$new_ben_balance=$ben_balance+$eamount_uncharged;
$new_spon_balance=$spon_balance-$eamount;

$sql="UPDATE main_accounts SET balance=$new_spon_balance
WHERE account_no='$phone_no'";

mysql_query($sql) or die(mysql_error());

$sql_three="UPDATE voucher_maternity SET balance=$new_ben_balance
WHERE account_no='$ben_account_no'";

mysql_query($sql_three) or die(mysql_error());

//$sql = "INSERT INTO voucher_maternity (account_no,balance) VALUES ('$phone_no','$eamount')";
//$eamount=$eamount-$transaction_charge;

$response  = "END You have shared to ".$ben_first_name." ".$ben_last_name."  voucher valued  Ksh.".$eamount_uncharged;

 $sql = "INSERT INTO voucher_transfers(voucher_type,account_from,account_to,amount) VALUES ('afya','$phone_no','$ben_account_no','$eamount_uncharged')";
 mysql_query($sql) or die(mysql_error());


$transaction_type="Transfer";


$user_type="Subscriber";

$sql2="INSERT INTO transaction_billing (datetime, account_number,user_type,amount, transaction_type) VALUES ('$date_time','$phone_no', '$user_type','$transaction_charge','$transaction_type')";

mysql_query($sql2) or die(mysql_error());




mysql_close($con);



//Send SMS 

// Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');

// Specify your login credentials
$username    = "Mafya";
$apiKey      = "c9b737169af39b7001f5410bf3b5a289469f0ecee19cfa48e51759b68ca4cd0e"; 
$from="M-Afya";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254726209286,+254736342930";


    $recipients="$phone_no,$ben_account_no";

 
//$recipients = "+2547771234567,+2547771234568,+2547771234569";
// And of course we want our recipients to know what we really do
$message ="".$ben_first_name." ".$ben_last_name." has received a gift voucher of Ksh.".$eamount_uncharged;

// Create a new instance of our awesome gateway class
$gateway  = new AfricaStalkingGateway($username, $apiKey);

// Thats it, hit send and we'll take care of the rest
$results  = $gateway->sendMessage($recipients, $message,$from);
if ( count($results) ) {
  // These are the results if the request is well formed
  foreach($results as $result) {
	//echo " Number: " .$result->number;
	//echo " Status: " .$result->status;
	//echo " Cost: "   .$result->cost."\n";
  }
} else {
	// We only get here if we cannot process your request at all
	// (usually due to wrong username/apikey combinations)
  	echo "Oops, No messages were sent. ErrorMessage: ".$gateway->getErrorMessage();
}




}
 else if ($spon_balance>=$eamount And mysql_num_rows($ben_result) == 0){

$response  = "END Share  voucher failed.Inexistent beneficiary \n";

}


else {$response  = "END Share voucher failed. Low value. Your Open voucher value is Ksh ".$spon_balance."\n";}


}

else if ($epin!=$password){

$response  = "END Share voucher failed.You enterred wrong PIN ".$epin." \n";

}





}

//end of loading other Maternity pocket

//end  of other malaria  pocket
//start of other insurance 


//end of other insurance


//start of adding card
else if ($text == "1*1*6" and $len==5){
$response="CON To Add Medicard,enter M-Afya PIN ";}


else if($pieces[3]!="" and $pieces[2]==6){
$pieces = explode("*",$text);
// echo $pieces[0];
 //echo $pieces[1];
$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("cardplan_mafyatest", $con);

$result = mysql_query("SELECT * FROM main_accounts
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $password=$row['password'];
        $balance=$row['balance'];
               }

$epin=$pieces[3];

if ($epin==$password){
//$password=rand(1000,9999);

//$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
//if (!$con)
 // {
 // die('Could not connect: ' . mysql_error());
 // }

//mysql_select_db("cardplan_mafyatest", $con);

$query = "SELECT MAX(SUBSTR(`account_no`, 13)) AS `next_phone` FROM `main_accounts` WHERE `account_no` LIKE '%". $phone_no ."%'";
$res = mysql_query($query) or die(mysql_error());

if(mysql_num_rows($res) == 0){
$new_account =  $phone_no."01";
}
else {
$row = mysql_fetch_array($res);
if(is_numeric($row['next_phone'])){
$new_account = $row['next_phone'] + 1;
if($new_account < 10)
$new_account = $phone_no."0". $new_account;
else
$new_account = $phone_no.$new_account;
}
else 
$new_account = $phone_no."01";
}



$sql = "INSERT INTO main_accounts (account_no,password) VALUES ('". $new_account ."','')";
//echo $sql;
  
 
mysql_query($sql) or die(mysql_error());

$new_account=trim($new_account,"254");
$new_account="0$new_account";

mysql_close($con);


$response  = "END New MediCard added to your M-Afya wallet. Access number is ".$new_account.".\nTo activate the card please visit an M-Afya Service Provider.\n";





  
//$new_account=ltrim($phoneNumber,'254');
//$new_changed_account="0$new_account";
///$response  = "END  Card added successfully" .$pieces[1]."!\n";
$message="You added a new MediCard to your M-Afya wallet\nThe card access number is ".$new_account.".\nPlease visit an M-Afya Service Provider to activate this card ";
//Sensd SMS
 // Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');

// Specify your login credentials
$username    = "Mafya";
$apiKey      = "c9b737169af39b7001f5410bf3b5a289469f0ecee19cfa48e51759b68ca4cd0e"; 
$from="M-Afya";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254726209286,+254736342930";


    $recipients=$phoneNumber;

 
//$recipients = "+2547771234567,+2547771234568,+2547771234569";
// And of course we want our recipients to know what we really do
//$message = "You have redeemed ".$amount." of voucher at Healthwise clinic ";

// Create a new instance of our awesome gateway class
$gateway  = new AfricaStalkingGateway($username, $apiKey);

// Thats it, hit send and we'll take care of the rest
$results  = $gateway->sendMessage($recipients, $message,$from);
if ( count($results) ) {
  // These are the results if the request is well formed
  foreach($results as $result) {
	//echo " Number: " .$result->number;
	//echo " Status: " .$result->status;
	//echo " Cost: "   .$result->cost."\n";
  }
} else {
	// We only get here if we cannot process your request at all
	// (usually due to wrong username/apikey combinations)
  	echo "Oops, No messages were sent. ErrorMessage: ".$gateway->getErrorMessage();
}









}

else if($epin!=$password){$response="END Sorry you enterred wrong PIN"; }
//end of adding a card
}
//service providers start here

if ($text == "1*2" ){
 $response  = "CON M-Afya Services provider \n";
 //$response  = "CON M-Afya Services provider".$len."\n";
 $response .= "7. Set up account \n";
 $response .= "8. Check voucher\n";
 $response .= "9. Claim voucher\n ";
 
}
if ($text == "2*2" ){
 $response  = "END Sorry, this service is not available in Kiswahili at this time  \n";
 
}
//merchant activation
else if ($text == "1*2*7" and $len=5){

$response  = "CON Services Provider Account \n";
 //$response  = "CON M-Afya Services provider".$len."\n";
 $response .= "1. Register facility\n";
 $response .= "2. Validate facility\n";
 $response .= "3. Change PIN";
}
//code to activate wallet 

//else if ($text == "1*2*7*1" and $len=7){

//$response  = "END To activate a wallet,\n please pay Ksh 69 by M-Pesa Buy
//Goods Till No 304719\n";

//}
else if ($text >= "1*2*7*1" and ($pieces[2]==7)){

$response  = "CON  Please provide your facility code\n";


if($pieces[4]!="" ){
//now find facility from the database 


$fac_code=$pieces[4];
$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("cardplan_mafyatest", $con);


$result = mysql_query("SELECT facility_name FROM facility_details
                 WHERE facility_code='$fac_code'");
          
               
              while($row = mysql_fetch_array($result))
              {
        $found_name =$row['facility_name'];
        $found_location =$row['district'];
  
             } 

mysql_close($con);


if($found_name!=""and ($pieces[5]=="")){
if($pieces[3]=="1"){
$response  = "CON Facility validated code ".$fac_code." , ".$found_name."\n 1. Confirm and register \n 2. Decline\n" ;
}
else if($pieces[3]=="2"){

$response  = "END Your facility validated code is ".$fac_code."\n Name: ".$found_name."" ;
}
//PIN  change
else if($pieces[3]=="3"){
$response  = "CON Change PIN. Enter your M-afya PIN \n";

}
//check PIN
else if($pieces[3]=="3" and ($pieces[4]<="9999")){
$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
 {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("cardplan_mafyatest", $con);

$result = mysql_query("SELECT * FROM merchants
                 WHERE phone_no=$phone_no");
          
               
              while($row = mysql_fetch_array($result))
               {
         $password=$row['merchant_pin'];
                        }

  

 //$new_pin=$pieces[4];
$epin=$pieces[4];


//if ($epin ==$password){


$response  = "CON   Enter New 4- Digit PIN " ;
////if ($pieces[5]>="0000" ){
 
mysql_query("UPDATE merchants  SET merchant_pin=$pieces[5]
WHERE phone_no=$phone_no");
 $response  = "END Successful PIN change. New PIN is ".$pieces[5]. " \n" ;
 //}
//}
}
 //End of PIN change

}
}

else if($found_name!="" and ($pieces[5]=="1")){

$response  = "END Facility registration successful. To activate  pay Ksh. 69 to \n M-PESA till 304719 using the same phone number ";

$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("cardplan_mafyatest", $con); 


$sql_insert = "INSERT INTO merchants(bs_name,business_no,phone_no,location,balance,active) 
VALUES ('$found_name','$fac_code','$phoneNumber','$found_location','0','0')";
mysql_query($sql_insert) or die(mysql_error());


}
else if($found_name!="" and ($pieces[5]=="2")){

$response  = "END Facility registration canceled";



}

}

 
 
 
 
 else if($found_name=="" and ($pieces[4]!="")){

$response  = "END Failed. Facility code ".$fac_code. " NOT Found \n" ;
}
 //}
//Provider  PIN change


 //end oer of provider PIN chnage 








//end of  merchant activation
//merchant check voucher start
else if ($text == "1*2*8" and $len=5){

$response  = "CON Services Provider Check Voucher\n Enter PIN \n";
 //$response  = "CON M-Afya Services provider".$len."\n";
//check  service provider balance 

}
//else if ($text >= "1*1*2*".$pin and $len==10 ){
else if($pieces[2]==8 And $pieces[3]!=""){
//else if ($balance_check=$m And $text >= "1*2*2*".$pin){
//$pieces = explode("*",$text);
$m_password= $pieces[3];
 //echo $pieces[1];


$phone_no=ltrim($phoneNumber,'+');



$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
 {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("cardplan_mafyatest", $con);





$resul1 = mysql_query("SELECT * FROM merchants
               WHERE phone_no=$phone_no");
          
               
              while($row = mysql_fetch_array($resul1))
               {
        $merchant_balance =$row['balance'];
          $password =$row['merchant_pin'];
              }
     
               
              
        
            
        
               
                     
             
  // mysql_close($con);
 
if($m_password==$password){ 

$response  = "END Your  total voucher remainder is ".$merchant_balance;
}

else{ 
$response  = "END Service Provider voucher  check Failed Wrong PIN please try again\n";
}

} 
 

//merchant check voucher end
//redeeming merchant voucher starts here 
else if ($text == "1*2*9"){
$pieces = explode("*",$text);
$response  = "CON Claim Service Provider voucher: Enter M-Afya PIN number \n";
//$response  = "CON Redeem Service Provider voucher: Enter M-Afya PIN number".$len." !\n";
}
else if ($pieces[2]==9){
 if  ($pieces[4]==""){
$response  = "CON  Enter Amount \n";
//$response  = "CON Enter Amount ".$len."\n";
}

 else if ($pieces[4]>="1"){
//else if ($pieces[2]==5 and $len==12){



//$response  = "END You got here ";

$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("cardplan_mafyatest", $con);

$result = mysql_query("SELECT * FROM merchants
                 WHERE phone_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $password=$row['merchant_pin'];
         $m_balance=$row['balance'];
         $m_no=$row['business_no'];
               }
$transaction_charge=30;
  $eamount_charge=$eamount+$transaction_charge;

 //$new_pin=$pieces[4];
$epin=$pieces[3];
//$m_no=$pieces[4];
$eamount=$pieces[4];
  $eamount_charge=$eamount+$transaction_charge;
if ($epin ==$password){
if($eamount<$m_balance){



$response  = "END Transaction Successful! You have redeemed Ksh. ".$eamount." of your Service Provider  voucher\n";
 $sql = "INSERT INTO merchant_settlements(business_no,amount,debit,settlement_status) VALUES ('$m_no','$eamount','1','2')";
mysql_query($sql) or die(mysql_error());

$transaction_type="Claim";

$user_type="Service Provider";

$sql2="INSERT INTO transaction_billing (datetime, account_number,user_type,amount, transaction_type) VALUES ('$date_time','$phone_no', '$user_type','$transaction_charge','$transaction_type')";

mysql_query($sql2) or die(mysql_error());

 $new_m_balance=$m_balance-$eamount_charge;
 
 mysql_query("UPDATE merchants SET balance=$new_m_balance WHERE phone_no='$phone_no'");
 
 
 
//Send SMS 

// Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');

// Specify your login credentials
$username    = "Mafya";
$apiKey      = "c9b737169af39b7001f5410bf3b5a289469f0ecee19cfa48e51759b68ca4cd0e"; 
$from="M-Afya";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254726209286,+254736342930";


    $recipients=$phone_no;

 
//$recipients = "+2547771234567,+2547771234568,+2547771234569";
// And of course we want our recipients to know what we really do
$message = "You have redeemed ".$eamount." your voucher value remainder is ".$new_m_balance ;

// Create a new instance of our awesome gateway class
$gateway  = new AfricaStalkingGateway($username, $apiKey);

// Thats it, hit send and we'll take care of the rest
$results  = $gateway->sendMessage($recipients, $message,$from);
if ( count($results) ) {
  // These are the results if the request is well formed
  foreach($results as $result) {
	//echo " Number: " .$result->number;
	//echo " Status: " .$result->status;
	//echo " Cost: "   .$result->cost."\n";
  }
} else {
	// We only get here if we cannot process your request at all
	// (usually due to wrong username/apikey combinations)
  	echo "Oops, No messages were sent. ErrorMessage: ".$gateway->getErrorMessage();
}





}
}

else if ($eamount>$m_balance){

$response  = "END Redeem Failed.Low balance.Your balance is ".$m_balance;
}
else if ($epin!=$password){

$response  = "END Redeem Failed.You enterred wrong PIN ".$epin." \n";

//send SMS
// Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');

// Specify your login credentials
$username    = "Mafya";
$apiKey      = "c9b737169af39b7001f5410bf3b5a289469f0ecee19cfa48e51759b68ca4cd0e"; 
$from="M-Afya";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254726209286,+254736342930";


    $recipients=$phone_no;

 
//$recipients = "+2547771234567,+2547771234568,+2547771234569";
// And of course we want our recipients to know what we really do
$message = " Service provider redeem Transaction failed wrong PIN entered";

// Create a new instance of our awesome gateway class
$gateway  = new AfricaStalkingGateway($username, $apiKey);

// Thats it, hit send and we'll take care of the rest
$results  = $gateway->sendMessage($recipients, $message,$from);
if ( count($results) ) {
  // These are the results if the request is well formed
  foreach($results as $result) {
	//echo " Number: " .$result->number;
	//echo " Status: " .$result->status;
	//echo " Cost: "   .$result->cost."\n";
  }
} else {
	// We only get here if we cannot process your request at all
	// (usually due to wrong username/apikey combinations)
  	echo "Oops, No messages were sent. ErrorMessage: ".$gateway->getErrorMessage();
}




}

}
}
//


//service provider ends 
//start of the Kiswahili Menu

else if ( $text == "2" ) {
//$pieces = explode("*",$text);
// echo $pieces[0];
 //echo $pieces[1];




  $response  = "CON  Chagua aina ya matumizi  \n";
 // $response  = "CON  Select user type".$len." \n";
  $response .= "1. Mteja \n";
  $response .= "2. Muhudumu \n";
  
 
  
  }
  
else if ($text == "2*1" ){
 $response  = "CON M-Afya Huduma kwa Wateja \n";
 // $response  = "CON M-Afya Subscriber services ".$len."\n";
 $response .= "1. Jisajilishe \n";
 $response .= "2. Angalia akiba  \n";
 $response .= "3. 
  vocha\n";
 $response .= "4. Weka akiba vocha \n";
 $response .= "5. Zawadi vocha \n";
 $response .= "6. Ongeza kadi \n";



}  
  else if ($text == "2*1*1" ){

$pieces = explode("*",$text);
// echo $pieces[0];
 //echo $pieces[1];





$password=rand(1000,9999);
$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("cardplan_mafyatest", $con);


//insert the variables in the database 
//$sql = "INSERT INTO mpesa_transaction_log //(system_id,mp_transaction_id,transaction_type,transaction_id,transaction_date,transaction_time,phone_no,first_name,middle_name,last_name,account_n//umber,amount,currency) VALUES //('$system_id','$mp_transaction_id','$transaction_type','$transaction_id','$transaction_date','$transaction_time','$phone_no','$first_name','$middl//e_name','$last_name','$account_number','$amount','$currency')";
//echo $sql;

//mysql_query($sql) or die(mysql_error());

$result = mysql_query("SELECT * FROM voucher_maternity
                 WHERE account_no=$phone_no");


if(mysql_num_rows($result) == 0){



$sql = "INSERT INTO main_accounts (account_no,password) VALUES ('$phone_no','$password')";
//echo $sql;
 mysql_query($sql) or die(mysql_error());

  $sql_one = "INSERT INTO voucher_maternity (account_no,balance) VALUES ('$phone_no','0')";
  mysql_query($sql_one) or die(mysql_error());
 $sql_two = "INSERT INTO voucher_malaria (account_no,balance) VALUES ('$phone_no','0')";
  mysql_query($sql_two) or die(mysql_error());
 $sql_three = "INSERT INTO voucher_insurance (account_no,balance) VALUES ('$phone_no','0')";
   mysql_query($sql_three) or die(mysql_error());


mysql_close($con);


$response  = "END Umefaulu kujisajili kwa huduma ya M-Afya!\n";

$message="Umefaulu kujisajili M-Afya.Namba yako ya siri ni ".$password." Nunua kibeti kwa Ksh.30-Lipa Na M-PESA  kupitia till Nambari.912526";
//Sensd SMS
 // Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');

// Specify your login credentials
$username    = "Mafya";
$apiKey      = "c9b737169af39b7001f5410bf3b5a289469f0ecee19cfa48e51759b68ca4cd0e"; 
$from="M-Afya";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254726209286,+254736342930";


    $recipients=$phoneNumber;

 
//$recipients = "+2547771234567,+2547771234568,+2547771234569";
// And of course we want our recipients to know what we really do
//$message = "You have redeemed ".$amount." of voucher at Healthwise clinic ";

// Create a new instance of our awesome gateway class
$gateway  = new AfricaStalkingGateway($username, $apiKey);

// Thats it, hit send and we'll take care of the rest
$results  = $gateway->sendMessage($recipients, $message,$from);
if ( count($results) ) {
  // These are the results if the request is well formed
  foreach($results as $result) {
  //echo " Number: " .$result->number;
  //echo " Status: " .$result->status;
  //echo " Cost: "   .$result->cost."\n";
  }
} else {
  // We only get here if we cannot process your request at all
  // (usually due to wrong username/apikey combinations)
    echo "Oops, No messages were sent. ErrorMessage: ".$gateway->getErrorMessage();
}
}
else {

$response  = "END Samahani!Usajili haukufaulu.Nambari yako tayari imesajiliwa  M-Afya!\n";



}

 } 
  
 //end of subscriber registration
//check  subscriber balance 
//else if ($text == "1*1*2" And $len ==5 ){
else if ($text == "2*1*2" And $len ==5){
//$response  = "CON HIV voucher: Enter merchant number".$len." !\n";
$response  = "CON Weka namba ya siri M-Afya:\n";
}



//else if ($text >= "1*1*2*".$pin and $len==10 ){
else if ($pieces[2]==2 And $len==10){
$pieces = explode("*",$text);
$s_password= $pieces[3];
 //echo $pieces[1];


$phone_no=ltrim($phoneNumber,'+');



$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("cardplan_mafyatest", $con);





$result = mysql_query("SELECT * FROM main_accounts
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $main_balance =$row['balance'];
          $password =$row['password'];
               }
     $result1 = mysql_query("SELECT * FROM voucher_maternity
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result1))
               {
         $v_maternity_balance =$row['balance'];
         // $password =$row['password'];
               }          
         $result2 = mysql_query("SELECT * FROM voucher_malaria
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result2))
               {
         $v_malaria_balance =$row['balance'];
         // $password =$row['password'];
               }          
        //       $result3 = mysql_query("SELECT * FROM voucher_insurance
       //          WHERE account_no='$phone_no'");
          
               
       //       while($row = mysql_fetch_array($result3))
       //        {
      //   $v_insurance_balance =$row['balance'];
         // $password =$row['password'];
       //        }          
               
               
                     
             
   mysql_close($con);
 
if($s_password==$password){ 
if($pieces[0]==2){
$response  = "END Baki ya vocha ni: \n1.Vocha wazi Ksh.".$main_balance."\n2.Vocha ya Afya  Ksh.".$v_maternity_balance;
}
else if($pieces[0]==1){$response  = "END Your voucher's value are: \n1.Open voucher Ksh.".$main_balance."\n2.Afya voucher  Ksh.".$v_maternity_balance;}

}





else{ 

$response  = "END Haukufalu!.Nambari ya Siri ".$s_password."\n  Sio sahihi tafadhali jaribu tena";
}




}
//new code for listing voucher types
//else if ($text == "1*1*3" And $len >=5 ){
//$response  = "CON Select pocket type ".$len." !\n";
//$response  = "CON Select voucher type \n";
 //$response .= "1. Afya voucher \n";
 //$response .= "2. Restricted  voucher\n";
 //$response .= "3. Group   voucher\n";

//}



//end of code for listing voucher 

//start of afya voucher  pocket redemption
else if ($text == "2*1*3" And $len ==5 ){
$response  = "CON Komboa Afya vocha:\nWeka Nambari ya Muhudumu\n";
//$response  = "CON General voucher: Enter merchant number".$len." !\n";
}
else if ($pieces[0]==2 And $len == 11){
$response  = "CON Weka nambari ya siri ya  M-Afya\n";
//$response  = "CON Enter M-Afya PIN ".$len."\n";
}
else if ($pieces[0]==2  And $len ==16 ){
$response  = "CON Weka kiwango\n";
//$response  = "CON Enter Amount ".$len."\n";
}


//else if ($text >= "1*1*3*1*".$merchant_no."*".$pin."*".$amount And $len >=19){


//$pieces = explode("*",$text);
//if ($pieces[3]==1){
else if ($pieces[0]==2 and $pieces[4]>=$pin){
$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("cardplan_mafyatest", $con);

$result = mysql_query("SELECT * FROM main_accounts
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $password=$row['password'];
        $balance=$row['balance'];
               }

//get maternity voucher balance 
$result = mysql_query("SELECT * FROM voucher_maternity
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
        
        $v_balance=$row['balance'];
               }
//end of get maternity voucher 
//assign  the exploded text string
$epin=$pieces[4];
$m_no=$pieces[3];
$eamount=$pieces[5];
//$pocket_type=$pieces[3];
//end of assigning the exploded string 
//get merchant name and balance 
$mer_result = mysql_query("SELECT * FROM merchants
                 WHERE business_no='$m_no'");
          
               
              while($row = mysql_fetch_array($mer_result))
               {
         $m_name=$row['bs_name'];
        $m_balance=$row['balance'];
               }




//end of get merchant  name and balance
if ($epin ==$password){
if($v_balance>=$eamount And mysql_num_rows($mer_result) > 0){
$new_v_balance=$v_balance-$eamount;
$m_new_balance=$m_balance+$eamount;


//start deposit into merchants voucher 
//$sql_one = "INSERT INTO voucher_maternity (account_no,balance) VALUES ('$phone_no','$eamount')";

//mysql_query($sql_one) or die(mysql_error());
//end of deposit into merchnants voucher
//update the new balance 
$sql="UPDATE voucher_maternity SET balance=$new_v_balance
WHERE account_no='$phone_no'";

mysql_query($sql) or die(mysql_error());
//update merchnats balance
$sql_two="UPDATE merchants  SET balance=$m_new_balance
WHERE business_no='$m_no'";

mysql_query($sql_two) or die(mysql_error());


//end of update 



$response  = "END Umekomboa Ksh.".$eamount." kutoka Afya vocha".$m_name.".Baki ya Afya  vocha.".$new_v_balance;

}





//Send SMS 

// Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');

// Specify your login credentials
$username    = "Mafya";
$apiKey      = "c9b737169af39b7001f5410bf3b5a289469f0ecee19cfa48e51759b68ca4cd0e"; 
$from="M-Afya";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254726209286";


    $recipients=$phoneNumber;

 
//$recipients = "+2547771234567,+2547771234568,+2547771234569";
// And of course we want our recipients to know what we really do
$message = "Umekomboa Ksh.".$eamount." kutoka Afya vocha , ".$m_name.".Baki ya Afya vocha ni Ksh".$new_v_balance;

// Create a new instance of our awesome gateway class$gateway  = new AfricaStalkingGateway($username, $apiKey);
$gateway  = new AfricaStalkingGateway($username, $apiKey);
// Thats it, hit send and we'll take care of the rest
$results  = $gateway->sendMessage($recipients,$message,$from);
if ( count($results) ) {
  // These are the results if the request is well formed
  foreach($results as $result) {
  //echo " Number: " .$result->number;
  //echo " Status: " .$result->status;
  //echo " Cost: "   .$result->cost."\n";
  }
} else {
  // We only get here if we cannot process your request at all
  // (usually due to wrong username/apikey combinations)
    echo "Oops, No messages were sent. ErrorMessage: ".$gateway->getErrorMessage();
}



}

else if ($v_balance<$eamount And mysql_num_rows($mer_result) > 0 ) {$response  = "END Haukufaulu kukomboa.Baki iko chini.Baki ya Afya vocha ni Ksh.".$v_balance;}

else if ($v_balance>$eamount And mysql_num_rows($mer_result) == 0 ) {$response  = "END Haukufaulu. Muhudumu hajasajiliwa ";}





else if ($epin!=$password){$response  = "END  Haukufaulu kukomboa, nambari ya siri sio sahihi \n";
$response  = "END Redeem Failed,you enterred wrong PIN is".$epin." \n";
}
}
//else if ($v_balance>=$eamount) {$response  = "END Transaction failed.In existent service provider ";}


///else if ($epin!=$password){

//$response  = "END  Haukufaulu kukomboa, nambari ya siri sio sahihi \n";
///$response  = "END Redeem Failed,you enterred wrong PIN is".$epin." \n";
//}

//}
//}
//end of maternity voucher redemption
 
 //start of malaria voucher redemption
 

//start of the insurance  pocket redemption



//start os saving voucher 
else if ($text == "2*1*4" And $len ==5 ){
//$response  = "CON Load own General voucher: Enter Enter M-Afya PIN".$len." !\n";
$response  = "CON Hifadhi  Afya vocha:\n Weka namba ya siri \n";
}
//enter PIN for own account and Malaria  voucher



//enter amount  for own account and general voucher  
else if ($pieces[2]==4 And $len == 10){

if($pieces[0]==2){
$response  = "CON Hifadhi vocha weka kiwango \n";
}

//$response  = "CON Enter amount   ".$len."\n";
}
//enter amount for own account and malaria  voucher

//enter amount for own account and malaria  voucher

//code to select the type of other voucher 


//if the selected other walley pocket   is maternity 


//enter PIN  number to load other maternity pocket  

//enter amount   to load other malaria pocket 

//start of load own maternity pocket
else if ($pieces[2]==4 And $pieces[4]>=0){
$pieces = explode("*",$text);
if($pieces[0]==2){
$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("cardplan_mafyatest", $con);

$result = mysql_query("SELECT * FROM main_accounts
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $spon_balance =$row['balance'];
         $password  =$row['password'];
               }

   

 //$new_pin=$pieces[4];
$epin=$pieces[3];
//$m_no=$pieces[4];
$eamount=$pieces[4];

//$raw_ben_account_no=$pieces[5];

//$phoneNumber=ltrim($raw_ben_account_no,0);

//$ben_account_no="254$phoneNumber";



if ($epin ==$password){
if($spon_balance>=$eamount){
$result = mysql_query("SELECT * FROM voucher_maternity
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $ben_balance =$row['balance'];
       //  $password  =$row['password'];
               }
$new_ben_balance=$ben_balance+$eamount;
$new_spon_balance=$spon_balance-$eamount;

$sql="UPDATE main_accounts SET balance=$new_spon_balance
WHERE account_no='$phone_no'";

mysql_query($sql) or die(mysql_error());

$sql_three="UPDATE voucher_maternity SET balance=$new_ben_balance
WHERE account_no='$phone_no'";

mysql_query($sql_three) or die(mysql_error());

//$sql = "INSERT INTO voucher_maternity (account_no,balance) VALUES ('$phone_no','$eamount')";

$response  = "END Umehifadhi  Ksh.".$eamount." kama Afya vocha. Baki ya  Afya vocha ni Ksh.".$new_ben_balance."\n";

$sql = "INSERT INTO voucher_transfers(voucher_type,account_from,account_to,amount) VALUES ('afya','$phone_no','$phone_no','$eamount')";
mysql_query($sql) or die(mysql_error());
mysql_close($con);



//Send SMS 

// Be sure to include the file you've just downloaded
//require_once('AfricasTalkingGateway.php');

// Specify your login credentials
//$username    = "Mafya";
//$apiKey      = "c9b737169af39b7001f5410bf3b5a289469f0ecee19cfa48e51759b68ca4cd0e"; 
//$from="M-Afya";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254726209286,+254736342930";


    //$recipients=$phoneNumber;

 
//$recipients = "+2547771234567,+2547771234568,+2547771234569";
// And of course we want our recipients to know what we really do
//$message = "You have d open voucher Ksh.".$eamount." to own wallet as  Afya voucher.Your current Afya voucher value Ksh.".$new_ben_balance;

// Create a new instance of our awesome gateway class
//$gateway  = new AfricaStalkingGateway($username, $apiKey);

// Thats it, hit send and we'll take care of the rest
//$results  = $gateway->sendMessage($recipients, $message,$from);
//if ( count($results) ) {
  // These are the results if the request is well formed
 // foreach($results as $result) {
	//echo " Number: " .$result->number;
	//echo " Status: " .$result->status;
	//echo " Cost: "   .$result->cost."\n";
 // }
//} else {
	// We only get here if we cannot process your request at all
	// (usually due to wrong username/apikey combinations)
  //	echo "Oops, No messages were sent. ErrorMessage: ".$gateway->getErrorMessage();
//}




}

else {$response  = "END Haukufaulu. Baki iko chini.  Afya vocha baki ni Ksh.".$balance."\n";}


}


else if ($epin!=$password){

$response  = "END Haukufaulu  kuhifadhi .Nambari ya siri ".$epin." sio sahihi. Jaribu tena  \n";

}
}

}


//end of load own maternity pocket 


else if ($text == "2*1*5" And $len ==5 ){
//$response  = "CON Load own General voucher: Enter Enter M-Afya PIN".$len." !\n";
$response  = "CON Zawadi vocha:\nWeka nambari ya mpokezi\n";
}
else if ($pieces[0]==2 And $len ==16 ){
//$response  = "CON Load own General voucher: Enter Enter M-Afya PIN".$len." !\n";
$response  = "CON Zawadi vocha:\nWeka Nambari ya siri  \n";
}
//else if ($text >= "1*1*5*".$d_account_no."*".$pin And $len ==21 ){
else if ($pieces[0]==2 And $len ==21 ){

//$response  = "CON Load own General voucher: Enter Enter M-Afya PIN".$len." !\n";
$response  = "CON Zawadi vocha:\n Weka kiwango \n";
}


else if ($pieces[0]==2 And $pieces[5]>10){
$pieces = explode("*",$text);

$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("cardplan_mafyatest", $con);

$result = mysql_query("SELECT * FROM main_accounts
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $spon_balance =$row['balance'];
         $password  =$row['password'];
               }

   

 //$new_pin=$pieces[4];
$epin=$pieces[4];
//$m_no=$pieces[4];
$eamount=$pieces[5];

$raw_ben_account_no=$pieces[3];

$phoneNumber=ltrim($raw_ben_account_no,0);

$ben_account_no="254$phoneNumber";
//get beneficiary name 
$ben_result = mysql_query("SELECT * FROM main_accounts
                 WHERE account_no='$ben_account_no'");
          
               
              while($row = mysql_fetch_array($ben_result))
               {
         $ben_first_name=$row['fname'];
         $ben_last_name=$row['lname'];
               }


//end of get beneficiary name
if ($epin==$password){
if($spon_balance>=$eamount  and mysql_num_rows($ben_result) > 0){
$result = mysql_query("SELECT * FROM voucher_maternity
                 WHERE account_no='$ben_account_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $ben_balance =$row['balance'];
         //$ben_first_name=$row['fname'];
         //$ben_last_name=$row['lname'];
       //  $password  =$row['password'];
               }
$new_ben_balance=$ben_balance+$eamount;
$new_spon_balance=$spon_balance-$eamount;

$sql="UPDATE main_accounts SET balance=$new_spon_balance
WHERE account_no='$phone_no'";

mysql_query($sql) or die(mysql_error());

$sql_three="UPDATE voucher_maternity SET balance=$new_ben_balance
WHERE account_no='$ben_account_no'";

mysql_query($sql_three) or die(mysql_error());

//$sql = "INSERT INTO voucher_maternity (account_no,balance) VALUES ('$phone_no','$eamount')";

$response  = "END Umemtumia ".$ben_first_name." ".$ben_last_name."  zawadi vocha ya   Ksh.".$eamount;

 $sql = "INSERT INTO voucher_transfers(voucher_type,account_from,account_to,amount) VALUES ('afya','$phone_no','$ben_account_no','$eamount')";
 mysql_query($sql) or die(mysql_error());


mysql_close($con);



//Send SMS 

// Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');

// Specify your login credentials
$username    = "Mafya";
$apiKey      = "c9b737169af39b7001f5410bf3b5a289469f0ecee19cfa48e51759b68ca4cd0e"; 
$from="M-Afya";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254726209286,+254736342930";


    $recipients="$phone_no,$ben_account_no";

 
//$recipients = "+2547771234567,+2547771234568,+2547771234569";
// And of course we want our recipients to know what we really do
$message ="".$ben_first_name." ".$ben_last_name." amepokea zawadi vocha ya Ksh.".$eamount;

// Create a new instance of our awesome gateway class
$gateway  = new AfricaStalkingGateway($username, $apiKey);

// Thats it, hit send and we'll take care of the rest
$results  = $gateway->sendMessage($recipients, $message,$from);
if ( count($results) ) {
  // These are the results if the request is well formed
  foreach($results as $result) {
  //echo " Number: " .$result->number;
  //echo " Status: " .$result->status;
  //echo " Cost: "   .$result->cost."\n";
  }
} else {
  // We only get here if we cannot process your request at all
  // (usually due to wrong username/apikey combinations)
    echo "Oops, No messages were sent. ErrorMessage: ".$gateway->getErrorMessage();
}




}
 else if ($spon_balance>=$eamount And mysql_num_rows($ben_result) == 0){

$response  = "END Zawadi  vocha haikufaulu. Mpokezi hajasajilwa! \n";

}


else {$response  = "END Zawadi vocha haikufaulu.Baki iko chini. Baki ya Afya vocha ni Ksh ".$balance."\n";}


}

else if ($epin!=$password){

$response  = "END Zawadi vocha haikufaulu.Namba ya siri sio sahihi ".$epin." \n";

}





}

//end of loading other Maternity pocket

//end  of other malaria  pocket
//start of other insurance 


//end of other insurance


//start of adding card
else if ($text == "2*1*6" and $len==5){
$response="CON Ongeza Medicard, weka namba ya siri ";}


else if($pieces[0]==2 and $pieces[2]==6){
$pieces = explode("*",$text);
// echo $pieces[0];
 //echo $pieces[1];
$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("cardplan_mafyatest", $con);

$result = mysql_query("SELECT * FROM main_accounts
                 WHERE account_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $password=$row['password'];
        $balance=$row['balance'];
               }

$epin=$pieces[3];

if ($epin==$password){
//$password=rand(1000,9999);

//$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
//if (!$con)
 // {
 // die('Could not connect: ' . mysql_error());
 // }

//mysql_select_db("cardplan_mafyatest", $con);

$query = "SELECT MAX(SUBSTR(`account_no`, 13)) AS `next_phone` FROM `main_accounts` WHERE `account_no` LIKE '%". $phone_no ."%'";
$res = mysql_query($query) or die(mysql_error());

if(mysql_num_rows($res) == 0){
$new_account =  $phone_no."01";
}
else {
$row = mysql_fetch_array($res);
if(is_numeric($row['next_phone'])){
$new_account = $row['next_phone'] + 1;
if($new_account < 10)
$new_account = $phone_no."0". $new_account;
else
$new_account = $phone_no.$new_account;
}
else 
$new_account = $phone_no."01";
}



$sql = "INSERT INTO main_accounts (account_no,password) VALUES ('". $new_account ."','')";
//echo $sql;
  
 
mysql_query($sql) or die(mysql_error());

$new_account=trim($new_account,"254");
$new_account="0$new_account";

mysql_close($con);


$response  = "END MediCard mpya imeongezwa kwenye kibeti cha M-Afya.Namba ya kutumia ni ".$new_account.".\n Kidhinisha hii kadi tembelea muhumu wa M-Afya.\n";





  
//$new_account=ltrim($phoneNumber,'254');
//$new_changed_account="0$new_account";
///$response  = "END  Card added successfully" .$pieces[1]."!\n";
$message="MediCard mpya imeongezwa kwenye kibeti cha M-Afya.\nNamba ya kutumia ni ".$new_account.".\n Kuidhinisha hii kadi tembelea muhudumu wa  M-Afya  ";
//Sensd SMS
 // Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');

// Specify your login credentials
$username    = "Mafya";
$apiKey      = "c9b737169af39b7001f5410bf3b5a289469f0ecee19cfa48e51759b68ca4cd0e"; 
$from="M-Afya";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254726209286,+254736342930";


    $recipients=$phoneNumber;

 
//$recipients = "+2547771234567,+2547771234568,+2547771234569";
// And of course we want our recipients to know what we really do
//$message = "You have redeemed ".$amount." of voucher at Healthwise clinic ";

// Create a new instance of our awesome gateway class
$gateway  = new AfricaStalkingGateway($username, $apiKey);

// Thats it, hit send and we'll take care of the rest
$results  = $gateway->sendMessage($recipients, $message,$from);
if ( count($results) ) {
  // These are the results if the request is well formed
  foreach($results as $result) {
  //echo " Number: " .$result->number;
  //echo " Status: " .$result->status;
  //echo " Cost: "   .$result->cost."\n";
  }
} else {
  // We only get here if we cannot process your request at all
  // (usually due to wrong username/apikey combinations)
    echo "Oops, No messages were sent. ErrorMessage: ".$gateway->getErrorMessage();
}









}

else if($epin!=$password){$response="END Nambari ya siri sio sahihi"; }
//end of adding a card
}
//service providers start here
 /*
if ($text == "2*2" ){
 $response  = "CON Muhumudu wa  M-Afya \n";
 //$response  = "CON M-Afya Services provider".$len."\n";
 $response .= "7. Idhinisha akaunti ya M-afya\n";
 $response .= "8. Angalia  vocha \n";
 $response .= "9. Komboa vocha\n ";
}
//merchant activation
else if ($text == "2*2*7" and $len=5){

$pieces = explode("*",$text);
// echo $pieces[0];
 //echo $pieces[1];





$password=rand(1000,9999);

$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("cardplan_mafyatest", $con);


$res = mysql_query("SELECT * FROM merchant_activation_log
                 WHERE phone_no='$phone_no'");


$result = mysql_query("SELECT * FROM merchants
                 WHERE phone_no='$phone_no' AND active = 1");

if(mysql_num_rows($result) == 0 and mysql_num_rows($res)==0){

$sql = "INSERT INTO merchant_activation_log (phone_no) VALUES ('$phone_no')";
mysql_query("UPDATE merchants SET active=1, merchant_pin='$password' WHERE phone_no='$phone_no'");




//mysql_query("UPDATE merchants SET password=$password
//WHERE phone_no='$phone_no'");
//echo $sql;
  
  mysql_query($sql) or die(mysql_error());



mysql_close($con);


$response  = "END Usajili wa muhumu  umefaulu  \n";
//$response  = "END Service Provider Registration successful" .$pieces[1]."!\n"
$message="Umejisajilisha kama muhudumu wa M-Afya.Namba ya siri ni ".$password;
//Sensd SMS
 // Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');

// Specify your login credentials
$username    = "Mafya";
$apiKey      = "c9b737169af39b7001f5410bf3b5a289469f0ecee19cfa48e51759b68ca4cd0e"; 
$from="M-Afya";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254726209286,+254736342930";


    $recipients=$phoneNumber;

 
//$recipients = "+2547771234567,+2547771234568,+2547771234569";
// And of course we want our recipients to know what we really do
//$message = "You have redeemed ".$amount." of voucher at Healthwise clinic ";

// Create a new instance of our awesome gateway class
$gateway  = new AfricaStalkingGateway($username, $apiKey);

// Thats it, hit send and we'll take care of the rest
$results  = $gateway->sendMessage($recipients, $message,$from);
if ( count($results) ) {
  // These are the results if the request is well formed
  foreach($results as $result) {
  //echo " Number: " .$result->number;
  //echo " Status: " .$result->status;
  //echo " Cost: "   .$result->cost."\n";
  }
} else {
  // We only get here if we cannot process your request at all
  // (usually due to wrong username/apikey combinations)
    echo "Oops, No messages were sent. ErrorMessage: ".$gateway->getErrorMessage();
}

}

//else if(mysql_num_rows($result) == 0 and mysql_num_rows($res)!=0 ) {
//$sql = "INSERT INTO merchants (phone_no,active,merchant_pin) VALUES ('$phone_no','1','$password')";
//mysql_query($sql) or die(mysql_error());
//$response  = "END Sorry!Registration Failed.Inexistent account.Please register on phone application first ";

//}
else   {
$response  = "END Haukufaulu, muhudumu tayari amesajiliwa  ";

}
}

//merchant activation
//redeeming merchant voucher starts here 
else if ($text == "2*2*9" And $len ==5 ){

$response  = "CON Komboa vocha ya muhudumu: Ingiza namba ya siri ya M-afya \n";
//$response  = "CON Redeem Service Provider voucher: Enter M-Afya PIN number".$len." !\n";
}
else if ($pieces[2]==9 And $len==8){
$response  = "CON Weka kiwango \n";
//$response  = "CON Enter Amount ".$len."\n";

}
else if ($pieces[2]==9  And $len >=9 ){
//else if ($pieces[2]==5 and $len==12){
if($pieces[0]==2){
$pieces = explode("*",$text);

$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("cardplan_mafyatest", $con);

$result = mysql_query("SELECT * FROM merchants
                 WHERE phone_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($result))
               {
         $password=$row['merchant_pin'];
         $m_balance=$row['balance'];
               }

  

 //$new_pin=$pieces[4];
$epin=$pieces[3];
//$m_no=$pieces[4];
$eamount=$pieces[4];
if ($epin ==$password){
if($eamount<$m_balance){


$response  = "END Umefaulu kukomboa Ksh. ".$eamount." kutoka vocha ya  muhudumu\n";
 $sql = "INSERT INTO merchant_settlements(business_no,amount,debit,settlement_status) VALUES ('$m_no','$eamount','1','0')";
mysql_query($sql) or die(mysql_error());

 $new_m_balance=$m_balance-$eamount;
 
 mysql_query("UPDATE merchants SET balance=$new_m_balance WHERE phone_no='$phone_no'");
 
 
 
//Send SMS 

// Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');

// Specify your login credentials
$username    = "Mafya";
$apiKey      = "c9b737169af39b7001f5410bf3b5a289469f0ecee19cfa48e51759b68ca4cd0e"; 
$from="M-Afya";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254726209286,+254736342930";


    $recipients=$phone_no;

 
//$recipients = "+2547771234567,+2547771234568,+2547771234569";
// And of course we want our recipients to know what we really do
$message = "Umekomboa Ksh. ".$amount." baki ya vocha ni Ksh. ".$new_m_balance ;

// Create a new instance of our awesome gateway class
$gateway  = new AfricaStalkingGateway($username, $apiKey);

// Thats it, hit send and we'll take care of the rest
$results  = $gateway->sendMessage($recipients, $message,$from);
if ( count($results) ) {
  // These are the results if the request is well formed
  foreach($results as $result) {
  //echo " Number: " .$result->number;
  //echo " Status: " .$result->status;
  //echo " Cost: "   .$result->cost."\n";
  }
} else {
  // We only get here if we cannot process your request at all
  // (usually due to wrong username/apikey combinations)
    echo "Oops, No messages were sent. ErrorMessage: ".$gateway->getErrorMessage();
}





}
}
else if ($eamount>$m_balance){

$response  = "END Haukufaulu kukomboa.Baki iko chini. Baki ni Ksh. ".$m_balance;
}
else if ($epin!=$password){

$response  = "END haukufaulu.You nambari ya siri ".$epin." sio sahihi \n";

//send SMS
// Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');

// Specify your login credentials
$username    = "Mafya";
$apiKey      = "c9b737169af39b7001f5410bf3b5a289469f0ecee19cfa48e51759b68ca4cd0e"; 
$from="M-Afya";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254726209286,+254736342930";


    $recipients=$phone_no;

 
//$recipients = "+2547771234567,+2547771234568,+2547771234569";
// And of course we want our recipients to know what we really do
$message = " Muhudumu hakuweza kukomboa ,nambari ya siri sio sahihi";

// Create a new instance of our awesome gateway class
$gateway  = new AfricaStalkingGateway($username, $apiKey);

// Thats it, hit send and we'll take care of the rest
$results  = $gateway->sendMessage($recipients, $message,$from);
if ( count($results) ) {
  // These are the results if the request is well formed
  foreach($results as $result) {
  //echo " Number: " .$result->number;
  //echo " Status: " .$result->status;
  //echo " Cost: "   .$result->cost."\n";
  }
} else {
  // We only get here if we cannot process your request at all
  // (usually due to wrong username/apikey combinations)
    echo "Oops, No messages were sent. ErrorMessage: ".$gateway->getErrorMessage();
}




}

}



}
//
//check  service provider balance 
else if ($text == "2*2*8" And $len ==5 ){

$response  = "CON Weka nambari ya siri ni:  \n";
}



//else if ($text >= "1*1*2*".$pin and $len==10 ){
else if($pieces[2]==8 And $len==10){

//else if ($balance_check=$m And $text >= "1*2*2*".$pin){
//$pieces = explode("*",$text);
$m_password= $pieces[3];
 //echo $pieces[1];


$phone_no=ltrim($phoneNumber,'+');



$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
 {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("cardplan_mafyatest", $con);





$resul1 = mysql_query("SELECT * FROM merchants
               WHERE phone_no='$phone_no'");
          
               
              while($row = mysql_fetch_array($resul1))
               {
        $merchant_balance =$row['balance'];
          $password =$row['merchant_pin'];
              }
     
               
              
        
            
        
               
                     
             
  // mysql_close($con);
 
if($m_password==$password and $pieces[0]=="2"){ 

$response  = "END Baki yako ya vocha ni ".$merchant_balance;
}

else{ 
$response  = "END Hukufaulu kuona nambari ya siri sio sahihi\n";
}

}
*///
//service provider ends 
 
  
//else {$response="END Wrong Commands  please try again\n";}

// Print the response onto the page so that our gateway can read it
header('Content-type: text/plain');
echo $response;
 