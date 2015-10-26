 <?php

 

  $mp_transaction_id = $_POST['transaction_reference'];
  $system_id=$_POST['mm_system_id'];
  $transaction_type= $_POST['transaction_type'];
  $transaction_time=$_POST['transaction_time'];
  $transaction_date=$_POST['transaction_date'];
  $phone_no=$_POST['sender_phone'];
  //$l_phone_no=$_POST['sender'];
  $first_name=$_POST['first_name'];
  $middle_name=$_POST['middle_name'];
  $last_name=$_POST['last_name'];
  $amount=$_POST['amount'];
  //$mp_transaction_id=$_POST['mp_transaction_id'];
  $account_number=$_POST['account_number'];
  $currency=$_POST['currency'];
 
date_default_timezone_set("Africa/Nairobi");
$date_time= date('d/m/Y h:i:s a', time());
  
 // echo $phone_no."<br/>";
  
 $open_voucher=($amount*1);
 
 
 $phone_no=ltrim($phone_no,'+');
 
   
  
//echo $com_balance."<br/>";
   
echo $phone_no."<br/>";

 
 
$con = mysql_connect("localhost","cardplan_mafyat","mafyat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("cardplan_mafyatest", $con);
//get main balance from the database and update


$result = mysql_query("SELECT * FROM main_accounts
                 WHERE account_no='$phone_no'");
          
           
            while($row = mysql_fetch_array($result))
              {
         $main_balance =$row['balance'];
         $status=$row['account_activate'];
             }
  echo "The balance".$main_balance; 
  echo "the status is ".$status; 
    
 $result2 = mysql_query("SELECT * FROM merchants
                 WHERE phone_no='$phone_no'");
          
               
             while($row = mysql_fetch_array($result2))
               {
          $merchant_balance =$row['balance'];
          $merchant_status=$row['active'];
              }

   // echo mysql_num_rows($result);
  //echo $main_balance."<br/>";
   
    //$new_main_balance=$main_balance+$com_balance;

   echo mysql_num_rows($result2);
   
   
   echo "merchnant status".$merchant_status;
echo "the merchant has".$merchant_balance;

//echo $status;
if(mysql_num_rows($result)>=1 and ($amount!=69)){
if($status=="0" and ($amount>="0")){


mysql_query("UPDATE main_accounts SET active=1
WHERE account_no=$phone_no");

mysql_query("UPDATE main_accounts SET account_activate=1
WHERE account_no=$phone_no");

mysql_query("UPDATE main_accounts SET fname='$first_name'
WHERE account_no='$phone_no'");


mysql_query("UPDATE main_accounts SET lname='$last_name'
WHERE account_no=$phone_no");

$transaction_type="activation";

$message=$first_name." ".$last_name." M-Afya wallet Activated. Welcome to M-Afya!You can buy Open vouchers and save to this wallet ";

$user_type="Subscriber";

$sql2="INSERT INTO transaction_billing (datetime, account_number,user_type,amount, transaction_type) VALUES ('$date_time','$phone_no', '$user_type','$transaction_charge','$transaction_type')";

mysql_query($sql2) or die(mysql_error());


}
else if ($status=="1" and ($amount>="0"))
{
$new_main_balance=$main_balance+$open_voucher;

mysql_query("UPDATE main_accounts SET balance=$new_main_balance
WHERE account_no=$phone_no");


$message=$first_name." ".$last_name.", you have bought M-Afya Open voucher Ksh.".$amount.". Your Open M-Afya voucher total is Ksh.".$new_main_balance;

 
 //echo $message;
}

//insert the variables in the database 
  $sql = "INSERT INTO mpesa_transactions_log (system_id,mp_transaction_id,transaction_type,transaction_id,transaction_date,transaction_time,phone_no,first_name,middle_name,last_name,account_number,amount,currency) VALUES ('$system_id','$mp_transaction_id','$transaction_type','$transaction_id','$transaction_date','$transaction_time','$phone_no','$first_name','$middle_name','$last_name','$account_number','$amount','$currency')";
//echo $sql;





mysql_query($sql) or die(mysql_error());

//mysql_query($sql2) or die(mysql_error());
//
$response = array('status' => '01', 'description' => 'Accepted');
echo json_encode($response);



//mysql_close($con);
 
 
  
 

 
// echo $balance;









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
//$message = "Testing";

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


// echo $phone_no;
 
// DONE!!!

//activate for merchants 



if(mysql_num_rows($result2) >= 1 and ($amount==69)){
if($merchant_status=="0"){


//Generate a random PIN 

$rand_pin=rand(1000,9999);

echo $rand_pin;

mysql_query("UPDATE merchants SET active=1
WHERE phone_no=$phone_no");

mysql_query("UPDATE merchants  SET merchant_pin=$rand_pin
WHERE phone_no=$phone_no");



$message="Approved.Your M-Afya PIN is ".$rand_pin." To complete registration, go to account setup menu & validate your facility. A 5 digit facility code is required";
//}


//insert the variables in the database 
  $sql3 = "INSERT INTO mpesa_transactions_log (system_id,mp_transaction_id,transaction_type,transaction_id,transaction_date,transaction_time,phone_no,first_name,middle_name,last_name,account_number,amount,currency) VALUES ('$system_id','$mp_transaction_id','$transaction_type','$transaction_id','$transaction_date','$transaction_time','$phone_no','$first_name','$middle_name','$last_name','$account_number','$amount','$currency')";
//echo $sql;
$user_type="Service Provider";
$transaction_type="activation";


$sql4="INSERT INTO transaction_billing (datetime,account_number,user_type,amount, transaction_type) VALUES ('$date_time','$phone_no', '$user_type','$amount','$transaction_type')";


mysql_query($sql3) or die(mysql_error());


mysql_query($sql4) or die(mysql_error());





}
else if($merchant_status=="1"){   $message="Sorry, Service provider activation failed, your account is already active."; }
 



$response = array('status' => '01', 'description' => 'Accepted');
echo json_encode($response);



mysql_close($con);


 

 
// echo $balance;



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
//$message = "Testing";

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




?> 