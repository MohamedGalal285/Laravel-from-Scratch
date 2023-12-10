<?php
use app\core\form\Form;
?>


    <h1>Create an account</h1>

<?php $form = Form::begin('' , "post") ; ?>
<div class="row">
    <div class="col">
        <?php echo $form->field($model , 'firstname') ?>
    </div>
    <div class="col">
        <?php echo $form->field($model , 'lastname') ?>
    </div>
</div>
<?php echo $form->field($model , 'email') ?>
<?php echo $form->field($model , 'password')->passwordField() ?>
<?php echo $form->field($model , 'passwordConfirm')->passwordField() ?>
<button type="submit" class="btn btn-primary">Register</button>
<?php Form::end(); ?>



<!-- <form action="" method="post">
    
    <div class="mb-3">
        <label  class="form-label">First Name</label>
        <input type="text" class="form-control" name="firstname" >

    </div>
    <div class="mb-3">
        <label  class="form-label">last Name</label>
        <input type="text" class="form-control" name="lastname" >
    </div>
    
    <div class="mb-3">
        <label  class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" >
    </div>
    <div class="mb-3">
        <label  class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="mb-3">
        <label  class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="passwordConfirm">
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form> -->
