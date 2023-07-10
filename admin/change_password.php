<?php
session_start();
include "conn.php";
$msg = "";
$errmsg = "";
$matchmsg = "";
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpass = $_POST['password1'];
    if ($password === $confirmpass) {
        $sql = "update admin_login set password='$password' where Email='$email'";
        $sql_run = mysqli_query($con, $sql);
        if ($sql_run) {
            $msg = '<div class="alert alert-success" role="alert">
        Your Password is Successfylly Changed.....
        </div>';
        } else {
            $errmsg = '<div class="alert alert-danger" role="alert">
        Somthing is wrong please try again....
        </div>';
        }
    } else {
        $matchmsg = '<div class="alert alert-danger" role="alert">
    Password is not match...
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
    <style>
    </style>
</head>

<body>
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <?php
                        if (isset($msg)) {
                            echo $msg;
                        }
                        if (isset($errmsg)) {
                            echo $errmsg;
                        }
                        if (isset($matchmsg)) {
                            echo $matchmsg;
                        }
                        ?>
                        <div class="card-header">
                            <h5>Change password</h5>
                        </div>
                        <div class="card-body p-4">

                            <form class="needs-validation mb-3" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter New Password">
                                </div>
                                <div class="mb-3">
                                    <label for="password1" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password1" id="password1" placeholder="Enter Confirm Password">
                                </div>
                                <div class="spass mb-3">
                                    <input type="checkbox" id="formCheck" class="check" onclick="myLogPassword()">
                                    <label for="formCheck"> Show Password</label>
                                </div>
                                <button type="submit" name="submit" class="btn btn-success w-100">Submit</button>
                                <a href="login.php">Back To Login</a>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        function myLogPassword() {
            var a = document.getElementById('password');
            var b = document.getElementById('password1');
            if (a.type === "password") {
                a.type = "text"
                b.type = "text"
            } else {
                a.type = "password"
                b.type = "password"
            }

        }

        document.querySelector('#email').addEventListener('blur', validateEmail);
        document.querySelector('#password').addEventListener('blur', validatePass);
        const reSpaces = /^\S*$/;

        function validateEmail(e) {
            const email = document.querySelector('#email');
            if (email.value == "") {
                email.classList.add('is-invalid');
                email.classList.remove('is-valid');
                return false;
            } else if (email.value != "") {
                email.classList.remove('is-invalid');
                email.classList.add('is-valid');
                return true;
            }
        }

        function validatePass(e) {
            const pass = document.querySelector('#password');
            const re = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})(?=.*[!@#$%^&*])/;
            if (pass.value == "") {
                pass.classList.add('is-invalid');
                pass.classList.remove('is-valid');
                return false;
            } else if (reSpaces.test(pass.value) && pass.value != "" && re.test(pass.value)) {
                pass.classList.remove('is-invalid');
                pass.classList.add('is-valid');
                return true;
            }
        }
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            for (let form of forms) {
                form.addEventListener('submit', function(event) {
                        if (!form.checkValidity() || !validateEmail() || !validatePass()) {
                            event.preventDefault()
                            event.stopPropagation()
                        } else {
                            form.classList.add('was-validated');
                        }
                    },
                    false
                );
            }
        })();
    </script>
</body>

</html>