<!DOCTYPE html>
<html>

<head>
    <link href="../Assets/CSS/bootstrap.css" rel="stylesheet">
    <title>REGISTER YOUR GUEST</title>
</head>
<style>
    img {
        width: 700px;
    }
    </style>

<body>

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="../index.php">Guest</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="./user.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./customercomplaints.php">Complaints</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Guest Entry<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a class="btn btn-primary my-2 my-sm-0" href="adminlogin.php">I'm an Admin</a>
            </form>
        </div>
    </nav>

    <div class="container-fluid" style="margin-top:20px;">
        <form method="post" action="guestdone.php">
            <!-- <div class="input-group mb-3">
        <div class="input-group-prepend" id="button-addon3">
        <button class="btn btn-outline-secondary" type="button">Button</button>
        <button class="btn btn-outline-secondary" type="button">Button</button>
        <button class="btn btn-outline-secondary" type="button">Button</button> -->

            <label for="inputAddress2">Name</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend" id="button-addon3" data-toggle="buttons">
                    <button class="btn btn-outline-secondary" type="button">
                        <input type="radio" name="Title" value="Mr. " autofocus="true" checked hidden>Mr.
                    </button>
                    <button class="btn btn-outline-secondary" type="button">
                        <input type="radio" name="Title" value="Mrs. " hidden>Mrs.
                    </button>
                    <button class="btn btn-outline-secondary" type="button">
                        <input type="radio" name="Title" value="Ms. " hidden>Ms.
                    </button>
                </div>
                <input type="text" class="form-control" name="Name" placeholder="Your Name" aria-describedby="button-addon3">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Apartment Block</label>
                    <input type="text" name="Block" class="form-control" id="inputEmail4" placeholder="Name of the block. [A-1 to C-3]" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Apartment Number</label>
                    <input type="text" name="Number" class="form-control" id="inputPassword4" placeholder="3-digit Apartment Number. [001 to 203]" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Reason for Visit</label>
                    <input type="text" name="Reason" class="form-control" id="inputEmail4" placeholder="Please be precise and clear" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Phone Number</label>
                    <input type="number" name="Phone" class="form-control" id="inputPassword4" placeholder="Your personal contact number" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Enter</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

</body>

</html>