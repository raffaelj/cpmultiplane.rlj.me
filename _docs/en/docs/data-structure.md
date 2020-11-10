# Data structure

CpMultiplane heavily relies on field names and types. A few of them have hard coded meanings, but most of them are handled via views and partials of the rljbase theme.

Have a look at the theme folders to see some default templates.

## Fields

### Reserved field names

#### title

**type:** `text`

The title is used for the html title tag, for seo title tags, for menus and as the page headline.

#### published

**type:** `boolean`

If not `true` (`false`, empty or unset), your page isn't published.

You can omit this field if you use the CpMultiplaneGUI.

#### content

**type:** `wysiwyg|markdown|repeater|text|textarea|layout`

#### description

**type:** `text|textarea`

For description tag in html head (for search engines)

You can omit this field, if you use the seo field instead.

### User definable field names

#### slug

**type:** `text`

A slug is the part of your url after the domain name, so if your page title is "My beautiful page", you slug should be "my-beautiful-page" and it is available at `https://example.com/my-beautiful-page`.

If you don't use a slug field, your page urls use the entry ids, that aren't really user or seo friendly, e. g. `https://example.com/5d91e027333862162c000082`.

You don't have to name it "slug", but that's the common name. Either way, you have to explicitly specify the name of your slug field in your multiplane config. Otherwise it will always default to the entry id.

config.yaml:

```
multiplane:
    slugName: slug
```

config.php:

```
'multiplane' => [
    'slugName' => 'slug',
],
```

#### nav

**type:** `multiple-select`

Part of CpMultiplaneGUI side bar. You can omit this field.

If you choose to use a different name than "nav", you have to set a config variable.

config.yaml:

```yaml
multiplane:
    navName: menu
```

config.php:

```
'multiplane' => [
    'navName' => 'menu',
],
```

### Optional field names

#### excerpt

**type:** `textarea|wysiwyg|markdown|text`

Used for posts partials to display an excerpt instead of the whole article
Also used for seo description if description field is empty.

#### featured_image

**type:** `asset`

for thumbnails in posts partials or for header images on pages

#### background_image

**type:** `asset`

#### gallery

**type:** `gallery|simple-gallery`

#### carousel or slider

**type:** `gallery|simple-gallery`

simple image carousel/slider

This is not enabled in the rljbase or rljstripes theme, because image sliders are annoying. If you want to use it, render a partial in your rljbase child theme.

```
@render('views:partials/featured-media.php', ['page' => $page, 'mode' => 'carousel'])
```

or

```
@render('views:partials/carousel.php', ['carousel' => $page['carousel']])
```

#### video

**type:** `videolink`

for privacy friendly YouTube or Vimeo videos, requires VideoLinkField addon

#### tags

**type:** `tags`

#### contactform

Part of CpMultiplaneGUI side bar

#### subpagemodule

Part of CpMultiplaneGUI side bar

#### class

type: text

Add a css class to the body tag of a page.
