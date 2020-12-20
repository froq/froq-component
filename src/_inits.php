<?php
/**
 * Copyright (c) 2015 · Kerem Güneş
 * Apache License 2.0 <https://opensource.org/licenses/apache-2.0>
 */
declare(strict_types=1);

// Global stuff.
{
    /**
     * Init Froq! global.
     */
    if (!isset($GLOBALS['@froq'])) {
        $GLOBALS['@froq'] = [];
    }

    /**
     * Set global.
     * @param  string $key
     * @param  any    $value
     * @return void
     */
    function set_global(string $key, $value)
    {
        $GLOBALS['@froq'][$key] = $value;
    }

    /**
     * Get global.
     * @param  string   $key
     * @param  any|null $default
     * @return any|null
     */
    function get_global(string $key, $default = null)
    {
        if ($key === '*') { // All.
            $value = $GLOBALS['@froq'];
        } elseif ($key[-1] === '*') { // All subs (eg: "foo*" or "foo.*").
            $values = [];
            $search = substr($key, 0, -1);
            foreach ($GLOBALS['@froq'] as $key => $value) {
                if ($search && str_starts_with($key, $search)) {
                    $values[$key] = $value;
                }
            }
            $value = $values;
        } else { // Sub only (eg: "foo" or "foo.bar").
            $value = $GLOBALS['@froq'][$key] ?? $default;
        }
        return $value;
    }

    /**
     * Delete global.
     * @param  string $key
     * @return void
     * @since  3.0
     */
    function delete_global(string $key)
    {
        unset($GLOBALS['@froq'][$key]);
    }
}

// System stuff.
{
    /**
     * Ini.
     * @param  string   $name
     * @param  any|null $default
     * @param  bool     $bool
     * @return string|bool|null
     * @since  4.0
     */
    function ini(string $name, $default = null, bool $bool = false)
    {
        $value = (string) ini_get($name);
        if ($value === '') {
            $value = $default;
        }

        static $bools = ['on', 'yes', 'true', '1'];

        if ($bool) {
            $value = $value && in_array(strtolower($value), $bools);
        }

        return $value;
    }

    /**
     * Env.
     * @param  string   $name
     * @param  any|null $default
     * @param  bool     $server_lookup
     * @return any|null
     * @since  4.0
     */
    function env(string $name, $default = null, bool $server_lookup = true)
    {
        $value = $_ENV[$name] ?? $_ENV[strtoupper($name)] ?? null;

        if ($value === null) {
            // Try with server global.
            if ($server_lookup) {
                $value = $_SERVER[$name] ?? $_SERVER[strtoupper($name)] ?? null;
            }

            if ($value === null) {
                // Try with getenv() (ini variable order issue).
                if (($value = getenv($name)) === false) {
                    if (($value = getenv(strtoupper($name))) === false) {
                        unset($value); // Set as null back.
                    }
                }
            }
        }

        return $value ?? $default;
    }
}

// Casting utility stuff.
{
    /**
     * Int.
     * @param  numeric $in
     * @return int
     * @since  3.0
     */
    function int($in): int
    {
        return (int) $in;
    }

    /**
     * Float.
     * @param  numeric  $in
     * @param  int|null $precision
     * @return float
     * @since  3.0
     */
    function float($in, int $precision = null): float
    {
        return !$precision ? (float) $in : round((float) $in, $precision);
    }

    /**
     * String.
     * @param  scalar $in
     * @param  bool   $trim
     * @return string
     * @since  3.0
     */
    function string($in, bool $trim = false): string
    {
        return !$trim ? (string) $in : trim((string) $in);
    }

    /**
     * Bool.
     * @param  scalar $in
     * @return bool
     * @since  3.0
     */
    function bool($in): bool
    {
        return (bool) $in;
    }

    // function array(): array {} // :(

    /**
     * Object.
     * @param  object|array|null $in
     * @return object
     * @since  3.0
     */
    function object($in = null): object
    {
        return (object) $in;
    }

    /**
     * Void.
     * @param  any &...$ins
     * @return void
     * @since  3.0
     */
    function void(&...$ins): void
    {
        foreach ($ins as &$in) {
            $in = null;
        }
    }
}

// Merge/append/prepend/aggregate.
{
    /**
     * Merge.
     * @param  array $array
     * @param  ...   $arrays
     * @return array
     * @since  4.0
     */
    function merge(array &$array, ...$arrays): array
    {
        return ($array = array_merge($array,
            ...array_map(fn($v) => (array) $v, $arrays)));
    }

    /**
     * Append.
     * @param  array &$array
     * @param  ...    $values
     * @return array
     * @since  4.0
     */
    function append(array &$array, ...$values): array
    {
        return array_append($array, ...$values);
    }

    /**
     * Prepend.
     * @param  array &$array
     * @param  ...    $values
     * @return array
     * @since  4.0
     */
    function prepend(array &$array, ...$values): array
    {
        return array_prepend($array, ...$values);
    }

    /**
     * Aggregate.
     * @param  array      $array
     * @param  callable   $func
     * @param  array|null $carry
     * @return array
     * @since  4.4
     */
    function aggregate(array $array, callable $func, array $carry = null): array
    {
        return array_aggregate($array, $func, $carry);
    }
}

// Dirty debug (dump) tools.. :(
{
    function _ps($s) {
        if (is_null($s)) return 'NULL';
        if (is_bool($s)) return $s ? 'TRUE' : 'FALSE';
        return preg_replace('~\[(.+?):.+?:(private|protected)\]~', '[\1:\2]', print_r($s, true));
    }
    function _pd($s) {
        ob_start(); var_dump($s); $s = ob_get_clean();
        return preg_replace('~\["?(.+?)"?(:(private|protected))?\]=>\s+~', '[\1\2] => ', _ps(trim($s)));
    }
    function pre($s, $e=false) {
        echo "<pre>", _ps($s), "</pre>", "\n";
        $e && exit;
    }
    function prs($s, $e=false) {
        echo _ps($s), "\n";
        $e && exit;
    }
    function prd($s, $e=false) {
        echo _pd($s), "\n";
        $e && exit;
    }
}