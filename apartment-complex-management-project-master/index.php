<?php 
    session_start();
    error_reporting(E_ALL & ~E_NOTICE);
    include("./Assets/dbconnect.php");
    //$conn = new mysqli("localhost","root","admin","apartments");
    if($_SERVER['REQUEST_METHOD'] == 'POST')    {
        $querybhk = $_POST['bhks'];
        $_SESSION['querybhk'] = $querybhk;
        $sql = "SELECT * FROM APARTMENT_DETAILS WHERE (BLOCK, APT_NUM) NOT IN(SELECT PREFERRED_BLOCK, PREFERRED_APT FROM RESIDENT) AND BHK = '$querybhk'";
        $result = $conn->query($sql);
        if($conn->error)
            die();
        $showresults = "true";
        $resultcount = $result->num_rows;
        // echo $resultcount;
        // while($row = $result->fetch_assoc())
        //     print_r($row);
    }
?>


<!DOCTYPE html>

<head>
    <link href="Assets/CSS/bootstrap.css" rel="stylesheet">
    <link href="Assets/CSS/animate.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>RESIDENTIAL COMPLEX MANAGEMENT</title>
</head>
<style>
    body {
        background-image: url(./Assets/IMAGES/Img%20For%20Index.jpg);
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
</style>
<html>

<body>
    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand mb-0 h1">APARTMENT COMPLEX MANAGEMENT SYSTEM</span>
    </nav>
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-sm-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">I am an Administrator</h5>
                        <p class="card-text">Manage resident DBs, handle complaints, and view & manage Goats here...</p>
                        <a class="btn btn-success" href="./PHP/admin.php">Continue as Administrator</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">I live here</h5>
                        <p class="card-text">You are the person with most power. Lodge complaints wrt literally
                            anything, or register your guests here....</p>
                        <a class="btn btn-success" href="./PHP/user.php">Continue as Resident/Guest</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Enquiry</h5>
                        <p class="card-text">Fancy an apartment in our Complex? Decide your BHK Specification and shortlist your dream house!</p>
                        <p class="card-text"><form method="post">
                            <div class="form-group">
                                <label>BHK Specification</label>
                                <select class="form-control" name="bhks">
                                    <option value="2">2 BHK</option>
                                    <option value="3">3 BHK</option>
                                    <option value="4">4 BHK</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Get a Step Closer to My Dream House</button>
                        </form>
                        </p>
                        <?php
                            if($showresults == "true")  {

                                ?>
                                <p class="card-text">Showing results for <?php echo $_SESSION['querybhk'];?> BHK specification</p>
                                <p class="card-text">Query returned <?php echo $resultcount;?> vacant flats with your desired specification</p>
                                
                                <p class="card-text">
                                    <table class="table table-dark">
                                        <tr><th>BLOCK</th><th>APARTMENT NUMBER</th><th>BHK SPECIFICATION</th><th>FLOOR</th></tr>
                                        <?php
                                            while($row = $result->fetch_assoc())    {
                                                $digit = intdiv($row['APT_NUM'], 100);
                                                $digit = $digit == 0 ? "G" : $digit;
                                                echo "<tr><td>".$row['BLOCK']."</td><td>".$row['APT_NUM']."</td><td>".$row['BHK']."</td><td>".$digit."</td></tr>";
                                            }
                                        ?>
                                    </table>
                                </p>
                                <p class="card-text">Contact the Complex office now to book your flat!</p>
                                
                                <?php
                                session_destroy();
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