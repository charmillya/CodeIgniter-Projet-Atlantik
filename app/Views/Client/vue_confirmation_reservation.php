<?php if(!isset($erreur)) { ?>

    <div class="text-light divRounded text-center">
    <h2><b>Confirmation de réservation</b></h2>
    </div>

    <br><br><br>

    <div class="text-light text-center divReservation">
        <br>
        <div class="text-light text-center divInfosReservation">
                <?php
                echo '<h6>Réservation enregistrée sous le n°<b>'.$noReservationSelected.' ! </b></h6>';
                echo '<h6>'.$txtEnvoiMail.'</h6>';
                if(isset($infoPaiement)) {
                    echo '<h6><i>'.$infoPaiement.'</i></h6>';
                }
                echo '<h6><a href="confirmer/facture/'.$noReservationSelected.'">Télécharger la facture</a></h6>';
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

<?php } else { ?>

    <div class="text-light divRounded text-center">
    <h2><b>Erreur de réservation</b></h2>
    </div>

    <br><br><br>

    <div class="text-light text-center divReservation">
        <br>
        <div class="text-light text-center divInfosReservation">
                <?php
                echo '<h6>'.$erreur.'</h6>';
                ?>
        </div>
        <br><br>
        <?php
        echo '<a class="btn btn-light" href="/traversees/1">Retour aux traversées</a>';
        ?>
        <br><br>
            

    </div>
    <br><br><br>

<?php } ?>