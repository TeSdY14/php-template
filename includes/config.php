<?php

function config($key = '')
{
    $config = [
        'name' => 'site name',
        'site_url' => '',
        'pretty_uri' => false,
        'nav_menu' => [
            '' => 'Accueil',
            'page1' => 'Page1',
            'page2' => 'Page2',
            'pagen' => 'PageN',
            'about' => 'A propos',
            'contact' => 'Contact',
        ],
        'template_path' => 'template',
        'content_path' => 'content',
        'version' => 'v1.0',
    ];

    return isset($config[$key]) ? $config[$key] : null;
}
