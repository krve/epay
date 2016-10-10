<?php

namespace Epay;

use Epay\Error\OptionRequired;

class Api
{
    protected static $apiURL;

    protected static $required = [];

    public function __construct(array $data)
    {
        foreach($data as $key => $value) {
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

        $client = new \SoapClient(static::$apiURL);

        $payload = array_merge([
            'merchantnumber' => $merchantNumber,
            'pwd' => $password,
            'epayresponse' => ''
        ], $params);

        return $client->__soapCall($method, [$payload], $options);
    }

    /**
     * Perform a special subscription request (for their 'other' API)
     *
     * @param       $method
     * @param array $params
     * @param array $options
     *
     * @return mixed
     * @throws \Exception
     */
    public static function subRequest($method, array $params = [], array $options = [])
    {
        if (! static::$apiURL) {
            throw new \Exception('Epay Api URL not defined');
        }

        $merchantNumber = Epay::usesMerchantNumber();
        $password = Epay::usesPassword();

        $client = new \SoapClient(static::$apiURL);

        $payload = array_merge([
            'authentication' => [
                'merchantnumber' => $merchantNumber,
                'password' => $password,
            ],
        ], $params);

        $payload = [
            ("${method}request") => $payload
        ];

        $response = $client->__soapCall($method, [$payload], $options);

        $responseObject = $method . 'Result';

        return $response->$responseObject;
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

        foreach($requireds as $required) {
            if (in_array($required, $dataKeys) && $data[$required] == null) {
                throw new OptionRequired($required);
            }

            if (! in_array($required, $dataKeys)) {
                throw new OptionRequired($required);
            }
        }
    }
}
