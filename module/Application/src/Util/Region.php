<?php
declare(strict_types=1);

namespace Application\Util;

class Region
{
    /**
     * @return string
     */
    public static function getCurrentTimeZone(): string
    {
        return date_default_timezone_get();
    }


    /**
     * @return string
     */
    public static function getBrazilianTimeZone(): string
    {
        return 'America/Recife';
    }


    /**
     * @return string
     */
    public static function getBrazilianTimeZoneDaylightSavings(): string
    {
        return 'America/Sao_Paulo';
    }


    /**
     * @return \DateTimeZone
     */
    public static function getCurrentTimeZoneObj(): \DateTimeZone
    {
        return new \DateTimeZone(self::getCurrentTimeZone());
    }


    /**
     * @return \DateTimeZone
     */
    public static function getBrazilianTimeZoneObj(): \DateTimeZone
    {
        return new \DateTimeZone(self::getBrazilianTimeZone());
    }


    /**
     * @return \DateTimeZone
     */
    public static function getBrazilianTimeZoneDaylightSavingsObj(): \DateTimeZone
    {
        return new \DateTimeZone(self::getBrazilianTimeZoneDaylightSavings());
    }


    /**
     * @return string
     */
    public static function getCurrentLocale(): string
    {
        return \Locale::getDefault();
    }


    /**
     * @return string
     */
    public static function getDefaultLocale(): string
    {
        return self::getBrazilianLocale();
    }


    /**
     * @return string
     */
    public static function getBrazilianLocale(): string
    {
        return 'pt_BR';
    }

}