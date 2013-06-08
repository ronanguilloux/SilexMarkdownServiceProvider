<?php
/**
 * This file is part of the rg/silexmarkdownserviceprovider package.
 *
 */

namespace Rg\Markdown;

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
class Finder
{

    protected $basePath = __DIR__;
    protected $extension  = 'md';

    /**
     * __construct
     *
     * @param array $args ('path' => $path, 'extension => $extension)
     *
     * @return void
     */
    public function __construct($args = array())
    {
        if (!empty($args['path']) && file_exists($args['path'])) {
            $this->basePath = $args['path'];
        }
        if (!empty($args['extension'])) {
            $this->extension = $args['extension'];
        }
    }

    /**
     * getContent
     * Retrieve a file content using the given path
     *
     * @param string $path the markdown file path
     *
     * @return mixed: false or the markdown file raw content (string)
     */
    public function getContent($path)
    {
        // only a page index was given ?
        if (('0' == $path) || (int) ($path) > 0) {
            $path = $this->findByIndex($path);
        } else {
            $path = $this->basePath . '/' . $path;
            $infos = pathinfo($path);
            // was the extension given ?
            if (empty($infos['extension'])) {
                $path .= '.md';
            }
        }
        if (file_exists($path)) {
            return file_get_contents($path);
        }

        return false;
    }

    /**
     * findByIndex
     * Retrieve a filepath using the index that starts the searched file name
     * by ex: 1 stands for 1-summary.md
     *
     * @param mixed $int the page index
     *
     * @return mixed false/string the file path that matches the given $int
     */
    protected function findByIndex($int)
    {
        $files = glob($this->basePath . "/$int-*.md");
        if (0 < count($files)) {
            return $files[0];
        }

        return false;
    }

    /**
     * getList
     *
     * @return array mardown file list
     */
    public function getList()
    {
        $list = glob($this->basePath . "/*.md");
        foreach ($list as $key=>$item) {
            $item = pathinfo($item);
            $item = $item['filename'];
            $item = preg_split("/^[\d-]+/", $item, 2, PREG_SPLIT_NO_EMPTY);
            $list[$key] = ucfirst($item[0]);
        }

        return $list;
    }
}
