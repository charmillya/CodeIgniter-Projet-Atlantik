<div class="text-light divRounded text-center">
<h2><b>Modifier mes informations</b></h2>
</div>

<br><br><br>

<div class="text-light text-center divReservation">

    <br>
    <div class="text-light text-center divInfosTraversee">
        <br>
        <form action="" method='post'>
            <?php if(isset($informationsModifiees)) {
                echo '<h6 class="text-success"><b>Informations modifiées avec succès !</b></h6><br>';
            } else if(isset($erreur)) {
                echo '<h6 class="text-danger"><b>'.$erreur.'</b></h6><br>';
            }?>
            <h6><b>Nom (<span class="text-danger">*</span>)</b></h6>
            <input type="text" disabled class="input-group-text" style="margin: auto; background-color: grey;" name="txtNom" value="<?php echo $_SESSION['nom']; ?>">
            <br>
            <h6><b>Prénom (<span class="text-danger">*</span>)</b></h6>
            <input type="text" disabled class="input-group-text" style="margin: auto; background-color: grey;" name="txtPrenom" value="<?php echo $_SESSION['prenom']; ?>">
            <br>
            <h6><b>Adresse (<span class="text-danger">*</span>)</b></h6>
            <input type="text" class="input-group-text" style="margin: auto;" name="txtAdresse" value="<?php echo $_SESSION['adresse']; ?>">
            <br>
            <h6><b>Ville (<span class="text-danger">*</span>)</b></h6>
            <input type="text" class="input-group-text" style="margin: auto;" name="txtVille" value="<?php echo $_SESSION['ville']; ?>">
            <br>
            <h6><b>Code Postal (<span class="text-danger">*</span>)</b></h6>
            <input type="text" class="input-group-text" style="margin: auto;" name="txtCodePostal" max="5" value="<?php echo $_SESSION['codepostal']; ?>">
            <br>
            <h6><b>Tél. fixe</b></h6>
            <input type="text" class="input-group-text" style="margin: auto;" name="txtTelFixe" value="<?php echo $_SESSION['telfixe']; ?>">
            <br>
            <h6><b>Tél. mobile</b></h6>
            <input type="text" class="input-group-text" style="margin: auto;" name="txtTelMobile" value="<?php echo $_SESSION['telmobile']; ?>">
            <br>
            <p class="text-danger">* Champs obligatoires</p>
    </div>
            <br><br>
            <input type="submit" class="btn btn-light" name="btnModifierInfos" value="Modifier mes informations">
        </form>
        <br><br><br>
</div>

<br><br><br>