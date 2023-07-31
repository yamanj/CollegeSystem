
<html>
    <body>
    <form action="signup.php" method="post">

<h1>Sign Up</h1>

<label id="fname" ><b>First Name</b></label>
<input type="text"  name="fname" required>
<br>

<label id="lname"><b>Last Name</b></label>
<input type="text"  name="lname" required>
<br>


<label id="email"><b>Email</b></label>
<input type="text"  name="email" required>
<br>

<label id="userid"><b>User Name</b></label>
<input type="text"  name="userid" required>
<br>

<label id="password"><b>Password</b></label>
<input type="password"  name="password" required>
<br>

<button type="submit" name="signup" >Sign Up</button>

</form>
        <?php
        if (isset($_POST['signup'])){
        $dsn = 'mysql:host=localhost; dbname=it1150';
        $username='root';
        $password='';
        $query='';
        try{
        $db=new PDO($dsn,$username,$password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = $_POST['email'];
        $password = $_POST['password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $userid = $_POST['userid'];

        $query ="insert into Users (user_name,email,password,first_name,last_name) 
        values (:userid,:email,:password,:fname,:lname)";

        $statement = $db->prepare($query);
       $statement->bindValue(':email',$email);
       $hash = password_hash($password,PASSWORD_DEFAULT);
       $statement->bindValue(':password',$hash);
       $statement->bindValue(':userid',$userid);
       $statement->bindValue(':fname',$fname);
       $statement->bindValue(':lname',$lname);

          $statement->execute();
          $statement->closeCursor();
          echo "account information added.<br>";
          echo "<a href='index.html'>Back to main page.</a> ";
        }
        catch(PDOException $e){
            echo $query . "<br>" . $e->getMessage();
        }
        $db = null;
    }
     
    ?>
</body>
    </html>