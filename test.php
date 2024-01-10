<?php





$filename = $_FILES["choosefile"]["name"];
        $tempfile = $_FILES["choosefile"]["tmp_name"];
        $folder = "image/".$filename;
        
        if($filename == "")
        {
            echo "blank not allowed";
        }else{
           $hey="there you go";
            $subject = 'hey';
            $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
              // $headers .= "From:".$from_email."\r\n"; // Sender Email
               //$headers .= "Reply-To: ".$reply_to_email."\r\n"; // Email address to reach back
               $headers .= "Content-Type: multipart/mixed;"; // Defining Content-Type
               $headers .= "boundary = simpleboundary\r\n"; //Defining the Boundary
                    
               //plain text
               $body = "--simpleboundary\r\n";
               $body .= "Content-Type: text/plain\r\n";
               $body .="Content-Disposition: inline\r\n";
               $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
               $body .=  $hey."\r\n";
                    
                 //attachment
               $body .= "--simpleboundary\r\n";
               //$body .="Content-Type: image/jpeg\r\n";
               $body .="Content-Type: application/pdf\r\n";
               $body .="Content-Disposition: attachment\r\n";
               $body .="Content-Transfer-Encoding: base64\r\n";
               $body .= $tempfile."/r/n"; // Attaching the encoded file with email
               $body .= "--simpleboundary--\r\n";
               
               if (mail("gviraj347@gmail.com", $subject, $body, $headers)) {
                echo "Message successfully sent!";
            } else {
                echo "Message delivery failed...";
            }
        }
      
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
    </head>
    <body>
    <form action="test.php" method="post"  enctype="multipart/form-data">
            <input type="file"  name="choosefile"  id="">
            
                <button type="submit" name="btn_img" >
                Submit
            </button>
            
        </form>

      
    </body>
</html>