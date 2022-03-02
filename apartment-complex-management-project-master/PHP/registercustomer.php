<?php
error_reporting(E_ALL & ~E_NOTICE);
// $_SESSION['islisting'] = "";
session_start();
require_once('authenticate.php');
$uname = $_SESSION["username"];
?>
<?php
    $_SESSION['isregister'] = "show";
    $listing = "";
    $managing = "";
    include("../Assets/dbconnect.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST')    {
        if($_POST['Toggler']=="listing")    {
            // $toggle = $_POST['Toggler'];
            // echo $toggle;
            $block = $_POST['QueryBlock'];
            // $_SESSION['Block'] = $block;
            if($block === "*")  {
                $sql = "SELECT * FROM RESIDENT ORDER BY PREFERRED_BLOCK, PREFERRED_APT"; 
                $title = "<h4><strong><u>Showing results for all the blocks: </u></strong></h4>";
            }    else {
                $sql = "SELECT * FROM RESIDENT WHERE PREFERRED_BLOCK LIKE '%$block%' ORDER BY PREFERRED_BLOCK, PREFERRED_APT";
                $title = "<h4><strong><u>Showing results for the blocks: ".$block."</u></strong></h4>";
            }
            // echo $sql;
            $results = $conn->query($sql);
            // $noresults = mysqli_num_rows($results);
            if($results->num_rows == 0)
                $_SESSION['isfound'] = false;
            else
                $_SESSION['isfound'] = true;
            $_SESSION['ischeck'] = true;
            $_SESSION['isregister'] = "";
            $listing = "show";
        }
        else if($_POST['Toggler']=="manage")    {
            $managing = "show";
            $_SESSION['isregister'] = "";
            $sql = "SELECT * FROM RESIDENT ORDER BY PREFERRED_BLOCK, PREFERRED_APT";
            $results = $conn->query($sql);
            if($results->num_rows == 0)
                $_SESSION['isfound'] = false;
            else
                $_SESSION['isfound'] = true;
            $_SESSION['ismanage'] = true;
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>RESIDENT</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="#">Registrations<span class="sr-only">(current)</span></a>
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


    <div class="container-fluid" style="margin-top:20px;">
        <div class="accordion" id="accordionExample">
        <div class="card">
    
    </div>
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
                            Register a new Resident
                        </button>
                        <a class="btn btn-info" type="button" href="./formerresidents.php" style="float: right;">
                            Former Residents of this Complex
                        </a>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse <?php $register = $_SESSION['isregister']; echo $register; ?>" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <form method="post" action="custregd.php">
                            <!-- <div class="input-group mb-3">
        <div class="input-group-prepend" id="button-addon3">
        <button class="btn btn-outline-secondary" type="button">Button</button>
        <button class="btn btn-outline-secondary" type="button">Button</button>
        <button class="btn btn-outline-secondary" type="button">Button</button> -->

                            <label for="inputAddress2">Name</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend" id="button-addon3" data-toggle="buttons">
                                    <button class="btn btn-outline-secondary" type="button" autofocus="true" checked>
                                        <input type="radio" name="Title" value="Mr. " autofocus="true" checked hidden>Mr.
                                    </button>
                                    <button class="btn btn-outline-secondary" type="button">
                                        <input type="radio" name="Title" value="Mrs. " hidden>Mrs.
                                    </button>
                                    <button class="btn btn-outline-secondary" type="button">
                                        <input type="radio" name="Title" value="Ms. " hidden>Ms.
                                    </button>
                                </div>
                                <input type="text" class="form-control" name="Name" placeholder="Name" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Date of birth</label>
                                    <input type="date" name="DoB" class="form-control" id="inputEmail4" placeholder="DoB : dd-mm-YYYY" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Phone Number</label>
                                    <input type="number" name="Phone" class="form-control" id="inputPassword4" placeholder="Your personal contact number" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Email address</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" name="EmailId" placeholder="id@domain.com">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlSelect1">Block Number</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="Block">
                                        <option value="A-1">A1</option>
                                        <option value="A-2">A2</option>
                                        <option value="A-3">A3</option>
                                        <option value="B-1">B1</option>
                                        <option value="B-2">B2</option>
                                        <option value="B-3">B3</option>
                                        <option value="C-1">C1</option>
                                        <option value="C-2">C2</option>
                                        <option value="C-3">C3</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlSelect1">Apartment Number</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="AptNumber">
                                        <option value="001">001</option>
                                        <option value="002">002</option>
                                        <option value="003">003</option>
                                        <option value="101">101</option>
                                        <option value="102">102</option>
                                        <option value="103">103</option>
                                        <option value="201">201</option>
                                        <option value="202">202</option>
                                        <option value="203">203</option>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Previous Address</label>
                                <textarea class="form-control" name="Address" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Continue</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <form method="post" class="form-inline" id="Check_Res">
                            <div class="form-group align-items-center">
                                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseTwo">
                                    Resident List
                                </button>
                                <input type="hidden" name="Toggler" value="manage">
                                <button class="btn btn-primary mx-sm-5" onclick="document.getElementById('Check_Res').submit();" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Manage Residents
                                </button>
                            </div>
                        </form>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse <?php echo $listing; ?>" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <form method="post" class="form-inline">
                            <div class="form-group align-items-center">
                                <!-- <div class="col-auto"> -->
                                <label for="inlineFormInput">Block Name</label>
                                <select class="form-control mx-sm-3" id="inlineFormInput" name="QueryBlock" required>
                                    <option value="*" autofocus>All</option>
                                    <option value="A">All A blocks</option>
                                    <option value="A-1">A1</option>
                                    <option value="A-2">A2</option>
                                    <option value="A-3">A3</option>
                                    <option value="B">All B blocks</option>
                                    <option value="B-1">B1</option>
                                    <option value="B-2">B2</option>
                                    <option value="B-3">B3</option>
                                    <option value="C">All C blocks</option>
                                    <option value="C-1">C1</option>
                                    <option value="C-2">C2</option>
                                    <option value="C-3">C3</option>
                                </select>
                                <!-- </div> -->
                                <input type="hidden" id="custId" name="Toggler" value="listing">
                                <!-- <div class="col-auto"> -->
                                <button type="submit" class="btn btn-primary mx-sm-3">Show</button>
                                <!-- </div> -->
                            </div>
                        </form>
                        <?php 
                            error_reporting(E_ALL & ~E_NOTICE);
                            session_start();
                            if($_SESSION['ischeck'] == true && $_SESSION['isfound'] === false)
                                echo "<strong>The query returned 0 results. Please try something else.</strong>";
                            else if($_SESSION['ischeck'] === true && $_SESSION['isfound'] === true) {
                                echo $title."<br>";
                                echo "<table class=\"table table-striped\"><tr><th>BLOCK</th><th>APARTMENT</th><th>NAME</th><th>PHONE NUMBER</th><th>EMAIL ADDRESS</th><th>PREVIOUS ADDRESS</th></tr>";
                                while($row = $results->fetch_assoc())
                                echo "<tr><td>".$row['PREFERRED_BLOCK']."</td><td>".$row['PREFERRED_APT']."</td><td>".$row['TITLE']." ".$row['FULLNAME']."</td><td>".$row['PHONE_NO']."</td><td>".$row['EMAIL']."</td><td>".$row['PREV_ADDRESS']."</td></tr>";
                                echo "</table>";
                                $_SESSION['isfound'] = null;
                                $_SESSION['ischeck'] = null;
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="card">

                <div id="collapseThree" class="collapse <?php echo $managing; ?>" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        <?php
                            if($_SESSION['ismanage'] === true)   {
                                if($_SESSION['isfound'] === false)  {
                                    echo "<strong>No one lives in this complex anymore :(</strong>";
                                }
                                else if($_SESSION['isfound'] === true)  {
                                    echo "<table class=\"table table-striped\"><tr><th>BLOCK</th><th>APARTMENT</th><th>NAME</th><th>CONTACT NUMBER</th><th>MANAGEMENT</th></tr>";
                                    while($row = $results->fetch_assoc())   {
                                        echo "<tr><td>".$row['PREFERRED_BLOCK']."</td><td>".$row['PREFERRED_APT']."</td><td>".$row['FULLNAME']."</td><td>".$row['PHONE_NO']."</td>";
                                        echo "<td><a class=\"btn btn-warning\" style=\"margin-right:20px;\" href=\"../PHP/editresident.php?resid=".$row['RES_ID']."\">Edit details</a>";
                                        echo "<a class=\"btn btn-danger\" href=\"../PHP/ridresident.php?resid=".$row['RES_ID']."\">Wave goodbye</a></td>";
                                }
                            }
                            }
                        ?>
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
