<?php
/**
 * Copyright (c) 2015 · Kerem Güneş
 * Apache License 2.0 · http://github.com/froq/froq-common
 */
declare(strict_types=1);

namespace froq\common\trait;

/**
 * Data Count Trait.
 *
 * A trait, provides `count()` method for the classes defining `$data` property as array.
 *
 * @package froq\common\trait
 * @object  froq\common\trait\DataCountTrait
 * @author  Kerem Güneş
 * @since   5.7
 */
trait DataCountTrait
{
    /**
     * Get count of data array.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->data);
    }
}
