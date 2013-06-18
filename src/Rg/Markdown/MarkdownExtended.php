<?php
/**
 * This file is part of the rg/silexmarkdownserviceprovider package.
 *
 */

namespace Rg\Markdown;

use Michelf\MarkdownExtra;

/**
 * Find markdown files
 *
 * @category  Rg
 * @package   SilexMarkdown
 * @author    Ronan Guilloux <ronan.guilloux@gmail.com>
 * @copyright 2013 Ronan Guilloux <ronan.guilloux@gmail.com>
 * @license   MIT https://raw.github.com/ronanguilloux/SilexMarkdown/master/LICENSE.md
 * @version   Release: 0.1
 * @link      https://github.com/ronanguilloux/SilexMarkdown
 */
class MarkdownExtended extends MarkdownExtra
{

    /**
     * getTitle
     * Returns title
     * from a markdown source
     * eventually containing "====" underlined label,
     * usually parsed as <h1>
     *
     * @param string $markdown
     *
     * @return string $title
     */
    public function getTitle($markdown)
    {
        $html = "<xml>" . self::transform($markdown) . "</xml>";
        $dom = new \DOMDocument;
        $dom->loadXml($html);

        return $dom->getElementsByTagName('h1')->item(0)->nodeValue;
    }
}
