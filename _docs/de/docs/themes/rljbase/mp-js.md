# mp.js

Grundsätzlich funktioniert das Theme auch ohne Javascript, zum Aufhübschen oder für Bilder-Lightboxen habe ich trotzdem ein Toolkit erstellt. Auch `mp.js` ist modular aufgebaut und wird mit Hilfe von node und browserify kompiliert.

Einige Teile von `mp.js` können überall genutzt werden. Ich habe es aber mit dem Ziel geschrieben, das HTML des rljbase-Themes anzusprechen. Es könnte also ungewollte Nebeneffekte haben, wenn du es in deinem eigenen Projekt nutzt, dass komplett anders aufgebaut ist.

## Features

* simples Cookie-Management
* Handhabung von Privatspäre-Events
* simple video - display YouTube and Vimeo iframes with a thumbnail and don't load videos without user's privacy consent
* simple image lightbox
* simple image carousel
* simple mail address protection
* prevents a `:target` jump in the pure css mobile nav

to do...

siehe: englische Version: [mp.js](/en/mp-js)