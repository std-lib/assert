<?php

namespace Std;

/**
 * Extend the absolutely amazing Webmozart Assertion Class with a few extra definitions.
 *
 * @author A.B. Carroll <ben@hl9.net>
 *
 * @method static void nullOrHostname($value, $message = '')
 * @method static void allHostname($values, $message = '')
 */
class Assert extends \Webmozart\Assert\Assert
{
    /**
     * Checks a value if it is a valid hostname.  Note that it does NOT mean domain -- it may NOT contain '.'
     *
     * More of a demonstration as to the complexity of negating the Webmozart assertions.
     *
     * @param string      $value
     * @param string|null $message
     * @static
     */
    public static function hostname(string $value, string $message = null): void
    {
        $isIp = true;

        try {
            self::ipv4($value);
        } catch (\Throwable $e) {
            $isIp = false;
        }
        self::false($isIp, "The value $value is not a valid hostname (is ipv4)");
        self::regex(
            $value,
            "#^(((?!-))(xn--|_{1,1})?[a-z0-9-]{0,61}[a-z0-9]{1,1}\.)*(xn--)?([a-z0-9][a-z0-9\-]{0,60}|[a-z0-9-]{1,30}\.[a-z]{2,})$#i",
            \sprintf(
                $message ? : 'The value %s is not a valid hostname',
                static::valueToString($value)
            )
        );
    }

    public static function containsDot(string $value, string $message = null): void
    {
        self::contains($value, '.');
    }
}
