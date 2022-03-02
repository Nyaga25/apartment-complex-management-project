<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once('authenticate.php');
$uname = $_SESSION["username"];
date_default_timezone_set("Asia/Kolkata");
$t = time();
?>


<?php
    // echo $_POST['Toggler'];
    include("../Assets/dbconnect.php");
    if($_SERVER['REQUEST_METHOD']=='POST')  {
        if($_POST['Toggler'] == 'Assignment')   {
            // echo count($_POST)."<br>";
            $id = $_POST['Comp_Id'];
            $subject = $_POST['NewCategory'];
            $handler = $_POST['Handler'];
            $phone = $_POST['HandlerPhone'];
            //echo $id.$subject.$handler.$phone;
            date_default_timezone_set("Asia/Kolkata");
            $t = time();
            $conn->query("INSERT INTO COMP_RESOLUTION(COMPLAINT_ID, COMP_SUBJECT, COMP_HANDLER, HANDLER_PHONE, TIMESTAMP) VALUES($id,'$subject','$handler',$phone,$t)");
            $conn->query("UPDATE COMPLAINTS SET SUBJECT = '$subject', TIMESTAMP = '$t' WHERE COMPLAINT_ID = '$id'");
        }
        else if($_POST['Toggler'] == 'Drop')    {
            $id = $_POST['Comp_Id'];
            $conn->query("UPDATE COMPLAINTS SET COMP_STATUS = 'DROPPED', TIMESTAMP = '$t' WHERE COMPLAINT_ID = '$id'");
        }
        else if($_POST['Toggler'] == 'Resolve') {
            $id = $_POST['Comp_Id'];
            $conn->query("UPDATE COMPLAINTS SET COMP_STATUS = 'RESOLVED', TIMESTAMP = '$t' WHERE COMPLAINT_ID = '$id'");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="../Assets/CSS/bootstrap.css" rel="stylesheet">
    <title>COMPLAINTS</title>
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
                    <a class="nav-link" href="./registercustomer.php?user=<?php echo $uname; ?>">Registrations</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Complaints<span class="sr-only">(current)</span></a>
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


    <?php
        
        $sql1 = "SELECT * FROM COMPLAINTS WHERE COMP_STATUS = 'NOT RESOLVED'";
        $sql2 = "SELECT * FROM COMPLAINTS C INNER JOIN COMP_RESOLUTION CR ON C.COMPLAINT_ID = CR.COMPLAINT_ID WHERE COMP_STATUS = 'SCHEDULED FOR RESOLUTION'";
        $sql3 = "SELECT * FROM COMPLAINTS WHERE COMP_STATUS = 'DROPPED' OR COMP_STATUS = 'RESOLVED' ORDER BY TIMESTAMP";
        $results1 = $conn->query($sql1);
        $results2 = $conn->query($sql2);
        
        $results3 = $conn->query($sql3);


?>
<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">UNRESOLVED COMPLAINTS</span>
</nav>

<table class="table table-striped">
    <tr>
        <th>COMPLAINT ID</th>
        <th>COMPLAINANT DETAILS</th>
        <th>SUBJECT</th>
        <th>COMPLAINT DETAILS</th>
        <th>DATE FILED</th>
        <th>ACTION</th>
    </tr>

<?php
    while($row = $results1->fetch_assoc())  {
        echo "<tr><td>".$row['COMPLAINT_ID']."</td><td>".$row['NAME']."&nbsp ; Block: ".$row['APT_BLOCK']."&nbsp ; Apt: ".$row['APT_NUM']."</td>
        <td>".$row['SUBJECT']."</td><td>".$row['COMP_BODY']."</td><td>".$row['DATE_FILED']."</td><td>
            <input type=\"hidden\" name=\"Comp_ID\" value=\"".$row['COMPLAINT_ID']."\">
            <button class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#exampleModal".$row['COMPLAINT_ID']."\">SET FOR RESOLUTION</button>
            <button class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#dropModal".$row['COMPLAINT_ID']."\">DROP</button>

            <div class=\"modal fade\" id=\"exampleModal".$row['COMPLAINT_ID']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
            <div class=\"modal-dialog\" role=\"document\">
            <div class=\"modal-content\">
            <div class=\"modal-header\">
            <h5 class=\"modal-title\" id=\"exampleModalLabel\">Complaint Resolution</h5>
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
            </button>
            </div>
        <div class=\"modal-body\">
            <form method=\"post\">
                <p>Enter details about the person handling the complaint : </p>
                <div class=\"form-row\">
                <div class=\"form-group col-md-6\">
                <label for=\"exampleFormControlSelect1\">Complaint ID</label>
                    <input type=\"text\" class=\"form-control\" id=\"exampleFormControlSelect1\" name=\"Comp_Id\" value=\"".$row['COMPLAINT_ID']."\" readonly>
                </div>";
                
                $category = $gen = $wet = $dry = $dri = $oth = "";
                $category = $row['SUBJECT'];
                if($category == "General")
                    $gen = "selected";
                else if($category == "Wet Repairs")
                    $wet = "selected";
                else if($category == "Dry Repairs")
                    $dry = "selected";
                else if($category == "Drinking Water")
                    $dri = "selected";
                else 
                    $oth = "selected";
                echo "<div class=\"form-group col-md-6\">
                <label for=\"exampleFormControlSelect1\">Reconfigure Category</label>
                <select class=\"form-control\" id=\"exampleFormControlSelect1\" name=\"NewCategory\">
                    <option value=\"General\" $gen>GENERAL</option>
                    <option value=\"Wet Repairs\" $wet>WET REPAIRS</option>
                    <option value=\"Dry Repairs\" $dry>DRY REPAIRS</option>
                    <option value=\"Drinking Water\" $dri>DRINKING WATER</option>
                    <option value=\"Others\" $oth>OTHERS</option>
                </select>
            </div>
                </div>
                
                
                <div class=\"form-group\">
                <label for=\"exampleFormControlSelect1\">Name of handler</label>
                    <input class=\"form-control\" id=\"exampleFormControlSelect1\" name=\"Handler\">
                </div>
                <div class=\"form-group\">
                <label for=\"exampleFormControlSelect1\">Handler's phone</label>
                    <input class=\"form-control\" id=\"exampleFormControlSelect1\" name=\"HandlerPhone\">
                </div>            
                <input type=\"hidden\" name=\"Toggler\" value=\"Assignment\">
            

            </div>
        <div class=\"modal-footer\">
        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>
        <button type=\"submit\" class=\"btn btn-primary\">Save</button>
        </form>
        </div>
    </div>
    </div>
</div>

<div class=\"modal fade\" id=\"dropModal".$row['COMPLAINT_ID']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
<div class=\"modal-dialog\" role=\"document\">
<div class=\"modal-content\">
<div class=\"modal-header\">
<h5 class=\"modal-title\" id=\"exampleModalLabel\">Complaint Resolution</h5>
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
<span aria-hidden=\"true\">&times;</span>
</button>
</div>
<div class=\"modal-body\">
<form method=\"post\">
        <p>The complaint with ID ".$row['COMPLAINT_ID']." will be dropped.<br>Are you sure?</p>
        <input type=\"hidden\" name=\"Comp_Id\" value=\"".$row['COMPLAINT_ID']."\">
        <input type=\"hidden\" name=\"Toggler\" value=\"Drop\">
</div>
<div class=\"modal-footer\">
<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cancel</button>
<button type=\"submit\" class=\"btn btn-primary\">Yes, Drop</button>
</form>
</div>
</div>
</div>
</div>

</td>
</tr>";
    }

?>
</table>

<nav style="margin-top:30px;" class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">SCHEDULED FOR RESOLUTION</span>
</nav>

<table class="table table-striped">
    <tr>
        <th>COMPLAINT ID</th>
        <th>COMPLAINANT DETAILS</th>
        <th>SUBJECT</th>
        <th>COMPLAINT DETAILS</th>
        <th>COMPLAINT HANDLER</th>
        <th>HANDLER PHONE</th>
        <th>ACTION</th>
    </tr>

    <?php
    while($row1 = $results2->fetch_assoc())  {
        echo "<tr><td>".$row1['COMPLAINT_ID']."</td><td>".$row1['NAME']."&nbsp Block: ".$row1['APT_BLOCK']."&nbsp Apt: ".$row1['APT_NUM']."</td>
        <td>".$row1['COMP_SUBJECT']."</td><td>".$row1['COMP_BODY']."</td><td>".$row1['COMP_HANDLER']."</td><td>".$row1['HANDLER_PHONE']."</td><td>
            <input type=\"hidden\" name=\"Comp_ID\" value=\"".$row1['COMPLAINT_ID']."\">
            <button class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#resolveModal".$row1['COMPLAINT_ID']."\">THE WORK IS DONE!</button>

            <div class=\"modal fade\" id=\"resolveModal".$row1['COMPLAINT_ID']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
            <div class=\"modal-dialog\" role=\"document\">
            <div class=\"modal-content\">
            <div class=\"modal-header\">
            <h5 class=\"modal-title\" id=\"exampleModalLabel\">Complaint Resolution</h5>
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
            </button>
            </div>
            <div class=\"modal-body\">
            <form method=\"post\">
                    <p>The complaint with ID ".$row1['COMPLAINT_ID']." will be marked as resolved.<br>Are you sure it has been successfully resolved?</p>
                    <input type=\"hidden\" name=\"Comp_Id\" value=\"".$row1['COMPLAINT_ID']."\">
                    <input type=\"hidden\" name=\"Toggler\" value=\"Resolve\">
            </div>
            <div class=\"modal-footer\">
            <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Was a misclick</button>
            <button type=\"submit\" class=\"btn btn-primary\">It's Resolved</button>
            </form>
            </div>
            </div>
            </div>
            </div> 
            </td>
            </tr>";


    }
?>
</table>

<nav style="margin-top:30px;" class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">RESOLVED OR DROPPED COMPLAINTS</span>
</nav>

<table class="table table-striped">
    <tr>
        <th>COMPLAINT ID</th>
        <th>COMPLAINANT DETAILS</th>
        <th>SUBJECT</th>
        <th>COMPLAINT DETAILS</th>
        <th>ACTION TAKEN</th>
        <th>DATE OF ACTION</th>
    </tr>

<?php
    while($row3 = $results3->fetch_assoc())  {
        $timestamp = $row3['TIMESTAMP'];
        $d = date('d-m-Y',$timestamp);
        echo "<tr><td>".$row3['COMPLAINT_ID']."</td><td>".$row3['NAME']."&nbsp Block: ".$row3['APT_BLOCK']."&nbsp Apt: ".$row3['APT_NUM']."</td>
        <td>".$row3['SUBJECT']."</td><td>".$row3['COMP_BODY']."</td><td>".$row3['COMP_STATUS']."</td><td>".$d."</td></tr>";
    }
?>
</table>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>

</html>