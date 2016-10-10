<?php

namespace Epay;

use Epay\Error\ErrorParser;
use Epay\Error\EpayException;

class Customer extends Api
{
    protected static $apiURL = 'https://ssl.ditonlinebetalingssystem.dk/remote/subscription.asmx?WSDL';

    public $id;
    public $description;
    public $created;
    public $exp_month;
    public $exp_year;
    public $card_type_id;
    public $transactions;

    public function __construct($id, $description, $created, $exp_month, $exp_year, $card_type_id, $transactions)
    {
        $this->id = $id;
        $this->description = $description;
        $this->created = $created;
        $this->exp_month = $exp_month;
        $this->exp_year = $exp_year;
        $this->card_type_id = $card_type_id;

        // Create an array based on the amount of transactions
        if (count((array)$transactions) == 0) {
            $this->transactions = [];
        } else if (count($transactions->TransactionInformationType) == 1) {
            $this->transactions =[$transactions->TransactionInformationType];
        } else if (count($transactions->TransactionInformationType) > 1) {
            $this->transactions = $transactions->TransactionInformationType;
        }
    }

    /**
     * Delete the customer
     *
     * @return bool
     * @throws \Epay\Error\EpayException
     */
    public function delete()
    {
        $payload = [
            'subscriptionid' => $this->id
        ];

        $response = static::request('deletesubscription', $payload);

        if ($response->deletesubscriptionResult == true) {
            return true;
        }

        throw new EpayException(ErrorParser::getMessage($response->epayresponse));
    }

    /**
     * Find a customer by the customer_id
     *
     * @param $customer_id
     *
     * @return \Epay\Customer
     * @throws \Epay\Error\EpayException
     */
    public static function retrieve($customer_id)
    {
        $payload = [
            'subscriptionid' => $customer_id
        ];

        $response = static::request('getsubscriptions', $payload);

        if ($response->getsubscriptionsResult == true && count((array)$response->subscriptionAry) > 0) {
            $type = $response->subscriptionAry->SubscriptionInformationType;

            return new self(
                $type->subscriptionid,
                $type->description,
                $type->created,
                $type->expmonth,
                $type->expyear,
                $type->cardtypeid,
                $type->transactionList
            );
        }

        throw new EpayException(ErrorParser::getMessage($response->epayresponse));
    }
}
