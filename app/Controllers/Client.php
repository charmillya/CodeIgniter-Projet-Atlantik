<?php

namespace App\Controllers;
use App\Models\ModeleClient;
use App\Models\ModeleLiaison;
use App\Models\ModelePeriode;
use App\Models\ModeleCategorie;
use App\Models\ModeleSecteur;
use App\Models\ModeleType;
use App\Models\ModeleTraversee;
use App\Models\ModeleEnregistrer;
use App\Models\ModeleReservation;
use Exception;

helper(['assets']); // donne accès aux fonctions du helper 'asset'

class Client extends BaseController
{
    public function ReserverTraversee($noTraversee)
    {
        $session = session();
        $_SESSION['tabReservationEntree'] = array(); // reset du tableau de réservation pour éviter que des quantités d'une ancienne confirmation de réservation annulée restent

        $modTraversee = new ModeleTraversee();
        $data['nomLiaisonSelected'] = $modTraversee->where('traversee.notraversee', $noTraversee)->GetLiaisonFromTraversee();
        $data['traverseeSelected'] = $modTraversee->where('traversee.notraversee', $noTraversee)->first();

        $modPeriode = new ModelePeriode();
        $data['noPeriodeTraversee'] = $modPeriode->GetPeriodePourTraversee($noTraversee);

        $modType = new ModeleType();
        $noLiaisonSelected = $modTraversee->where('traversee.notraversee', $noTraversee)->first();
        $data['typesTarifs'] = $modType->GetTypesTarifs($noLiaisonSelected->NOLIAISON, $data['noPeriodeTraversee']->noperiode);

        foreach($data['typesTarifs'] as $unTypeTarif) { // chargement en priorité du tableau des quantités dispo pour éviter qu'il soit incomplet en cas d'erreur de saisie (return)
            $data['quantiteDispoCategorie'][$unTypeTarif->LETTRECATEGORIE] = $modTraversee->GetCapaciteMaximale($noTraversee, $unTypeTarif->LETTRECATEGORIE)->CAPACITEMAX-$modTraversee->GetQuantiteEnregistreeLettre($noTraversee, $unTypeTarif->LETTRECATEGORIE)->QUANTITEENREGISTREE;
        }

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
        $totalQuantitePourCategorie = 0; // initialisation à 0 pour le premier check
        $lettreCategorieCourante = $data['typesTarifs'][0]->LETTRECATEGORIE; // initialisation à vide pour le premier check

        foreach($data['typesTarifs'] as $unTypeTarif) { // check quantité > 0 & dispo bdd

            $quantiteSaisie = $this->request->getPost($unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE); // on récupère l'input saisi pr chaque typetarif
            // grâce à son nom (catégorie + type)
            $totalQuantite += $quantiteSaisie;

            if($quantiteSaisie > $data['quantiteDispoCategorie'][$unTypeTarif->LETTRECATEGORIE]) {
            // si quantité saisie pour ce type est > à la quantité max - enregistrée pour la catégorie (mais du coup il faudrait faire un total pr chaque catégorie plutôt?? si le total excède)
                $data['TitreDeLaPage'] = "Atlantik - Erreur de réservation";
                $data['Erreur'] = "Il n'y a pas assez de places restantes pour le type ".$unTypeTarif->LIBELLETYPE.".";
                return view('Templates/Header', $data)
                . view('Client/vue_reserver_traversee', $data)
                . view('Templates/Footer');
            }
            // check ds un premier temps pr chaque input du form afin de pouvoir donner le libellé qui bloque si erreur. si tout est bon, on check pour la catégorie entière

            if($unTypeTarif->LETTRECATEGORIE == $lettreCategorieCourante) { // si on est tjrs sur la même cat
                $totalQuantitePourCategorie += $quantiteSaisie;
            } else {
                $totalQuantitePourCategorie = $quantiteSaisie; // reset du total si on change de catégorie
            }

            if ($totalQuantitePourCategorie > $data['quantiteDispoCategorie'][$unTypeTarif->LETTRECATEGORIE]) {
                $data['TitreDeLaPage'] = "Atlantik - Erreur de réservation";
                $data['Erreur'] = "Il n'y a pas assez de places disponibles pour la catégorie ".$unTypeTarif->LIBELLECATEGORIE.".";
                return view('Templates/Header', $data)
                . view('Client/vue_reserver_traversee', $data)
                . view('Templates/Footer');            
            }

            $lettreCategorieCourante = $unTypeTarif->LETTRECATEGORIE;
            
            if ($this->request->getPost($unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE) > 0) { 
            // on met dans un tableau les quantités demandées pour lettre & type correspondants mais que si > 0 (uniquement les champs qu'on va insert)
                $_SESSION['tabReservationEntree'][$unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE] = $this->request->getPost($unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE);
            }

        }
        if($totalQuantite <= 0) {
            $data['TitreDeLaPage'] = "Atlantik - Erreur de réservation";
            $data['Erreur'] = "Saisie incorrecte : vous devez réserver au minimum 1 billet.";
            return view('Templates/Header', $data)
            . view('Client/vue_reserver_traversee', $data)
            . view('Templates/Footer');        
        }

        return redirect()->to(site_url('/traversees/reserver/'.$noTraversee.'/confirmer'));

        // maintenant redirection vers confirmation puislà-bas ajout si validé par user

    }


