<?php include "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brief-16</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css?<?= time(); ?>">
</head>

<body>

    <header class="fixed-top">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <img src="images/logo.png" class="d-inline-block align-top mx-3 logo" alt="logo">
                <a class="navbar-brand text-white" href="index.php">Solibrary</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link text-white" aria-current="page" href="member.php?id=<?php $_GET["id"] ?>">Home</a>
                        <a class="nav-link text-white" href="index.php">Contact</a>
                        <a class="nav-link text-white" href="aboutVisitor.php">About</a>
                        <a class="nav-link text-white explore" onclick="scrollDown()">Explore</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon text-white"></span>
                        </button>
                    </div>
                </div>

                <!-- Profile dropdown -->

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle bg-transparent border-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php

                        $id = $_GET['id'];

                        $statement = $conn->prepare("SELECT * FROM `members` WHERE id = $id");
                        $statement->execute();
                        $memberDetails = $statement->fetch();

                        echo $memberDetails['Nickname'];

                        ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="memberProfile.php?id=<?php echo $id; ?>">Profile</a></li>
                        <li><a class="dropdown-item" href="myReservations.php?id=<?php echo $id; ?>">My Reservations</a></li>
                        <li><a class="dropdown-item" href="index.php">Log out</a></li>
                    </ul>
                </div>

            </div>
        </nav>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Explore</a>
                </li>
            </ul>
        </div>
    </header>

    <div id="backgroundImg" class="d-flex align-items-center">
        <div class="container text-center">
            <h1 class="text-white">Welcome to our media library! We're a community of book lovers who believe in the power of reading and sharing knowledge. Our library offers a wide selection of books, magazines, and other media that you can borrow and enjoy.</h1>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/165265fe22.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>