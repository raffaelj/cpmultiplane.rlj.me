# mp.js

In general, the theme `rljbase` works without javascript. For prettyfication or for image lightboxes, I created a lightweight toolkit. `mp.js` is modular and is built with Node.js and browserify.

Parts of `mp.js` can be used everywhere, but I wrote it specifically to target the markup from the rljbase theme. So it might have some unwanted side effects if you use it in your own project with a completely different markup.

## Features

* simple cookie management
* handle privacy events
* simple video - display YouTube and Vimeo iframes with a thumbnail and don't load videos without user's privacy consent
* simple image lightbox
* simple image carousel
* simple mail address protection
* prevents a `:target` jump in the pure css mobile nav

## Modules

### Core

to do...

### Cookie

to do...

### MailProtection

Simple mail address protection to prevent some crawlers from being able to read them. This only works for crawlers, that read raw html without running javascript.

If you write email addresses in the pattern `john.doe [AT] example [DOT] com` (with spaces) or `john.doe[AT]example[DOT]com` (without spaces), they will be converted to `john.doe@example.com`.

It also replaces the pattern inside mailto links, if you created them before via php.

So the markup

```html
<a href="mailto:john.doe [AT] example [DOT] com">john.doe [AT] example [DOT] com</a>
```

becomes

```html
<a href="mailto:john.doe@example.com">john.doe@example.com</a>
```

**Usage:**

Add a snippet to your (theme) bootstrap.php

```php
mp()->add('scripts', [
'MP.ready(function() {
    MP.MailProtection.decode();
});'
]);
```

Usage example with a customized pattern:

```php
mp()->add('scripts', [
'MP.ready(function() {
    MP.MailProtection.init({at:"[Ät]",dot:"[Punkt]"});
});'
]);
```

### Privacy

to do...

### SimpleCarousel

to do...

### SimpleLightbox

I tried multiple lightboxes out there, but I wasn't able to find one, that wasn't bloated or that didn't require a predifined pattern. So I wrote my own.

It expects a wrapper as a group selector and it allows multiple options for your markup, e. g.:

```html
<div class="gallery">
    <a href="img/original.jpg" title="Image caption in lightbox">
        <img src="img/thumbnail.jpg" />
    </a>
</div>
```

```html
<p class="gallery">
    <a href="img/original.jpg">
        <figure>
            <img src="img/thumbnail.jpg" />
            <figcaption>Image caption in lightbox<figcaption>
        </figure>
    </a>
</p>
```

**Init lightbox:**

```js
MP.ready(function() { // document is ready
    // init lightbox
    MP.Lightbox.init({
        group: '.gallery',  // all elements with class 'gallery' are galleries
        selector: 'a'       // all a tags are detected as image links
    });
});
```

*Tip:* The lightbox is also compatible with WordPress Gutenberg galleries.

```js
MP.ready(function() {
    MP.Lightbox.init({group: '.wp-block-gallery', selector: 'a'});
}
```

### SimpleModalManager

to do...

### SimpleVideo

to do...
