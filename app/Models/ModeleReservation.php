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

} // Fin Classe