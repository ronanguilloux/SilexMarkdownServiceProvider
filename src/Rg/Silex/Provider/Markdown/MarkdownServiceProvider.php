<?php
/**
 * This file is part of the rg/silexmarkdownserviceprovider package.
 *
 */

namespace Rg\Silex\Provider\Markdown;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Rg\Markdown\MarkdownExtended;
use Rg\Markdown\Finder;
use Rg\Twig\Extension\Markdown as Markdown;

/**
 * Silex Michelf's Markdown Provider
 *
 * @category  Rg
 * @package   SilexMarkdown
 * @author    Ronan Guilloux <ronan.guilloux@gmail.com>
 * @copyright 2013 Ronan Guilloux <ronan.guilloux@gmail.com>
 * @license   MIT https://raw.github.com/ronanguilloux/SilexMarkdown/master/LICENSE.md
 * @version   Release: 0.1
 * @link      https://github.com/ronanguilloux/SilexMarkdown
 */
class MarkdownServiceProvider implements ServiceProviderInterface
{

    /**
     * register
     *
     * @param Application $app
     *
     * @return mixed registered services
     */
    public function register(Application $app)
    {
        $app['md.parser'] = $app->share(function () use ($app) {
            return new MarkdownExtended();
        });

        $app['md.finder'] = $app->share(function () use ($app) {
            $args = array('path' => ($app['md.path']) ? $app['md.path'] : null);

            return new Finder($args);
        });
    }

    /**
     * boot
     *
     * @param Application $app
     *
     * @return void
     */
    public function boot(Application $app)
    {

    }
}
