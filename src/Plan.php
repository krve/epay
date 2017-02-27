<?php

namespace Epay;

use Epay\Error\EpayException;
use Epay\Error\ErrorParser;

class Plan extends Api
{
    protected static $apiURL = 'https://recurring.api.epay.eu/v1/RecurringSOAP.svc?singleWsdl';

    protected static $required = ['amount', 'interval', 'name'];

    protected static $intervals = [
        'daily'   => 4,
        'weekly'  => 5,
        'monthly' => 6,
        'yearly'  => 7,
    ];

    /**
     * Signup a new customer for the plan.
     *
     * @param $customer
     *
     * @throws \Epay\Error\EpayException
     *
     * @return \Epay\Subscription
     */
    public function signup($customer, $email)
    {
        $response = static::request('getsubscriber', [
            'subscriber' => [
                'subscriptionid' => $customer,
            ],
        ]);

        if ($response->subscriber == null) {
            $response = static::request('signupsubscriber', [
                'recurringplanlist' => [
                    'recurringplan' => [
                        'recurringplanid' => $this->id,
                    ],
                ],
                'subscription' => [
                    'subscriptionid' => $customer,
                    'emailaddress'   => $email,
                ],
            ]);

            if ($response->result == true) {
                return Subscription::getByPlanAndCustomer($this->id, $customer);
            }

            throw new EpayException($response->message);
        }

        $payload = [
            'recurringplan' => [
                'recurringplanid' => $this->id,
            ],
            'subscription' => [
                'subscriptionid' => $customer,
            ],
        ];

        $response = static::request('addrecurringplantosubscription', $payload);

        if ($response->result == true) {
            return Subscription::getByPlanAndCustomer($this->id, $customer);
        }

        throw new EpayException($response->message);
    }

    /**
     * Delete the plan.
     *
     * @throws \Epay\Error\EpayException
     *
     * @return bool
     */
    public function delete()
    {
        $payload = [
            'recurringplan' => [
                'recurringplanid' => $this->id,
            ],
        ];

        $response = static::request('deleterecurringplan', $payload);

        if ($response->result == true) {
            return true;
        }

        throw new EpayException($response->message);
    }

    /**
     * Fetch the plan's subscriptions.
     *
     * @return array
     */
    public function subscriptions()
    {
        return Subscription::byPlan($this->id);
    }

    /**
     * Create a new plan.
     *
     * @param array $options
     *
     * @throws \Epay\Error\EpayException
     * @throws \Exception
     *
     * @return \Epay\Plan
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
                'currency'              => $currency,
                'description'           => $options['name'],
                'recurringperiod'       => 1,
                'recurringperiodtypeid' => $interval,
                'recurringperiodprice'  => $options['amount'],
                'addfee'                => false,
            ],
        ];

        $response = static::request('createrecurringplan', $payload);

        if ($response->result == true) {
            $id = $response->recurringplan->recurringplanid;

            return static::retrieve($id);
        }

        throw new EpayException(ErrorParser::getMessage($response->epayresponse));
    }

    /**
     * Find the specified recurring plan.
     *
     * @param $recurring_plan_id
     *
     * @throws \Epay\Error\EpayException
     *
     * @return \Epay\Plan
     */
    public static function retrieve($recurring_plan_id)
    {
        $response = static::request('getrecurringplan', [
            'recurringplan' => [
                'recurringplanid' => $recurring_plan_id,
            ],
        ]);

        if ($response->result == true && count((array) $response->recurringplan) > 0) {
            $plan = $response->recurringplan;

            return new self([
                'id'       => $recurring_plan_id,
                'name'     => $plan->description,
                'currency' => $plan->currency,
            ]);
        }

        throw new EpayException($response->message);
    }
}
