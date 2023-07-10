
<!-- login modal -->
<div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation mb-3" action="login.php" method="post" novalidate>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Email" class="col-form-label">Email :</label>
                        <input type="text" name="e-mail" class="form-control" id="email">
                    </div>
                    <div class="forgot-password-link mb-3">
                        <p class="text-center">don't have account? <button type="button" data-bs-toggle="modal" data-bs-target="#singupmodal" style="text-decoration:none;border: none; background-color:white;">
                               singup
                            </button></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submitbtn" class="btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>