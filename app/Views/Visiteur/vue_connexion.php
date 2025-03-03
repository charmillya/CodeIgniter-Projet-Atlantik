<div class="text-center">
    <style>
        body {background-color: #242424;}
    </style>
    <?php 
    echo '<text class="text-light">';
    echo '<div class="text-light divRounded text-center">';
    echo '<h3><b>Identifiez-vous ou créez un compte</b></h3>';
    echo "</div><br><br>";

    ?>

    <div class="text-light text-center divReservation">

        <br>
        <div class="text-light text-center divInfosTraversee">
            <?php
            echo form_open('connexion');
            echo csrf_field(); ?>
            <h6>Adresse e-mail</h6>
            <input class="connexionInput" type="input" name="txtIdentifiant" value="<?php echo set_value('txtIdentifiant'); ?>" /><br />
            <br>
            <h6>Mot de passe</h6>
            <input class="connexionInput" type="password" name="txtMotDePasse" value="<?php echo set_value('txtMotDePasse'); ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
            title="Le mot de passe doit contenir au moins 8 caractères dont un chiffre, une lettre majuscule et une lettre minuscule" /><br />

            <br><br>
            <div class="connexionBtn">
                <a href="creercompte" class="btn btn-light">Créer un compte</a>
                <input class="btn btn-light" type="submit" name="submit" value="Connexion"/>
            </div>
            <? echo form_close(); ?>

            <br>
            <b><?php if ($Erreur != "") { echo $Erreur; } ?></b>
        </div>
        <br>
    </div>
    <br><br><br>
</div>