<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleEnregistrer extends Model
{
    protected $table = 'enregistrer';
    // protected $primaryKey = 'XXX';  
    // la clé primaire n'est pas spécifiée ici car clé concaténée
 
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['NORESERVATION', 'LETTRECATEGORIE', 'NOTYPE', 'QUANTITERESERVEE', 'QUANTITEEMBARQUEE'];
 
    // Nota Bene : la méthode 'find(clé)' héritée de Model prend pour argument la clé primaire
    // spécifiée dans $primaryKey. Cette dernière variable étant laissée à null
    // on va redéfinir la méthode find(clé)
 
    // REDEFINITION de find, héritée de Model
    public function find($noReservation = null)
    {
        $builder = $this->builder(); // récupération d'une instance de la classe QueryBuilder
        return $builder->where(['NORESERVATION' => $noReservation])->get()->getResult();
        // Nota Bene : avec la classe QueryBuilder il est possible d'attaquer n'importe
        // quelle table, et de réaliser n'importe quelle 'opération' : update, insert ... where...
        // ici, par défaut, la table mappée étant 'contenir', on fait notre where ... from 'contenir'
    }
}