<?php

namespace App\Controllers;
helper(['assets']); // donne accès aux fonctions du helper 'asset'

class Visiteur extends BaseController
{
    public function accueil()
    {
        $data['TitreDeLaPage'] = "Atlantik - Accueil";
        echo view('Templates/Header.php', $data) . view('Visiteur/vue_accueil') . view('Templates/Footer.php');
    }
}
