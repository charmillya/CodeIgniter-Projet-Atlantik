<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Visiteur::accueil');
$routes->match(['get', 'post'], 'connexion', 'Visiteur::seConnecter');
$routes->match(['get', 'post'], 'creercompte', 'Visiteur::creerUnCompte');
$routes->get('deconnexion', 'Visiteur::seDeconnecter');

