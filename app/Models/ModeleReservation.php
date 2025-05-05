<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleReservation extends Model
{
    protected $table = 'reservation'; // nom de la table mappée

    protected $primaryKey = 'NORESERVATION'; // clé primaire
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['NOTRAVERSEE', 'NOCLIENT', 'DATEHEURE', 'MONTANTTOTAL', 'PAYE', 'MODEREGLEMENT'];

    public function GetCommandesClient($noClient) {
        return $this->join('traversee', 'reservation.NOTRAVERSEE = traversee.NOTRAVERSEE',  'inner')
        ->join('liaison', 'traversee.NOLIAISON = liaison.NOLIAISON',  'inner')
        ->join('port as portdepart', 'portdepart.NOPORT = liaison.NOPORT_DEPART',  'inner')
        ->join('port as portarrivee', 'portarrivee.NOPORT = liaison.NOPORT_ARRIVEE',  'inner')
        ->where('reservation.noclient', $noClient)
        ->orderBy('reservation.DATEHEURE', 'DESC')
        ->select('reservation.NORESERVATION as NORESERVATION, DATE(reservation.DATEHEURE) as DATERESERVATION, portdepart.nom as PORTDEPART, portarrivee.nom as PORTARRIVEE, DATE(traversee.DATEHEUREDEPART) as DATETRAVERSEE, reservation.MONTANTTOTAL as TOTAL, reservation.PAYE as PAYE')
        ->paginate(5);
    }

    public function GetAllCommandesClient($noClient) {
        return $this->join('traversee', 'reservation.NOTRAVERSEE = traversee.NOTRAVERSEE',  'inner')
        ->join('liaison', 'traversee.NOLIAISON = liaison.NOLIAISON',  'inner')
        ->join('port as portdepart', 'portdepart.NOPORT = liaison.NOPORT_DEPART',  'inner')
        ->join('port as portarrivee', 'portarrivee.NOPORT = liaison.NOPORT_ARRIVEE',  'inner')
        ->where('reservation.noclient', $noClient)
        ->orderBy('reservation.DATEHEURE, reservation.NORESERVATION', 'DESC')
        ->select('reservation.NORESERVATION as NORESERVATION, DATE(reservation.DATEHEURE) as DATERESERVATION, portdepart.nom as PORTDEPART, portarrivee.nom as PORTARRIVEE, DATE(traversee.DATEHEUREDEPART) as DATETRAVERSEE, reservation.MONTANTTOTAL as TOTAL, reservation.PAYE as PAYE')
        ->get()
        ->getResult();
    }
    
} // Fin Classe