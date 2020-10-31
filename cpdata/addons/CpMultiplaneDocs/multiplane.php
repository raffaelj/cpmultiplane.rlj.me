<?php

// apply toc to main nav
$app->on('multiplane.page', function(&$page, &$posts, &$site) {

    // walk through nav tree and apply toc to active element
    function apply_toc_to_nav($nav, $toc) {

        if (!isset($toc[0])) $toc = [$toc];

        foreach ($nav as &$n) {
            if ($n['active']) $n['children'] = \array_merge($toc, $n['children']);
            else $n['children'] = apply_toc_to_nav($n['children'], $toc);
        }

        return $nav;
    }

    $toc = null;
    $nav = mp()->getNav('pages', 'main');

    $hash = $page['content_hash'];

    $cachepath = "tmp:///{$hash}.md.toc.json";

    if ($this->filestorage->has($cachepath)) {

        // create tree from reformatted toc
        $toc = [
            'title' => 'ToC',
            'url'   => '#',
            'class' => 'toc',
            'children' => \json_decode($this->filestorage->read($cachepath), true)
        ];

    }

    if (!$toc) return;

    // apply toc as first child to active element in main nav
    $nav = apply_toc_to_nav($nav, $toc);

    mp()->set('nav', ['main' => $nav]);

});
