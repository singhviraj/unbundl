<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
$ordererr = $modelerr = $incorrect1= $incorrect2= "";
$z =0;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    //$x = test_input($_POST["email"]);
    //$y = test_input($_POST["password"]);
        
        if (empty($_POST["order"])) {
          $ordererr = "order id is required";
        }
        else{
            $x = test_input($_POST["order"]);
        }
        if (empty($_POST["model"])) {
            $modelerr = "model number is required";
          }
else{
    $y = test_input($_POST["model"]);
}

    $len =strlen($x);
    $pattern1 = "/[a-z]/i";
    $pattern2 = "/[0-9]/i";
    
    if($len == 13)
    {
    for($i =0;$i<$len;$i++)
    {
        
        $a =substr($x, $i,1 );
       if($i<3){
     if(1 == preg_match($pattern1, $a)){
           $z =$z+1;
        }
       }
       if($i>=3){
    if(1 == preg_match($pattern2, $a)){
           $z =$z+1;
        }
       }   
        
    }


    }
    if($len != 13){
        echo "error";
    }
  if($y != 'LTW' || $y !='Aero' ){
    $incorrect1 ="model is wrong";
  }
  if($z !=13){
    $incorrect2 = "Kindly order on xyz@gmail.com for warranty registration.";
}
   
    if($z ==13 && $y == 'LTW' || $y =='Aero'){
      
        header("Location: createaccount.php/");
    }
   
}
  
 //if(empty($accountpassword)== TRUE || empty($email)== TRUE){
   // echo'you can not leave it blank';
//}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
    </head>
    <body>
       <h2>PHP Form Validation To start emails</h2>
       
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  
  Installation Service Order No: <input type="text" name="order">
  <br><br><?php echo $ordererr;?><br><br>
  <br><br><?php echo $incorrect1;?><br><br>
  Model Name: <input type="text" name="model">
  <br><br><?php echo $modelerr;?><br><br>
  <br><br><?php echo $incorrect2;?><br><br>
     <input type="submit" name="submit" value="Submit"> 
</form>
       <br><br>
      
    </body>
</html>
<?php



?>