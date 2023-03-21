<?php
ob_start();
include "connection.php";
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
                <div class="card-body p-4 px-5 my-5">
                    <h3 class="mb-4 text-center">Nice to see you again!</h3>

                    <form method="POST" class="row g-3 needs-validation px-4 mt-2" novalidate>

                        <div class="col-12">
                            <div class="form-outline">
                                <label class="form-label" for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control" required>
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary mt-3 col-12" type="submit" name="submit">Submit</button>
                            <p class="text-decoration-none text-dark text-center mt-3">Don't have an account yet? <a href="signup.php" class="link-primary text-decoration-underline signinhere fw-bolder">Sign up</a>.</p>
                        </div>

                    </form>

                    <?php


                    if (isset($_POST["submit"])) {

                        $email = $_POST["email"];
                        $password = $_POST["password"];

                        $statement = $conn->prepare("SELECT * FROM `members` WHERE '$email' LIKE `Email` AND '$password' LIKE `Password`");
                        $statement->execute();
                        $rowCount = $statement->rowCount();

                        if ($rowCount > 0) {

                            $result = $statement->fetch();

                            if ($result["Admin"] == 1) {
                                header("Location: admin.php?".'id='.$result["id"]);
                            } else {
                                header("Location: member.php?".'id='.$result["id"]);
                            }

                            ob_end_flush();
                            exit();

                        } else {
                            echo '<p class="text-center link-danger fw-bolder h4 text-decoration-underline">Access denied due to incorrect login details.</p>';
                        }
                    };

                    ?>

                </div>
            </div>

        </div>



    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/165265fe22.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="script.js"></script>

</body>

</html>