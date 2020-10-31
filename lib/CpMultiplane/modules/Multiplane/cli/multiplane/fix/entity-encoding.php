<?php
/*
 * html_entity_decode in all wysiwyg fields in all collections
 */

if (!COCKPIT_CLI) return;

$time_all = time();

$collections = cockpit('collections')->collections();

$languages = $app->module('multiplane')->getLanguages(false, false);

$fixes = [];

// collect wysiwyg field names
$fixFields = [];
foreach ($collections as $col) {
    if (isset($col['fields']) && is_array($col['fields'])) {
        $f = [];
        foreach ($col['fields'] as $field) {
            if ($field['type'] == 'wysiwyg') {
                $f[] = $field['name'];
                if ($field['localize'] == true) { // check translated fields
                    foreach ($languages as $lang) {
                        $f[] = $field['name'] . '_' . $lang;
                    }
                }
            }
        }
        if (!empty($f)) $fixFields[$col['name']] = $f;
    }
}

foreach ($fixFields as $collection => $fields) {

    $count = cockpit('collections')->count($collection);

    CLI::writeln("Found $count entries in $collection");

    $options = [];

    foreach ($fields as $field) {
        $options['fields'][$field] = true;
    }

    $entries = cockpit('collections')->find($collection, $options);

    CLI::writeln("Starting to convert fields: " . implode(', ', $fields));

    $time = time();

    foreach ($entries as &$entry) {

        foreach ($fields as $field) {
            if (isset($entry[$field])) {
                $entry[$field] = html_entity_decode($entry[$field]);
            }
        }

    }

    // save entries
    cockpit('collections')->save($collection, $entries);

    CLI::writeln("Converted $count items in " . (time() - $time) . ' seconds');

}

CLI::writeln("Done all in " . (time() - $time_all) . ' seconds');

