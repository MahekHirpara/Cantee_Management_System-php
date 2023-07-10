<?php
include "conn.php";

$error = "";
session_start();

if (isset($_POST['email']) && isset($_POST['pass'])) {
    $uname = $_POST['email'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM `admin_login` WHERE Email='$uname' AND password='$pass'";
    $res = mysqli_query($con, $sql);
    if (mysqli_num_rows($res) === 1) {
        $row = mysqli_fetch_assoc($res);
        if ($row['Email'] === $uname && $row['password'] === $pass) {
            $_SESSION["email"] = $row['Email'];
            header("Location:home.php");
        }
    } else {
        $error = '<div class="alert alert-danger" role="alert">
            plese enter register email and password
            </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>canteen managment system</title>



    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="row content d-flex justify-content-center align-items-center">
            <div class="col-md-5 mt-5">
                <div class="box shadow bg-white p-4 rounded-2">
                <?php if (isset($_SESSION['status'])) {
                    echo '<div class="alert alert-success" role="alert">
                    '.$_SESSION['status'].'
                    </div>';
                        } 
                        if(isset($_SESSION['statuss'])){
                            echo '<div class="alert alert-danger" role="alert">
                    '.$_SESSION['statuss'].'
                    </div>';
                        }
                     unset($_SESSION['status']);
                     unset($_SESSION['statuss']);
                        ?>
                        <?php if (isset($errormsg)) {
                            echo $errormsg;
                        } ?>
                    <h3 class="mb-3 text-center ps-3">Login</h3>
                    <form class="needs-validation mb-3" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
                        <?php if (isset($error)) {
                            echo $error;
                        } ?>
                        
                        <div class="mb-3">
                            <input type="email" name="email" id="Email" placeholder="Enter Email" class="form-control rounded-3" required>
                        </div>
                        <div class="mb-3">
                            <input type="Password" name="pass" id="Password" placeholder="Enter Password" class="form-control rounded-3" required>
                        </div>
                        <div class="spass mb-3">
                            <input type="checkbox" id="formCheck" class="check" onclick="myLogPassword()">
                            <label for="formCheck"> Show Password</label>
                        </div>
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" name="submit" class="btn btn-dark border-0 rounded-3" style="background-color:black;">login</button>
                        </div>
                        <div class="forgot-password-link mb-3">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#first-modal" style="border: none;">
                                Forget Password?
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal" id="first-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="reset_password_code.php" method="post">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Enter Email :</label>
                            <input type="text" class="form-control" name="email" id="user-input">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="second-modal btn btn-primary" name="submit">SEND EMAIL</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Second Modal -->

    <script src="assets/js/Validation.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        function myLogPassword() {
            var a = document.getElementById('Password');
            var b = document.getElementById('eye');
            var c = document.getElementById('eye-slash');
            if (a.type === "password") {
                a.type = "text"
                b.style.opacity = "0";
                c.style.opacity = "1";
            } else {
                a.type = "password"
                b.style.opacity = "1";
                c.style.opacity = "0";
            }
        }
    </script>


</body>

</html>