<?php

include "connection.php";
$id = $_GET['id'];

?>

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

    <main>

        <!-- ::::::::::::::::::::::::::::::::::: Header (navbar, h1, button, arrow, 100vh) ::::::::::::::::::::::::::::::::::: -->

        <header class="fixed-top">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <img src="images/logo.png" class="d-inline-block align-top mx-3 logo" alt="logo">
                    <a class="navbar-brand text-white">Solibrary</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link text-white" aria-current="page" href="member.php?id=<?php echo $id; ?>">Home</a>
                            <a class="nav-link text-white" href="member.php?id=<?php $_GET["id"] ?>">Contact</a>
                            <a class="nav-link text-white" href="aboutMembers.php">About</a>
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

                            $statement = $conn->prepare("SELECT * FROM `members` WHERE id = $id");
                            $statement->execute();
                            $memberDetails = $statement->fetch();

                            echo $memberDetails['Nickname'];

                            ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
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
            <div class="container">
                <div class="row">
                    <div class="col-5">
                        <h1 class="text-white text-wrap mb-4" onclick="testiWsf()">Discover your favorite books, magazines, novels and more with us!</h1>
                        <a href="signup.php" class="btn btn-warning btn-lg rounded-pill p-2"><span class="p-4 headerSUbtn">Sign up for free!</span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="down-arrow" onclick="scrollDown()"></div>

        <!-- ::::::::::::::::::::::::::::::::::: Cards container (Search, Cards, Pagination) ::::::::::::::::::::::::::::::::::: -->

        <div class="container px-5">
            <form method="POST" class="row g-3 needs-validation px-5 mt-1">

            <h3>Update your information</h3>

                <div class="col-md-4">
                    <label for="fullName" class="form-label">Full name</label>
                    <input type="text" class="form-control" placeholder="Current one: <?php echo $memberDetails['Full_Name']; ?>" id="fullName" name="fullName">
                </div>
                <div class="col-md-4">
                    <label for="nickName" class="form-label">Nickname</label>
                    <input type="text" class="form-control" placeholder="Current one: <?php echo $memberDetails['Nickname']; ?>" id="nickName" name="nickName">
                </div>
                <div class="col-md-4">
                    <label for="phoneNumber" class="form-label">Phone number</label>
                    <input type="number" class="form-control" placeholder="Current one: <?php echo $memberDetails['Phone']; ?>" id="phoneNumber" name="phoneNumber" aria-describedby="inputGroupPrepend">
                </div>

                <div class="col-md-3">
                    <label for="occupation" class="form-label">Occupation</label>
                    <select class="form-select" id="occupation" name="occupation">
                        <option value="" disabled selected>Choose option</option>
                        <option value="Etudiant">Etudiant</option>
                        <option value="Fonctionnaire">Fonctionnaire</option>
                        <option value="Employe">Employe</option>
                        <option value="Femme au foyer">Femme au foyer</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="CINnumber" class="form-label">C.I.N</label>
                    <input type="text" class="form-control"placeholder="Current one: <?php echo $memberDetails['CIN']; ?>"  id="CINnumber" name="laCarte">
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Current one: <?php echo $memberDetails['Password']; ?>" id="password" name="password">
                </div>

                <div class="col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" placeholder="Current one: <?php echo $memberDetails['Address']; ?>" id="address" name="addressLocal">
                </div>
                <div class="col-md-6">
                    <label for="birthDate" class="form-label">Birth date</label>
                    <input type="date" class="form-control" id="birthDate" name="birthDate">
                </div>

                <div class="col-12">
                    <button class="btn btn-primary col-12 mb-3" type="submit" name="saveChanges">Save Changes</button>
                </div>

            </form>
        </div>

        <?php

            if (isset($_POST["saveChanges"])) {

                $Full_Name = $_POST["fullName"];
                $Nickname = $_POST["nickName"];
                $Password = $_POST["password"];
                $address = $_POST["addressLocal"];
                $Phone = $_POST["phoneNumber"];
                $LaCarte = $_POST["laCarte"];
                $Birth_date = $_POST["birthDate"];

                $sqlQuery = "UPDATE `members` SET `Full_Name` = COALESCE('$Full_Name', `Full_Name`), `Nickname` = COALESCE('$Nickname', `Nickname`), `Password` = COALESCE('$Password', `Password`), `Address` = COALESCE('$address', `Address`), `Phone` = COALESCE('$Phone', `Phone`), `CIN` = COALESCE('$LaCarte', `CIN`), `Birth_date` = COALESCE('$Birth_date', `Birth_date`) WHERE id = $id";

                $statement = $conn->prepare($sqlQuery);
                $statement->execute();

            }

        ?>

        <!-- ::::::::::::::::::::::::::::::::::: Footer (Copyright, social media icons) ::::::::::::::::::::::::::::::::::: -->

        <?php include "footer.php" ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/165265fe22.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>

</body>

</html>