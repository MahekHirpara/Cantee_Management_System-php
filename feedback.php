<?php
session_start();
?>
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="image/feedback.png" style="width:50px; height:50px;">
                <h4><strong>Give us your feedback.</strong></h4>
                <hr>
                <h6>Your Rating</h6>
            </div>
            
                <form action="Feed.php" method="post">
                <?php if (isset($_SESSION['cid'])) {
            ?>
                    <div class="form-check mb-4">

                        <input name="feedback" type="radio" value="very good">

                        <label class="ml-3">Very good</label>
                        <img src="image/verygood.png" style="width:20px; height: 20px;">
                    </div>
                    <div class="form-check mb-4">
                        <input name="feedback" type="radio" value="good">
                        <label class="ml-3">Good</label>
                        <img src="image/good.png" style="width:20px; height: 20px;">
                    </div>
                    <div class="form-check mb-4">
                        <input name="feedback" type="radio" value="bad">
                        <label class="ml-3">Bad</label>
                        <img src="image/verybed.png" style="width:20px; height: 20px;">
                    </div>
                    <div class="form-check mb-4">
                        <input name="feedback" type="radio" value="very bad">
                        <label class="ml-3">Very Bad</label>
                        <img src="image/bad.png" style="width:20px; height: 20px;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="send" class="btn">Send</button>
                    </div>
                    <?php
            } else {
                echo '<div class="container" style="min-height : 610px; margin-top:200px;">
                                 <div class="alert alert-info my-3">
                                     <font style="font-size:22px"><center>You need to <strong><a class="" data-bs-toggle="modal" data-bs-target="#login-modal">Login</a></strong>frist</center></font>
                                 </div></div>';
            }

            ?>
                </form>
            
        </div>
    </div>
</div>