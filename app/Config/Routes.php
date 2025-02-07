<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Visiteur::Accueil');
$routes->match(['get', 'post'], 'connexion', 'Visiteur::SeConnecter');
$routes->match(['get', 'post'], 'creercompte', 'Visiteur::CreerUnCompte');
$routes->get('deconnexion', 'Visiteur::SeDeconnecter');

$routes->get('afficherliaisons', 'Visiteur::AfficherLesLiaisons');
$routes->get('affichertarifs/(:num)', 'Visiteur::AfficherLesTarifs/$1');

// fix le alpha qui marche pas

