<?php
return [
  'name' => 'mpdocs',
  'label' => 'CpMultiplane Docs',
  '_id' => 'mpdocs',
  '_created' => 1595175169,
  '_modified' => 1604316221,
  'search' => [
    'enabled' => true,
  ],
  'pages' => 'pages',
  'siteSingleton' => 'site',
  'slugName' => 'permalink',
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
];