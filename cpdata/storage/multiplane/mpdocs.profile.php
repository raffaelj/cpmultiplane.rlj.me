<?php
return [
  'name' => 'mpdocs',
  'label' => 'CpMultiplane Docs',
  '_id' => 'mpdocs',
  '_created' => 1595175169,
  '_modified' => 1607619919,
  'search' => [
    'enabled' => true,
  ],
  'pages' => 'pages',
  'siteSingleton' => 'site',
  'theme' => 'mpdocs',
  'use' => [
    'collections' => [
      0 => 'pages',
    ],
    'singletons' => [
      0 => 'site',
    ],
  ],
  'description' => 'Dual language, all pages and posts are in one collection, markdown for content
Suggested: BetterMarkdown addon',
  'pageTypeDetection' => 'type',
  'preRenderFields' => [
    0 => 'content',
  ],
  'displayBreadcrumbs' => true,
  'isMultilingual' => true,
  'usePermalinks' => true,
  'fieldNames' => [
    'slug' => 'slug',
  ],
];
