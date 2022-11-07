<?php
return [

    'app.name' => 'mpdocs',

    'i18n' => 'en',
    'languages' => [
        'default' => 'English',
        'de'      => 'Deutsch',
    ],

    'multiplane' => [
        'profile' => 'mpdocs',
        'pageTypes' => [
            'page',
            'addon',
            'theme',
        ],
        'debug' => [
//             'lexy'    => true,
//             'overlay' => true,
        ],
    ],

    'unique_slugs' => [
        'collections' => [
            'pages' => 'title',
        ],
        'localize' => [
            'pages' => 'title',
        ],
    ],

    'imageresize' => [
        'prettyNames' => true,
        'optimize' => true,
        'customFolder' => '',
        'replaceAssetsManager' => true,
        'profiles' => [
            'thumbs' => [
                'width'   => 100,
                'height'  => 100,
                'method'  => 'thumbnail',
                'quality' => 70,
            ],
        ],
    ],

    'bettermarkdown' => [
        // 'cache' => false,
        'cached_toc_format' => 'tree',
        'tree_toc' => [
            'replace_keys' => [
                'text' => 'title',
            ],
            'unset_keys' => ['level', 'id'],
        ],
        'toc' => [
            'selectors' => ['h2', 'h3', 'h4', 'h5', 'h6'],
            'blacklist' => [
                'nav',
                'top',
                'main',
                'privacy-notice',
                'loadexternalvideos',
            ],
//             'replacements' => [
//                 '/^mp_form/' => 'id_mp_form',
//             ],
        ],
    ],

];
