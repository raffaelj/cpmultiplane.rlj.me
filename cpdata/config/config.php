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
//         'debug' => ['lexy' => true],
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
//         'cache' => false,
        'cached_toc_format' => 'tree',
        'tree_toc' => [
            'replace_keys' => [
                'text' => 'title',
            ],
            'unset_keys' => ['level', 'id'],
        ],
        'toc' => [
            'selectors' => ['h2', 'h3', 'h4', 'h5', 'h6'],
            'replacements' => [
                '/^nav$/' => 'nav-1',
                '/^top$/' => 'top-1',
                '/^main$/' => 'main-1',
                '/^(?:-|_)*(?:privacy)(?:\s|-)(?:notice)/i' => 'id_privacy-notice',
                '/^loadExternalVideos$/' => 'loadExternalVideos-1',
                '/^mp_form/' => 'id_mp_form',
            ],
        ],
    ],

];
