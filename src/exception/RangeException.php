<?php
/**
 * Copyright (c) 2015 · Kerem Güneş
 * Apache License 2.0 · http://github.com/froq/froq-common
 */
declare(strict_types=1);

namespace froq\common\exception;

use froq\common\interface\Thrownable;
use froq\common\trait\ThrownableTrait;

/**
 * @package froq\common\exception
 * @object  froq\common\exception\RangeException
 * @author  Kerem Güneş
 * @since   4.0
 */
class RangeException extends \RangeException implements Thrownable
{
    use ThrownableTrait;
}
