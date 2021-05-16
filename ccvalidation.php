<!DOCTYPE html>
<html lang="en">

<head>
	<title> ETMP Registration </title>
	<meta charset ="utf-8">
	<meta name="author" content="Chen Jun Xue">
	<meta name="descrtiption" content="ETMP CreditCardValidation">
	<meta name="keywords" content="ETMP, card validation">
	<link rel="stylesheet" href="style/style.css">
</head>

<header>
		
<?php include "navigation.php";?>


</header>

<body>
<?php  

 define("CARD_TYPE_MC", 0);  

 define("CARD_TYPE_VS", 1);  

 class CCreditCard  

 {  

 // Class Members  

 var $__ccName = '';  

 var $__ccType = '';  

 var $__ccNum = '';  

 var $__ccExpM = 0;  

 var $__ccExpY = 0;
 
 // Constructor   

 function CCreditCard($name, $type, $num, $expm, $expy)   

 {
	 // Set member variables   

 if(!empty($name))   

 {  
 $this->__ccName = $name;   

 }   

 else   

 {   
 die('Name cannot be empty');   

 }

 switch(strtolower($type))   
 {   
   case 'mc':   

   case 'mastercard':   

   case 'm':   

   case '1':   

     $this->__ccType = CARD_TYPE_MC;   

     break;   

   case 'vs':   

   case 'visa':   

   case 'v':   

   case '2':   

     $this->__ccType = CARD_TYPE_VS;   

     break;   

   default:   

     die('Invalid card type');   
 }
 
 if(!empty($num))    

 {    
   $cardNumber = preg_replace("[^0-9]", "", $num);    

   // Make sure the card number isnt empty    

   if(!empty($cardNumber))    

   {    
     $this->__ccNum = $cardNumber;    
   }    

   else    

   {    
     die('Card Number cannot be empty');    
   }    

 }    

 else    

 {    
   die('Card Number cannot be empty');    

 }
 
 if(!is_numeric($expm) || $expm < 1 || $expm > 12)    

 {    
   die('Invalid expiry month');    

 }    

 else    

 {    
   $this->__ccExpM = $expm;    

 }    

 // Get the current year    

 $currentYear = date('Y');    

 settype($currentYear, 'integer');    

 if(!is_numeric($expy) || $expy < $currentYear || $expy    

 > $currentYear + 10)    

 {    
   die('Invalid expiry year');    

 }    

 else    

 {    
   $this->__ccExpY = $expy;    

 }    

 }
 
 function Name()    
 {    
   return $this->__ccName;    

 }    
  
 function Type()    
 {    
   switch($this->__ccType)    
     {    
     case CARD_TYPE_MC:    

       return 'mastercard [1]';    

       break;    

     case CARD_TYPE_VS:    

       return 'Visa [2]';    

       break;    
    
   }    

 }    
 
 function Number()    

 {    
   return $this->__ccNum;    

 }    

 function ExpiryMonth()    

 {    
   return $this->__ccExpM;    

 }    

 function ExpiryYear()    

 {    
   return $this->__ccExpY;    

 }
 
 function SafeNumber($char = 'x', $numToHide = 6)     

 {     
   // Hide number, if can hide 4 numbers only then change 6 to 4  
   $cardNumber = $this->__ccNum;     

   $cardNumber = substr($cardNumber, 0, strlen($cardNumber) - 6);        

   for($i = 0; $i < 6; $i++)     

   {     
     $cardNumber .= $char;     

   }     

   return $cardNumber;     

 }
 
 function IsValid()     
 {  
   $validFormat = false;     

 switch($this->__ccType)     

 {     

   case CARD_TYPE_MC:     

     $validFormat = preg_match("/^[0-9]{16}+/", $this->__ccNum);  
	
     break;     

 case CARD_TYPE_VS:     

     $validFormat = preg_match("/^[0-9]{16}+/", $this->__ccNum);     

     break;     

   default:     

   $validFormat = true;     

 }

 if($validFormat ) return true;      

   else return false;      

  }      

 }      

?>

</body>
</html>