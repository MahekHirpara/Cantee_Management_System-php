<?php
session_start();
include "razorpay-php/Razorpay.php";
include "conn.php";
include "header.php";
?>

<div class="py-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card ">
                    <div class="card-body">
                        <h5>Basic Details</h5>
                        <hr>
                        <?php include "gateway-config.php";
                        $amount = $_SESSION['totalamount'];
                        $displayCurrency = "INR";
                        $webtital = "VKMcanteen";

                        use Razorpay\Api\Api;

                        $api = new Api($keyId, $keySecret);

                        //
                        // We create an razorpay order using orders api
                        // Docs: https://docs.razorpay.com/docs/orders
                        //
                        $orderData = [
                            'receipt'         => 3456,
                            'amount'          =>  $amount * 100, // 2000 rupees in paise
                            'currency'        => 'INR',
                            'payment_capture' => 1 // auto capture
                        ];

                        $razorpayOrder = $api->order->create($orderData);

                        $razorpayOrderId = $razorpayOrder['id'];

                        $_SESSION['razorpay_order_id'] = $razorpayOrderId;

                        $displayAmount = $amount = $orderData['amount'];

                        if ($displayCurrency !== 'INR') {
                            $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
                            $exchange = json_decode(file_get_contents($url), true);

                            $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
                        }

                        $data = [
                            "key"               => $keyId,
                            "amount"            => $amount,
                            "name"              =>  $webtital,
                            "description"       => "Tron Legacy",
                            "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
                            "prefill"           => [
                                "name"              => $_SESSION['fname'],
                                "email"             => $_SESSION['E-mail'],
                                "contact"           => $_SESSION['phone'],
                            ],
                            "notes"             => [
                                "address"           => "Hello World",
                                "merchant_order_id" => "12312321",
                            ],
                            "theme"             => [
                                "color"             => "#F37254"
                            ],
                            "order_id"          => $razorpayOrderId,
                        ];

                        if ($displayCurrency !== 'INR') {
                            $data['display_currency']  = $displayCurrency;
                            $data['display_amount']    = $displayAmount;
                        }

                        $json = json_encode($data);
                        ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Frist Name :</label>
                                <?php echo $_SESSION['fname']; ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Last Name :</label>
                                <?php echo $_SESSION['lname']; ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">E-mail :</label>
                                <?php echo $_SESSION['E-mail']; ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Phone no :</label>
                                <?php echo $_SESSION['phone']; ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Amount :</label>
                                <?php if (isset($_SESSION['uname'])) {
                                    echo $_SESSION['totalamount'];
                                } ?>
                            </div>
                            <div class="col-md-12 mb-3">
                                
                                <form action="verify.php" method="POST">
                                    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $data['key'] ?>" data-amount="<?php echo $data['amount'] ?>" data-currency="INR" data-name="<?php echo $data['name'] ?>" data-image="<?php echo $data['image'] ?>" data-description="<?php echo $data['description'] ?>" data-prefill.name="<?php echo $data['prefill']['name'] ?>" data-prefill.email="<?php echo $data['prefill']['email'] ?>" data-prefill.contact="<?php echo $data['prefill']['contact'] ?>" data-notes.shopping_order_id="<?php ?>" data-order_id="<?php echo $data['order_id'] ?>" <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount'] ?>" <?php } ?> <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency'] ?>" <?php } ?>>
                                    </script>
                                    <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
                                    <input type="hidden" name="shopping_order_id" value="<?php echo $_SESSION['cid'] ?>">
                                </form>
                            </div>
                        </div>
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
    document.querySelector('#lname').addEventListener('blur', validateLName);
    document.querySelector('#E-mail').addEventListener('blur', validateEmail);
    document.querySelector('#phone').addEventListener('blur', validatePhone);

    function validateFName(e) {
        const FName = document.querySelector('#fname');
        if (FName.value == "") {
            FName.classList.add('is-invalid');
            FName.classList.remove('is-valid');
            return false;
        } else if (FName.value != "") {
            FName.classList.remove('is-invalid');
            FName.classList.add('is-valid');
            return true;
        }
    }

    function validateLName(e) {
        const LName = document.querySelector('#lname');
        if (LName.value == "") {
            LName.classList.add('is-invalid');
            LName.classList.remove('is-valid');
            return false;
        } else if (LName.value != "") {
            LName.classList.remove('is-invalid');
            LName.classList.add('is-valid');
            return true;
        }
    }

    function validateEmail(e) {
        const email = document.querySelector('#E-mail');
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

    function validatePhone(e) {
        const phone = document.querySelector('#phone');
        if (phone.value == "") {
            phone.classList.add('is-invalid');
            phone.classList.remove('is-valid');
            return false;
        } else if (phone.value != "") {
            phone.classList.remove('is-invalid');
            phone.classList.add('is-valid');
            return true;
        }
    }

    (function() {

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        for (let form of forms) {
            form.addEventListener('submit', function(event) {
                    if (!form.checkValidity() || !validatePhone() || !validateEmail() || !validateLName() || !validateFName()) {
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