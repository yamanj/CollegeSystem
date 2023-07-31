<html>
    <body>
    <form action="login.php" method="post">

<h1>Login</h1>

<label id="userid"><b>User Name</b></label>
<input type="text"  name="userid" required>
<br>

<label id="password"><b>Password</b></label>
<input type="password"  name="password" required>
<br>

<button type="submit" name="login" >Login</button>

</form>
<?php
        if (isset($_POST['login'])){
        $dsn = 'mysql:host=localhost; dbname=it1150';
        $username='root';
        $password='';
        $query='';
        try{
        $db=new PDO($dsn,$username,$password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $userid = $_POST['userid'];
        $password = $_POST['password'];
        $query ="select * from Users where user_name =:userid";

        $statement = $db->prepare($query);
        $statement->bindValue(':userid',$userid);
        $statement->execute();
        $row = $statement->fetch();

        if ($row != null){                
        $validUser = password_verify($password,$row['password']);
        if ($validUser) {
          session_start();  
          $_SESSION['is_valid_admin'] = true;
          $_SESSION['first_name'] = $row['first_name'];
          $_SESSION['last_name'] = $row['last_name'];
          $_SESSION['user_name'] = $row['user_name'];

          header("Location:index.php");
        }
        else{
            echo "invalid login.";
        }
        $statement->closeCursor();

        }

        }
        
        catch(PDOException $e){
            echo $query . "<br>" . $e->getMessage();
        }
        $db = null;
    }
     
    ?>