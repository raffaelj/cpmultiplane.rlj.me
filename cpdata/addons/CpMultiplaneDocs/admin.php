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
    'cpmultiplanedocs:assets/link-collectionitem.tag'
]);

// skip login
if (getenv('MPDOCS_ENVIRONMENT') === 'DEVELOPMENT' && (int) getenv('MPDOCS_SKIP_LOGIN') === 1) {

    $user = [
        'user'   => 'randomeditor',
        'name'   => 'Random Editor',
        '_id'    => 'randomeditor',
        'email'  => '',
        'active' => true,
        'group'  => 'admin',
        'i18n'   => $app->getClientLang(),
    ];
    $permanent = false;
    $app->module('cockpit')->setUser($user, $permanent);

}
