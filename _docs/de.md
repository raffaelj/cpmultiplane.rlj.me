# CpMultiplane

CpMultiplane ist ein simples, leichtgewichtiges PHP-Frontend, das auf dem [Cockpit CMS][1] basiert. Es ist für Entwicklerinnen gedacht, die eine Basis für individuelle Projekte benötigen. Wenn du nach einer Ein-Klick-Lösung suchst, bist du hier falsch.

CpMultiplane ist noch nicht ganz fertiggestellt, ich nutze es aber bereits für einige kleinere Webprojekte.

## Ressourcen

[Source][2]{.button} [Docs][5]{.button}

* [Cockpit source][3]
* [Cockpit docs][4]
* [inofficial Cockpit docs][6]
* [Thread in Cockpit support forum][7]

## Meine primären Ziele

1. **Privatsphäre** per Design und Privatshpäre per Default
2. **Entwicklerinnenfreundlich**
    * keine Plugins notwendig, um die Hälfte der Kern-Features zu deaktivieren
    * die Möglichkeit, alles anzupassen
    * Themes ohne Div-Salat
3. **Klares Backend** für meine Kundinnen - Cockpit CMS mit Addons und Modifikationen
4. **Strukturierte Daten** - System und Daten sind portabel und zukunftssicher
5. **Modularer** und wiederverwendbarer code
6. **Semantisches** HTML, **responsives** CSS, **benutzbar ohne Javascript**
6. **Mehrsprachigkeit** per Design

## Warum das Rad neu erfinden?

**In aller Kürze:** Ich habe kein System gefunden, das mit meinen Zielen harmoniert.

**tldr:** In der Vergangenheit habe ich hauptsächlich WordPress und jekyll genutzt und hier und da auch mal in andere Systeme reingeschaut.

Ich mochte die Datenstruktur von jekyll sehr gern und ich kam auch gut damit klar, Texte in Markdown zu verfassen, mal eben einen Datensatz in Yaml anzupassen und schnell ein fehlendes Template in liquid für den geänderten Datensatz zu schreiben. Nicht-Programmierern ist das ohne übersichtliches Backend aber schwer zuzumuten.

WordPress scheint zwar sehr anwenderfreundlich zu sein, wenn man sich aber nicht intensiv mit Custom Post Types auseinandersetzt, verleitet es dazu, Daten in vorgefertigte Strukturen zu quetschen. Entwicklerfreundlich ist WordPress leider gar nicht. Über 2000 Funktionen im globalen Scope, Abwärtskompatibilität zum völlig veralteten PHP5, zig fast gleichlautende Funktionsnamen, kein Output-Buffer, Adware und Bloatware als Plugins, keine Sensibilität für Datenschutz (Google Fonts, Gravatar), Sicherheitslücken... Die Liste ist lang.

Mit dem Cockpit CMS fand ich das ideale Backend, das sich einfach anpassen lässt, das Daten strukturiert ablegt und das mir mehrere Schnittstellen zur Datenabfrage bietet. Beim Erkunden des CMS fand ich schnell heraus, dass ich viele Bordmittel von Cockpit direkt für das Frontend nutzen kann und ich begann den ersten Prototyp Monoplane zu schreiben, den ich später zu CpMultiplane weiterentwickelte.

## Bausteine

CpMultiplane ist ein Wrapper, der Cockpit als library lädt, ein paar Variablen und Konstanten anpasst und dann das Modul Multiplane registriert.

### Cockpit

Das Cockpit CMS kommt von Haus aus ohne Frontend. Es ist zur reinen Datenpflege in strukturierter Form angelegt und bietet verschiedene Schnittstellen zur Datenabfrage oder -änderung an. CpMultiplane setzt hier auf die PHP-API für das Frontend und auf das Default-User-Interface als Backend.

Cockpit bringt die wichtigsten libraries mit, ist aber insgesamt sehr simpel gehalten. Es ist modular erweiterbar und darauf ausgelegt auf individuelle Bedürfnisse angepasst zu werden.

![CpMultiplane model simple](/_docs/img/uploads/cpmultiplane-model-simple_opt.svg)

### Multiplane

Das Modul Multiplane kümmert sich darum, dass Url-Pfade aufgelöst und in entsprechende Datenbankabfragen übersetzt werden. Anschließend werden die abgefrageten Daten als HTML-Seiten ausgeliefert.

### CpMultiplaneGUI

Dieses Addon ist die Schnittstelle zwischen Cockpit und CpMultiplane um verschiedene Konfigurationsprofile zu erstellen oder das User-Interface anzupassen.

### UniqueSlugs-Addon

Um Seiten nicht via kryptischer ID, sondern über eine lesbare und SEO-freundliche URL aufrufen zu können, sorgt das Addon im Hintergrund dafür, dass aus Seitentiteln einmalige URL-Pfade entstehen.

### FormValidation-Addon

Das Formular-Modul von Cockpit ist nur sehr rudimentär ausgestattet. Mit dem FormValidation-Addon können Formularfelder angelegt und Formulareingaben validiert werden.

### weitere Addons

BlockEditor und LayoutComponents, ImageResize, VideoLinkField, rljUtils, EditorFormats, BlockEditor...

### Theme(s)

Es gibt ein responsives Basis-Theme "rljbase", das als Grundlage für Kind-Themes dient. Es hat Template-Dateien für die meisten Anwendungsfälle, ein rudimentäres, aber responsives Layout und ein leichtgewichtiges Javascript `mp.js` für z. B. Lightboxen oder privatsphärefreundliches Einbinden von YoutTube-Videos.

Ein weiteres Theme ist "rljstripes", das hauptsächlich als Inspiration dienen soll, wie ein Kind-Theme erstellt werden kann.

## Bausteine-Diagramm

Setzt man nun alle Bausteine zusammen, sieht das Konstrukt ungefähr so aus:

![CpMultiplane model](/_docs/img/uploads/cpmultiplane-model_opt.svg)

## Felder, bzw. strukturierte Daten

CpMultiplane basiert sehr stark auf Feldtypen und -namen. Ein paar von ihnen haber eine hartkodierte Bedeutung. Die meisten werden aber über Template-Dateien des rljbase-Themes gehandhabt.

## Themes

Da CpMultiplane nur ein Basis-Theme hat, das als Skelett für Kind-Themes dient, gehe ich im Folgenden auf die Bestandteile des Themes "rljbase" ein.

### Lexy templating

Lexy ist ein weiteres Cockpit-Bordmittel und ist an den BladeCompiler von Laravel angelehnt. Die Syntax erinnert etwas an liquid templating (jekyll), ist aber deutlich simpler gehalten.

Ein Theme besteht aus mehreren Template-Dateien, die im Ordner `views` abgelegt sind. 

### Templates

to do...

### sass partials

to do...

### mp.js

Grundsätzlich funktioniert das Theme auch ohne Javascript, zum Aufhübschen oder für Bilder-Lightboxen habe ich ein leichtgewichtiges Toolkit erstellt. Auch `mp.js` ist modular aufgebaut und wird mit Hilfe von Node.js und browserify kompiliert.

**Features**

* simples Cookie-Management
* Handhabung von Privatsphäre-Events
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
