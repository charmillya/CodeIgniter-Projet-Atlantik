<div class="text-center">
<style>
    body {background-color: #242424;}
</style>
<?php 
echo "<br>";
echo '<text class="text-light">';
echo '<h4><b>Créer un compte Atlantik</b></h4>';
echo "<br><br>";

echo form_open('creercompte');
echo csrf_field(); ?>
<label for="txtIdentifiant">Adresse e-mail <span class="text-danger">*</span></label>
<br>
<input class="connexionInput" type="input" name="txtIdentifiant" value="<?php echo set_value('txtIdentifiant'); ?>" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" title="L'adresse e-mail doit être valide"><br>
<br>

<label for="txtMotDePasse">Mot de passe <span class="text-danger">*</span></label>
<br>
<input class="connexionInput" type="password" name="txtMotDePasse" value="<?php echo set_value('txtMotDePasse'); ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
title="Le mot de passe doit contenir au moins 8 caractères dont un chiffre, une lettre majuscule et une lettre minuscule" /><br />
<br>

<label for="txtNom">Nom <span class="text-danger">*</span></label>
<br>
<input class="connexionInput" type="input" name="txtNom" value="<?php echo set_value('txtNom'); ?>" /><br />
<br>

<label for="txtPrenom">Prénom <span class="text-danger">*</span></label>
<br>
<input class="connexionInput" type="input" name="txtPrenom" value="<?php echo set_value('txtPrenom'); ?>" /><br />
<br>

<label for="txtAdresse">Adresse <span class="text-danger">*</span></label>
<br>
<input class="connexionInput" type="input" name="txtAdresse" value="<?php echo set_value('txtAdresse'); ?>" /><br />
<br>

<label for="txtCodePostal">Code postal <span class="text-danger">*</span></label>
<br>
<input class="connexionInput" type="input" name="txtCodePostal" value="<?php echo set_value('txtCodePostal'); ?>" /><br />
<br>

<label for="txtVille">Ville <span class="text-danger">*</span></label>
<br>
<input class="connexionInput" type="input" name="txtVille" value="<?php echo set_value('txtVille'); ?>" /><br />
<br>

<label for="txtTelFixe">Tel. fixe</label>
<br>
<input class="connexionInput" type="input" name="txtTelFixe" value="<?php echo set_value('txtTelFixe'); ?>" /><br />
<br>

<label for="txtTelMobile">Tel. mobile</label>
<br>
<input class="connexionInput" type="input" name="txtTelMobile" value="<?php echo set_value('txtTelMobile'); ?>" /><br />
<br><br>
<p class="text-danger">* Champs obligatoires</p>
<br><br>
<div class="connexionBtn">
<a href="connexion" class="btn btn-light">Me connecter</a>
<input class="btn btn-light" type="submit" name="submit" value="Créer un compte"/>
</div>
<? echo form_close(); ?>

<br><br>
<b><?php if ($Erreur != "") { echo $Erreur; } ?></b>
</div>
</body>
</html>