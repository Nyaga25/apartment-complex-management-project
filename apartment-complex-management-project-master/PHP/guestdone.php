<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST')   {
        $title = $_POST['Title'];
        $name = $_POST['Name'];
        $apt_block = $_POST['Block'];
        if(strlen($apt_block) == 2) {
            $start = substr($apt_block,0,1);
            $end = substr($apt_block,1);
            $apt_block = $start."-".$end;
            // echo $block;
        }  
        $apt_num = $_POST['Number'];
        $reason = $_POST['Reason'];
        $phone = $_POST['Phone'];
        $date = null;
        $time = null;

        $name = $title.$name;

        // echo $title;
        // echo $name;

        date_default_timezone_set("Asia/Kolkata");
        // echo date_default_timezone_get();
        $arr = localtime(time(),true);   
        $t = time();
        // print_r($arr);
        $min = $arr['tm_min']; 
        $len = strlen($min);
        if($len === 1)
            $min = "0".$min;
        $hour = $arr['tm_hour'];
        $len = strlen($hour);
        if($len === 1)
            $hour = "0".$hour;
        $time = $hour.":".$min;
        // echo($t . "<br>");
        $date = date("d-m-Y",$t);

        //echo($name.$apt_block.$apt_num.$reason.$phone.$time.$date);

        $hostName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "apartments";

        include("../Assets/dbconnect.php");

        if($conn->connect_error)
            echo("lolwut");
        $sql = "CALL check_insert('$apt_block','$apt_num',@result)";

        $conn->query($sql);

        $res = $conn->query('SELECT @result');
        $resaa = $res->fetch_assoc();
        $isallowed = $resaa['@result'];
        // echo $isallowed;
        if($isallowed == -1)    {

        $sql = "INSERT INTO GUEST(NAME, APT_BLOCK, APT_NUM, REASON, PHONE, DATE_OE, TIME_OE, TIMESTAMP) VALUES('$name','$apt_block','$apt_num','$reason','$phone','$date','$time','$t')";

        $conn->query($sql);

        $conn->close();
    
    ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Confirmation</title>
    <link href="../Assets/CSS/bootstrap.css" rel="stylesheet">
    <meta http-equiv="refresh" content="8;url=./user.php" />
</head>

<body>

    <div class="jumbotron">
        <h1 class="display-4">Welcome,
            <?php echo $name; ?>
        </h1>
        <p class="lead">Please enjoy your stay in our complex. We look forward to being of your service.</p>
        <hr class="my-4">
        <p>You checked-in as a guest at
            <?php echo $time; ?> on
            <?php echo $date; ?> to the resident of
            <?php echo $apt_block.":".$apt_num."."; ?>
        </p>
        <!-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
        <br><br><br>
        <p>You'll be redirected back to the home page shortly. Hang on..</p>
    </div>

</body>

</html>

        <?php }
    else if($isallowed == 1)   {   ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Confirmation</title>
    <link href="../Assets/CSS/bootstrap.css" rel="stylesheet">
    <meta http-equiv="refresh" content="10;url=./user.php" />
</head>

<body>

    <div class="jumbotron">
        <h1 class="display-4">No one lives in that apartment :(</h1>
        <p class="lead">Want to actually buy the house? Contact an admin today.....</p>
        <?php $conn->close(); ?>
        <hr class="my-4">
        <!-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
        <br><br><br>
        <p>You'll be redirected back to the home page shortly. Hang on..</p>
    </div>

</body>

</html>


    <?php }
    } ?>