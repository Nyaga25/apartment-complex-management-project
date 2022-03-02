<?php

$resid = $_GET['resid'];

include("../Assets/dbconnect.php");

$sql = "SELECT * FROM RESIDENT WHERE RES_ID = '$resid'";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

date_default_timezone_set('Asia/Kolkata');
$ts = time();
$ets = $row['REG_TIMESTAMP'];
$durts = ($ts - $ets);
$name = $row['FULLNAME'];
$phone = $row['PHONE_NO'];
$lname = $row['LNAME'];

$sql1 = "DELETE FROM RESIDENT WHERE RES_ID = '$resid'";
$conn->query($sql1);
echo $conn->error;

if(empty($_POST['Iscomms']))   
    $iscomms = "OPTED OUT";
else if($_POST['Iscomms'] == "On")
    $iscomms = $row['EMAIL'];

$conn->query($sql1);
if(empty($_POST['Feedback']))
    $fdbk = "Null";
else	
    $fdbk = $_POST['Feedback'];

$sql2 = "UPDATE FORMERRESIDENT SET EMAILID = '$iscomms', FEEDBACK = '$fdbk', EXITTIMESTAMP = $ets, DURATIONTIMESTAMP = $durts WHERE RES_ID = '$resid'";
$conn->query($sql2);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../Assets/CSS/bootstrap.css">
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="11;url=./registercustomer.php">
    <script type="text/javascript">
        var timeleft = 10;
        var redirectTimer = setInterval(function(){
            timeleft--;
            if(timeleft >= 1)
                document.getElementById("countdownTimer").textContent = timeleft;
            if(timeleft <= 0)   {
                document.getElementById("redirectText").textContent = "Redirecting...";
                clearInterval(downloadTimer);
            }
        },1000);
    </script>
    <title>BEST WISHES</title>
</head>
<body>
<div class="container" style="margin-top:20px;">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Goodbye <?php echo $row['TITLE'].$lname; ?> </h1>
                <p class="lead">We wish you the best in all your future ventures and apologize for any inconvenience caused. We'd also like to thank you for giving us an oppurtunity to serve you 😄</p>
                <p><span id="redirectText">You will be redirected back in <span id="countdownTimer">10</span></span></p>
            </div>
        </div>
</body>
</html>