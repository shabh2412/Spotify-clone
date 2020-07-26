<?php
    include("includes/includedFiles.php");
?>

<div class="userDetails">
    <div class="container borderBottom">
        <h2>EMAIL</h2>
        <input type="text" class="email" name="email" placeholder="Type your new email address here..." value="<?php echo $userLoggedIn->getEmail();?>">
    </div>
    <div class="container">
        <h2>PASSWORD</h2>
    </div>
</div>