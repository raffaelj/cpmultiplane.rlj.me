# Setup

## Intended use

### Backend - Cockpit

1. Create a singleton `site` for your default page definitions.
2. Create a collection `pages` for all of your pages.
3. Create a collection `posts` for all of your blog posts.
4. Use the CpMultiplaneGUI addon.

### Frontend - CpMultiplane

1. create a child theme of rljbase or create your own theme
2. adjust defaults in `/child-theme/config/config.php`
3. add snippets to `/child-theme/bootstrap.php`, that are explicitly for your theme
4. add snippets to `/config/bootstrap.php`, that are specifically for your setup
5. change some partials to fit your needs

## Recommended Addons

Copy/install these addons into `cockpit/addons/`.

* [CpMultiplaneGUI][2]
  * adds a few fields to the sidebar, so you don't have to define them in your collection definitions
  * some gui tweaks for easier access
  * enable option to use settings profiles
* [UniqueSlugs][3]
  * If urls should point to `/beautiful-heading` instead of `/5f96fb606136312729000191`
  * for multilingual slugs in language switch
* [rljUtils][4]
  * fixes security issues in Admin UI for multi user setups
  * big language buttons for multilingual setups
* [FormValidation][5]
  * The inbuilt Forms Controller requires field definitions from this addon
  * The inbuilt views and css files are written to match the field definitions
* [VideoLinkField][6]
  * inbuilt `/assets/js/mp.js`, some views and css files are designed to load videos privacy friendly with a privacy notice, that pops up only when a user clicks a play button
* [SimpleImageFixBlackBackgrounds][7]
  * replaces the SimpleImage library with a modified version to fix black backgrounds of transparent png and gif files on hosts with a non-bundled PHP GD version
  * It works on the German webhoster Uberspace, but it doesn't work in the php7-apache docker image. So if you have problems with GD, this addon might be helpful.
* [EditorFormats][10] - if you want to give your users a Wysiwyg field

## Settings

The fastest way to change some defaults, is to add some values to `/cockpit/config/config.php`:

```php
<?php
return [
    'app.name' => 'CpMultiplane',

    'i18n' => 'en',
    'languages' => [
        'default' => 'English',
        'de' => 'Deutsch',
    ],

    // define settings here
    'multiplane' => [
        'pages' => 'pages',
        'siteSingleton' => 'site',
        'slugName' => 'slug',
        'use' => [
            'collections' => [
                'pages',
                'posts',
                'products',
            ],
            'singletons' => [
                'site',
            ],
            'forms' => [
                'contact',
            ],
        ],
    ],
];
```

The cleaner and more user friendly way is to use the GUI. Create a profile, name it `my-profile` and set multiplane to the profile name:

```php
return [
    'app.name' => 'CpMultiplane',

    'i18n' => 'en',
    'languages' => [
        'default' => 'English',
        'de' => 'Deutsch',
    ],

    // define settings via profile
    'multiplane' => [
        'profile' => 'my-profile',
    ],
];
```

## Quickstart

```bash
cd ~/html
./mp multiplane/quickstart --template basic
```

Templates: minimal, basic, full

to do...

## Collections

to do...

### Pages

to do...

### Subpages (posts)

to do...

## Site Singleton

to do...

## Profiles

to do...



[2]: https://github.com/raffaelj/cockpit_CpMultiplaneGUI
[3]: https://github.com/raffaelj/cockpit_UniqueSlugs
[4]: https://github.com/raffaelj/cockpit_rljUtils
[5]: https://github.com/raffaelj/cockpit_FormValidation
[6]: https://github.com/raffaelj/cockpit_VideoLinkField
[7]: https://github.com/raffaelj/cockpit_SimpleImageFixBlackBackgrounds
[10]: https://github.com/pauloamgomes/CockpitCms-EditorFormats