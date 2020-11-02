<?php

// apply toc to main nav
$app->on('multiplane.page', function(&$page, &$posts, &$site) {

    // quick and dirty redirect option for empty parent pages
    if (!empty($page['redirect_to']) && is_string($page['redirect_to'])) {
        $this->reroute($page['redirect_to']);
        $this->stop();
    }

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

        $_toc = \json_decode($this->filestorage->read($cachepath), true);

        if (empty($_toc)) return;

        // create tree from reformatted toc
        $toc = [
            'title' => 'ToC',
            'url'   => '#',
            'class' => 'toc',
            'children' => $_toc
        ];

    }

    if (!$toc) return;

    // apply toc as first child to active element in main nav
    $nav = apply_toc_to_nav($nav, $toc);

    mp()->set('nav', ['main' => $nav]);

});
