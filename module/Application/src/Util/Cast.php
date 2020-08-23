<?php
declare(strict_types=1);

namespace Application\Util;

class Cast
{
    /**
     * @param mixed    $value
     * @param int|null $default
     *
     * @return int|null
     */
    public static function toInt($value, ?int $default = null): ?int
    {
        $return = $value !== null ? (int) $value : null;

        if ($return === null) {
            $return = $default;
        }

        return $return;
    }


    /**
     * @param mixed      $value
     * @param float|null $default
     *
     * @return float|null
     */
    public static function toFloat($value, ?float $default = null): ?float
    {
        $return = $value !== null ? (float) $value : null;

        if ($return === null) {
            $return = $default;
        }

        return $return;
    }


    /**
     * @param mixed       $value
     * @param string|null $default
     *
     * @return string|null
     */
    public static function toString($value, ?string $default = null): ?string
    {
        $return = $value !== null ? (string) $value : null;

        if ($return === null) {
            $return = $default;
        }

        return $return;
    }


    /**
     * @param mixed              $value
     * @param \DateTimeZone|null $timeZone
     * @param \DateTime|null     $default
     *
     * @throws \Exception
     * @return \DateTime|null
     */
    public static function toDateTime($value, ?\DateTimeZone $timeZone = null, ?\DateTime $default = null): ?\DateTime
    {
        $return = null;

        if ($value !== null) {
            if (is_string($value)) {
                $return = new \DateTime($value, $timeZone);
            }
            elseif (is_int($value) || is_float($value)) {
                $value  = self::toInt($value);
                $return = new \DateTime('@' . $value, $timeZone);
            }
        }

        if ($return === null) {
            $return = $default;
        }

        return $return;
    }

}