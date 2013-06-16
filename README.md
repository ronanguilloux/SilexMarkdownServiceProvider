Silex Markdown Service Provider
===============================

[Silex PHP micro-framework](https://github.com/fabpot/silex/) Markdown Service Provider

To be used with Michel Fortin's [michelf/php-markdown](https://github.com/michelf/php-markdown) 
PHP parser for Markdown and Markdown Extra derived from the original Markdown.pl by John Gruber

[![Build Status](https://secure.travis-ci.org/ronanguilloux/SilexMarkdownServiceProvider.png?branch=master)](http://travis-ci.org/ronanguilloux/SilexMarkdownServiceProvider)
[![Total Downloads](https://poser.pugx.org/ronanguilloux/SilexMarkdownServiceProvider/downloads.png)](https://packagist.org/packages/ronanguilloux/SilexMarkdownServiceProvider)

Implementations examples:

* [SilexMarkdown demo website](https://github.com/ronanguilloux/SilexMarkdown) (github repository)


Usage
-----

``` php
<?php

# app.php

use Rg\Silex\Provider\Markdown\MarkdownServiceProvider;

$app->register(new MarkdownServiceProvider(), array(
    'md.path' => __DIR__ .'/relative-path-to-markdown-files-directory')
);

// Retrieve .md file content
$markdown = $app['md.finder']->getContent('path-to-mardown-file');

// Parse it into html
$html = $app['md.parser']->transform($markdown);

```


Tests
-----

Tests need --dev option while installing dependecing using composer:

    $ composer.phar install --dev
    $ wget http://pear.phpunit.de/get/phpunit.phar
    $ chmod +x phpunit.phar
    $ ./phpunit.phar


License
-------

This Silex Service Provider is released under the MIT License.  
See the bundled LICENSE file for details.  
You can find a copy of this software here: https://github.com/ronanguilloux/SilexMarkdownServiceProvider
