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
    <link rel="stylesheet" type="text/css" href="style.css?<?=time();?>">
</head>

<body>

    <main>

        <?php

        include "header.php";

        $id = $_GET['id'];

        $statement = $conn->prepare("SELECT * FROM `item` WHERE Item_Code = $id");
        $statement->execute();
        $items = $statement->fetchAll();

        foreach ($items as $item) { // "SELECT items.*, categories.name FROM items JOIN categories ON items.category_code = categories.code"

        ?>

            <div class="card mx-auto my-5">
                <div class="row">
                    <div class="col-md-4 images-container">
                        <img src="<?php echo $item['Cover_Image']; ?>" class="img-fluid rounded-start" alt="Card image">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body text-start">
                            <h5 class="card-title"><span class="fw-bold" style="max-width: 600px;">Title:</span> <?php echo $item['Title']; ?></h5>
                            <p class="card-text">
                                <span class="fw-bold">Status:</span> <?php echo $item['Status']; ?><br>
                                <span class="fw-bold">Author:</span> <?php echo $item['Author_Name']; ?><br>
                                <span class="fw-bold">State:</span> <?php echo $item['State']; ?><br>
                                <span class="fw-bold">Edition Date:</span> <?php echo $item['Edition_Date']; ?><br>
                                <span class="fw-bold">Purchase Date:</span> <?php echo $item['Purchase_Date']; ?><br>
                                <span class="fw-bold">Category Code:</span> <?php 
                                    $categoryId = $item['Category_Code'];
                                    $statement = $conn->prepare("SELECT * FROM `category` WHERE `Category_Code` = $categoryId");
                                    $statement->execute();
                                    $category = $statement->fetch();
                                    echo $category['Category_Name'];
                                ?><br>
                            </p>
                            <button class="btn btn-primary border rounded-pill px-5">Reserve</button>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        };
        include "footer.php";
        ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/165265fe22.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>