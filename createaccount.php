<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Enter the details below</title>
        <?php
        //setting the maximum execution of 500 seconds so that our script can finish till the end.

       ini_set('max_execution_time', 500);
      
       $emailerror="";
       $name = $email =$number=$address=$city=$state=$pincode=$snumber=$pdate="";
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
      
        {
            // getting form inputs
            $name = test_input($_POST["name"]);
                $email = test_input($_POST["email"]);
                // checking if the email is in correct format
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
          
          
        if( empty($emailerror) ){
           
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

            $message= "email =".$email . " " . ",name=".$name." ".",phone number =".$number." ".",address=".$address." ".",city=".$city." ".",state=".$state." ".
            ",pincode =".$pincode." ".",serial number=".$snumber." ".",purchase date=".$pdate;

            $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
                      
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
           
            $body .="Content-Transfer-Encoding: base64\r\n";
           
            $body .= $encoded_content1; // Attaching the encoded file with email

            $body .= "--simpleboundary\r\n";
            $body .="Content-Type: application/pdf\r\n";
            $body .="Content-Disposition: attachment; filename=".$filename2."\r\n";
           
            $body .="Content-Transfer-Encoding: base64\r\n";
           
            $body .= $encoded_content2; // Attaching the encoded file with email
             


            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "unbundl";
            // Creating a connection
            
            $conn = new mysqli($servername, $username, $password, $database);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            else{
                echo"created successfully";
            }
            //Inserting user values in table
            
            $stmt = "INSERT INTO details (name, email, number,address,
            city,state,pincode,snumber,pdate,filename1,filename2) VALUES ('$name','$email',
             '$number', '$address','$city' ,'$state','$pincode','$snumber','$pdate','$filename1','$filename2')";
           if ($conn->query($stmt) === TRUE) {
            echo "New record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }



            $sentMailResult = mail("gviraj347@gmail.com", "hey", $body, $headers);
         
            if($sentMailResult ){
               echo "Thank you for
sharing the documents with us. Our team will verify the details and get back to you within 7
working days. FFIPL reserves the right to reject the warranty application if the registration
terms & conditions are not met. Please refer to the product’s user manual for detailed
warranty terms & conditions.";
            }
            else{
                die("Sorry but the email could not be sent.
                            Please go back and try again!");
            }
           
           
            
           
        }
}
// removing necessary characters from the string
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
  Name: <input type="text" name="name" value="<?php echo $name;?>" required>
  <br><br>
 
  E-mail: <input type="text" name="email" value="<?php echo $email;?>" required>
  
  
  <br><br><h5><?php echo $emailerror;?></h5><br><br>
  Mobile Number: <input type="number" name="number" value="<?php echo $number;?>" required>
  <br><br>

  Address: <input type="text" name="address" value="<?php echo $address;?>" required>
  <br><br>
 
  City: <input type="text" name="city" value="<?php echo $city;?>" required>
  <br><br>
  
  State: <input type="text" name="state" value="<?php echo $state;?>" required>
  <br><br>
  
  Pincode: <input type="number" name="pincode" value="<?php echo $pincode;?>" required>
  <br><br>
  <h2>Product Information</h2>
  Serial Number: <input type="number" name="snumber" value="<?php echo $snumber;?>" required>
  <br><br>
  
  Purchase Date: <input type="date" name="pdate"  value="<?php echo $pdate;?>" required>
  <br><br>
  Scan of Invoice:  <input  type="file" name="attachment1"  required/>
  <br><br>
 
  Scan of Life Time Warranty Registration:  <input  type="file" name="attachment2"  required/>
  <br><br>
  
   <input type="submit" name="button" value="Submit"> 
</form>
    </body>
</html>