    public function ConfirmerReservation($noTraversee) {
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

            if(!isset ($session->mel)) { //redirection vers la page pour saisir ses quantités et non confirmer la réservation (l'user n'a rien saisi)
                $_SESSION['reservationNoTraversee'] = $noTraversee;
                return redirect()->to(site_url('/connexion'));
            }

            $data['tabReservationEntree'] = $_SESSION['tabReservationEntree'];

            //var_dump($_SESSION['tabReservationEntree']);
            //die(); // pour voir le contenu des réservations de l'user

            $data['TitreDeLaPage'] = "Atlantik - Récapitulatif de réservation";
            return view('Templates/Header', $data)
            . view('Client/vue_recap_reservation', $data)
            . view('Templates/Footer');

        }

        $modReservation = new ModeleReservation();
        $modEnregistrer = new ModeleEnregistrer();

        $montantTotal = 0;
        foreach($data['typesTarifs'] as $unTypeTarif) {
            if(isset($_SESSION['tabReservationEntree'][$unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE])) {
                $montantTotal += $unTypeTarif->TARIF*$_SESSION['tabReservationEntree'][$unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE];
            }
        }

        try {
            if($this->request->getPost('moyenPaiement') == 'CB') {
                $modeReglement = 'CB';
                $statutPaiement = 1; // en attendant de faire paybox
            } else {
                $modeReglement = 'ESPECES';
                $statutPaiement = 0;
            }
            $data['noReservationSelected'] = $modReservation->insert([
                'NOTRAVERSEE' => $noTraversee,
                'NOCLIENT' => $_SESSION['numero'],
                'DATEHEURE' => date('Y-m-d H:i:s'),
                'MONTANTTOTAL' => $montantTotal,
                'PAYE' => $statutPaiement,
                'MODEREGLEMENT' => $modeReglement // par défaut
            ]);

            foreach($data['typesTarifs'] as $unTypeTarif) { 
                if(isset($_SESSION['tabReservationEntree'][$unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE])) { // pour chaque type, si l'user a réservé au - un billet de celle-ci
                    $modEnregistrer->insert([ // on insert dans la bdd
                        'NORESERVATION' => $data['noReservationSelected'],
                        'LETTRECATEGORIE' => $unTypeTarif->LETTRECATEGORIE,
                        'NOTYPE' => $unTypeTarif->NOTYPE,
                        'QUANTITERESERVEE' => $_SESSION['tabReservationEntree'][$unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE],
                        'QUANTITEEMBARQUEE' => 0
                    ], false);
                }

            }
        } catch (Exception $e) {
            $data['erreur'] = "Un problème est survenu lors de l'enregistrement de votre réservation. Veuillez réessayer.";
        }


        try {            
            $to = $_SESSION['mel'];
            $subject = "Votre réservation chez Atlantik";

            $txt = "Bonjour ".$_SESSION['prenom'].",\n\nNous vous confirmons votre réservation <b>n°".$data['noReservationSelected']."</b> 
            pour la traversée <b>n°".$data['traverseeSelected']->NOTRAVERSEE."</b> du <b>".date('d/m/Y', strtotime($data['traverseeSelected']->DATEHEUREDEPART))."</b>.
            \n\n<b><i>Détail de votre réservation:</i></b> \n";

            foreach($data['typesTarifs'] as $unTypeTarif) {
                if(isset($_SESSION['tabReservationEntree'][$unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE])) {
                    $txt .= $unTypeTarif->LIBELLECATEGORIE." - ".$unTypeTarif->LIBELLETYPE." : <b>".$_SESSION['tabReservationEntree'][$unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE]."</b> (".$unTypeTarif->TARIF*$_SESSION['tabReservationEntree'][$unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE]."€)\n";
                }
            }

            $txt .= "\n\nLe montant total de votre réservation est de <b>".$montantTotal."€</b>.\n\nNous vous remercions pour votre confiance et vous souhaitons un agréable voyage.
            \n\n<i>L'équipe Atlantik.</i>";

            $headers = "From: noreply.atlantik@gmail.com";
            mail($to,$subject,$txt,$headers);
            $data['txtEnvoiMail'] = "Un mail de confirmation vous a été envoyé à l'adresse suivante : ".$_SESSION['mel'];
        } catch (Exception $e) {
            $data['txtEnvoiMail'] = "Un problème est survenu lors de l'envoi du mail de confirmation. Veuillez vérifier votre adresse mail.";
        }

