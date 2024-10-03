<?php
include 'includes/nav.php';
include 'includes/dbconnect.php';
// session_start();

$id = $_GET['product'];

if (filter_var($id, FILTER_VALIDATE_INT) === FALSE) {
  die("No valid ID");
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MyCart - product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <style>
    .pimg {
      height: 450px;
      width: 400px;
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

    .flpimg {
      height: 300px;
    }

    .pbtn {
      width: 300px;
      height: 50px;
      color: black;
      font-size: 25px;
      font-weight: bold;
    }

    .pdetails {
      height: 900px;
    }

    .tag {
      color: red;
    }
  </style>
</head>

<body>
  <!-----main product section---->
  <div class="container text-center my-5 mx-15">
    <div class="row">
      <?php
      include 'includes/dbconnect.php';
      $query = mysqli_query($conn, "SELECT * FROM products WHERE pid='$id'");

      if ($row = mysqli_fetch_array($query)) {
        $name = $row['pname'];
        $price = $row['pprice'];
        $info = $row['pdesc'];
        $img = $row['pimg'];
        $subcat = $row['psubcat'];

        $_SESSION['pprice'] = $price;
      } else {
        echo ("error");
      }
      ?>
      <div class="col">
        <div class="my-2 mx-5" style="width: 18rem;">
          <a href="product.php?product=<?php echo ($row['pid']); ?>" class="text">
            <!-- Fix the image path here -->
            <img src="<?php echo $img; ?>" class="card-img-top pimg" alt="Product Image">
          </a>
          <div class="container text-center my-2">
            <div class="row">
              <div class="col">
                <a href="buynow.php?product=<?php echo ($id); ?>" class="btn btn-warning pbtn my-2 mx-0">BUY NOW</a>
              </div>
              <div class="col">
                <a href="cart.php?id=<?php echo ($id); ?>" class="btn btn-warning pbtn my-2 mx-0">ADD TO CART</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col pdetails">
        <div class="my-3">
          <h3><?php echo htmlspecialchars($name); ?></h3>
          <h2 class="text">₹<?php echo htmlspecialchars($price); ?></h2>
          <h2 class="distag">30% off</h2>
          <h2><i class="tag">Free delivery</i></h2>
          <h5 class="text"><?php echo htmlspecialchars($info); ?></h5>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <?php
      $query = mysqli_query($conn, "SELECT * FROM products WHERE psubcat ='$subcat'");

      while ($row = mysqli_fetch_array($query)) {
        $name = $row['pname'];
        $price = $row['pprice'];
        $info = $row['pdesc'];
        $img = $row['pimg'];
        $pid = $row['pid'];
      ?>
        <div class="col">
          <div class="card my-2 mx-2" id="<?php echo htmlspecialchars($pid) ?>" style="width: 18rem;">
            <a href="product.php?product=<?php echo htmlspecialchars($row['pid']); ?>" class="text">
              <img src="<?php echo $img; ?>" class="card-img-top pimg" alt="Product Image">
              <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($name); ?></h5>
                <p class="card-text">₹<?php echo htmlspecialchars($price); ?>
                <p class="distag">30% off</p><i>Free delivery</i></p>
                <a href="#" class="btn btn-warning">❤️WISHLIST</a>
              </div>
            </a>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>

<?php
include 'includes/footer.php';
?>