<div class="container-fluid wrapper">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto box e-plan">
        <div class="row col-12 mt-4">
            <div class="col-lg-6 col-md-5 col-sm-12 e-img">

            <?php foreach($event as $data) { ?>

                <img class="img-fluid img-thumbnail" src="./../../assets/images/uploaded_images/<?php echo $data['event_picture']; ?>" alt="Image de l'évènement">
            </div>
            <div class="col-lg-6 col-md-7 col-sm-12 e-infos">
                <h2><?php echo $data['event_name']; ?></h2>
                <strong>Date : </strong>
                <p><?php echo $data['event_date']; ?></p>
                <strong>Description :</strong>
                <p><?php echo $data['event_description']; ?></p>
            </div>
        </div>
        <hr>
        <div class="row col-12 mt-4">
            <div class="col-lg-6 col-md-5 col-sm-12 e-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d11566.017800943258!2d3.5306775!3d43.55437075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sfr!4v1569487613640!5m2!1sfr!2sfr" class="img-thumbnail" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
            <div class="col-lg-6 col-md-7 col-sm-12 e-infos">
                <h2><?php echo $data['city_address']; ?></h2>
                <p><strong><?php echo $data['zip_code_address']; ?></strong></p>
                <p><?php echo $data['address']; ?></p>

            <?php } ?>

                <button class="btn btn-primary">Itinéraire vers le lieu</button>
            </div>
        </div>
        <hr>
        <div class="row col-12 mt-4 table-responsive">
            <h2>Participants</h2>
            <table class="table table-dark">
                <thead>
                    <tr>
                    <th scope="col">Prénom/Nom</th>
                    <th scope="col">Rang</th>
                    <th scope="col">Cotisation</th>
                    <th scope="col">Participation</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($participants as $data) { ?>
                    <tr>
                        <th scope="row"><?php echo $data['alias']; ?></th>
                        <td>
                            <?php if($p_rank['creator_id'] == $data['id_user']) {
                                echo '<i class="fas fa-crown"></i>Créateur de l\'évènement';
                            } else if ($data['super_user']) {
                                echo '<i class="fas fa-user-shield"></i>Administrateur';
                            } else {
                                echo '<i class="fas fa-user"></i>Invité';
                            }?>
                        <td><?php
                        if ($data['fees']) {
                            echo ''.$data['fees'].'€';     
                        }?>
                        </td>
                        <td> 
                        <ul class="p-0">
                            <?php foreach($p_needs as $need) { 
                                if($data['id_user'] == $need['supplier_id']) {
                                    echo ' <li> '.$need['need_name'].' ('.$need['category_name'].')</li> ';
                                }
                            } ?>
                        </ul>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <?php foreach($event as $data) { ?>

        <div class="row col-12 mt-4 table-responsive"<?php if($data['mandatory_needs'] == FALSE) { echo 'style="display:none;"'; } ?>>

        <?php } ?>

            <h2>Besoins de l'évenement</h2>

            

            <table class="table table-dark">
                <thead>
                    <tr>
                    <th scope="col">Besoin</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Etat</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($needs->result() as $need) { ?>

                    <tr>
                    <th scope="row"><?php echo $need->need_name; ?></th>

                    <td><?php echo $need->category_name; 
                    ?></td>

                    <td><?php if($need->supplier_id) {
                        echo '<i class="far fa-check-circle"></i> '.$need->alias.'';
                    } else {
                        echo ' <button class="btn btn-primary">Je m\'occupe de ça !</button>';
                    } ?></td>
                    </tr>
                <?php } ?>    
                </tbody>
            </table>
            
        </div>
        <?php foreach($event as $data) { ?>
        <div class="row col-12 mt-4" <?php if($data['mandatory_fees'] == FALSE) { echo 'style="display:none;"'; } ?>>
            <h2 class="col-12">Cotisations</h2>
            <?php foreach($total_fees as $fees) { ?>
            <p class="col-12"><?php echo $fees['fees']; ?> sur les <?php echo $data['max_fees']; ?>€ nécessaires</p>
            
            <div class="col-6">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo ($fees['fees'] / $data['max_fees']) * 100; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="10"></div>
                </div>
                <button class="btn btn-primary mt-3 mb-3">Nouvelle cotisation</button>
            </div>
            <?php } ?>
        <?php } ?>
        </div>
    </div>
</div>