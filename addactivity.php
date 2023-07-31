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
    <form action="addactivity.php" method="post"> 
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
    
    //insert club 
    
    if (isset($_POST['club'])){
        $sql = "insert into clubmembers (user_id,club_id) values ('".$userName."','".$_POST['club']."')";
        if (mysqli_query($conn, $sql)) 
        echo "New club membership added successfully.<br>";
    }
?>
<form action="addactivity.php" method="post">

<p>
Club<br>
<select name="club" value="club">
<option value="" >select club  </option>
             <?php
             try{
             // get all semesters from DB and display in select
              $sql = "select  * from clubs  ";
              $result = mysqli_query($conn, $sql); 
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                echo "<option value=".$row['club_id'].">".$row['title']."</option>";
                }   
            }
        }
        catch(Exception $e ){
            echo "Exception error: ".$e->getMessage();
        }
            mysqli_close($conn);

            ?>
</select>
</p></p>

    <input type="submit" >
</p>
</form>
</body>
</html>