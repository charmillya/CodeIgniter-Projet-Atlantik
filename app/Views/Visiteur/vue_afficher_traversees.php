<div class="text-light divRounded text-center">
<h2><b>Horaires des traversées</b></h2>
</div>

<br><br><br><br>

<div class="container-fluid parent">
    <div class="divSecteurs child">
        <?php 
        foreach($lesSecteurs as $unSecteur) {
            echo '<a class="btn btn-light" href="/traversees/'.$unSecteur->NOSECTEUR.'">'.$unSecteur->NOM.'</a>';
            if($unSecteur != end($lesSecteurs)) {
                echo '<br><br>';
            }
        }
        ?>
    </div>
    <div class="divTraversees text-center child text-light">
        <h6><i>Veuillez sélectionner la liaison et la date souhaitée.</i></h6>
        <br>
        <?php if ($liaisonsSecteurCourant != null) { // si il y a des liaisons pour ce secteur ?> 
            <form method="post" action="">
                <select class="btn btn-light" name="liaisons" id="liaisons">
                    <?php 
                    foreach($liaisonsSecteurCourant as $uneLiaison) {
                        if(isset ($noLiaisonSelected) && $noLiaisonSelected == $uneLiaison->NOLIAISON) {
                            echo '<option value="'.$uneLiaison->NOLIAISON.'" selected>'.$uneLiaison->portdepart.' - '.$uneLiaison->portarrivee.'</option>';
                        } else {
                            echo '<option value="'.$uneLiaison->NOLIAISON.'">'.$uneLiaison->portdepart.' - '.$uneLiaison->portarrivee.'</option>';
                        }
                    }
                    ?>
                </select>
                <?php if(isset ($dateSelected)) { ?>
                    <input style="margin-left: 1em;" class="btn btn-light" type="date" id="date" name="date" value="<?php echo $dateSelected; ?>">
                <?php } else { ?>
                    <input style="margin-left: 1em;" class="btn btn-light" type="date" id="date" name="date">
                <?php } ?>
                <br><br>
                <input type="submit" class="btn btn-light" name="btnAfficherTraversees" value="Afficher les traversées">
            </form>
            <br>

            <?php if(isset ($dateSelected)) { // si le form a été envoyé ?>
                <h6><b><?php echo $nomLiaisonSelected->portdepart.' - '.$nomLiaisonSelected->portarrivee; ?></b></h6>
                <h6>Traversées pour le <?php echo date('d/m/Y', strtotime($dateSelected));; ?>. Veuillez sélectionner la traversée souhaitée.</h6>

                <br><br>

                <table class="tableLiaisons text-light text-center mx-auto">
                    <tr>
                        <td>N°</td>
                        <td>Heure</td>
                        <td>Bateau</td>
                        <?php 
                        foreach($lesCategories as $uneCategorie) {
                            echo '<td><b>'.$uneCategorie->LETTRECATEGORIE.'</b><br>'.$uneCategorie->LIBELLE.'</td>';
                        }
                        ?>
                    </tr>
                    <?php 
                    foreach($tabTraversees as $uneTraversee) {
                        echo '<tr>';    
                        echo '<td>'.$uneTraversee['NOTRAVERSEE'].'</td>';
                        echo '<td>'.$uneTraversee['DATEHEUREDEPART'].'</td>';
                        echo '<td>'.$uneTraversee['NOM'].'</td>';
                        foreach($lesCategories as $uneCategorie) { // pour chaque catégorie, on affiche l'entrée dans l'array traverséeCourante correspondant à cette lettre
                            echo '<td>'.$uneTraversee[$uneCategorie->LETTRECATEGORIE].'</td>';
                        }
                        echo '</tr>';
                    }
                    ?>
                </table>
                <br>

            <?php } ?>

            <!--à faire: ajouter un get post dans la route et ds Visiteur l'affichge du tableau si on vient en post (envoi formulaire)-->


        <?php } else { ?>
            <h6><b>Ce secteur ne comporte pas de liaisons.</b></h6>
        <?php }; ?>
    </div>
    
</div>

<br><br>