<?php

namespace App\Components\Grifo;

use App\Exceptions\AppException;
use Throwable;

/**
 * Class GrifoException
 *
 * 1001 - 'Currency(%s->%s) conversion is not possible'
 *
 * @package App\Components\Grifo
 */
class GrifoException extends AppException implements Throwable
{
    //
}
