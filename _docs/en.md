# CpMultiplane

CpMultiplane is a simple, lightweight php frontend, that is based on the fast and headless [Cockpit CMS][1]. It is meant to be used by developers, who need a base to create individual websites. If you search for a One-Click-Solution, this is the wrong place for you.

CpMultiplane is not finished, yet, but I already use it in production for a few small websites.

## Resources

[Source][2]{.button} [Docs][5]{.button}

* [Cockpit source][3]
* [Cockpit docs][4]
* [inofficial Cockpit docs][6]
* [Thread in Cockpit support forum][7]

## My main goals

1. **Privacy** by design and privacy by default
2. **Developer friendliness**
    * no plugins to deactivate half of the core features needed
    * ability to adjust everything
    * theming without div soup
3. **Clean backend** for my clients - Cockpit CMS with addons and modifications
4. **Structured data** - keep the system and the data portable and future proof
5. **Modular** and reusable code
6. **Semantic** html, **responsive** css, **usable without javascript**
6. **Multilingualism** by design

## Why reinventing the wheel?

**In short:** I wasn't able to find an existing system, that matched my goals.

**tldr:** In the past I mostly worked with WordPress and jekyll and sometimes I had a look at different systems.

I like the data structure of jekyll and I don't have a problem with writing texts in markdown, changing a data set in yaml or adding a missing template in liquid for the changed data set. But you can't expect this of non-programmers without a well-arranged backend. Also, I missed the ability to have forms without loading third party services through javascript.

WordPress seems to be very user friendly, but it tends users to press their data into predefined structures. It is not developer friendly. More than 2000 functions in the global scope, backwards compatibility to the outdated PHP5, a lot of nearly similar named function, no output buffer, adware and bloatware as plugins, no sensibility for privacy (Google fonts, gravater), security issues... It's a long list.

With Cockpit I found the ideal backend, that is easy to extend, that stores data in a structured way and that gives me multiple interfaces to query the data. While exploring that cms, I discovered a lot of on-board tools, that I can use for a frontend. I started to write the first prototype Monoplane, which I than developed further to CpMultiplane.

## Components

CpMultiplane is a wrapper, that loads Cockpit as a library, changes a few variables and constants and than registers the module Multiplane.

### Cockpit CMS

Cockpit CMS is headless without a frontend. It is created for pure data management in a structured way and it has multiple interfaces to get or change that data. CpMultiplane uses the php api for the frontend and the default user interface as backend.

Cockpit comes with the most important libraries, but in total it was kept clean and simple. It is modular extendible and was made to be customized to your individual needs.

![CpMultiplane model simple](/docs/img/uploads/cpmultiplane-model-simple_opt.svg)

### Multiplane

The module Multiplane takes care of translating url paths into database request and to deliver the data as html.

### CpMultiplaneGUI

This addon is the gateway between Cockpit and CpMultiplane to create different configuration profiles or to adjust the user interface.

### UniqueSlugs addon

To be able to reach pages with a readable, seo friendly url instead of a cryptic id, this addon creates unique url slugs from page titles in the background.

### FormValidation addon

The Forms module from Cockpit is quite rudimentary. With the FormValidation addon you can add form fields and validate form data.

### Other addons

BlockEditor and LayoutComponents, ImageResize, VideoLinkField, rljUtils, EditorFormats, BlockEditor...

to do...

### Theme

There is one responsive base theme "rljbase", that serves as skeleton for child themes. It has template files for the most use caess, a rudimentary, responsive layout and a lightweight javascript `mp.js` for image lightboxes or privacy friendly embedding of YouTube videos.

The other theme "rljstripes" serves mainly as inspiration, how to create a child theme.

## Chart of components

If you put all the components together, the cunstruct looks kind of like this:

![CpMultiplane model](/docs/img/uploads/cpmultiplane-model_opt.svg)

## Fields or data structure

CpMultiplane heavily relies on field names and types. A few of them have hard coded meanings, but most of them are handled via views and partials of the rljbase theme.

## Themes

Since CpMultiplane has only one base theme, that serves as skeleton for child themes, in the following text I go deeper into the components of the "rljbase" theme.

### Lexy templating

Lexy is another on-board tool of Cockpit. It is inspired by laravels' BladeCompiler. The syntax feels a bit like liquid (jekyll), but it is far more simple.

### Templates

A theme has multiple template files, that are stored in its' `views` subfolder.

to do...

### sass partials

to do...

### mp.js

In general, the theme "rljbase" works without javascript. For prettyfication or for image lightboxes, I created a lightweight toolkit. `mp.js` is modular and is built with Node.js and browserify.

**Features**

* simple cookie management
* handle privacy events
* simple video - display YouTube and Vimeo iframes with a thumbnail and don't load videos without user's privacy consent
* simple image lightbox
* simple image carousel
* simple mail address protection
* prevents a `:target` jump in the pure css mobile nav


### Child theme

to do...


[1]: https://getcockpit.com/
[2]: https://github.com/raffaelj/CpMultiplane
[3]: https://github.com/agentejo/cockpit/
[4]: https://getcockpit.com/documentation/getting-started
[5]: https://cpmultiplane.rlj.me
[6]: https://zeraton.gitlab.io/cockpit-docs/
[7]: https://discourse.getcockpit.com/t/monoplane-cpmultiplane-simple-php-frontend-that-uses-cockpit-as-a-library/720
