<?php

namespace App\Controllers;
use App\Models\ModeleClient;
helper(['assets']); // donne accès aux fonctions du helper 'asset'

class Visiteur extends BaseController
{
    public function accueil()
    {
        $session = session();
        $data['TitreDeLaPage'] = "Atlantik - Accueil";
        echo view('Templates/Header.php', $data) . view('Visiteur/vue_accueil') . view('Templates/Footer.php');
    }

    public function seConnecter()
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

            $data['Erreur'] = "Saisie incorrecte !";
            return view('Templates/Header', $data)
            . view('Visiteur/vue_connexion', $data) // Renvoi formulaire de connexion
            . view('Templates/Footer');
        }


        $Identifiant = $this->request->getPost('txtIdentifiant');
        $MdP = $this->request->getPost('txtMotDePasse');
        $MdP_Hash = password_hash($MdP, PASSWORD_ARGON2I);

        $modClient = new ModeleClient(); // instanciation modèle

        $condition = ['MEL'=>$Identifiant];
        $clientRetourne = $modClient->where($condition)->first();
 
        if ($clientRetourne != null && password_verify($MdP, $clientRetourne->MOTDEPASSE)) {

            $session->set('mel', $clientRetourne->MEL);
            $session->set('nom', $clientRetourne->NOM);
            $session->set('prenom', $clientRetourne->PRENOM);

            $data['TitreDeLaPage'] = "Atlantik - Accueil";
            return redirect()->to('/'); // Redirection vers la page d'accueil
        } else {

            $data['Erreur'] = "Identifiant et/ou mot de passe inconnu.s !";
            return view('Templates/Header', $data)
            . view('Visiteur/vue_connexion', $data)
            . view('Templates/Footer');
        }
    }

    public function creerUnCompte()
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
    }

    public function seDeconnecter()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
