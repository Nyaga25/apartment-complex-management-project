<?php
    $conn = new mysqli('localhost', 'root', '', 'apartments');
    if($conn->connect_errno > 0)    {
        ?>
        <script>alert("Database connection could not be made :(");</script>
        <?php
    }