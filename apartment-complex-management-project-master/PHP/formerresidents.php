<?php
    error_reporting(E_ALL & ~E_NOTICE);
// $_SESSION['islisting'] = "";
    session_start();
    require_once('authenticate.php');
    $uname = $_SESSION["username"];
    include("../Assets/dbconnect.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>FORMER RESIDENTS</title>
    <meta charset="utf-8">
    <link href="../Assets/CSS/bootstrap.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</head>

<body>
<?php
        
        $result = $conn->query("SELECT * FROM FORMERRESIDENT");
        
?>
<nav class="navbar navbar-light bg-transparent">
    <a class="btn btn-outline-success" href="./registercustomer.php">◀️ Go Back</a>
</nav>

<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">FORMER RESIDENTS</span>
</nav>

<table class="table table-striped">
    <tr>
        <th>NAME</th>
        <th>PHONE NUMBER</th>
        <th>EMAIL ID(IF COMMS OPTED)</th>
        <th>FEEDBACK GIVEN</th>
        <th>DURATION OF STAY(IN DAYS)</th>
    </tr>

    <?php
    while($row = $result->fetch_assoc())    {
        $time = $row['DURATIONTIMESTAMP'];
        $days = (int)($time / 86400);
        echo "<tr><td>".$row['NAME']."</td><td>".$row['PHONE_NO']."</td>
        <td>".$row['EMAILID']."</td><td>".$row['FEEDBACK']."</td><td>".$days."</td></tr>";
    }
    ?>
    </table>
    </body>
    </html>
