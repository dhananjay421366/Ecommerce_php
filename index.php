<?php
include 'includes/nav.php';
include 'includes/dbconnect.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyCart - The Shopping Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <style>
        .pimg {
            height: 280px;
            width: 300px;
        }

        .pimgfurniture {
            height: 280px;
            width: 287px;
        }

        .text {
            text-decoration: none;
            color: black;
        }

        .distag {
            color: green;
            font-weight: bolder;
            font-size: large;
        }

        .cardbody {
            background-color: pink;
            border-radius: 0px;
        }

        .crd1 {
            height: 500px;
            border-radius: 30px;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/banner/banner-1.jpg" style="height: 550px" class="d-block w-100 des" alt="banner" />
            </div>
            <div class="carousel-item">
                <img src="images/banner/banner-2.jpg" style="height: 550px" class="d-block w-100 des" alt="banner" />
            </div>
            <div class="carousel-item">
                <img src="images/banner/banner-3.jpg" style="height: 550px" class="d-block w-100 des" alt="banner" />
            </div>
            <div class="carousel-item">
                <img src="images/banner/banner-4.jpg" style="height: 550px" class="d-block w-100 des" alt="banner" />
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container my-5">
    <h1>Products</h1>
    <div class="row">
        <?php
        include 'includes/dbconnect.php';

        $query = mysqli_query($conn, "SELECT * FROM products");
        while ($row = mysqli_fetch_array($query)) {
            $name = $row['pname'];
            $price = $row['pprice'];
            $img = $row['pimg'];
            $pid = $row['pid'];
        ?>
            <div class="col-md-4 my-3">
                <div class="card crd1" id="<?php echo $pid; ?>" style="width: 18rem;">
                    <a href="product.php?product=<?php echo $pid; ?>" class="text">
                        <img src="<?php echo $img; ?>" class="card-img-top pimg" alt="Product Image">
                        <div class="card-body cardbody">
                            <h5 class="card-title"><?php echo $name; ?></h5>
                            <h3 class="card-text">₹<?php echo $price; ?></h3>
                            <p class="distag">30% off</p>
                            <i>Free delivery</i><br>
                            <a href="#" class="btn btn-warning">❤️</a>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>
<?php
include 'includes/footer.php';
?>
