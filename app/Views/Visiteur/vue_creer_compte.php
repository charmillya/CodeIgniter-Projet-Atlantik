<div class="text-center">
<style>
    body {background-color: #242424;}
</style>
<?php 
echo "<br>";
echo '<text class="text-light">';
echo '<h4><b>Créer un compte Atlantik</b></h4>';
echo "<br><br>";

echo form_open('connexion');
echo csrf_field(); ?>
<label for="txtIdentifiant">Adresse e-mail <span class="text-danger">*</span></label>
<br>
<input class="connexionInput" type="input" name="txtIdentifiant" value="<?php echo set_value('txtIdentifiant'); ?>" /><br />
<br>
<label for="txtMotDePasse">Mot de passe <span class="text-danger">*</span></label>
<br>
<input class="connexionInput" type="input" name="txtMotDePasse" value="<?php echo set_value('txtMotDePasse'); ?>" /><br />
<br>
<label for="txtMotDePasse">Nom <span class="text-danger">*</span></label>
<br>
<input class="connexionInput" type="input" name="txtNom" value="<?php echo set_value('txtNom'); ?>" /><br />
<br>
<label for="txtMotDePasse">Prénom <span class="text-danger">*</span></label>
<br>
<input class="connexionInput" type="input" name="txtPrenom" value="<?php echo set_value('txtPrenom'); ?>" /><br />
<br>
<label for="txtMotDePasse">Adresse <span class="text-danger">*</span></label>
<br>
<input class="connexionInput" type="input" name="txtAdresse" value="<?php echo set_value('txtAdresse'); ?>" /><br />
<br>
<label for="txtMotDePasse">Code postal <span class="text-danger">*</span></label>
<br>
<input class="connexionInput" type="input" name="txtCodePostal" value="<?php echo set_value('txtCodePostal'); ?>" /><br />
<br>
<label for="txtMotDePasse">Ville <span class="text-danger">*</span></label>
<br>
<input class="connexionInput" type="input" name="txtVille" value="<?php echo set_value('txtVille'); ?>" /><br />
<br>
<label for="txtMotDePasse">Tel. fixe</label>
<br>
<input class="connexionInput" type="input" name="txtTelFixe" value="<?php echo set_value('txtTelFixe'); ?>" /><br />
<br>
<label for="txtMotDePasse">Tel. mobile</label>
<br>
<input class="connexionInput" type="input" name="txtTelMobile" value="<?php echo set_value('txtTelMobile'); ?>" /><br />
<br><br>
<p class="text-danger">* Champs obligatoires</p>
<br><br>
<div class="connexionBtn">
<a href="connexion" class="btn btn-light">Me connecter</a>
<a href="creercompte" class="btn btn-light">Créer un compte</a>
</div>
<? echo form_close(); ?>

<br><br>
<b><?php if ($Erreur != "") { echo $Erreur; } ?></b>
</div>
</body>
</html>