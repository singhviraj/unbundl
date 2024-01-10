<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Enter the details below</title>
        <?php
       // ini_set('max_execution_time', 500);
      //  $nameerr = $emailerr=$emailerror=$numbererr=$addresserr=$cityerr=$stateerr=$pincodeerr =
       // $snumbererr="";
       $emailerror="";

        if ($_SERVER["REQUEST_METHOD"] == "POST") 
      
        {
            /*
            if (empty($_POST["name"])) {
                $nameerr = "name is required";
              }
              else{
                $name = test_input($_POST["name"]);
              }*/
              
          //    if (empty($_POST["email"])) {
         //       $emailerr = "email is required";
          //    }
           //   else{
            $name = test_input($_POST["name"]);
                $email = test_input($_POST["email"]);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailerror = "Invalid email format";
                  }
                $number = test_input($_POST["number"]);
                $address = test_input($_POST["address"]);
                $city = test_input($_POST["city"]);
                $state = test_input($_POST["state"]);
                $pincode = test_input($_POST["pincode"]);
                $snumber = test_input($_POST["snumber"]);
                $pdate = test_input($_POST["pdate"]);
          //    }
              
             /* if (empty($_POST["number"])) {
                $numbererr = "phone number is required";
              }
              else{
                $number = test_input($_POST["number"]);
              }
              if (empty($_POST["address"])) {
                $addresserr = "address is required";
              }
              else{
                $address = test_input($_POST["address"]);
              }
              if (empty($_POST["city"])) {
                $cityerr = "city is required";
              }
              else{
                $city = test_input($_POST["city"]);
              }
              if (empty($_POST["state"])) {
                $stateerr = "state is required";
              }
              else{
                $state = test_input($_POST["state"]);
              }
              if (empty($_POST["pincode"])) {
                $pincodeerr = "pincode is required";
              }
              else{
                $pincode = test_input($_POST["pincode"]);
              }


              if (empty($_POST["snumber"])) {
                $snumbererr = "serial number is required";
              }
              else{
                $snumber = test_input($_POST["snumber"]);
              }
             
              */
              
          
        if( empty($emailerror) ){
 $message=  $email . "   " .$name;
           
            //Get uploaded file data using $_FILES array
            $tmp_name1 = $_FILES['attachment1']['tmp_name']; // get the temporary file name of the file on the server
            $filename1     = $_FILES['attachment1']['name']; // get the name of the file
            $filesize1     = $_FILES['attachment1']['size']; // get size of the file for size validation
                       
            //read from the uploaded file & base64_encode content
            $handle1 = fopen($tmp_name1, "r"); // set the file handle only for reading the file
            $content1 = fread($handle1, $filesize1); // reading the file
            fclose($handle1);                 // close upon completion
         
            $encoded_content1 = chunk_split(base64_encode($content1));

            $tmp_name2 = $_FILES['attachment2']['tmp_name']; // get the temporary file name of the file on the server
            $filename2     = $_FILES['attachment2']['name']; // get the name of the file
            $filesize2     = $_FILES['attachment2']['size']; // get size of the file for size validation
                       
            //read from the uploaded file & base64_encode content
            $handle2 = fopen($tmp_name2, "r"); // set the file handle only for reading the file
            $content2 = fread($handle2, $filesize2); // reading the file
            fclose($handle2);                 // close upon completion
         
            $encoded_content2 = chunk_split(base64_encode($content2));

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
            $body .=  $message ."\r\n";

             
                           
            //attachment
            $body .= "--simpleboundary\r\n";
            $body .="Content-Type: application/pdf\r\n";
            $body .="Content-Disposition: attachment; filename=".$filename1."\r\n";
           // $body .="Content-Disposition: attachment\r\n";
            $body .="Content-Transfer-Encoding: base64\r\n";
           // $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
            $body .= $encoded_content1; // Attaching the encoded file with email

            $body .= "--simpleboundary\r\n";
            $body .="Content-Type: application/pdf\r\n";
            $body .="Content-Disposition: attachment; filename=".$filename2."\r\n";
           // $body .="Content-Disposition: attachment\r\n";
            $body .="Content-Transfer-Encoding: base64\r\n";
           // $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
            $body .= $encoded_content2; // Attaching the encoded file with email
             
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
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
        ?>
    </head>
    <body>
       <h2>Customer Information</h2>
<form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" required>
  <br><br>
 
  E-mail: <input type="text" name="email" required>
  
  
  <br><br><?php echo $emailerror;?><br><br>
  Mobile Number: <input type="number" name="number" required>
  <br><br>

  Address: <input type="text" name="address" required>
  <br><br>
 
  City: <input type="text" name="city" required>
  <br><br>
  
  State: <input type="text" name="state" required>
  <br><br>
  
  Pincode: <input type="number" name="pincode" required>
  <br><br>
  
  Serial Number: <input type="number" name="snumber" required>
  <br><br>
  
  Purchase Date: <input type="date" name="pdate" required>
  <br><br>
  Scan of Invoice:  <input  type="file" name="attachment1"  required/>
  <br><br>
 
  Scan of Life Time Warranty Registration:  <input  type="file" name="attachment2" required/>
  <br><br>
  
   <input type="submit" name="button" value="Submit"> 
</form>
    </body>
</html>