<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleType extends Model
{
    protected $table = 'type'; // nom de la table mappée

    protected $primaryKey = 'NOTYPE'; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['LIBELLE'];

    public function GetTypesTarifs($noLiaison, $noPeriode) {
        return $this->join('tarifer', 'tarifer.NOTYPE = type.NOTYPE and tarifer.LETTRECATEGORIE = type.LETTRECATEGORIE', 'inner')
        ->join('categorie', 'categorie.LETTRECATEGORIE = type.LETTRECATEGORIE', 'inner')
        ->where('tarifer.noliaison', $noLiaison)
        ->where('tarifer.noperiode', $noPeriode)
        ->select('type.lettrecategorie as LETTRECATEGORIE, type.notype as NOTYPE, type.libelle as LIBELLETYPE, categorie.libelle as LIBELLECATEGORIE, tarifer.noperiode as NOPERIODE, tarifer.noliaison as NOLIAISON, tarifer.tarif as TARIF')
        ->get()
        ->getResult();
    }
} // Fin Classe