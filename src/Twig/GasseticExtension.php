<?php

namespace Gassetic\Bridge\Twig;

use Gassetic\Metadata;

class GasseticExtension extends \Twig_Extension
{
    private $metadata;

    public function __construct(Metadata $metadata)
    {
        $this->metadata = $metadata;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('gassetic_files', array($this, 'getFiles')),
        );
    }

    public function getFiles($names)
    {
        $names = (array) $names;
        $files = array();

        foreach ($names as $name) {
            $files[] = $this->metadata->getFile($name);
        }

        return call_user_func_array('array_merge', $files);
    }
}
