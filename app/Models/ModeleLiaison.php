<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleLiaison extends Model
{
    protected $table = 'liaison'; // nom de la table mappée

    protected $primaryKey = 'NOLIAISON'; // clé primaire
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['NOPORT_DEPART', 'NOPORT_ARRIVEE', 'DISTANCE'];

    public function getLiaisonsParSecteur()
    {
        return $this->join('secteur', 'liaison.NOSECTEUR = secteur.NOSECTEUR', 'inner')
            ->join('port AS portdepart', 'portdepart.noport = liaison.NOPORT_DEPART',  'inner')
            ->join('port AS portarrivee', 'portarrivee.noport = liaison.NOPORT_ARRIVEE',  'inner')
            ->select('secteur.NOM AS secteurNom, liaison.NOLIAISON, liaison.DISTANCE, portdepart.nom AS portdepart, portarrivee.nom AS portarrivee')
            ->get()
            ->getResult();
    }

} // Fin Classe