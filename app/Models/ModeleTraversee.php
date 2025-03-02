<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleTraversee extends Model
{
    protected $table = 'traversee'; // nom de la table mappée

    protected $primaryKey = 'NOTRAVERSEE'; // clé primaire
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['NOLIAISON', 'NOBATEAU', 'DATEHEUREDEPART', 'DATEHEUREARRIVEE', 'CLOTUREEMBARQUEMENT'];

    public function GetTraverseesBateaux() {
        return $this->join('bateau', 'traversee.NOBATEAU = bateau.NOBATEAU', 'inner')
            ->select('*')
            ->get()
            ->getResult();
    }

    public function GetQuantiteEnregistreeLettre($noTraversee, $lettreCategorie) { // récupère quantité enregistrée pour chaque lettrecatégorie
        return $this->join('reservation', 'traversee.NOTRAVERSEE = reservation.NOTRAVERSEE', 'inner')
        ->join('enregistrer', 'enregistrer.NORESERVATION = reservation.NORESERVATION', 'inner')
        ->where('traversee.notraversee', $noTraversee)
        ->where('enregistrer.lettrecategorie', $lettreCategorie)
        ->select('COALESCE(SUM(quantitereservee), 0) AS QUANTITEENREGISTREE')
        ->first();
    }

    public function GetQuantiteEnregistreeLettreType($noTraversee, $lettreCategorie, $noType) { // récupère quantité enregistrée pour chaque lettrecatégorie et chaque type
        return $this->join('reservation', 'traversee.NOTRAVERSEE = reservation.NOTRAVERSEE', 'inner')
        ->join('enregistrer', 'enregistrer.NORESERVATION = reservation.NORESERVATION', 'inner')
        ->where('traversee.notraversee', $noTraversee)
        ->where('enregistrer.lettrecategorie', $lettreCategorie)
        ->where('enregistrer.notype', $noType)
        ->select('COALESCE(SUM(quantitereservee), 0) AS QUANTITEENREGISTREE')
        ->first();
    }

    public function GetCapaciteMaximale($noTraversee, $lettreCategorie) { // récupère capacité maximale pour chaque lettrecatégorie pour une traversée
        return $this->join('bateau', 'traversee.NOBATEAU = bateau.NOBATEAU', 'inner')
        ->join('contenir', 'bateau.NOBATEAU = contenir.NOBATEAU', 'inner')
        ->where('traversee.notraversee', $noTraversee)
        ->where('contenir.lettrecategorie', $lettreCategorie)
        ->select('capacitemax as CAPACITEMAX')
        ->first();
    }

    public function GetLiaisonFromTraversee() {
        return $this->join('liaison', 'liaison.noliaison = traversee.noliaison',  'inner')
            ->join('port AS portdepart', 'portdepart.noport = liaison.NOPORT_DEPART',  'inner')
            ->join('port AS portarrivee', 'portarrivee.noport = liaison.NOPORT_ARRIVEE',  'inner')
            ->select('liaison.noliaison, portdepart.nom as portdepart, portarrivee.nom as portarrivee')
            ->first();
    }

} // Fin Classe