<div class="text-center">
<style>
    body {background-color: #242424;}
</style>
<?php 
echo "<br>";
echo '<text class="text-light">';
echo '<h4><b>Identifiez-vous ou créez un compte</b></h4>';
echo "<br><br>";

echo form_open('connexion');
echo csrf_field(); ?>
<label for="txtIdentifiant">Adresse e-mail</label>
<br>
<input class="connexionInput" type="input" name="txtIdentifiant" value="<?php echo set_value('txtIdentifiant'); ?>" /><br />
<br>
<label for="txtMotDePasse">Mot de passe</label>
<br>
<input class="connexionInput" type="input" name="txtMotDePasse" value="<?php echo set_value('txtMotDePasse'); ?>" /><br />

<br><br><br>
<div class="connexionBtn">
<a href="creercompte" class="btn btn-light">Créer un compte</a>
<input class="btn btn-light" type="submit" name="submit" value="Connexion"/>
</div>
<? echo form_close(); ?>

<br><br>
<b><?php if ($Erreur != "") { echo $Erreur; } ?></b>
</div>
</body>
</html>