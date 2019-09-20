<div class="container-fluid wrapper">

    <?php
		echo form_open('login/index');
        echo validation_errors();
		if (isset($msg))
		echo '<p>'.$msg.'</p>';
	?>
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto box r-form">

        <div class="form-group row">
            <label class="col-4 col-form-label" for="email">Email</label> 
            <div class="col-8">
            <input id="email" name="email" type="text" required="required" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-4 col-form-label">Mot de passe</label> 
            <div class="col-8">
            <input id="password" name="password" type="password" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Connexion</button>
            <?php 
		    echo form_close(); 
		    ?>
            </div>
        </div>

</div>

</div>