<?php

namespace Epay;

use Epay\Error\Errors;
use Epay\Error\EpayException;

class Plan extends Api
{
    protected static $apiURL = 'https://recurring.api.epay.eu/v1/RecurringSOAP.svc?singleWsdl';

    protected static $required = ['amount', 'interval', 'name'];

    protected static $intervals = [
        'daily' => 4,
        'weekly' => 5,
        'monthly' => 6,
        'yearly' => 7,
    ];

    /**
     * Signup a new customer for the plan
     *
     * @param $customer
     *
     * @return \Epay\Subscription
     * @throws \Epay\Error\EpayException
     */
    public function signup($customer)
    {
        $payload = [
            'recurringplan' => [
                'recurringplanid' => $this->id,
            ],
            'subscription' => [
                'subscriptionid' => $customer
            ],
        ];

        $response = static::subRequest('addrecurringplantosubscription', $payload);

        if ($response->result == true) {
            return Subscription::getByPlanAndCustomer($this->id, $customer);
        }

        throw new EpayException($response->message);
    }

    /**
     * Delete the plan
     *
     * @return bool
     * @throws \Epay\Error\EpayException
     */
    public function delete()
    {
        $payload = [
            'recurringplan' => [
                'recurringplanid' => $this->id,
            ]
        ];

        $response = static::subRequest('deleterecurringplan', $payload);

        if ($response->result == true) {
            return true;
        }

        throw new EpayException($response->message);
    }

    /**
     * Create a new plan
     *
     * @param array $options
     *
     * @return \Epay\Plan
     * @throws \Epay\Error\EpayException
     * @throws \Exception
     */
    public static function create(array $options)
    {
        static::validate($options);

        $currency = isset($options['currency']) ? $options['currency'] : Epay::usesCurrency();
        $interval = $options['interval'];
        $interval = isset(static::$intervals[$interval]) ? static::$intervals[$interval] : null;

        if (is_null($interval)) {
            throw new \Exception('Interval not correct');
        }

        $payload = [
            'recurringplan' => [
                'currency' => $currency,
                'description' => $options['name'],
                'recurringperiod' => 1,
                'recurringperiodtypeid' => $interval,
                'recurringperiodprice' => $options['amount'],
                'addfee' => false,
            ]
        ];

        $response = static::subRequest('createrecurringplan', $payload);

        if ($response->result == true) {
            $id = $response->recurringplan->recurringplanid;

            return static::retrieve($id);
        }

        throw new EpayException(Errors::getMessage($response->epayresponse));

        // currency
        // description
        // paymentwindowtext
        // trialperiod
        // trialperiodtypeid
        // trialperiodprice
        // recurringperiod
        // recurringperiodtypeid
        // recurringperiodprice
        // addfee
        // expireafterxpayments
        // expireafterperiod
        // expireafterperiodtypeid
        // exactexpirydate
        // capturedelayperiod
        // capturedelayperiodtypeid
    }

    /**
     * Find the specified recurring plan
     *
     * @param $recurring_plan_id
     *
     * @return \Epay\Plan
     * @throws \Epay\Error\EpayException
     */
    public static function retrieve($recurring_plan_id)
    {
        $response = static::subRequest('getrecurringplan', [
            'recurringplan' => [
                'recurringplanid' => $recurring_plan_id
            ]
        ]);

        if ($response->result == true && count((array)$response->recurringplan) > 0) {
            $plan = $response->recurringplan;

            return new self([
                'id' => $recurring_plan_id,
                'name' => $plan->description,
                'currency' => $plan->currency
            ]);
        }

        throw new EpayException($response->message);
    }
}
