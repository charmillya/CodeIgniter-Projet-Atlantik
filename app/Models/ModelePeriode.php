<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelePeriode extends Model
{
    protected $table = 'periode'; // nom de la table mappée

    protected $primaryKey = 'NOPERIODE'; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['DATEDEBUT', 'DATEFIN'];

    public function GetPeriodesPourLiaison() {
        return $this->join('tarifer', 'tarifer.NOPERIODE = periode.NOPERIODE', 'inner')
        ->join('liaison', 'tarifer.NOLIAISON = liaison.NOLIAISON',  'inner')
        ->select('DISTINCT(datedebut) AS DATEDEBUT, datefin AS DATEFIN')
        ->get()
        ->getResult();
    }

    public function GetNbPeriodesPourLiaison() {
        return $this->join('tarifer', 'tarifer.NOPERIODE = periode.NOPERIODE', 'inner')
        ->join('liaison', 'tarifer.NOLIAISON = liaison.NOLIAISON',  'inner')
        ->select('COUNT(liaison.noliaison) AS nbperiodes')
        ->first();
    }

    public function GetPeriodePourTraversee($noTraversee) {
        $requete = $this->db->query('SELECT DATE(dateheuredepart) as dateheuredepart FROM traversee WHERE notraversee = '.$noTraversee);
        $dateDepart = $requete->getResult();
        $dateDepart = $dateDepart[0]->dateheuredepart;
        return $this->where('datedebut < ',$dateDepart)
        ->where('datefin > ',$dateDepart)
        ->select('periode.noperiode')
        ->first();
    }
    
} // Fin Classe