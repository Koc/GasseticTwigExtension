<?php

namespace Gassetic;

use Symfony\Component\Yaml\Yaml;

class Metadata
{
    private $files = array();

    private $env;

    public static function fromYamlFile($path, $env)
    {
        $yaml = Yaml::parse(file_get_contents($path));

        return new static($yaml, $env);
    }

    public function __construct(array $files = [], $env = 'dev')
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
        foreach ($this->files as $mimetype) {
            if (isset($mimetype['files'][$name])) {
                return $mimetype['files'][$name];
            }
        }

        throw new \InvalidArgumentException(sprintf('File "%s" not defined in metadata.', $name));
    }
}
