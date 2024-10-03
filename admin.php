<?php
include 'includes/dbconnect.php';
?>
<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin-mycart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">mycart-Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Logout</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-warning" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h4>Add Product</h4>
        <!-- Add enctype attribute for file upload -->
        <form action="/php/Ecommerce_php/admin.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInput" class="form-label">Product name</label>
                <input type="text" class="form-control" name="pname" id="" aria-describedby="emailHelp" required>
            </div>

            <div class="mb-3">
                <label for="exampleInput" class="form-label">Product price</label>
                <input type="number" name="pprice" class="form-control" id="" required>
            </div>

            <div class="mb-3">
                <label for="exampleInput" class="form-label">Product information</label>
                <input type="text" class="form-control" name="pdesc" id="" aria-describedby="emailHelp" required>
            </div>

            <div class="mb-3">
                <label for="number" class="form-label">Product image</label>
                <input type="file" accept="image/jpeg, image/png, image/jpg" name="pimg" class="form-control" id="" required>
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">Product category</label>
                <p><b>Categories:</b> Electronics, Fashion, Furniture, Grocery</p>
                <input type="text" class="form-control" name="pcat" id="" aria-describedby="emailHelp" required>
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">Product subcategory</label>
                <p><b>Subcategories:</b> Laptop, Mens, Womens, Home, Watch</p>
                <input type="text" class="form-control" name="psubcat" id="" aria-describedby="emailHelp" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>

<?php
include 'includes/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["pname"];
    $price = $_POST["pprice"];
    $info = $_POST["pdesc"];
    $cate = $_POST["pcat"];
    $subcate = $_POST["psubcat"];

    // Handling the uploaded image file
    $image = $_FILES["pimg"]["name"]; // File name
    $tempname = $_FILES["pimg"]["tmp_name"]; // Temporary file location

    // Set the destination folder path
    $folder = "images/product/";

    // Create the folder if it doesn't exist
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    // Set the target file path
    $target_file = $folder . basename($image);

    // Move the uploaded image file to the server folder
    if (move_uploaded_file($tempname, $target_file)) {
        // Save the product information to the database
        $sql = "INSERT INTO `products` (`pname`, `pprice`, `pdesc`, `pimg`, `pcat`, `psubcat`) VALUES ('$name', '$price', '$info', '$target_file', '$cate', '$subcate')";
        
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<div class='alert alert-success'>Product added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Failed to add product!</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Failed to upload image!</div>";
    }
}
?>

<?php
include 'includes/footer.php';
?>
