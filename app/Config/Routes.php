<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('api/reservations/(:num)', 'Client::indexReservations/$1');
// on peut récupérer les commandes de n'importe quel client, attention
// mettre en paramètre adresse mail et mdp aussi?? qu'on a depuis la datastore

$routes->get('api/clients/(:any)/(:any)', 'Client::indexClients/$1/$2');

$routes->get('/', 'Visiteur::Accueil');
$routes->match(['get', 'post'], 'connexion', 'Visiteur::SeConnecter');
$routes->match(['get', 'post'], 'creercompte', 'Visiteur::CreerUnCompte');
$routes->get('deconnexion', 'Visiteur::SeDeconnecter');

$routes->get('liaisons', 'Visiteur::AfficherLesLiaisons');
$routes->get('tarifs/(:num)', 'Visiteur::AfficherLesTarifs/$1');

$routes->match(['get', 'post'], 'traversees/(:num)', 'Visiteur::AfficherLesTraversees/$1');

$routes->match(['get', 'post'], 'traversees/reserver/(:num)', 'Client::ReserverTraversee/$1');

$routes->match(['get', 'post'], 'traversees/reserver/(:num)/confirmer', 'Client::ConfirmerReservation/$1');
$routes->match(['get', 'post'], 'traversees/reserver/(:num)/confirmer/facture/(:num)', 'Client::AfficherFacture/$2');

$routes->get('compte/commandes', 'Client::AfficherLesCommandes');
$routes->match(['get', 'post'], 'compte/modifier', 'Client::ModifierInfosCompte');

