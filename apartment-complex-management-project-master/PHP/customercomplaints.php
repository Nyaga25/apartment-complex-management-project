<!DOCTYPE html>
<html>

<head>
    <link href="../Assets/CSS/bootstrap.css" rel="stylesheet">
    <title>REGISTER COMPLAINT</title>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</head>

<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
$hostName = "localhost";
$userName = "root";
$password = "";
$dbName = "apartments";
$status = null;

include("../Assets/dbconnect.php");

if ($conn->connect_error) {
    die("Couldn't connect");
}
$_SESSION['isregister'] = "show";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($_POST['isreopen'] == "true")    {
        $compid = $_POST['Comp_Id'];
        $sql = "SELECT * FROM COMPLAINTS WHERE COMPLAINT_ID = '$compid'";
        $_SESSION['isfound'] = true;
        $_SESSION['compid'] = $compid;
        $_SESSION['subject'] = $row['SUBJECT'];
        $_SESSION['status'] = "REOPENED";
        $_SESSION['date_filed'] = $row['DATE_FILED'];
        date_default_timezone_set('Asia/Kolkata');
        $t = time();
        $conn->query("UPDATE COMPLAINTS SET COMP_STATUS = 'NOT RESOLVED', TIMESTAMP = $t WHERE COMPLAINT_ID = '$compid'");
        // $reopenmsg = "Your complaint has been reopened successfully. Your complaint ID is retained, i.e. ".$_SESSION['compid'];
        $_SESSION['ischeck'] = true;
        $_SESSION['isregister'] = "";
        $_SESSION['ischecking'] = "show";
    }
    
    if (!empty($_POST['compidcheck'])) {
        $name = $_POST['namecheck'];
        $compid = $_POST['compidcheck'];
        $reopenmsg = "<form class=\"form-inline\" method=\"post\">
        <div class=\"form-group\">
        <input type=\"hidden\" name=\"isreopen\" value=\"true\">
        <input type=\"hidden\" name=\"Comp_Id\" value=\"".$compid."\">
        Not satisfied?<input class=\"btn btn-link\" type=\"submit\" value=\"Reopen complaint\">
        </div>";
        $sql = "SELECT * FROM COMPLAINTS WHERE COMPLAINT_ID = '$compid'";

        $result = $conn->query($sql);
        
        $row = $result->fetch_assoc();
        if($result->num_rows == 0)
            $_SESSION['isfound'] = false;
        else	{
            $result1 = $conn->query("SELECT * FROM COMP_RESOLUTION WHERE COMPLAINT_ID = '$compid'");
            $row1 = $result1->fetch_assoc();
            $_SESSION['isfound'] = true;
            $_SESSION['compid'] = $compid;
            $_SESSION['subject'] = $row['SUBJECT'];
            $_SESSION['status'] = $row['COMP_STATUS'];
            $_SESSION['date_filed'] = $row['DATE_FILED'];
            $_SESSION['date'] = date('Y-m-d',$row['TIMESTAMP']);
            $_SESSION['handler'] = $row1['COMP_HANDLER'];
            $_SESSION['handlerphone'] = $row1['HANDLER_PHONE'];
        }
        $_SESSION['ischeck'] = true;
        $_SESSION['isregister'] = "";
        $_SESSION['ischecking'] = "show";
    }
}

$conn->close();

?>




<style>
    img {
        width: 700px;

    }
    .error {
        border: 1px red solid;
    }
    </style>

<body>

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="../index.php">Resident</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="./user.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Complaints<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./guestreg.php">Guest Entry</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a class="btn btn-primary my-2 my-sm-0" href="adminlogin.php">I'm an Admin</a>
            </form>
        </div>
    </nav>

    <div class="container-fluid" style="padding: 0px;">
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-info" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Register a complaint
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse <?php $register = $_SESSION['isregister']; echo $register;?>" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <form method="post" action="done.php">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Apartment Block</label>
                                    <input type="text" name="Block" class="form-control" id="inputEmail4" placeholder="Name of the block[A-1 to C-3]" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Apartment Number</label>
                                    <input type="text" name="Number" class="form-control" id="inputPassword4" placeholder="3-digit Apartment Number[001 to 203]" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputAddress2">Name</label>
                                <input type="text" name="Name" class="form-control" id="inputAddress2" placeholder="Name of complainant" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Subject of Complaint(Select any one; note that a proper subject will speed up grievance redressal process)</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="Subject">
                                    <option value="General" selected>GENERAL(NEIGHBOURS, AMBIENCE, AUTHORITY ETC.)</option>
                                    <option value="Wet Repairs">WET REPAIRS</option>
                                    <option value="Dry Repairs">DRY REPAIRS</option>
                                    <option value="Drinking Water">DRINKING WATER</option>
                                    <option value="Others">OTHERS</option>
                                </select>
                            </div>
                            <!--                        <div class="form-row">-->
                            <div class="form-group">
                                <label>Issue</label>
                                <textarea name="Complaint" class="form-control" placeholder="Type out your complaint in a precise manner" required></textarea>
                            </div>
                            <!--                        </div>-->

                            <button type="submit" class="btn btn-primary">Register Complaint</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-info" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Check your complaint status
                        </button>
                        
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse <?php $ischecking = $_SESSION['ischecking']; echo $ischecking;?>" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <form method="post">
                            <div class="form-row align-items-center">
                                <div class="col-auto">
                                    <label class="sr-only" for="inlineFormInput">Name</label>
                                    <input type="text" name="namecheck" class="form-control mb-2" id="inlineFormInput" placeholder="Name of current resident">
                                </div>
                                <div class="col-auto">
                                    <label class="sr-only" for="inlineFormInputGroup">Complaint ID</label>
                                    <input type="text" name="compidcheck" class="form-control mb-2" id="inlineFormInput" placeholder="Your Complaint ID" required>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2">Check</button>
                                </div>
                            </div>
                        </form>
                        <b><?php
                        error_reporting(E_ALL & ~E_NOTICE);
                        session_start();
                        // echo $_SESSION['date_filed'];
                        if($_SESSION['ischeck'] === true && $_SESSION['isfound'] === false)
                            echo "Your complaint could not be found. Sorry.";
                        else if($_SESSION['ischeck'] === true && $_SESSION['isfound'] === true)   {
                            echo "Your complaint ID'd <u>".$_SESSION['compid']."</u> categorized as <u>".$_SESSION['subject']."</u> filed on <u>".$_SESSION['date_filed']."</u> has the status <u>".$_SESSION['status']."</u>.";
                            if($_SESSION['status'] === "RESOLVED" || $_SESSION['status'] === "DROPPED")  {
                            echo "<details>
                            <summary>More details about your complaint --></summary>
                                <p style=\"margin-top: 30px\">The aforementioned action was taken on <u>".$_SESSION['date']."</u></p>
                                <p>".$reopenmsg."</p>
                            </details>";
                            }
                            else if($_SESSION['status'] === "SCHEDULED FOR RESOLUTION"){
                            echo "<details>
                            <summary>More details about your complaint --></summary>
                                <p style=\"margin-top: 30px\">The aforementioned action was taken on <u>".$_SESSION['date']."</u><br>
                                <p>Your complaint is being handled by <u>".$_SESSION['handler']."</u>. Reach out to him in case of questions at <u>".$_SESSION['handlerphone']."</u></p>
                            </details>";
                            }
                        }
                        session_unset();
                        session_destroy();
                        ?></b>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>

</html>
