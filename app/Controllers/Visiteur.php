<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModeleClient;
use App\Models\ModeleLiaison;
use App\Models\ModelePeriode;
use App\Models\ModeleCategorie;
use App\Models\ModeleReservation;
use App\Models\ModeleSecteur;
use App\Models\ModeleTraversee;

helper(['assets']); // donne accès aux fonctions du helper 'asset'

class Visiteur extends BaseController
{
    use ResponseTrait;

    // php 8.2.12
    public function Accueil()
    {
        $session = session();
        $data['TitreDeLaPage'] = "Atlantik - Accueil";
        echo view('Templates/Header.php', $data) . view('Visiteur/vue_accueil') . view('Templates/Footer.php');
    }

    public function SeConnecter()
    {
        helper(['form']);
        $session = session();
        $data['Erreur'] = "";

        $data['TitreDeLaPage'] = 'Atlantik - Connexion';

        if (!$this->request->is('post')) {
            return view('Templates/Header', $data) // Renvoi formulaire de connexion
            . view('Visiteur/vue_connexion')
            . view('Templates/Footer');
        }

        $reglesValidation = [ // Régles de validation
            'txtIdentifiant' => 'required|valid_email',
            'txtMotDePasse' => 'required',
        ];
        if (!$this->validate($reglesValidation)) {

            $data['Erreur'] = "Saisie incorrecte / veuillez remplir tous les champs.";
            return view('Templates/Header', $data)
            . view('Visiteur/vue_connexion', $data) // Renvoi formulaire de connexion
            . view('Templates/Footer');
        }


        $Identifiant = $this->request->getPost('txtIdentifiant');
        $MdP = $this->request->getPost('txtMotDePasse');

        $modClient = new ModeleClient(); // instanciation modèle

        $condition = ['MEL'=>$Identifiant];
        $clientRetourne = $modClient->where($condition)->first();
 
        if ($clientRetourne != null && password_verify($MdP, $clientRetourne->MOTDEPASSE)) {

            $session->set('numero', $clientRetourne->NOCLIENT);
            $session->set('mel', $clientRetourne->MEL);
            $session->set('nom', $clientRetourne->NOM);
            $session->set('prenom', $clientRetourne->PRENOM);
            $session->set('adresse', $clientRetourne->ADRESSE);
            $session->set('codepostal', $clientRetourne->CODEPOSTAL);
            $session->set('ville', $clientRetourne->VILLE);
            $session->set('telfixe', $clientRetourne->TELEPHONEFIXE);
            $session->set('telmobile', $clientRetourne->TELEPHONEMOBILE);

            if(isset($_SESSION["reservationNoTraversee"])) {
                $data['TitreDeLaPage'] = "Atlantik - Réservation";
                return redirect()->to(site_url('/traversees/reserver/'.$_SESSION["reservationNoTraversee"]));
            } else {
                $data['TitreDeLaPage'] = "Atlantik - Accueil";
                return redirect()->to('/'); // Redirection vers la page d'accueil
            }

        } else {

            $data['Erreur'] = "Identifiant et/ou mot de passe inconnu.s !";
            return view('Templates/Header', $data)
            . view('Visiteur/vue_connexion', $data)
            . view('Templates/Footer');
        }
    }

    public function CreerUnCompte()
    {
        helper(['form']);
        $session = session();
        $data['Erreur'] = "";

        $data['TitreDeLaPage'] = 'Atlantik - Créer un compte';

        if (!$this->request->is('post')) {
            return view('Templates/Header', $data) // Renvoi formulaire de connexion
            . view('Visiteur/vue_creer_compte')
            . view('Templates/Footer');
        }

        $reglesValidation = [ // Régles de validation
            'txtIdentifiant' => 'required|valid_email',
            'txtMotDePasse' => 'required|string',
            'txtNom' => 'required|string',
            'txtPrenom' => 'required|string',
            'txtAdresse' => 'required|string',
            'txtCodePostal' => 'required|alpha_numeric|exact_length[5]',
            'txtVille' => 'required|string',
            'txtTelFixe' => 'permit_empty|alpha_numeric|exact_length[10]',
            'txtTelMobile' => 'permit_empty|alpha_numeric|exact_length[10]',
        ];
        if (!$this->validate($reglesValidation)) {

            $data['Erreur'] = "Saisie incorrecte / veuillez remplir tous les champs.";
            return view('Templates/Header', $data)
            . view('Visiteur/vue_creer_compte', $data)
            . view('Templates/Footer');
        }

        if ($this->request->getPost('txtTelFixe') != null) {
            $TelFixe = $this->request->getPost('txtTelFixe');
        } else {
            $TelFixe = null;
        }
        if ($this->request->getPost('txtTelMobile') != null) {
            $TelMobile = $this->request->getPost('txtTelMobile');
        } else {
            $TelMobile = null;
        }

        $donneesAInserer = array(
            'MEL' => $this->request->getPost('txtIdentifiant'),
            'MOTDEPASSE' => password_hash($this->request->getPost('txtMotDePasse'), PASSWORD_ARGON2I),
            'NOM' => $this->request->getPost('txtNom'),
            'PRENOM' => $this->request->getPost('txtPrenom'),
            'ADRESSE' => $this->request->getPost('txtAdresse'),
            'CODEPOSTAL' => $this->request->getPost('txtCodePostal'),
            'VILLE' => $this->request->getPost('txtVille'),
            'TELFIXE' => $TelFixe,
            'TELMOBILE' => $TelMobile,
        );

        $modClient = new ModeleClient(); // instanciation modèle
        $data['clientAjoute'] = $modClient->insert($donneesAInserer, false);
        
        if ($data['clientAjoute'] == 1) {
            $data['TitreDeLaPage'] = "Atlantik - Connexion";
            return view('Templates/Header', $data)
            .view('Visiteur/vue_connexion', $data)
            .view('Templates/Footer');
        } else {
            $data['Erreur'] = "Erreur lors de l'ajout.";
            return view('Templates/Header', $data)
            .view('Visiteur/vue_creer_compte', $data)
            .view('Templates/Footer');
        }

    }

