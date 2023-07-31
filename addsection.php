<!DOCTYPE html>
<html>
<head>
<style>
    * { font-family: Arial, Helvetica, sans-serif; }
    table { max-width: 900px; margin-left: auto; margin-right: auto; border-collapse: collapse; }
    td, th { border: 1px solid teal; padding: 4px; }
    th { background-color: teal; color: white; font-size: 1.1em; font-weight: bold; }
    table tr:first-child td { border: 0px; }
</style>
</head>
<body>
<a href="login.php">Login</a><br>
    <a href="schedule.php">Registration</a><br>
    <a href="courses.php">View courses</a><br>
    <a href="addclass.php">Add a Class</a><br>
    <a href="sections.php">View sections</a><br>
    <a href="addsection.php">Add a section</a><br>
    <a href="activities.php">Student Clubs</a><br>
    <a href="addactivity.php">Add a Student Club</a><br> 
    <form action="addsection.php" method="post"> 
    <input type="submit" name="logout" value="logout" /> 
    </form>
<?php
    session_start();

if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  header("Location:index.html");
  exit;
}

    //start  DB connection
    $userName = "";
    if (isset($_SESSION['user_name']))
      $userName = $_SESSION['user_name'];
    echo "<h1>welcome ".$userName."</h1>";
    $servername = "localhost";
    $connusername = "root";
    $password = "";
    $dbname = "it1150";

    $conn = mysqli_connect($servername, $connusername, $password, $dbname);
    // Check connection
    if (!$conn) {
         die("Connection failed: " . mysqli_connect_error());
    }
?>
<form action="addsection-submit.php" method="post">
<p>
CRN <br>
<input type="text" name="crn" id="crn">
</p>
<p>
Course ID<br>
<select name="course_id" value="course_id">
<option value="" >select course  </option>
             <?php
             // get all semesters from DB and display in select
              $sql = "select  course_id from courses ";
              $result = mysqli_query($conn, $sql); 
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                echo "<option value=".$row['course_id'].">".$row['course_id']."</option>";
                }   
            }
            ?>
</select>
</p></p>
<p >
Semester <br>
<select name="semester" value="semester">
<option value="" >select semester  </option>
             <?php
             try{
             // get all semesters from DB and display in select
              $sql = "select distinct semester from sections ";
              $result = mysqli_query($conn, $sql); 
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                echo "<option value=".$row['semester'];
                //mark selected option as selected
                if (isset($_GET['semester'])){
                  if ($_GET['semester']==$row['semester'])
                  echo " selected ";
                }
               echo  ">".$row['semester']."</option>";
              }   
            }
          }
          catch(Exception $e ){
            echo "Exception error: ".$e->getMessagege();
        }
            mysqli_close($conn);

            ?>
</select>
</p>
<p>
Room <br>
<input type="text" name="room" id="room">
</p>
<p>
Days <br>
<input type="text" name="days" id="days">
</p>
<p>
Times <br>
<input type="text" name="times" id="times">
</p>
<p>
    <input type="submit" >
</p>
</form>

</body>
</html>