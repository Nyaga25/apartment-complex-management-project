<!DOCTYPE html>
<html>

<head>
    <link href="../Assets/CSS/bootstrap.css" rel="stylesheet">
    <title>OH HI RESIDENT</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="../index.php">Resident</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./customercomplaints.php">Complaints</a>
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
    <p></p>
    <div class="container-fluid">
        <h2>
            Welcome, Resident
            <small class="text-muted">Check out our latest projects, file a complaint or register your guest here</small>
        </h2>
    </div>
    <div class="container-fluid">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="../Assets/IMAGES/Solar%20rooftop.jpg" alt="First slide" height="700px">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Solar Power</h5>
                        <p>The recently finished project has given solar power to <strong>all</strong> houses in the Complex</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="../Assets/IMAGES/Pure%20Water%20ok.jpg" alt="Second slide" height="700px">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Purified Water</h5>
                        <p>Purified Water Project is on the verge of completion. It brings purified water to <strong>all</strong> apartments</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="../Assets/IMAGES/Greenhouse.jpg" alt="Third slide" height="700px">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Greenhouse</h5>
                        <p>Upcoming Project[2019] which will bring a greenhouse right next to your balconies</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

</body>

</html>