    public function SeDeconnecter()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function AfficherLesLiaisons() {
        
        $session = session();
        $data['TitreDeLaPage'] = "Atlantik - Liaisons par secteur";

        $modLiaison = new ModeleLiaison(); // instanciation modèle
        $data['lesLiaisons'] = $modLiaison->GetLiaisonsParSecteur();

        return view('Templates/Header', $data)
        .view('Visiteur/vue_afficher_liaisons', $data)
        .view('Templates/Footer');
    }

    public function AfficherLesTarifs($liaison) {
        
        $session = session();
        $data['TitreDeLaPage'] = "Atlantik - Tarifs pour une liaison";

        $condition = ['liaison.noliaison'=>$liaison];

        $modLiaison = new ModeleLiaison();
        $data['lesTarifs'] = $modLiaison->where($condition)->GetTarifsPourLiaison();

        $data['liaisonCourante'] = $modLiaison->where($condition)->GetLiaisonCourante();

        $modCategorie = new ModeleCategorie();
        $data['nbTypes'] = $modCategorie->GetNbTypes();

        $modPeriode = new ModelePeriode();
        $data['periodesPourLiaison'] = $modPeriode->where($condition)->GetPeriodesPourLiaison();
        $data['nbPeriodes'] = $modPeriode->where($condition)->GetNbPeriodesPourLiaison();

        return view('Templates/Header', $data)
        .view('Visiteur/vue_afficher_tarifs', $data)
        .view('Templates/Footer');
    }

    public function AfficherLesTraversees($noSecteur) {
        $session = session();
        $data['TitreDeLaPage'] = "Atlantik - Traversées";

        $modSecteur = new ModeleSecteur();
        $data['lesSecteurs'] = $modSecteur->findAll();

        $condition = ['liaison.nosecteur'=>$noSecteur];
        $modLiaison = new ModeleLiaison();
        $data['liaisonsSecteurCourant'] = $modLiaison->where($condition)->GetLiaisonsParSecteur();

        if (!$this->request->is('post')) {
            return view('Templates/Header', $data)
            .view('Visiteur/vue_afficher_traversees', $data)
            .view('Templates/Footer');
        }

        $data['noLiaisonSelected'] = $this->request->getPost('liaisons');
        $data['dateSelected'] = $this->request->getPost('date');

        $data['nomLiaisonSelected'] = $modLiaison->where('noliaison', $data['noLiaisonSelected'])->GetLiaisonCourante();

        $modCategorie = new ModeleCategorie();
        $data['lesCategories'] = $modCategorie->findAll();

        $condition = ['traversee.noliaison'=>$data['noLiaisonSelected'], 'DATE(traversee.dateheuredepart)'=>$data['dateSelected']];
        $modTraversee = new ModeleTraversee();
        $data['lesTraversees'] = $modTraversee->where($condition)->GetTraverseesBateaux();

        $tabTraversees = array();

        foreach($data['lesTraversees'] as $uneTraversee) {
            $traverseeCourante = array();
            $traverseeCourante['NOTRAVERSEE'] = $uneTraversee->NOTRAVERSEE;
            $traverseeCourante['DATEHEUREDEPART'] = date('H:i', strtotime($uneTraversee->DATEHEUREDEPART));
            $traverseeCourante['NOM'] = $uneTraversee->NOM;
            foreach($data['lesCategories'] as $uneCategorie) {
                $quantiteEnregistree = $modTraversee->GetQuantiteEnregistreeLettre($uneTraversee->NOTRAVERSEE, $uneCategorie->LETTRECATEGORIE);

                $quantiteMaximale = $modTraversee->GetCapaciteMaximale($uneTraversee->NOTRAVERSEE, $uneCategorie->LETTRECATEGORIE); 

                $traverseeCourante[$uneCategorie->LETTRECATEGORIE] = $quantiteMaximale->CAPACITEMAX-$quantiteEnregistree->QUANTITEENREGISTREE;
            }
            $tabTraversees[] = $traverseeCourante;
        }

        $data['tabTraversees'] = $tabTraversees;

        return view('Templates/Header', $data)
        .view('Visiteur/vue_afficher_traversees', $data)
        .view('Templates/Footer');

    }
}
