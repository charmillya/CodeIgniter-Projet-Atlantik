<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleCategorie extends Model
{
    protected $table = 'categorie'; // nom de la table mappée

    protected $primaryKey = 'LETTRECATEGORIE'; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['LIBELLE'];

    public function GetNbTypes() {
        return $this->join('type', 'type.LETTRECATEGORIE = categorie.LETTRECATEGORIE', 'inner')
        ->select('categorie.LETTRECATEGORIE as LETTRECAT, COUNT(type.NOTYPE) as NBTYPES')
        ->groupBy('categorie.LETTRECATEGORIE')
        ->get()
        ->getResult();
    }
} // Fin Classe