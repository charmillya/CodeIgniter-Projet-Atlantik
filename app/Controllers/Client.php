<?php

namespace App\Controllers;
use App\Models\ModeleClient;
use App\Models\ModeleLiaison;
use App\Models\ModelePeriode;
use App\Models\ModeleCategorie;
use App\Models\ModeleSecteur;
use App\Models\ModeleType;
use App\Models\ModeleTraversee;

helper(['assets']); // donne accès aux fonctions du helper 'asset'

class Client extends BaseController
{
    public function ReserverTraversee($noTraversee)
    {
        $session = session();

        $modTraversee = new ModeleTraversee();
        $data['nomLiaisonSelected'] = $modTraversee->where('traversee.notraversee', $noTraversee)->GetLiaisonFromTraversee();
        $data['traverseeSelected'] = $modTraversee->where('traversee.notraversee', $noTraversee)->first();

        $modPeriode = new ModelePeriode();
        $data['noPeriodeTraversee'] = $modPeriode->GetPeriodePourTraversee($noTraversee);

        $modType = new ModeleType();
        $noLiaisonSelected = $modTraversee->where('traversee.notraversee', $noTraversee)->first();
        $data['typesTarifs'] = $modType->GetTypesTarifs($noLiaisonSelected->NOLIAISON, $data['noPeriodeTraversee']->noperiode);

        if (!$this->request->is('post')) {
            if(!isset ($session->mel)) {
                $_SESSION['reservationNoTraversee'] = $noTraversee;
                return redirect()->to(site_url('/connexion'));
            }

            $data['TitreDeLaPage'] = "Atlantik - Réservation";
            return view('Templates/Header', $data)
            . view('Client/vue_reserver_traversee', $data)
            . view('Templates/Footer');
        }

        $totalQuantite = 0;
        foreach($data['typesTarifs'] as $unTypeTarif) { // check quantité > 0 & dispo bdd
            $tabInfoLettre = $this->request->getPost('tabInfoLettre');
            $tabInfoType = $this->request->getPost('tabInfoType');
            $quantiteSaisie = $this->request->getPost($unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE); // on récupère l'input saisi pr chaque typetarif
            // grâce à son nom (catégorie + type)
            $totalQuantite += $quantiteSaisie;

            if($quantiteSaisie > $modTraversee->GetCapaciteMaximale($noTraversee, $unTypeTarif->LETTRECATEGORIE)-$modTraversee->GetQuantiteEnregistreeLettre($noTraversee, $unTypeTarif->LETTRECATEGORIE)) {
            // si quantité saisie pour ce type est > à la quantité max - enregistrée pour la catégorie (mais du coup il faudrait faire un total pr chaque catégorie plutôt?? si le total excède)
                $data['TitreDeLaPage'] = "Atlantik - Erreur de réservation";
                $data['Erreur'] = "Il n'y a pas assez de places restantes pour ".$unTypeTarif->LIBELLE.".";
                return redirect()->to(site_url('/traversees/reserver/'.$noTraversee));
            }

        }
        if($totalQuantite <= 0) {
            $data['TitreDeLaPage'] = "Atlantik - Erreur de réservation";
            $data['Erreur'] = "Saisie incorrecte : vous devez réserver au minimum 1 billet.";
            return redirect()->to(site_url('/traversees/reserver/'.$noTraversee));
        }

        // maintenant redirection vers confirmation puislà-bas ajout si validé par user

    }

}