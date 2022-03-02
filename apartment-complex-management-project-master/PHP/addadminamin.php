<?php
    session_start();
    error_reporting(E_ALL & ~E_NOTICE);
    $_SESSION['Email'] = "";
    $_SESSION['Name'] = "";
    include("../Assets/dbconnect.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST')    {
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        // echo $name.$email;
        $password = sha1($_POST['Password']);
        $_SESSION['Email'] = "$email";
        $_SESSION['Name'] = "$name";
        $adminemail = $_POST['AdminEmail'];
        $adminpassword = sha1($_POST['AdminPassword']);
        $time = 0;
        $result = $conn->query("SELECT * FROM ADMIN WHERE EMAIL = '$email'");
        echo $conn->error;
        if($result->num_rows > 0)
            $emailduplicate = "<p><span style=\"color: red;\">Your email is already taken. Login using your credentials by </span><a href=\"./adminlogin.php\">clicking here</a>.</p>";
        else {
            $result = $conn->query("SELECT * FROM ADMIN WHERE EMAIL = '$adminemail' AND PASSWORD = '$adminpassword'");
            echo $conn->error;  
            if($result->num_rows == 0)  {
                ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../Assets/CSS/bootstrap.css">
    <title>NICE TRY, BUT NO</title>
</head>

<body>
    <div class="jumbotron" style="margin-top: 50px;">
        <p class="lead">Wrong admin credentials. Rolling back changes....</p>
        <center><img src='https://pics.me.me/naw-rosa-parks-mematic-net-39421382.png' height=500px width=500px></center>
        <?php header("Refresh: 9; url=adminlogin.php"); ?>
    </div>
</body>

</html>


<?php
            }
        else{   
            $conn->query("INSERT INTO ADMIN(EMAIL, NAME, PASSWORD, TIMESTAMP) VALUES('$email','$name','$password',$time)");
            ?>
<html>

<head>
    <link rel="stylesheet" href="../Assets/CSS/bootstrap.css">
    <title>WELCOME MATE!</title>
</head>

<body>
    <div class="jumbotron" style="margin-top: 50px;">
        <p class="lead">"With great power comes great responsibility" - Benjamin Parker</p>
        <p class="lead">Your credentials have been recorded. Login using your UserID and Password..
        </p>
        <?php header("Refresh: 6; url=adminlogin.php"); ?>
    </div>
</body>

</html>

<?php       }
    die();    
    }
    
    }

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../Assets/CSS/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <title>ADD A NEW ADMIN</title>
</head>

<body>
    <div class="container" style="margin-top: 50px;">
    <div class='jumbotron'>
    <h4>ADDING A NEW ADMINISTRATOR</h4>
        <form method="post">
            <div class="form-group">
            <input name="hidden" type="text" style="display:none;">
                <label>Name</label>
                <input class="form-control" name="Name" type="text" value="<?php echo $_SESSION['Name']; ?>" required>
                <label>Email ID</label>
                <input class="form-control" name="Email" type="email" value="<?php echo $_SESSION['Email']; ?>" required>
                <?php echo $emailduplicate; ?>
                <label>Password</label>
                <input class="form-control" name="Password" autocomplete="new-password" type="password" placeholder="Maximum of 15 characters" maxlength="15" required>
                <?php    session_destroy();
                ?>
                <br />

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Go Ahead
                </button>
                <a class="btn btn-warning" style="float: right;" href="./adminlogin.php">Cancel</a>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Existing Administrator details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label>Administrator Email</label>
                                <input type="email" name="AdminEmail" class="form-control" required>
                                <label>Administrator Password</label>
                                <input type="password" name="AdminPassword" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add admin</button>
        </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>

</html>
