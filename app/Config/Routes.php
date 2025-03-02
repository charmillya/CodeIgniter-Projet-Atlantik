<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Visiteur::Accueil');
$routes->match(['get', 'post'], 'connexion', 'Visiteur::SeConnecter');
$routes->match(['get', 'post'], 'creercompte', 'Visiteur::CreerUnCompte');
$routes->get('deconnexion', 'Visiteur::SeDeconnecter');

$routes->get('liaisons', 'Visiteur::AfficherLesLiaisons');
$routes->get('tarifs/(:num)', 'Visiteur::AfficherLesTarifs/$1');

$routes->match(['get', 'post'], 'traversees/(:num)', 'Visiteur::AfficherLesTraversees/$1');

$routes->match(['get', 'post'], 'traversees/reserver/(:num)', 'Client::ReserverTraversee/$1');
