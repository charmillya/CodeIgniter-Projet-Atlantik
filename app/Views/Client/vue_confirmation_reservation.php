<div class="text-light divRounded text-center">
<h2><b>Confirmation de réservation</b></h2>
</div>

<br><br><br>

<div class="text-light text-center divReservation">
    <br>
    <div class="text-light text-center divInfosReservation">
            <?php
            echo '<h6>Réservation enregistrée sous le n°<b>'.$noReservationSelected.' ! </b></h6>';
            echo '<h6><i>Vous allez recevoir un mail de confirmation à l\'adresse suivante : </i><u class="text-info"><b>'.$_SESSION['mel'].'</b></u></h6>';
            ?>
    </div>
    <br><br>
    <div class="connexionBtn">
        <?php
        echo '<a class="btn btn-light" href="/traversees/1">Retour aux traversées</a>';
        echo '<a class="btn btn-light" href="/compte/commandes">Consulter mes commandes</a>';
        ?>
    </div>
    <br><br>
</div>
<br><br><br>