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

    protected $app;
    protected $mdPath;

    public function setUp()
    {
        if (!class_exists('Michelf\\Markdown')) {
            $this->markTestSkipped('Michelf Markdown Bundle was not installed.');
        }

        $this->app = new Application();
        $this->app['debug'] = true;
        $this->mdPath = __DIR__ .'/../../resources/markdown';

    }

    public function testRegister()
    {
        $this->app->register(new MarkdownServiceProvider(), array(
            'md.path' => $this->mdPath)
        );

        $app = $this->app;
        $this->app->get('/', function() use($app) {
            $markdown = $app['md.finder']->getContent(1);
            if($markdown){
                $html = $app['md.parser']->transform($markdown);
                return $html;
            }
        });
        $request = Request::create('/');
        $response = $this->app->handle($request);
        $this->app->terminate($request, $response);

        $this->assertInstanceOf('\Michelf\MarkdownExtra', $this->app['md.parser']);
        $expected = $this->app['md.parser']->transform($this->app['md.finder']->getContent(1));
        $this->assertContains($expected, $response->getContent());

        $html = "<xml>" . $response->getContent() . "</xml>";
        $dom = new \DOMDocument;
        $dom->loadXml($html);
        $title = $dom->getElementsByTagName('h1')->item(0)->nodeValue;
        $this->assertEquals("Well title", $title);

    }
}

?>

