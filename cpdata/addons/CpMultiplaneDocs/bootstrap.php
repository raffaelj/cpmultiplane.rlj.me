<?php

// simple 2 way bind between md files and database

$app->path('#flatfiles', MPDOCS_FLATFILE_DIR);

// store updated markdown content in `storage/flatfiles/`
$app->on('collections.save.after', function ($name, &$entry) {

    if (isset($entry['content'])) {

        $filename = !empty($entry['permalink']) ? \ltrim($entry['permalink'], '/') : $entry['slug'];

        $this('fs')->write("#flatfiles:{$filename}.md", $entry['content']);

    }

    if (isset($entry['content_de'])) {

        $filename = !empty($entry['permalink_de']) ? \ltrim($entry['permalink_de'], '/') : $entry['slug'];

        $this('fs')->write("#flatfiles:{$filename}.md", $entry['content_de']);

    }

});

// replace content of entries with content of stored md files
$app->on('collections.find.after.pages', function($collection, &$entries) {

    if (getenv('MPDOCS_ENVIRONMENT') !== 'DEVELOPMENT') return;

    // don't replace content while saving entry to create a new revision
    if (preg_match('/.*\/collections\/save_entry\/pages$/', $this['route'])) return;

    foreach ($entries as &$entry) {

        foreach (['', '_de'] as $suffix) {

            if (!empty($entry['permalink'.$suffix])) {

                $filename = \ltrim($entry['permalink'.$suffix], '/');

                if ($path = $this->path("#flatfiles:{$filename}.md")) {

                    $content = $this('fs')->read($path);

                    $hash = \md5($content);

                    // alert, if markdown file was changed and doesn't match the content field in the database
                    if (COCKPIT_ADMIN_CP && $hash !== $entry['content_hash'.$suffix]) {

                        $this->viewvars['mpdocs_alert'][] = [
                            'file'    => $filename.'.md',
                            'message' => "The file didn't match with the stored content in the database. If you want to revert the changes, select the last revision.",
                            'hash'    => $hash,
                        ];

                    }

                    // replace content
                    $entry['content'.$suffix]      = $content;
                    $entry['content_hash'.$suffix] = $hash;

                }
            }

        }

    }

});

// add hashes of md content
$app->on('collections.save.before', function ($name, &$entry, $isUpdate) {

    // set empty strings to null, otherwise the default fallback for empty entries to the
    // default language (en) doesn't work
    foreach ($entry as &$v) {
        if ($v === '') $v = null;
    }

    foreach (['', '_de'] as $suffix) {

        if (isset($entry['content'.$suffix])) {

            $entry['content_hash'.$suffix] = \md5($entry['content'.$suffix]);

        }
    }

});

// admin ui
if (COCKPIT_ADMIN_CP) {
    include_once(__DIR__.'/admin.php');
}

// multiplane
if (!COCKPIT_ADMIN && !COCKPIT_API_REQUEST) {
    include_once(__DIR__.'/multiplane.php');
}
