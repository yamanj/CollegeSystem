<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "it1150";
try{
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "insert into sections (crn,course_id,semester,room,days,times) values('".
$_POST['crn']."','".$_POST['course_id']."','".$_POST['semester']."','".$_POST['room'].
"','".$_POST['days']."','".$_POST['times']."')";
if (mysqli_query($conn, $sql)) {
    echo "New section created successfully.<br>";
    echo "<a href='sections.php'>Back to sections.</a><br>";
    echo "<a href='index.php'>Back to main page.</a>";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
catch(Exception $e ){
    echo "Exception error: ".$e.getmessage();
}
  mysqli_close($conn);


?>