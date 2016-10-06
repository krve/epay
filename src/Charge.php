<?php

namespace Epay;

use Epay\Error\Errors;
use Epay\Error\EpayException;

class Charge extends Api
{
    protected static $apiURL = 'https://ssl.ditonlinebetalingssystem.dk/remote/subscription.asmx?WSDL';

    protected static $required = ['amount', 'order', 'customer'];

    /**
     * Creates a new charge
     *
     * @param array $options
     * @return \Epay\Charge
     * @throws \Epay\Error\EpayException
     */
    public static function create(array $options)
    {
        static::validate($options);

        $currency = isset($options['currency']) ? $options['currency'] : Epay::usesCurrencyCode();
        $instant_capture = isset($options['instant_capture']) ? $options['instant_capture'] : 1;
        $description = isset($options['description']) ? $options['description'] : '';

        // Create the payload
        $payload = [
            'subscriptionid' => $options['customer'],
            'orderid' => $options['order'],
            'amount' => $options['amount'],
            'currency' => $currency,
            'instantcapture' => $instant_capture,
            'description' => $description,
            'fraud' => '',
            'transactionid' => '',
            'pbsresponse' => '',
        ];

        $response = static::request('authorize', $payload);

        if ($response->authorizeResult == true) {
            // Return a new instance of it self
            return new self([
                'amount' => $options['amount'],
                'currency' => $currency,
                'customer' => $options['customer'],
                'instant_capture' => $instant_capture,
                'order' => $options['order'],
                'transaction_id' => $response->transactionid,
                'description' => $description
            ]);
        }

        // Throw an error based on the error code
        throw new EpayException(Errors::getMessage($response->epayresponse));
    }
}
