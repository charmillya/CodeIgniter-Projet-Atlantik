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

    public function GetQuantiteEnregistree() {
        return $this->join('reservation', 'traversee.NOTRAVERSEE = reservation.NOTRAVERSEE', 'inner')
        ->join('enregistrer', 'enregistrer.NORESERVATION = reservation.NORESERVATION', 'inner')
        ->select('COALESCE(SUM(quantitereservee), 0) AS QUANTITEENREGISTREE')
        ->first();
    }

    public function GetCapaciteMaximale() {
        return $this->join('bateau', 'traversee.NOBATEAU = bateau.NOBATEAU', 'inner')
        ->join('contenir', 'bateau.NOBATEAU = contenir.NOBATEAU', 'inner')
        ->select('capacitemax as CAPACITEMAX')
        ->first();
    }

} // Fin Classe