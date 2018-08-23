<?php
/**
  Liste des routes autorisées
 */
//Frontend
$routes[] = array(
    'url' => '/',
    'app' => 'Frontend',
    'action' => 'index'
);

$routes[] = array(
    'url' => '/article-([^/]+).html',
    'app' => 'Frontend',
    'action' => 'show'
);

$routes[] = array(
    'url' => '/connexion.html',
    'app' => 'Frontend',
    'action' => 'connexion'
);

$routes[] = array(
    'url' => '/logout.html',
    'app' => 'Frontend',
    'action' => 'logout'
);

//Backend

$routes[] = array(
    'url' => '/admin/',
    'app' => 'Backend',
    'action' => 'index'
);
$routes[] = array(
    'url' => '/admin/addArticle.html',
    'app' => 'Backend',
    'action' => 'addArticle'
);

$routes[] = array(
    'url' => '/admin/article-([^/]+).html',
    'app' => 'Backend',
    'action' => 'show'
);
$routes[] = array(
    'url' => '/admin/update-([^/]+).html',
    'app' => 'Backend',
    'action' => 'update'
);

$routes[] = array(
    'url' => '/admin/message.html',
    'app' => 'Backend',
    'action' => 'newcomment'
);
$routes[] = array(
    'url' => '/admin/deletePost-([^/]+).html',
    'app' => 'Backend',
    'action' => 'deletePost'
);

$routes[] = array(
    'url' => '/admin/deleteComment-([^/]+).html',
    'app' => 'Backend',
    'action' => 'deleteComment'
);

$routes[] = array(
    'url' => '/admin/publier-([^/]+).html',
    'app' => 'Backend',
    'action' => 'publier'
);
$routes[] = array(
    'url' => '/admin/newcomment.html',
    'app' => 'Backend',
    'action' => 'newcomment'
);
