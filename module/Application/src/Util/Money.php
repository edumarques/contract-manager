<?php
declare(strict_types=1);

namespace Application\Util;

use Symfony\Component\Intl\Currencies;

class Money
{
    /**
     * @return string
     */
    public static function getDefaultCurrencyCode(): string
    {
        return 'USD';
    }


    /**
     * @param string|null $locale
     *
     * @return string|null
     */
    public static function getCurrencyCode(?string $locale = null): ?string
    {
        $locale = $locale ?? Region::getDefaultLocale();

        switch ($locale) {
            case 'pt_BR':
                return 'BRL';
            case 'de_DE':
                return 'EUR';
            case 'en_US':
                return 'USD';
            default:
                return self::getDefaultCurrencyCode();
        }
    }


    /**
     * @param string|null $locale
     *
     * @return string|null
     */
    public static function getCurrencySymbol(?string $locale = null): ?string
    {
        return Currencies::getSymbol(self::getCurrencyCode($locale));
    }

}