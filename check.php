<?php
/*
$x = "abc1234567890";
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
       echo 0;
    }
   }
   if($i>=3){
if(1 == preg_match($pattern2, $a)){
       echo 1;
    }
   }   
    
}
}
if($len != 13){
    echo "error";
}

*/

if (mail("gviraj347@gmail.com","hey","hey")) {
    echo "Message successfully sent!";
} else {
    echo "Message delivery failed...";
}
?>