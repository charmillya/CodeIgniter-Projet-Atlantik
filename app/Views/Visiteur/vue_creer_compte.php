<div class="text-center">
<style>
    body {background-color: #242424;}
</style>
<?php 
    echo "<br>";
    echo '<text class="text-light">';
    echo '<div class="text-light divRounded text-center">';
        echo '<h3><b>Créer un compte Atlantik</b></h3>';
    echo "</div><br><br>";

    ?>

    <div class="text-light text-center divReservation">

        <br>
        <div class="text-light text-center divInfosTraversee">

            <?php
            echo form_open('creercompte');
            echo csrf_field(); ?>
            <h6><b>Adresse e-mail (<span class="text-danger">*</span>)</b></h6>
            <input class="connexionInput" type="text" name="txtIdentifiant" value="<?php echo set_value('txtIdentifiant'); ?>" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" title="L'adresse e-mail doit être valide"><br>
            <br>

            <h6><b>Mot de passe (<span class="text-danger">*</span>)</b></h6>
            <input class="connexionInput" type="password" name="txtMotDePasse" value="<?php echo set_value('txtMotDePasse'); ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
            title="Le mot de passe doit contenir au moins 8 caractères dont un chiffre, une lettre majuscule et une lettre minuscule" /><br />
            <br>

            <h6><b>Nom (<span class="text-danger">*</span>)</b></h6>
            <input class="connexionInput" type="text" name="txtNom" value="<?php echo set_value('txtNom'); ?>" /><br />
            <br>

            <h6><b>Prénom (<span class="text-danger">*</span>)</b></h6>
            <input class="connexionInput" type="text" name="txtPrenom" value="<?php echo set_value('txtPrenom'); ?>" /><br />
            <br>

            <h6><b>Adresse (<span class="text-danger">*</span>)</b></h6>
            <input class="connexionInput" type="input" name="txtAdresse" value="<?php echo set_value('txtAdresse'); ?>" /><br />
            <br>

            <h6><b>Code Postal (<span class="text-danger">*</span>)</b></h6>
            <input class="connexionInput" type="number" name="txtCodePostal" value="<?php echo set_value('txtCodePostal'); ?>" /><br />
            <br>

            <h6><b>Ville (<span class="text-danger">*</span>)</b></h6>
            <input class="connexionInput" type="text" name="txtVille" value="<?php echo set_value('txtVille'); ?>" /><br />
            <br>

            <h6>Tel. fixe</h6>
            <input class="connexionInput" type="number" name="txtTelFixe" value="<?php echo set_value('txtTelFixe'); ?>" /><br />
            <br>

            <h6>Tel. mobile</h6>
            <input class="connexionInput" type="number" name="txtTelMobile" value="<?php echo set_value('txtTelMobile'); ?>" /><br />
            <br>
            <p class="text-danger">* Champs obligatoires</p>
            <br>
            <div class="connexionBtn">
            <a href="connexion" class="btn btn-light">Me connecter</a>
            <input class="btn btn-light" type="submit" name="submit" value="Créer un compte"/>
            </div>
            <? echo form_close(); ?>

            <br>
            <b><?php if ($Erreur != "") { echo $Erreur; } ?></b>
        <br>
        </div>
    <br>
    </div>
<br><br>
</div>
</body>
</html>