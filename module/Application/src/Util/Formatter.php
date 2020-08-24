<?php
declare(strict_types=1);

namespace Application\Util;

class Formatter
{
    /**
     * @param float  $value
     * @param int    $precision
     * @param string $decimalSeparator
     * @param string $thousandoSeparator
     *
     * @return string
     */
    public static function formatNumber(
        float $value,
        int $precision = 0,
        string $decimalSeparator = '.',
        string $thousandoSeparator = ','
    ): string
    {
        return number_format($value, $precision, $decimalSeparator, $thousandoSeparator);
    }


    /**
     * @param float       $value
     * @param string|null $locale
     * @param string|null $currencyCode
     * @param string|null $pattern
     *
     * @return string
     */
    public static function formatMoney(
        float $value,
        ?string $locale = null,
        ?string $currencyCode = null,
        ?string $pattern = null
    ): string
    {
        $locale       = $locale ?? Region::getCurrentLocale();
        $currencyCode = $currencyCode ?? Money::getCurrencyCode($locale);

        $numberFormatter = $pattern ?
            \NumberFormatter::create($locale, \NumberFormatter::CURRENCY, $pattern)
            : \NumberFormatter::create($locale, \NumberFormatter::CURRENCY);

        return $numberFormatter->formatCurrency($value, $currencyCode);
    }


    /**
     * @param \DateTime   $dateTime
     * @param string|null $format
     * @param string|null $locale
     *
     * @return string
     */
    public static function formatDate(\DateTime $dateTime, ?string $format = null, ?string $locale = null): string
    {
        $format = $format ?? DateTime::getDateFormatShort($locale);

        return strftime($format, $dateTime->getTimestamp());
    }


    /**
     * @param \DateTime   $dateTime
     * @param string|null $format
     * @param string|null $locale
     *
     * @return string
     */
    public static function formatTime(\DateTime $dateTime, ?string $format = null, ?string $locale = null): string
    {
        $format = $format ?? DateTime::getTimeFormat($locale);

        return strftime($format, $dateTime->getTimestamp());
    }

}