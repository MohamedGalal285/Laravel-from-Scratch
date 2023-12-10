
<?php
use app\core\form\Form;
?>


    <h1>Login</h1>

<?php $form = Form::begin('' , "post") ; ?>
<?php echo $form->field($model , 'email') ?>
<?php echo $form->field($model , 'password')->passwordField() ?>
<button type="submit" class="btn btn-primary">Login</button>
<?php Form::end(); ?>



    <!-- <h1>login</h1>


<form action="" method="post">
    
    <div class="mb-3">
        <label  class="form-label">Subject</label>
        <input type="text" class="form-control" >
    </div>
    <div class="mb-3">
        <label  class="form-label">Email address</label>
        <input type="email" class="form-control" >
    </div>
    <div class="mb-3">
        <label  class="form-label">Password</label>
        <input type="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form> -->
