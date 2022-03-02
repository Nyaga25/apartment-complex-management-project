<?php
    require_once('authenticate.php');
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
?>

<?php
    $uname = $_SESSION["username"];
?>
<?php
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
    $hostName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "apartments";

    $emailId = $_SESSION['email'];
    // echo $emailId;

    include("../Assets/dbconnect.php");

    date_default_timezone_set('Asia/Kolkata');

    $sql = "SELECT TIMESTAMP FROM ADMIN WHERE EMAIL = '$emailId'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $timestamp = $row['TIMESTAMP'];

    // echo "Admin logout time: ".$timestamp;

    // $sql3 = "SELECT TIMESTAMP FROM GUEST";

    // $results = $conn->query($sql3);

    // while($rows = $results->fetch_assoc())    {
    //     echo "   ".$rows['TIMESTAMP']."   ";
    // }

    $sql1 = "SELECT COUNT(*) AS COMP_COUNT FROM COMPLAINTS WHERE TIMESTAMP >= '$timestamp'";
    $sql2 = "SELECT COUNT(*) AS GUEST_COUNT FROM GUEST WHERE TIMESTAMP >= '$timestamp'";

    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $rc1 = mysqli_num_rows($result1);
    $rc2 = mysqli_num_rows($result2);
    // echo $rc1."   ".$rc2;

    $row1 = $result1->fetch_assoc();
    $row2 = $result2->fetch_assoc();

    if($rc1>0)
        $nocomp = $row1['COMP_COUNT'];
    else
        $nocomp = '0';

    if($rc2>0)
        $noguest = $row2['GUEST_COUNT'];
    else
        $noguest = '0';

    
?>
<!DOCTYPE html>
<html>

<head>
    <link href="../Assets/CSS/bootstrap.css" rel="stylesheet">
    <link href="../Assets/CSS/adminstyle.css" rel="stylesheet">
    <title>ADMIN MAIN</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand">Complex Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./registercustomer.php?user=<?php echo $uname; ?>">Registrations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="complaints.php?user=<?php echo $uname; ?>">Complaints</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminguest.php?user=<?php echo $uname; ?>">Guest Entries</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a class="btn btn-warning my-2 my-sm-0" href="logout.php">Logout</a>
            </form>
        </div>
    </nav>
    <div class="container-fluid" style="padding: 0px;">
        <div class="jumbotron jumbotron-fluid" id="jumbo">
            <div class="container">
                <p class="lead textbasically">Welcome back,</p>
                <?php echo '<h1 class="display-4 textbasically"><span>'.$uname.'</span></h1>'?>
            </div>
        </div>
    </div>


<div class="container">
    <h2>Let's catch up. Since you last logged in : </h2>
    <ul>
        <li>
            <p>There were <?php echo '<span style="color: red";>'.$nocomp.'</span>';?> new complaint(s) filed by the residents.</p>
        </li>
        <li>
            <p>And a total of <?php echo '<span style="color: green";>'.$noguest.'</span>';?>  new guest(s) visiting the Complex.</p>
        </li>
    
    
    
    
    </ul>

</div>




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

</body>

</html>