        if($this->request->getPost('moyenPaiement') == 'ESPECES') {
            $data['TitreDeLaPage'] = "Atlantik - Confirmation de réservation"; 
            $data['infoPaiement'] = "Vous avez choisi de régler en espèces. Merci de vous présenter à l'accueil pour finaliser votre réservation.";
            return view('Templates/Header', $data)
            . view('Client/vue_confirmation_reservation', $data)
            . view('Templates/Footer');
        } else {
            $data['TitreDeLaPage'] = "Atlantik - Paiement en ligne"; 
            return view('Templates/Header', $data)
            . view('Client/vue_paiement_reservation', $data)
            . view('Templates/Footer');
        }

    }

    public function ModifierInfosCompte() {
        $session = session();

        if (!$this->request->is('post')) {
            if(!isset ($session->mel)) {
                return redirect()->to(site_url('/connexion'));
            }

            $data['TitreDeLaPage'] = "Atlantik - Modifier mes informations"; 
            return view('Templates/Header', $data)
            . view('Client/vue_modifier_infos_compte', $data)
            . view('Templates/Footer');
        }

        if($this->request->getPost('txtAdresse') == null || $this->request->getPost('txtCodePostal') == null || $this->request->getPost('txtVille') == null) {
            $data['erreur'] = "Veuillez remplir tous les champs.";
            $data['TitreDeLaPage'] = "Atlantik - Modifier mes informations";
            return view('Templates/Header', $data)
            . view('Client/vue_modifier_infos_compte', $data)
            . view('Templates/Footer');
        }

        $reglesValidation = [ // Régles de validation
            'txtAdresse' => 'required|string',
            'txtCodePostal' => 'required|alpha_numeric|exact_length[5]',
            'txtVille' => 'required|string',
            'txtTelFixe' => 'permit_empty|alpha_numeric|exact_length[10]',
            'txtTelMobile' => 'permit_empty|alpha_numeric|exact_length[10]',
        ];
        if (!$this->validate($reglesValidation)) {

            $data['TitreDeLaPage'] = "Atlantik - Erreur de modification";
            $data['erreur'] = "Saisie incorrecte / veuillez remplir tous les champs.";
            return view('Templates/Header', $data)
            . view('Client/vue_modifier_infos_compte', $data)
            . view('Templates/Footer');
        }

        if($this->request->getPost('txtTelFixe') != null) {
            $_SESSION['telfixe'] = $this->request->getPost('txtTelFixe');
        }
        if($this->request->getPost('txtTelMobile') != null) {
            $_SESSION['telmobile'] = $this->request->getPost('txtTelMobile');
        }

        $modClient = new ModeleClient();
        try {
            $modClient->where('NOCLIENT', $_SESSION['numero'])->set([
                'ADRESSE' => $this->request->getPost('txtAdresse'),
                'CODEPOSTAL' => $this->request->getPost('txtCodePostal'),
                'VILLE' => $this->request->getPost('txtVille'),
                'TELEPHONEFIXE' => $this->request->getPost('txtTelFixe'),
                'TELEPHONEMOBILE' => $this->request->getPost('txtTelMobile')
            ])->update();
        } catch (Exception $e) {
            $data['erreur'] = "Un problème est survenu lors de la modification de vos informations. Veuillez réessayer.";
        }

        $data['TitreDeLaPage'] = "Atlantik - Modifier mes informations";
        $data['informationsModifiees'] = true;
        return view('Templates/Header', $data)
        . view('Client/vue_modifier_infos_compte', $data)
        . view('Templates/Footer');
    }

    public function AfficherLesCommandes() {
        $session = session();

        $modReservation = new ModeleReservation();
        $data['commandesClient'] = $modReservation->GetCommandesClient($_SESSION['numero']);
        $data['pager'] = $modReservation->pager; // passer l'objet pager à la vue

        $data['TitreDeLaPage'] = "Atlantik - Commandes";
        return view('Templates/Header', $data)
        . view('Client/vue_afficher_commandes', $data)
        . view('Templates/Footer');
    }

}