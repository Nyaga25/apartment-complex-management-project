//Deprecated file. Unused in project.

<?php

error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once('authenticate.php');
$uname = $_SESSION["username"];
?>

<!DOCTYPE html>
<html>

<head>
    <link href="../Assets/CSS/bootstrap.css" rel="stylesheet">
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
                <li class="nav-item">
                    <a class="nav-link" href="./complaints.php?user=<?php echo $uname; ?>">Complaints</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Plans &#43; Projects<span class="sr-only">(current)</span></a>
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


</body>

</html>
