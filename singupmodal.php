<?php include "loginmodal.php"; ?>
<!-- regisation modal -->
<div class="modal fade" id="singupmodal" tabindex="-1" aria-labelledby="singupmodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation mb-3" action="registation.php" method="post" novalidate>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Username" class="col-form-label">Username :</label>
                        <input type="text" name="uname" class="form-control" id="Username">
                    </div>
                    <div class="mb-3">
                        <label for="Email" class="col-form-label">Email :</label>
                        <input type="text" name="email" class="form-control" id="Email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
