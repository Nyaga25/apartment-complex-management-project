<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once('authenticate.php');
$uname = $_SESSION["username"];
date_default_timezone_set('Asia/Kolkata');
?>
<?php 
include("../Assets/dbconnect.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST')    {
        // echo $_POST['Toggler']."   ".$_POST['Guest_Id'];
        if($_POST['Toggler'] == 'Drop') {
            $guid = $_POST['Guest_Id'];
            $conn->query("DELETE FROM GUEST WHERE GUID = '$guid'");
            echo $conn->error;
        }
    }

?>


<!DOCTYPE html>
<html>

<head>
    <title>GUEST MANAGEMENT</title>
    <link href="../Assets/CSS/bootstrap.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand">Complex Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="./admin.php?user=<?php echo $uname; ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registercustomer.php?user=<?php echo $uname; ?>">Registrations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="complaints.php?user=<?php echo $uname; ?>">Complaints</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Guest Entries<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a class="btn btn-warning my-2 my-sm-0" href="logout.php">Logout</a>
            </form>
        </div>
    </nav>

    <?php
        
        $result = $conn->query("SELECT * FROM GUEST");
        
?>
<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">GUESTS</span>
</nav>

<table class="table table-striped">
    <tr>
        <th>NAME</th>
        <th>VISITING</th>
        <th>REASON GIVEN</th>
        <th>TIMESTAMP OF VISIT</th>
        <th>MANAGE</th>
    </tr>

    <?php
        while($row = $result->fetch_assoc())    {
        echo "<tr><td>".$row['NAME']."</td><td>Block: ".$row['APT_BLOCK']."&nbsp ; Apt: ".$row['APT_NUM']."</td>
        <td>".$row['REASON']."</td><td>On ".$row['DATE_OE']."&nbsp ; At: ".$row['TIME_OE']."</td><td>
        <input type=\"hidden\" name=\"Guest_ID\" value=\"".$row['GUID']."\">
        <button class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#exampleModal".$row['GUID']."\">DELETE RECORD</button>

        <div class=\"modal fade\" id=\"exampleModal".$row['GUID']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
        <div class=\"modal-dialog\" role=\"document\">
        <div class=\"modal-content\">
        <div class=\"modal-header\">
        <h5 class=\"modal-title\" id=\"exampleModalLabel\">Record Deletion</h5>
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
        <span aria-hidden=\"true\">&times;</span>
        </button>
        </div>
        <div class=\"modal-body\">
        <form method=\"post\">
                <p>Record of ".$row['NAME']." will be permanently removed. Are you sure?</p>
                <input type=\"hidden\" name=\"Guest_Id\" value=\"".$row['GUID']."\">
                <input type=\"hidden\" name=\"Toggler\" value=\"Drop\">
        </div>
        <div class=\"modal-footer\">
        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cancel</button>
        <button type=\"submit\" class=\"btn btn-primary\">Yes, Delete</button>
        </form>
        </div>
        </div>
        </div>
        </div>
            </td>
            </tr>
        ";
        }
?>

</table>
</body>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</html>