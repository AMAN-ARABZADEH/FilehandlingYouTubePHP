<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <link rel="stylesheet" href="style.css">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Form Handling PHP & HTML</title>
</head>
<body>
<br>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <label for="name">Name:</label>
 <input type="text" name="name">
 <br><br><br>
 <label for="message">Message:</label>
 <textarea name="message" id="message" cols="70" rows="13"></textarea>
 <input type="submit" value="Submit" name="submit">
 
</form>
<br><br><br>


<?php

// https://www.w3schools.com/php/php_file_open.asp¨

// Created by: Aman Arabzadeh
// https://amanarab.netlify.app/
// https://github.com/AMAN-ARABZADEH
// 

// 
// 
if ($_SERVER["REQUEST_METHOD"] == "POST") {


 // Delete
  if (isset($_POST["delete"])) {
    $file = fopen("file.txt", "r");
    $lines = array();
    while (!feof($file)) {
      $line1 =  fgets($file);
      $line2  = fgets($file);
      $line3 = fgets($file);
      $lines[] = $line1 . $line2 . $line3;
    }
    $index = $_POST["delete"];
    fclose($file);
    unset($lines[$index]);

    $file = fopen("file.txt", "w");
    foreach($lines as $line){
        fwrite($file, $line);
    }
    fclose($file);
    
  }




 // $name = test_input($_POST["name"]);
 // $message = test_input($_POST["message"]);

 // echo "Name is: " . $name . "<br>" . "Message is: " . $message;

// Write to file
// Check for submit
if (isset($_POST["submit"])) {
  if (isset($_POST["name"]) && isset($_POST["message"])) {
    $name = test_input($_POST["name"]);  // take value from user inpu
    $message = test_input($_POST["message"]);  // same here 
    $date = date('Y-m-d H:i:s'); // current date and time
    $file = fopen("file.txt", "a");  //  open a file
    $data = $name . " : " . $message;  // concat


     // Write inside the file
    fwrite($file, $name . PHP_EOL);
    fwrite($file, $message . PHP_EOL);
    fwrite($file, $date . PHP_EOL);
    fclose($file);
  }
}

}

// Open the samne file
$file = fopen("file.txt", "r");

// read from file

$line = 0;
while (!feof($file)) { // not end of file
  $name = fgets($file);  // get each line
  $message = fgets($file);  // get the line
  $date = fgets($file);  // same here 
  if ($name && $message && $date) {  // As soon there is data go inside, All three lines at´re full Taken.
   // Print data on the screen 
    echo "Name: " . $name . "<br>";  
    echo "Message: " . $message . "<br>";
    echo "Date: " . $date . "<br>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='delete' value='$line'>";
    echo "<input type='submit'  value='Delete'>";
    echo "</form>";
  }
  $line++;
}

fclose($file);






//// To check for valid user input
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

 
</body>
</html>