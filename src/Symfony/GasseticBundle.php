<?php

namespace Gassetic\Bridge\Symfony;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GasseticBundle extends Bundle
{
    protected function getContainerExtensionClass()
    {
        return GasseticExtension::class;
    }
}
