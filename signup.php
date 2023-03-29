<?php include "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brief-16</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css?<?= time(); ?>">
</head>

<body>

    <main>

        <header class="fixed-top">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <img src="images/logo.png" class="d-inline-block align-top mx-3 logo" alt="logo">
                    <a class="navbar-brand text-white" href="index.php">IQRAE Library</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link text-white" aria-current="page" href="index.php">Home</a>
                            <a class="nav-link text-white" href="index.php">Contact</a>
                            <a class="nav-link text-white" href="aboutVisitor.php">About</a>
                            <a class="nav-link text-white explore" onclick="scrollDown()">Explore</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon text-white"></span>
                            </button>
                        </div>
                    </div>
                    <i class="fa-solid fa-user text-white p-2"></i>
                    <a href="signup.php" class="text-white text-decoration-none me-3">Sign up</a>
                    <i class="fa-sharp fa-solid fa-right-to-bracket text-white p-2"></i>
                    <a href="signin.php" class="text-white text-decoration-none me-3">Sign in</a>
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

            <div class="card mx-auto">

                <h3 class="text-center my-3 pt-2">Join now and start exploring!</h3>

                <form action="member.php?<?php  ?>" method="POST" class="row g-3 needs-validation px-5 mt-1" novalidate>


                    <div class="col-md-4">
                        <label for="fullName" class="form-label">Full name</label>
                        <input type="text" class="form-control" id="fullName" name="fullName" required>
                    </div>
                    <div class="col-md-4">
                        <label for="nickName" class="form-label">Nickname</label>
                        <input type="text" class="form-control" id="nickName" name="nickName" required>
                    </div>
                    <div class="col-md-4">
                        <label for="phoneNumber" class="form-label">Phone number</label>
                        <input type="number" class="form-control" id="phoneNumber" name="phoneNumber" aria-describedby="inputGroupPrepend" required>
                    </div>


                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-md-3">
                        <label for="occupation" class="form-label">Occupation</label>
                        <select class="form-select" id="occupation" name="occupation" required>
                            <option value="" disabled selected>Choose option</option>
                            <option value="Etudiant">Etudiant</option>
                            <option value="Fonctionnaire">Fonctionnaire</option>
                            <option value="Employe">Employe</option>
                            <option value="Femme au foyer">Femme au foyer</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="CINnumber" class="form-label">C.I.N</label>
                        <input type="text" class="form-control" id="CINnumber" name="laCarte" required>
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="col-md-6">
                        <label for="confirmPassword" class="form-label">Confirm password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>

                    <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="addressLocal" required>
                    </div>
                    <div class="col-md-6">
                        <label for="birthDate" class="form-label">Birth date</label>
                        <input type="date" class="form-control" id="birthDate" name="birthDate" required>
                    </div>


                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">By checking the box, I acknowledge that I have read and agree to the <a type="button" class="text-decoration-underline" data-bs-toggle="modal" data-bs-target="#exampleModal">rules</a>.</label>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Rules</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul>
                                        <li>A person cannot borrow or reserve more than three books at the same time.</li>
                                        <li>A borrowing operation must be preceded by a reservation.</li>
                                        <li>A torn item cannot be reserved or borrowed.</li>
                                        <li>A reservation is only made for a book actually available in the library and which is not subject to a current reservation.</li>
                                        <li>The validity of a reservation is limited to 24 hours.</li>
                                        <li>The loan period must not exceed 15 days.</li>
                                        <li>A person who submits a book after 15 days receives a penalty.</li>
                                        <li>A person who accumulates more than 3 penalties does not have the right to continue to borrow the books. And his account will be immediately locked.</li>
                                        <li>No operation will be possible without authentication, even a simple consultation.</li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary col-12" type="submit" name="submit">Submit</button>
                        <p class="text-decoration-none text-dark text-center mt-3">Already have an account? <a href="signin.php" class="link-primary text-decoration-underline pe-auto signinhere fw-bolder">Sign in</a>.</p>
                    </div>

                </form>

                <?php

                if (isset($_POST["submit"])) {

                    $Full_Name = $_POST["fullName"];
                    $Nickname = $_POST["nickName"];
                    $Password = $_POST["password"];
                    $address = $_POST["addressLocal"];
                    $Email = $_POST["email"];
                    $Phone = $_POST["phoneNumber"];
                    $LaCarte = $_POST["laCarte"];
                    $Occupation = $_POST["occupation"];
                    $Birth_date = $_POST["birthDate"];

                    $query = "INSERT INTO `members` (`id`, `Nickname`, `Full_Name`, `Password`, `Admin`, `Address`, `Email`, `Phone`, `CIN`, `Occupation`, `Penalty_Count`, `Birth_Date`, `Creation_Date`) VALUES (NULL, '$Nickname', '$Full_Name', '$Password', '0', '$address', '$Email', '$Phone', '$LaCarte', '$Occupation', '0', '$Birth_date', Now())";

                    $statement = $conn->prepare($query);
                    $statement->execute();

                    $email = $_POST["email"];
                    $password = $_POST["password"];

                    $statement = $conn->prepare("SELECT * FROM `members` WHERE '$email' LIKE `Email` AND '$password' LIKE `Password`");
                    $statement->execute();
                    $rowCount = $statement->rowCount();
                }

                ?>

            </div>
        </div>



    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/165265fe22.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="script.js"></script>

</body>

</html>