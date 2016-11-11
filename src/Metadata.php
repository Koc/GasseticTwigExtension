<?php

namespace Gassetic;

class Metadata
{
    private $files = array();

    private $env;

    public static function fromJsonFile($path, $env)
    {
        $json = json_decode(file_get_contents($path), true);

        return new static($json, $env);
    }

    public function __construct(array $files, $env)
    {
        $this->files = $files;
        $this->env = $env;
    }

    /**
     * @param string $name
     *
     * @return string[]
     */
    public function getFile($name)
    {
        if (!isset($this->files[$name])) {
            throw new \InvalidArgumentException(sprintf('File "%s" not defined in metadata.', $name));
        }

        return $this->files[$name][$this->env];
    }
}
