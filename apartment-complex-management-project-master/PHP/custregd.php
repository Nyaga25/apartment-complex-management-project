<!DOCTYPE html>
<html>
<head>
    <link href="../Assets/CSS/bootstrap.css" rel="stylesheet">
    <title>RESIDENT REGISTERED</title>
</head>
<body>
<?php

    if($_SERVER['REQUEST_METHOD']=='POST')  {
        $hostName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "apartments";

        include("../Assets/dbconnect.php");

        $title = $_POST['Title'];
        $fname = $_POST['Name'];
        // $lname = $_POST['Lname'];
        $lname = explode(" ",$fname);
        $lname = $lname[count($lname)-1];
        $dob = $_POST['DoB'];
        $phone = $_POST['Phone'];
        $email = $_POST['EmailId'];
        $block = $_POST['Block'];
        $aptnum = $_POST['AptNumber'];
        $prevadd = $_POST['Address'];

        // echo $title.$fname.$lname.$dob.$phone.$email.$block.$aptnum.$prevadd;
        date_default_timezone_set('Asia/Kolkata');
        $t = time();
        $sql = "CALL check_insert('$block','$aptnum',@result)";
        $conn->query($sql);

        $res = $conn->query('SELECT @result');
        $resaa = $res->fetch_assoc();
        $isallowed = $resaa['@result'];
        // echo $isallowed;

        if($isallowed == 1)
        {
            $sql = "INSERT INTO RESIDENT(TITLE,FULLNAME,LNAME,DOB,PHONE_NO,EMAIL,PREV_ADDRESS,PREFERRED_BLOCK,PREFERRED_APT,REG_TIMESTAMP) VALUES('$title','$fname','$lname','$dob','$phone','$email','$prevadd','$block','$aptnum','$t')";
            $conn->query($sql);
        
?>
    <div class="container-fluid" style="padding-top:20px;">
        <div class="jumbotron">
            <h1 class="display-4">Time to welcome <?php echo $title." ".$lname."!"; ?> </h1>
            <p class="lead">Resident registered to <?php echo $block." ".$aptnum."." ;?></p>
            <hr class="my-4">
            <p>Ensure that the resident looks forward to having a long and fruitful stay with us :)</p>
            <a class="btn btn-primary btn-lg" href="./registercustomer.php" role="button">Done</a>
        </div>    
    </div>
<?php 
        }
        else if($isallowed == -1)	{
?>
            <div class="container-fluid" style="padding-top:20px;">
        <div class="jumbotron">
            <h1 class="display-4">Sorry but the apartment you desire is already taken. :(</h1>
            <p class="lead">Please try again. Apologies for the inconvenience</p>
            <a class="btn btn-primary btn-lg" href="./registercustomer.php" role="button">Got It!</a>
        </div>    
    </div>

<?php
        }
    }


?>

</body>
</html>