<div class="container-fluid wrapper">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto box e-plan">
        <div class="row col-12 mt-4">
            <div class="col-lg-6 col-md-5 col-sm-12 e-img">
                <img class="img-fluid img-thumbnail" src="./../../assets/images/uploaded_images/<?php echo $event_picture; ?>" alt="Image de l'évènement">
            </div>
            <div class="col-lg-6 col-md-7 col-sm-12 e-infos">
                <h2><?php echo $event_name; ?></h2>
                <strong>Date : </strong>
                <p><?php echo $event_date; ?></p>
                <strong>Description :</strong>
                <p><?php echo $event_description; ?></p>
            </div>
        </div>
        <hr>
        <div class="row col-12 mt-4">
            <div class="col-lg-6 col-md-5 col-sm-12 e-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d11566.017800943258!2d3.5306775!3d43.55437075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sfr!4v1569487613640!5m2!1sfr!2sfr" class="img-thumbnail" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
            <div class="col-lg-6 col-md-7 col-sm-12 e-infos">
                <h2><?php echo $city_address; ?></h2>
                <p><strong><?php echo $zip_code_address; ?></strong></p>
                <p><?php echo $address; ?></p>
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
                    <tr>
                    <th scope="row">Jean dupont</th>
                    <td>Administrateur</td>
                    <td>15€</td>
                    <td>Viande(Nourriture) - Vins(Boissons/Alcool)</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row col-12 mt-4 table-responsive"<?php if($mandatory_needs == FALSE) { echo 'style="display:none;"'; } ?>>
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
                    <tr>
                    <th scope="row">Viande</th>
                    <td>Nourriture</td>
                    <td><i class="far fa-check-circle"></i>John Doe</td>
                    </tr>
                    <tr>
                    <th scope="row">Desserts glacés</th>
                    <td>Nourriture</td>
                    <td><button class="btn btn-primary">Je m'en occupe</button></td>
                    </tr>
                    <tr>
                    <tr>
                    <tr>
                    <th scope="row">Vins</th>
                    <td>Boissons/Alcool</td>
                    <td><i class="far fa-check-circle"></i>John Doe</td>
                    </tr>
                    <tr>
                </tbody>
            </table>
        </div>
        <div class="row col-12 mt-4" <?php if($mandatory_fees == FALSE) { echo 'style="display:none;"'; } ?>>
            <h2 class="col-12">Cotisations</h2>
            <p class="col-12">25€ sur les <?php echo $max_fees; ?>€ nécessaires</p>
            <div class="col-6">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="10"></div>
                </div>
                <button class="btn btn-primary mt-3 mb-3">Nouvelle cotisation</button>
            </div>
        </div>
    </div>
</div>