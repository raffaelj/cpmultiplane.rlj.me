# Lexy templating in Cockpit CMS

Lexy is a simple template parser class, that uses regex replacements to generate valid php from shortcodes.

## Core

Sources:

* https://github.com/agentejo/cockpit/blob/next/lib/Lexy.php
* https://github.com/agentejo/cockpit/blob/next/lib/Lime/App.php#L521

### comments

template:
```lexy
{{-- this is a comment --}}
```
output:
```php
<?php /* this is a comment */ ?>
```

### echos

**raw:**

template:
```lexy
{{ $str }}
```
output:
```php
<?php echo $str; ?>
```

**escaped:**

template:
```lexy
{{{ $str }}}
```
output:
```php
<?php echo htmlentities($str, ENT_QUOTES, "UTF-8", false); ?>
```

### if, foreach, for, while

template:
```lexy
@if(is_string($str))
    <p>{{ $str }}</p>
@elseif(is_array($str))
    <pre>{% print_r($str) %}</pre>
@else
    <p>I don't know, what to do</p>
@endif

<ul>
@foreach($data as $str)
    <li>{{ $str }}</li>
@endforeach
</ul>
```
output:
```php
<?php if (is_string($str)) { ?>
    <p><?php echo  $str ; ?></p>
<?php } elseif(is_array($str)) { ?>
    <pre><?php print_r($str) ?></pre>
<?php } else { ?>
    <p>I don't know, what to do</p>
<?php } ?>

<ul>
<?php foreach ($data as $str) { ?>
    <li><?php echo  $str ; ?></li>
<?php } ?>
</ul>
```

### php tags

template:
```lexy
{% $color = 'white' %}
<p>Follow the {{ $color }} rabbit.</p>
```
output:
```php
<?php $color = 'white' ?>
<p>Follow the <?php echo  $color ; ?> rabbit.</p>
```

### other

**print double braces**

template:
```lexy
@@some text@@
```
output:
```php
{{some text}}
```

## LimeExtra extensions

see: https://github.com/agentejo/cockpit/blob/next/lib/LimeExtra/App.php#L45-L70

to do...

```php
'extend'   => '<?php $extend(expr); ?>',
'base'     => '<?php $app->base(expr); ?>',
'route'    => '<?php $app->route(expr); ?>',
'trigger'  => '<?php $app->trigger(expr); ?>',
'assets'   => '<?php echo $app->assets(expr); ?>',
'start'    => '<?php $app->start(expr); ?>',
'end'      => '<?php $app->end(expr); ?>',
'block'    => '<?php $app->block(expr); ?>',
'url'      => '<?php echo $app->pathToUrl(expr); ?>',
'view'     => '<?php echo $app->view(expr); ?>',
'render'   => '<?php echo $app->view(expr); ?>',
'include'  => '<?php echo include($app->path(expr)); ?>',
'lang'     => '<?php echo $app("i18n")->get(expr); ?>',
```

### extend

pass a layout file to the renderer

template:
```lexy
@extend('cockpit:views/layouts/app.php')
```
output:
```php
<?php $extend('cockpit:views/layouts/app.php'); ?>
```
see: https://github.com/agentejo/cockpit/blob/next/lib/Lime/App.php#L540-L542

## CpMultiplane extensions

### image url shortcuts

Create image path urls with predefined sizes from assets ids or paths.

#### @uploads

template:
```lexy
<img src="@uploads($asset)" />
```
output:
```php
<img src="<?php echo MP_BASE_URL; $app->base("#uploads:" . ltrim($asset['path'], "/")); ?>" />
```

#### @logo

template:
```lexy
<img src="@logo($asset)" />
```
output:
```php
<img src="<?php echo MP_BASE_URL."/getImage?src=".urlencode($asset['_id'] ?? $asset['path'])."&w=".$app->module('multiplane')->get("lexy/logo/width", 200)."&h=".$app->module('multiplane')->get("lexy/logo/height", 200)."&q=".$app->module('multiplane')->get("lexy/logo/quality", 80); ?>" />
```
html output:
```html
<img src="/getImage?src=5e8c6677343137adc70001c1&w=200&h=200&q=80" />
```

The same procedure is used for the other image url shortcuts:

* **@thumbnail**
* **@bigthumbnail**
* **@image**
* **@headerimage**

