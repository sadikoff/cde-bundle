<?php

/*
 * This file is part of the koff/cde-bundle package.
 *
 * (c) Vladimir Sadicov <sadikoff@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koff\CdeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KoffCdeBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
