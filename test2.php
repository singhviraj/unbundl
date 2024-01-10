<?php
 
if(isset($_POST['button']) && isset($_FILES['attachment']))
{
   $message="yo";
 
    
    //Get uploaded file data using $_FILES array
    $tmp_name = $_FILES['attachment']['tmp_name']; // get the temporary file name of the file on the server
    $name     = $_FILES['attachment']['name']; // get the name of the file
    $size     = $_FILES['attachment']['size']; // get size of the file for size validation
    $type     = $_FILES['attachment']['type']; // get type of the file
    $error     = $_FILES['attachment']['error']; // get the error (if any)
 
     
    //read from the uploaded file & base64_encode content
    $handle = fopen($tmp_name, "r"); // set the file handle only for reading the file
    $content = fread($handle, $size); // reading the file
    fclose($handle);                 // close upon completion
 
    $encoded_content = chunk_split(base64_encode($content));
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
    $body .=  $message."\r\n";
         
    //attachment
    $body .= "--simpleboundary\r\n";
    $body .="Content-Type: application/pdf\r\n";
    $body .="Content-Disposition: attachment; filename=".$name."\r\n";
   // $body .="Content-Disposition: attachment\r\n";
    $body .="Content-Transfer-Encoding: base64\r\n";
   // $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
    $body .= $encoded_content; // Attaching the encoded file with email
     
    $sentMailResult = mail("gviraj347@gmail.com", "hey", $body, $headers);
 
    if($sentMailResult ){
        echo "<h3>File Sent Successfully.<h3>";
        // unlink($name); // delete the file after attachment sent.
    }
    else{
        die("Sorry but the email could not be sent.
                    Please go back and try again!");
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Send Attachment With Email</title>
</head>
<body>
   
        <form enctype="multipart/form-data" method="POST" action="test2.php" style="width: 500px;">
                       
            
                <input  type="file" name="attachment" placeholder="Attachment" required/>
            
            
                <input  type="submit" name="button" value="Submit" />
                        
        </form>
    
</body>
</html>