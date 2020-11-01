<?php

// add viewvar for notifications
$app->on('admin.init', function() {
    if (!isset($this->viewvars['mpdocs_alert'])) $this->viewvars['mpdocs_alert'] = [];
});

// add partial for notifications
$app->on('collections.entry.aside', function($collection) {

    echo $this->renderView('cpmultiplanedocs:views/partials/alert.php', compact('collection'));

});

// add assets
$app->helper('admin')->addAssets([
    'cpmultiplanedocs:assets/mpdocs-htmleditor-mod.js',
    'cpmultiplanedocs:assets/link-collectionitem.tag',
    'cpmultiplanedocs:assets/cp-search.tag',
]);

////////////// skip accounts and login

// not really necessary, because direct access to php files inside lib folders is denied
$this->bind('/install',  function() {return 'nice try ;-)';});
$this->bind('/install/', function() {return 'nice try ;-)';});

// set current user if defined via env vars
if (getenv('MPDOCS_ENVIRONMENT') === 'DEVELOPMENT' && (int) getenv('MPDOCS_SKIP_LOGIN') === 1) {

    $author    = getenv('MPDOCS_AUTHOR');
    $author_id = 'randomeditor';

    if (!$author) $author = 'randomeditor';
    else $author_id = preg_replace("/[^A-Za-z0-9]/", '', $author);

    $user = [
        'user'   => $author_id,
        'name'   => $author ?? 'Random Editor',
        '_id'    => $author_id,
        'email'  => '',
        'active' => true,
        'group'  => 'admin',
        'i18n'   => $app->getClientLang(),
    ];
    $permanent = false;
    $app->module('cockpit')->setUser($user, $permanent);

}


// dashboard widget
$this->on('admin.dashboard.widgets', function($widgets) {

    // add all entries with string "to do" to dashboard widget

    $todos   = [];
    $_search = 'to do';
    $regex   = "/(?<!&[^\s]){$_search}(?![^<>]*(([\/\"']|]]|\b)>))/iu";

    foreach (['en', 'de'] as $lang) {

        $suffix = $lang == 'en' ? '' : '_'.$lang;

        $todos[$lang] = $this->module('collections')->find('pages', [
            'filter' => [
                '$or' => [
                    ['title'.$suffix   => ['$regex' => $regex]],
                    ['content'.$suffix => ['$regex' => $regex]],
                ],
            ],
            'lang' => $lang,
        ]);

    }

    $problems = [];

    $widgets[] = [
        'name'    => 'mpdocs_problems',
        'content' => $this->view('cpmultiplanedocs:views/widgets/problems.php', compact('todos', 'problems')),
        'area'    => 'main'
    ];

}, 100);


// add pages to global app search
$this->on('cockpit.search', function($search, $list) {

    $collection = 'pages';

    // pages
    if ($this->module('collections')->hasaccess($collection, 'entries_view')) {

        $_search = \preg_quote($search);
        $regex = "/(?<!&[^\s]){$_search}(?![^<>]*(([\/\"']|]]|\b)>))/iu";

        foreach (['en', 'de'] as $lang) {

            $suffix = $lang == 'en' ? '' : '_'.$lang;

            $options = [
                'filter' => [
                    '$or' => [
                        ['title'.$suffix   => ['$regex' => $regex]],
                        ['content'.$suffix => ['$regex' => $regex]],
                    ],
                ],

            ];

            foreach ($this->module('collections')->find($collection, $options) as $entry) {

                $list[] = [
                    'icon'  => 'file-text-o',
                    'title' => $entry['title'.$suffix],
                    'url'   => $this->routeUrl('/collections/entry/'.$collection.'/'.$entry['_id']).'?lang='.$lang,
                    'lang'  => $lang
                ];

            }
        }

    }

});
