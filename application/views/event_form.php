<div class="container-fluid wrapper">
    <?php
		echo form_open_multipart('event/create');
	?>
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto box r-form">
        <h1>Créer un évènement</h1>
        <div class="form-group row">
            <label for="event_name" class="col-4 col-form-label">Nom de l'évènement</label> 
            <div class="col-8">
            <input id="event_name" name="event_name" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="event_description" class="col-4 col-form-label">Description</label> 
            <div class="col-8">
            <input id="event_description" name="event_description" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="event_picture" class="col-4 col-form-label">Image de l'évènement</label> 
            <div class="col-8">
                <div class="button-wrapper">
                    <span class="label">
                        Importer une image
                    </span>            
                    <input type="file" name="file_name" id="upload" class="upload-box" placeholder="Upload File">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="city_address" class="col-4 col-form-label">Ville de l'évènement</label> 
            <div class="col-8">
            <input id="city_address" name="city_address" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="zip_code_address" class="col-4 col-form-label">Code postal</label> 
            <div class="col-8">
            <input id="zip_code_address" name="zip_code_address" type="number" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-4 col-form-label">Adresse</label> 
            <div class="col-8">
            <input id="address" name="address" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="event_date" class="col-4 col-form-label">Date de l'évènement</label> 
            <div class="col-8">
            <input id="event_date" name="event_date" type="date" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4 col-form-label">Evènement public</label>
            <div class="col-8">
                <label class="switch form-group row">
                    <input type="checkbox" id="private" name="private" onclick="checkShow();">
                    <span class="slider round"></span>
                </label>
                <p id="private-info"> <small>Un évènement public apparaitra dans la liste des évènements EZ Party et tout le monde pourra demander à y participer</small></p>                
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4 col-form-label">Cotisation obligatoire</label>
            <div class="col-8">
                <label class="switch form-group row">
                    <input type="checkbox" id="mandatory_fees" name="mandatory_fees" onclick="checkShow();">
                    <span class="slider round"></span>
                </label>                
            </div>
        </div>
        <div class="form-group row" id="maxFees">
            <label for="max_fees" class="col-4 col-form-label">Objectif cotisation</label> 
            <div class="col-8">
            <input id="max_fees" name="max_fees" type="number" class="form-control" placeholder="€">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4 col-form-label">Participation aux besoins obligatoire</label>
            <div class="col-8">
                <label class="switch form-group row">
                    <input type="checkbox" id="mandatory_needs" name="mandatory_needs" onclick="checkShow();">
                    <span class="slider round"></span>
                </label>                
            </div>
        </div>
        <div id="needs-group">
            <label for="need" class="col-4 col-form-label"><button class="btn btn-primary" type="button" onclick="addElement();"><i class="fas fa-plus-circle" >Ajouter un besoin</i></button></label> 
            <div id="need-block" class="form-group row">
                <div class="col-8 offset-4 d-flex">
                    <input id="need" name="need[]" type="text" class="form-control col-6" required="required">
                    <select name="category[]" class="form-control col-4 col-sm-5 offset-1">
                        <option value="2">Boisson/Alcool</option>
                        <option value="3">Matériel</option>
                        <option value="4">Décoration</option>
                        <option value="5">Nourriture</option>
                        <option value="6">Autre</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Créer l'évènement</button>
            </div>
        </div>
</div>
    <?php 
		echo form_close(); 
	?>
</div>