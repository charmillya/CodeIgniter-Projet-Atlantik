<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleClient extends Model
{
    protected $table = 'client'; // nom de la table mappée

    protected $primaryKey = 'NOCLIENT'; // clé primaire
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['NOM', 'PRENOM', 'ADRESSE', 'CODEPOSTAL', 'VILLE', 'TELEPHONEFIXE', 'TELEPHONEMOBILE', 'MEL', 'MOTDEPASSE'];
} // Fin Classe