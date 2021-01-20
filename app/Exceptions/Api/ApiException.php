<?php

namespace App\Exceptions\Api;

use App\Exceptions\AppException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

/**
 * Class ApiException
 */
class ApiException extends HttpException implements Throwable
{
    //
}
