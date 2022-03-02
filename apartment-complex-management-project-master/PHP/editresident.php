<?php
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
    require_once('authenticate.php');

    $resid = $_GET['resid'];
    // echo $resid;
    $mraf = $mrsaf = $msaf = "";

    include("../Assets/dbconnect.php");
    $sql = "SELECT * FROM RESIDENT WHERE RES_ID = '$resid'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    // print_r($row);
    $title = $row['TITLE'];
    // echo "|".$title."|";
    if($title == "Mr. ") {
        // echo "yes";
        $mraf = "autofocus = \"true\" checked";
    } else if($title == "Mrs. ")
        $mrsaf = "autofocus = \"true\" checked";
    else if($title == "Ms. ")
        $msaf = "autofocus = \"true\" checked";
    $msg = "Nyet";
    $shiftmsg = "Nyet";
    // echo $_POST['Toggler'];

    if($_SERVER['REQUEST_METHOD'] == 'POST')   {
        if($_POST['Toggler'] == "Details")  {
        $title = $_POST['Title'];
        $fname = $_POST['Name'];
        // $lname = $_POST['Lname'];
        $lname = explode(" ",$fname);
        $lname = $lname[count($lname)-1];
        $dob = $_POST['DoB'];
        $phone = $_POST['Phone'];
        $email = $_POST['EmailId'];
        // $block = $_POST['Block'];
        // $aptnum = $_POST['AptNumber'];
        $prevadd = $_POST['Address'];

        // echo $title.$fname.$lname.$dob.$phone.$email.$block.$aptnum.$prevadd;

        $sql = "UPDATE RESIDENT SET TITLE='$title', FULLNAME='$fname', LNAME='$lname', DOB='$dob', PHONE_NO=$phone, EMAIL='$email', PREV_ADDRESS='$prevadd' WHERE RES_ID = '$resid'";
        $conn->query($sql);

        $sql = "SELECT * FROM RESIDENT WHERE RES_ID = '$resid'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $msg = "The changes have been carried out. <a href=\"./registercustomer.php\">Click here</a> to go back.";
    }
    else if($_POST['Toggler'] == "Shift")   {
        $block = $_POST['Block'];
        $aptnum = $_POST['AptNum'];
        $sql = "CALL check_insert('$block','$aptnum',@result)";
        $conn->query($sql);

        $res = $conn->query('SELECT @result');
        $resaa = $res->fetch_assoc();
        $isallowed = $resaa['@result'];
        if($isallowed == -1)
            $shiftmsg = "<p><span style=\"color: red; margin-bottom:5px;\">Shifting not possible. Apartment of desire already occupied.</span></p>";
        else if($isallowed == 1)    {
            $sql = "UPDATE RESIDENT SET PREFERRED_BLOCK = '$block', PREFERRED_APT = '$aptnum' WHERE RES_ID = '$resid'";
            $conn->query($sql);
            $shiftmsg =  "<p><span style=\"color: green; margin-bottom:5px;\">".$title.$row["LNAME"]." succesfully shifted to ".$block." ".$aptnum."</span></p>";
            $sql = "SELECT * FROM RESIDENT WHERE RES_ID = '$resid'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        }
    }

    }


?>


<!DOCTYPE html>
<html>

<head>
    <link href="../Assets/CSS/bootstrap.css" rel="stylesheet">
    <title>RESIDENT MANAGEMENT</title>
</head>

<body>
<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">Resident Details Edit/Apartment Shifting</span>
</nav>
    <div class="container" style="padding-top:50px;">
        <form method="post">
            <label for="inputAddress2">Name</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend" id="button-addon3" data-toggle="buttons">
                    <button class="btn btn-outline-secondary" type="button" <?php echo $mraf;?>>
                        <input type="radio" name="Title" value="Mr. " <?php echo $mraf;?>>Mr.
                    </button>
                    <button class="btn btn-outline-secondary" type="button" <?php echo $mrsaf;?>>
                        <input type="radio" name="Title" value="Mrs. " <?php echo $mrsaf;?>>Mrs.
                    </button>
                    <button class="btn btn-outline-secondary" type="button" <?php echo $msaf;?>>
                        <input type="radio" name="Title" value="Ms. " <?php echo $msaf;?>>Ms.
                    </button>
                </div>
                <input type="text" class="form-control" name="Name" placeholder="Name" value="<?php echo $row['FULLNAME'] ?>" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Date of birth</label>
                    <input type="date" name="DoB" class="form-control" id="inputEmail4" placeholder="DoB : dd-mm-YYYY" value="<?php echo $row['DOB'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Phone Number</label>
                    <input type="number" name="Phone" class="form-control" id="inputPassword4" placeholder="Your personal contact number" value="<?php echo $row['PHONE_NO'] ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" name="EmailId" placeholder="id@domain.com" value="<?php echo $row['EMAIL'] ?>">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect1">Block Number</label>
                    <input type="text" class="form-control" name="Block" value="<?php echo $row['PREFERRED_BLOCK'] ?>" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect1">Apartment Number</label>
                    <input type="text" class="form-control" name="AptNumber" value="<?php echo $row['PREFERRED_APT'] ?>" disabled>
                </div>

            </div>
            <p><span style="color:red;">You can't change resident's apartment from here to avoid integrity issue. </span><a href="#" data-toggle="modal" data-target="#exampleModal">Click here</a><span style="color:red;"> to carry out shifting of resident. Ensure you have saved your changes here.</span></p>
            <?php 
            if($shiftmsg != "Nyet")  
                echo $shiftmsg;
            ?>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Previous Address</label>
                <input type="text" class="form-control" name="Address" id="exampleFormControlTextarea1" rows="3" value="<?php echo $row['PREV_ADDRESS'] ?>">
            </div>
            <input type="hidden" name="Toggler" value="Details">

            <button type="submit" class="btn btn-success">Continue</button>
            <a class="btn btn-warning" style="float: right;" href="./registercustomer.php">Cancel</a>
        </form>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Resident Shifting</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <p>Input the apartment the resident wishes to shift to. Note that it may/may not be available.</p>
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
                                    <select class="form-control" id="exampleFormControlSelect1" name="AptNum">
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
                            <input type="hidden" name="Toggler" value="Shift">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" style="margin-left:30px;" class="btn btn-primary">Do It!</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <?php 
            if($msg != "Nyet")  
            echo $msg;
        ?>

    </div>




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

    </script>
</body>

</html>
