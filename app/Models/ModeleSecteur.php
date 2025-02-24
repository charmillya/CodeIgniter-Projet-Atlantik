<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleSecteur extends Model
{
    protected $table = 'secteur'; // nom de la table mappée

    protected $primaryKey = 'NOSECTEUR'; // clé primaire
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['NOM'];

} // Fin Classe