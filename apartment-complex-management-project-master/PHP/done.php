<!DOCTYPE html>
<html>

<head>
    <link href="../Assets/CSS/bootstrap.css" rel="stylesheet" type="text/css">
    <title>COMPLAINT REGISTERED</title>

</head>

<body>

<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "apartments";
    
    include("../Assets/dbconnect.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST')    {
        $block = $_POST['Block'];
        $number = $_POST['Number'];
        $name = $_POST['Name'];
        $subject = $_POST['Subject'];
        $complaint = $_POST['Complaint'];   
        if(strlen($block) == 2) {
            $start = substr($block,0,1);
            $end = substr($block,1);
            $block = $start."-".$end;
            // echo $block;
        }  
        // echo $block.$number;
        $sql = "CALL check_insert('$block','$number',@result)";

        $conn->query($sql);

        $res = $conn->query('SELECT @result');
        $resaa = $res->fetch_assoc();
        $isallowed = $resaa['@result'];
        // echo $isallowed;
        if($isallowed == -1)    {
        date_default_timezone_set('Asia/Kolkata');   
        $t = time();
        $date = date('Y-m-d',$t);
        // echo($t);
        
//        echo($block.$number.$name.$subject.$complaint);
        
        $sql = "INSERT INTO COMPLAINTS(APT_BLOCK,APT_NUM,NAME,SUBJECT,COMP_BODY,DATE_FILED,TIMESTAMP) VALUES('$block','$number','$name','$subject','$complaint','$date','$t')";
        
        if($conn->query($sql)==TRUE)
            $yeet = "Yeet";
    else	{
            $yeet = "Neet";
            echo $conn->error;
    }
        $sql1 = "SELECT MAX(COMPLAINT_ID) AS COMP_ID FROM COMPLAINTS";
        
        if($yeet === "Yeet")
        {
            $result = $conn->query($sql1);
            $row = $result->fetch_assoc();
            
        }
        

    ?>


    <div class="jumbotron">
        <h1 class="display-4">Thank You for your input</h1>
        <p class="lead">Your Complaint ID is : <?php echo($row["COMP_ID"]); ?>. Note it down for future reference.</p>
        <?php $conn->close(); ?>
        <hr class="my-4">
        <p>Your feedback helps in making this Apartment Community a better place to live in</p>
        <a class="btn btn-primary btn-lg" href="./customercomplaints.php" role="button">Got It!</a>
    </div>





    <?php	}
    elseif($isallowed == 1){
    
    ?>


    <div class="jumbotron">
        <h1 class="display-4">No one lives in that apartment :(</h1>
        <p class="lead">Please re-check and repeat. Contact an admin if this is a mistake.</p>
        <?php $conn->close(); ?>
        <hr class="my-4">
        <a class="btn btn-primary btn-lg" href="./customercomplaints.php" role="button">Got it</a>
    </div>


</body>



    <?php }
    } ?>