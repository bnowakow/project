<?php

namespace MasterPoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MasterPoBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
