<?php

namespace App\Exceptions\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException as BaseModelNotFoundException;
/**
 * Class ModelNotFoundException
 *
 * 1001 - error when inserting database.
 *
 * @package App\Exceptions\Repositories
 */
class ModelNotFoundException extends BaseModelNotFoundException
{

}
