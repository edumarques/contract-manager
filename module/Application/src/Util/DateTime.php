<?php
declare(strict_types=1);

namespace Application\Util;

class DateTime
{
    /**
     * @return string
     */
    public static function getDefaultDateFormatShort(): string
    {
        return '%m/%d/%Y';
    }


    /**
     * @return string
     */
    public static function getDefaultDateFormatLong(): string
    {
        return '%m/%d/%Y %l:%M %P';
    }


    /**
     * @return string
     */
    public static function getDefaultDateFormatTextualShort(): string
    {
        return '%B %d, %Y';
    }


    /**
     * @return string
     */
    public static function getDefaultDateFormatTextualLong(): string
    {
        return '%B %d, %Y at %l:%M %P';
    }


    /**
     * @return string
     */
    public static function getDefaultTimeFormat(): string
    {
        return '%H:%M';
    }


    /**
     * @param string|null $locale
     *
     * @return string
     */
    public static function getDateFormatShort(?string $locale = null): string
    {
        $locale = $locale ?? Region::getCurrentLocale();

        switch ($locale) {
            case 'pt_BR':
                return '%d/%m/%Y';
            case 'de_DE':
                return '%d.%m.%Y';
            default:
                return self::getDefaultDateFormatShort();
        }
    }


    /**
     * @param string|null $locale
     *
     * @return string
     */
    public static function getDateFormatLong(?string $locale = null): string
    {
        $locale = $locale ?? Region::getCurrentLocale();

        switch ($locale) {
            case 'pt_BR':
                return '%d/%m/%Y %H:%M';
            case 'de_DE':
                return '%d.%m.%Y %H:%M';
            default:
                return self::getDefaultDateFormatLong();
        }
    }


    /**
     * @param string|null $locale
     *
     * @return string
     */
    public static function getDateFormatTextualShort(?string $locale = null): string
    {
        $locale = $locale ?? Region::getCurrentLocale();

        switch ($locale) {
            case 'pt_BR':
                return '%d de %B de %Y';
            case 'de_DE':
                return 'der %d.%B %Y';
            default:
                return self::getDefaultDateFormatTextualShort();
        }
    }


    /**
     * @param string|null $locale
     *
     * @return string
     */
    public static function getDateFormatTextualLong(?string $locale = null): string
    {
        $locale = $locale ?? Region::getCurrentLocale();

        switch ($locale) {
            case 'pt_BR':
                return '%d de %B de %Y às %H:%M';
            case 'de_DE':
                return 'der %d.%B %Y, um %H:%M';
            default:
                return self::getDefaultDateFormatTextualLong();
        }
    }


    /**
     * @param string|null $locale
     *
     * @return string
     */
    public static function getTimeFormat(?string $locale = null): string
    {
        return self::getDefaultTimeFormat();
    }

}