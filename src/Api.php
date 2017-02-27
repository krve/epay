<?php

namespace Epay;

use Epay\Error\OptionRequired;

class Api
{
    protected static $apiURL;

    protected static $required = [];

    /**
     * Api constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Set the API Url
     *
     * @param string $url
     */
    public static function setApiURL($url)
    {
        static::$apiURL = $url;
    }

    /**
     * Perform a request
     *
     * @param       $method
     * @param array $params
     * @param array $options
     *
     * @return mixed
     * @throws \Exception
     */
    public static function request($method, array $params = [], array $options = [])
    {
        if (! static::$apiURL) {
            throw new \Exception('Epay Api URL not defined');
        }

        $merchantNumber = Epay::usesMerchantNumber();
        $password = Epay::usesPassword();

        if ($merchantNumber == null) {
            throw new \Exception('Merchant number is not defined');
        }

        $client = new \SoapClient(static::$apiURL);

        if (preg_match("/ssl\.ditonlinebetalingssystem\.dk/", static::$apiURL) == true) {
            $payload = array_merge([
                'merchantnumber' => $merchantNumber,
                'pwd' => $password,
                'epayresponse' => ''
            ], $params);

            return $client->__soapCall($method, [$payload], $options);
        } elseif (preg_match("/recurring\.api\.epay\.eu\/v1/", static::$apiURL) == true) {
            $payload = array_merge([
                'authentication' => [
                    'merchantnumber' => $merchantNumber,
                    'password' => $password,
                ],
            ], $params);

            $payload = [
                ("${method}request") => $payload
            ];

            $responseObject = $method . 'Result';

            return $client->__soapCall($method, [$payload], $options)->$responseObject;
        }

        throw new \Exception('API Url could not be matched.');
    }

    /**
     * Validate the data to see if the required keys are set
     *
     * @param array      $data
     * @param array|null $requireds
     *
     * @throws \Epay\Error\OptionRequired
     */
    public static function validate(array $data, array $requireds = null)
    {
        $requireds = $requireds ?: static::$required;

        $dataKeys = array_keys($data);

        foreach ($requireds as $required) {
            if (in_array($required, $dataKeys) && $data[$required] == null) {
                throw new OptionRequired($required);
            }

            if (! in_array($required, $dataKeys)) {
                throw new OptionRequired($required);
            }
        }
    }
}
