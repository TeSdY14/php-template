<?php

/**
 * Afficher le nom du site.
 * Displays site name.
 */
function site_name()
{
    echo config('name');
}

/**
 * Afficher l'adresse du site
 * Displays site url.
 */
function site_url()
{
    echo config('site_url');
}

/**
 * Afficher la version du site.
 * Displays site version.
 */
function site_version()
{
    echo config('version');
}

/**
 * Navigation.
 * @param string $sep
 */
function nav_menu($sep = ' | ')
{
    $nav_menu = '';
    $nav_items = config('nav_menu');
    
    foreach ($nav_items as $uri => $name) {
        $query_string = str_replace('page=', '', $_SERVER['QUERY_STRING'] ?? '');
        $class = $query_string == $uri ? ' active' : '';
        $url = config('site_url') . '/' . (config('pretty_uri') || $uri == '' ? '' : '?page=') . $uri;
        
        // Add nav item to list. See the dot in front of equal sign (.=)
        $nav_menu .= '<a href="' . $url . '" title="' . $name . '" class="item ' . $class . '">' . $name . '</a>' . $sep;
    }

    echo trim($nav_menu, $sep);
}

/**
 * Afficher le titre de la page. prend les données de l'URL,Remplace les "-" par un espace et met en majuscule
 * Displays page title. It takes the data from URL, it replaces the "-" with spaces and it capitalizes the words.
 */
function page_title()
{
    $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'Home';

    echo ucwords(str_replace('-', ' ', $page));
}

/**
 * Afficher le contenu de la page. Prend les donnée des pages dans le repertoire content/  . Si aucune correspondance, afficher la page d'erreur 404.
 * Displays page content. It takes the data from the pages inside the content/ directory. When not found, display the 404 error page.
 */
function page_content()
{
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $path = getcwd() . '/' . config('content_path') . '/' . $page . '.php';

    if (! file_exists($path)) {
        $path = getcwd() . '/' . config('content_path') . '/404.php';
    }

    echo file_get_contents($path);
}

function init()
{
    require config('template_path') . '/template.php';
}
