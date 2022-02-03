<?php
/**
 * Copyright (c) 2015 · Kerem Güneş
 * Apache License 2.0 · http://github.com/froq/froq-common
 */
declare(strict_types=1);

namespace froq\common\trait;

use froq\util\Objects;
use ReflectionObject, ReflectionObjectExtended;

/**
 * Object Trait.
 *
 * Represents a trait entity for objects which may be used with ConstantTrait, PropertyTrait and MethodTrait.
 *
 * @package froq\common\trait
 * @object  froq\common\trait\ObjectTrait
 * @author  Kerem Güneş
 * @since   5.0
 */
trait ObjectTrait
{
    /**
     * Reflect & return reflection
     *
     * @param  bool $extended
     * @return ReflectionObject|ReflectionObjectExtended
     */
    public final function reflect(bool $extended = false): ReflectionObject|ReflectionObjectExtended
    {
        return !$extended ? new ReflectionObject($this) : new ReflectionObjectExtended($this);
    }

    /**
     * Get id.
     *
     * @param  bool $withName
     * @return string
     */
    public final function getId(bool $withName = true): string
    {
        return Objects::getId($this, $withName);
    }

    /**
     * Get hash.
     *
     * @param  bool $withName
     * @param  bool $withRehash
     * @return string
     */
    public final function getHash(bool $withName = true, bool $withRehash = false): string
    {
        return Objects::getHash($this, $withName, $withRehash);
    }

    /**
     * Get serialized hash.
     *
     * @return string
     */
    public final function getSerializedHash(): string
    {
        return Objects::getSerializedHash($this);
    }

    /**
     * Get name.
     *
     * @return string
     */
    public final function getName(): string
    {
        return Objects::getName($this);
    }

    /**
     * Get short name.

     * @return string
     */
    public final function getShortName(): string
    {
        return Objects::getShortName($this);
    }

    /**
     * Get namespace.

     * @param  bool $baseOnly
     * @return string
     */
    public final function getNamespace(bool $baseOnly = false): string
    {
        return Objects::getNamespace($this, $baseOnly);
    }

    /**
     * Get parents.
     *
     * @return array|null
     */
    public final function getParents(): array|null
    {
        return Objects::getParents($this);
    }

    /**
     * Get interfaces.
     *
     * @return array|null
     */
    public final function getInterfaces(): array|null
    {
        return Objects::getInterfaces($this);
    }

    /**
     * Get traits.
     *
     * @param  bool $all
     * @return array|null
     */
    public final function getTraits(bool $all = true): array|null
    {
        return Objects::getTraits($this, $all);
    }
}
