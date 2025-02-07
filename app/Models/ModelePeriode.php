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
    
} // Fin Classe