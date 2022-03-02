<?php
    include("../Assets/dbconnect.php");
    
    $resid = $_GET['resid'];
    
    $sql = "SELECT TITLE, FULLNAME FROM RESIDENT WHERE RES_ID = '$resid'";

    $results = $conn->query($sql);

    $row = $results->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="../Assets/CSS/bootstrap.css">
    <meta charset="UTF-8">
    <title>RESIDENT EXIT: REVELATIONS</title>
</head>
<body>
    <div class="container" style="margin-top:20px;">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Resident Exit : </h1>
                <p class="lead">This will handle the exit of <?php echo $row['TITLE'].$row['FULLNAME']; ?></p>
            </div>
        </div>
    <form method="POST" action="bestwishes.php?resid=<?php echo $resid;?>">
        <div class="form-group">
            <label for="exampleInputEmail1">Constructive feedback(optional)</label>
            <textarea class="form-control" name="Feedback"></textarea>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" name="Iscomms" class="form-check-input" value="On" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Do you want to recieve occasional communication from us?(Eg: Event invites, Major Accomplishments, etc.)</label>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Submit</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bid us goodbye? 😞</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to go ahead?<br>
                        <span style="color:#ffcc00;">This action cannot be undone</span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button style="margin-left:30px;" type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>
</body>
</html>