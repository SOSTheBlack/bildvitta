<?php

namespace App\Exceptions\Api;

use Throwable;

/**
 * Class TokenException
 *
 * 1001 - 'missing token, is has required'.
 * 1002 - 'invalid token'.
 */
class TokenException extends ApiException implements Throwable
{
    //
}
