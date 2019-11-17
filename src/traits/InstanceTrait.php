<?php
/**
 * MIT License <https://opensource.org/licenses/mit>
 *
 * Copyright (c) 2015 Kerem Güneş
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
declare(strict_types=1);

namespace froq\traits;

/**
 * Instance Trait.
 * @package froq\traits
 * @object  froq\traits\instanceTrait
 * @author  Kerem Güneş <k-gun@mail.com>
 * @since   4.0
 */
trait InstanceTrait
{
    /**
     * Instance.
     * @var object
     */
    private static object $__instance;

    /**
     * Init.
     * @param  ... $arguments
     * @return object
     */
    public static final function init(...$arguments): object
    {
        return self::$__instance ?? (
               self::$__instance = new static(...$arguments)
        );
    }

    /**
     * Get instance.
     * @aliasOf init()
     */
    public static final function getInstance(...$arguments)
    {
        return self::init(...$arguments);
    }
}