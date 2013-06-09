<?php
/**
 * MarkdownServiceProviderTest.php
 *
 * @package MarkdownServiceProviderTest
 * @author ronan <ronan@studio1555>
 * @version 0.1
 * @copyright (C) 2013 ronan <ronan@studio1555>
 * @license MIT
 */

namespace Rg\Tests;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Rg\Silex\Provider\Markdown\MarkdownServiceProvider;

class MarkdownExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (!class_exists('Michelf\\Markdown')) {
            $this->markTestSkipped('Michelf Markdown Bundle was not installed.');
        }
    }

    public function testRegister()
    {
        $app = new Application();
        $app['debug'] = true;
        $mdPath = __DIR__ .'/../../resources/markdown';
        $app->register(new MarkdownServiceProvider(), array(
            'md.path' => $mdPath)
        );

        $app->get('/', function() use($app) {
            $markdown = $app['md.finder']->getContent(1);
            if($markdown){
                $html = $app['md.parser']->transform($markdown);
                return $html;
            }
        });
        $request = Request::create('/');
        $result = $app->handle($request);

        $this->assertInstanceOf('\Michelf\MarkdownExtra', $app['md.parser']);
        $expected = $app['md.parser']->transform($app['md.finder']->getContent(1));
        $this->assertContains($expected, $result->getContent());
    }
}
?>

