<?php
$showAlert = false;
$sql = false;
include 'includes/dbconnect.php';
include 'includes/nav.php';
//session_start();
error_reporting(E_ALL ^ E_NOTICE);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyCart-Signup</title>
    <style>
        .container {
            align-items: center;
        }

        .inp {
            width: 1000px;
        }

        .cont {
            background-color: pink;
        }

        .offerimg {
            height: 500px;
            width: 550px;
            margin-right: 255px;
        }

        .cold {}
    </style>

</head>

<body>

    <div class="container cont my-5 text-left">

        <div class="container text-left">
            <div class="row">
                <h1 class="">Signup And start Shopping</h1>
                <div class="col-6 cold">
                    <form action="signup.php" method="POST">

                        <div class="form-group col-md-6">
                            <label for="Username">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="" name="username" required>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Username">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="" name="email" required>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Username">City</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="" name="city" required>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Username">Subdistrict</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="" name="subdistrict" required>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Username">District</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="" name="district" required>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Username">State</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="" name="state" required>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Username">ZipCode</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="" name="zipcode" required>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Username">Phone</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="" name="phone" required>
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="Username">Alternate Phone</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="" name="alphone" required>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Username">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="" name="password" required>
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="Username">Confirm Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="" name="cpassword" required>
                            </div>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary my-2">Submit</button>
                        <b>Already Signup <a href="http://localhost/ecommerce/login.php">LogIn </a>Here !</b>
                    </form>
                </div>
                <div class="col-4 cold">
                    <h4>
                        If you have already registered with <b>mycart</b>- The shopping site Login now 👇
                    </h4>
                    <a href="http://localhost/ecommerce/login.php" class="btn btn-primary">LOGIN</a>
                    <div class="container offercontainer">
                        <img src="images/product/megasale.img.png" class="offerimg" alt="offer">
                    </div>

                </div>
            </div>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $state = $_POST["state"];
            $district = $_POST["district"];
            $subdistrict = $_POST["subdistrict"];
            $city = $_POST["city"];
            $zipcode = $_POST["zipcode"];
            $phone = $_POST["phone"];
            $alphone = $_POST["alphone"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $cpassword = $_POST["cpassword"];

            $exists = false;

            // Check if email already exists
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

            if (mysqli_num_rows($sql) > 0) {
                $exists = true; // Email exists
            }

            // Check if user already exists
            if ($exists) {
        ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Email Already exists in database..</strong> Try another email...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php
            } else if ($password == $cpassword) {
                // Insert new user
                $sql = "INSERT INTO `users` (`username`, `state`, `district`, `subdistrict`, `city`, `zipcode`, `phone`, `alphone`, `email`, `password`, `dt`) 
                VALUES ('$username', '$state', '$district', '$subdistrict', '$city', '$zipcode', '$phone', '$alphone', '$email', '$password', current_timestamp())";

                $result = mysqli_query($conn, $sql);

                if ($result) { // Check if insert was successful
                    echo '<script type="text/javascript">window.location.href = "login.php";</script>';
                } else {
                    echo "Error: " . mysqli_error($conn); // Display error if insert fails
                }
            } else {
                echo $showEroor = "Passwords do not match.";
            }
        }
        ?>





    </div>

</body>

</html>

<?php
include 'includes/footer.php';
?>