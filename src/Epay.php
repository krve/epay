<?php

namespace Epay;

class Epay
{
    protected static $currency = 'USD';

    protected static $currency_code = '840';

    protected static $merchant_number = '';

    protected static $password = '';

    /**
     * Set the merchant number
     *
     * @param $merchant_number
     */
    public static function setMerchantNumber($merchant_number)
    {
        static::$merchant_number = $merchant_number;
    }

    /**
     * Set the api password
     *
     * @param $password
     */
    public static function setPassword($password)
    {
        static::$password = $password;
    }

    /**
     * Set the currency used when billing users.
     *
     * @param $currency
     * @param $currency_code
     */
    public static function useCurrency($currency, $currency_code)
    {
        static::$currency = $currency;
        static::$currency_code = $currency_code;
    }

    /**
     * Get the merchant number currently set
     *
     * @return mixed
     */
    public static function usesMerchantNumber()
    {
        return static::$merchant_number;
    }

    /**
     * Get the password currently in use
     *
     * @return mixed
     */
    public static function usesPassword()
    {
        return static::$password;
    }

    /**
     * Get the currency currently in use.
     *
     * @return string
     */
    public static function usesCurrency()
    {
        return static::$currency;
    }

    /**
     * Get the currency code currently in use.
     *
     * @return string
     */
    public static function usesCurrencyCode()
    {
        return static::$currency_code;
    }
}
