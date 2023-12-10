<?php  include(VIEWS.'inc'.DS.'header.php'); ?>

<h1 class="text-center  mt-5 mb-2 py-3">Add New Category </h1>

    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">

            
                <?php if(isset($success)): ?>
                    <h3 class="alert alert-success text-center"><?php  echo $success; ?></h3>
                <?php endif; ?>
                <?php if(isset($error)): ?>
                    <h3 class="alert alert-danger text-center"><?php  echo $error; ?></h3>
                <?php endif; ?>


                <form class="p-5 border mb-5" method="POST" action="<?php url('categories/store'); ?>">
                    <div class="form-group">
                        <label for="tittle">Tittle</label>
                        <input type="text" required name="tittle" class="form-control" id="tittle" >
                    </div>
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <input type="text" required class="form-control" name="desc" id="desc">
                    </div>



                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
        
            </div>
        </div>
    </div>

<?php  include(VIEWS.'inc'.DS.'footer.php'); ?>
