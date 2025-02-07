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

    public function GetLiaisonsParSecteur()
    {
        return $this->join('secteur', 'liaison.NOSECTEUR = secteur.NOSECTEUR', 'inner')
            ->join('port AS portdepart', 'portdepart.noport = liaison.NOPORT_DEPART',  'inner')
            ->join('port AS portarrivee', 'portarrivee.noport = liaison.NOPORT_ARRIVEE',  'inner')
            ->select('secteur.NOM AS secteurNom, liaison.NOLIAISON, liaison.DISTANCE, portdepart.nom AS portdepart, portarrivee.nom AS portarrivee')
            ->get()
            ->getResult();
    }

    public function GetTarifsPourLiaison()
    {
        return $this->join('tarifer', 'tarifer.NOLIAISON = liaison.NOLIAISON', 'inner')
            ->join('type', 'type.LETTRECATEGORIE = tarifer.LETTRECATEGORIE AND type.NOTYPE = tarifer.NOTYPE',  'inner')
            ->join('categorie', 'type.LETTRECATEGORIE = categorie.LETTRECATEGORIE',  'inner')
            ->join('periode', 'periode.NOPERIODE = tarifer.NOPERIODE',  'inner')
            ->join('port AS portdepart', 'portdepart.noport = liaison.NOPORT_DEPART',  'inner')
            ->join('port AS portarrivee', 'portarrivee.noport = liaison.NOPORT_ARRIVEE',  'inner')
            ->where('DATEFIN >=', 'CURDATE()', false)
            ->orderBy('categorie.LETTRECATEGORIE, type.notype, datedebut')
            ->select('liaison.noliaison, portdepart.nom as PORTDEPART, portarrivee.nom as PORTARRIVEE, tarifer.TARIF, categorie.LETTRECATEGORIE, type.NOTYPE, type.LIBELLE as LIBELLETYPE, categorie.LIBELLE as LIBELLECATEGORIE, periode.DATEDEBUT, periode.DATEFIN')
            ->get()
            ->getResult();
    }

    public function GetLiaisonCourante()
    {
        return $this->join('port AS portdepart', 'portdepart.noport = liaison.NOPORT_DEPART',  'inner')
            ->join('port AS portarrivee', 'portarrivee.noport = liaison.NOPORT_ARRIVEE',  'inner')
            ->select('liaison.noliaison, portdepart.nom as portdepart, portarrivee.nom as portarrivee')
            ->first();
    }

} // Fin Classe