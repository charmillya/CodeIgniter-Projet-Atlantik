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
        <h6>Veuillez sélectionner la liaison et la date souhaitée.</h6>
        <br>
        <?php if ($liaisonsSecteurCourant != null) { ?>
            <form method="post" action="/traversees">
                <select class="btn btn-light" name="liaisons" id="liaisons">
                    <?php 
                    foreach($liaisonsSecteurCourant as $uneLiaison) {
                        echo '<option value="'.$uneLiaison->NOLIAISON.'">'.$uneLiaison->portdepart.' - '.$uneLiaison->portarrivee.'</option>';
                    }
                    ?>
                </select>
                <input style="margin-left: 1em;" class="btn btn-light" type="date" id="date" name="date">
            </form>


        <?php } else { ?>
            <h6><b>Ce secteur ne comporte pas de liaisons.</b></h6>
        <?php }; ?>
    </div>
    
</div>

<br><br>