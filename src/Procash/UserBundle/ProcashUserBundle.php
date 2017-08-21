<?php

namespace Procash\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ProcashUserBundle extends Bundle
 {

    public function getParent() {
        return 'FOSUserBundle';
    }

}
