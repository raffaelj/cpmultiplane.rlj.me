<?php
 return array (
  'name' => 'pages',
  'label' => 'Pages',
  '_id' => 'pages',
  'description' => '',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'title',
      'label' => '',
      'type' => 'text',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => true,
      'options' => 
      array (
      ),
      'width' => '1-2',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => true,
    ),
    1 => 
    array (
      'name' => 'published',
      'label' => '',
      'type' => 'boolean',
      'default' => '',
      'info' => '',
      'group' => 'config',
      'localize' => false,
      'options' => 
      array (
      ),
      'width' => '1-4',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => false,
    ),
    2 => 
    array (
      'name' => 'permalink',
      'label' => '',
      'type' => 'text',
      'default' => '',
      'info' => 'also used for markdown file bindings',
      'group' => '',
      'localize' => true,
      'options' => 
      array (
      ),
      'width' => '1-4',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'content',
      'label' => '',
      'type' => 'markdown',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => true,
      'options' => 
      array (
      ),
      'width' => '1-1',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => false,
    ),
    4 => 
    array (
      'name' => 'excerpt',
      'label' => 'Excerpt',
      'type' => 'wysiwyg',
      'default' => '',
      'info' => 'Only needed for posts',
      'group' => '',
      'localize' => true,
      'options' => 
      array (
        'editor' => 
        array (
          'height' => 80,
        ),
      ),
      'width' => '1-1',
      'lst' => false,
      'acl' => 
      array (
      ),
      'required' => false,
    ),
    5 => 
    array (
      'name' => 'tags',
      'label' => 'Tags',
      'type' => 'tags',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => true,
      'options' => 
      array (
      ),
      'width' => '1-1',
      'lst' => false,
      'acl' => 
      array (
      ),
      'required' => false,
    ),
    6 => 
    array (
      'name' => 'description',
      'label' => 'Short description',
      'type' => 'textarea',
      'default' => '',
      'info' => 'For search engines - max. 160 characters',
      'group' => '',
      'localize' => true,
      'options' => 
      array (
        'rows' => 2,
      ),
      'width' => '2-3',
      'lst' => false,
      'acl' => 
      array (
      ),
      'required' => false,
    ),
    7 => 
    array (
      'name' => 'slug',
      'label' => 'Url slug',
      'type' => 'text',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => true,
      'options' => 
      array (
      ),
      'width' => '1-3',
      'lst' => false,
      'acl' => 
      array (
      ),
      'required' => false,
    ),
    8 => 
    array (
      'name' => 'redirect_to',
      'label' => '',
      'type' => 'text',
      'default' => '',
      'info' => '',
      'group' => 'config',
      'localize' => true,
      'options' => 
      array (
      ),
      'width' => '1-1',
      'lst' => false,
      'acl' => 
      array (
      ),
    ),
  ),
  'sortable' => true,
  'in_menu' => false,
  '_created' => 1595174861,
  '_modified' => 1604433444,
  'color' => '',
  'acl' => 
  array (
  ),
  'sort' => 
  array (
    'column' => '_created',
    'dir' => -1,
  ),
  'rules' => 
  array (
    'create' => 
    array (
      'enabled' => false,
    ),
    'read' => 
    array (
      'enabled' => false,
    ),
    'update' => 
    array (
      'enabled' => false,
    ),
    'delete' => 
    array (
      'enabled' => false,
    ),
  ),
  'group' => '',
  'multiplane' => 
  array (
    'sidebar' => true,
    'type' => 'pages',
  ),
);