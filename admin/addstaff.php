<?php
include 'conn.php';

if (isset($_POST['submit'])) {
    $name = $_POST['Name'];
    $address = $_POST['Address'];
    $email = $_POST['Email'];
    $salary = $_POST['Salary'];
    $i = "upload/" . $_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], $i);
    $sql = "INSERT INTO `stafftb` (`StaffName`,`StaffAddress`,`StaffEmail`,`StaffSalary`, `Image`) VALUES ('$name', '$address','$email','$salary', '$i')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        header("location:staff.php");
    } else {
        echo "record not inserted";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>canteen managment System</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>

<body>
    <div class="backtohome" style="margin-top :20px; margin-left:20px;">
        <button class="button rounded-circle" style="height:45px; width:45px; background-color:#953545; border:none">
            <a href="home.php" style="color:white; "><i class="bi bi-arrow-left"></i></a>
        </button>
    </div>
    <div class="Container">
        <div class="row content d-flex justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="box shadow bg-white p-4 rounded-2">
                    <h3 class="mb-3 text-center ps-3">Add Staff Details</h3>
                    <form class="needs-validation mb-3" action="" enctype="multipart/form-data" method="post" novalidate>

                        <div class="mb-3">
                            <input type="text" name="Name" id="name" placeholder="Enter Staff Name" class="form-control rounded-3" required>
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text-area" name="Address" id="address" placeholder="Enter Address " class="form-control rounded-3" required>
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="Email" id="email" placeholder="Enter Email" class="form-control rounded-3" required>
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="Salary" id="salary" placeholder="Enter Salary" class="form-control rounded-3" required>
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="file" name="img" id="image" class="form-control rounded-3" required>
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback">
                            </div>
                        </div>
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" name="submit" class="btn border-0 rounded-3 text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        document.querySelector('#email').addEventListener('blur', validateEmail);
        document.querySelector('#salary').addEventListener('blur', validateSalary);
        document.querySelector('#name').addEventListener('blur', validateName);
        document.querySelector('#address').addEventListener('blur', validateAddres);
        document.querySelector('#image').addEventListener('blur', validateimage);

        function validateAddres(e) {
            const Add = document.querySelector('#address');
            if (Add.value == "") {
                Add.classList.add('is-invalid');
                Add.classList.remove('is-valid');
                return false;
            } else if (Add.value != "") {
                Add.classList.remove('is-invalid');
                Add.classList.add('is-valid');
                return true;
            }
        }

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

        function validateSalary(e) {
            const salary = document.querySelector('#salary');
            if (salary.value == "") {
                salary.classList.add('is-invalid');
                salary.classList.remove('is-valid');
                return false;
            } else if (salary.value != "") {
                salary.classList.remove('is-invalid');
                salary.classList.add('is-valid');
                return true;
            }
        }

        function validateName(e) {
            const Name = document.querySelector('#name');
            if (Name.value == "") {
                Name.classList.add('is-invalid');
                Name.classList.remove('is-valid');
                return false;
            } else if (Name.value != "") {
                Name.classList.remove('is-invalid');
                Name.classList.add('is-valid');
                return true;
            }
        }

        function validateimage(e) {
            const img = document.querySelector('#image')
            if (img.value == "") {
                img.classList.add('is-invalid');
                img.classList.remove('is-valid');
                return false;
            } else if (img.value != "") {
                img.classList.remove('is-invalid');
                img.classList.add('is-valid');
                return true;
            }
        }

        (function() {

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            for (let form of forms) {
                form.addEventListener('submit', function(event) {
                        if (!form.checkValidity() || !validateSalary() || !validateEmail() || !validateName() || !validateimage() || !validateAddres()) {
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