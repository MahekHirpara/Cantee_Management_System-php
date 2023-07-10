<?php 
session_start();
include "conn.php";


if(isset($_POST['submitbtn'])){
  $_SESSION['fname'] =$_POST['fname'];
  $_SESSION['lname'] =$_POST['lname'];
  $_SESSION['E-mail'] =$_POST['E-mail'];
  $_SESSION['phone'] =$_POST['phone'];
  if(isset($_SESSION['fname']))
  {
    header('location:pay.php');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Canteen managment</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

</head>
<body>

<div class="py-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card ">
                    <div class="card-body">
                        <h5>Basic Details</h5>
                        <hr>
                        <form id="basic_form" name="basic_form" action="" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Frist Name</label>
                                <input type="text" id="fname" name="fname" placeholder="Enter your Frist name" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Last Name</label>
                                <input type="text" id="lname" name="lname" placeholder="Enter your Last name" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">E-mail</label>
                                <input type="text" id="E-mail" name="E-mail" placeholder="Enter your E-mail" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Phone no.</label>
                                <input type="text" id="phone" name="phone" placeholder="Enter your phone no" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <input type="submit" class="btn btn-success" name="submitbtn" value="submit">
                            </div>
                        </div>
                        </form>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script>
document.querySelector('#fname').addEventListener('blur', validateFName);
document.querySelector('#lname').addEventListener('blur',  validateLName);
document.querySelector('#E-mail').addEventListener('blur', validateEmail);
document.querySelector('#phone').addEventListener('blur', validatePhone);

function validateFName(e) {
    const FName = document.querySelector('#fname');
    if (FName.value == "") {
        FName.classList.add('is-invalid');
        FName.classList.remove('is-valid');
        return false;
    }
    else if (FName.value != "") {
        FName.classList.remove('is-invalid');
        FName.classList.add('is-valid');
        return true;
    }
}
function validateLName(e) {
    const LName= document.querySelector('#lname');
    if (LName.value == "") {
        LName.classList.add('is-invalid');
        LName.classList.remove('is-valid');
        return false;
    }
    else if (LName.value != "") {
        LName.classList.remove('is-invalid');
        LName.classList.add('is-valid');
        return true;
    }
}
function  validateEmail(e) {
    const email = document.querySelector('#E-mail');
    if (email.value == "") {
        email.classList.add('is-invalid');
        email.classList.remove('is-valid');
        return false;
    }
    else if (email.value != "") {
        email.classList.remove('is-invalid');
        email.classList.add('is-valid');
        return true;
    }
}
function validatePhone(e) {
    const phone = document.querySelector('#phone');
    if (phone.value == "") {
        phone.classList.add('is-invalid');
        phone.classList.remove('is-valid');
        return false;
    }
    else if (phone.value != "") {
        phone.classList.remove('is-invalid');
        phone.classList.add('is-valid');
        return true;
    }
}

(function () {

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    for (let form of forms) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity() || !validatePhone() || !validateEmail() || !validateLName() || !validateFName()) {
                event.preventDefault()
                event.stopPropagation()
            }
            else {
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