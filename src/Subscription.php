<?php

namespace Epay;

use Epay\Plan;
use Epay\Customer;
use Epay\Error\EpayException;

class Subscription extends Api
{
    protected static $apiURL = 'https://recurring.api.epay.eu/v1/RecurringSOAP.svc?singleWsdl';

    protected static $required = ['customer', 'plan'];

    /**
     * Cancel the subscription
     *
     * @return bool
     * @throws \Epay\Error\EpayException
     */
    public function cancel()
    {
        $payload = [
            'subscriptionplan' => [
                'subscriptionplanid' => $this->id,
            ]
        ];

        $response = static::request('deletesubscriptionplan', $payload);

        if ($response->result == true) {
            return true;
        }

        throw new EpayException($response->message);
    }

    /**
     * Fetch this subscription's customer
     *
     * @return \Epay\Customer
     */
    public function customer()
    {
        return Customer::retrieve($this->customer);
    }

    /**
     * Get belonging plan
     *
     * @return \Epay\Plan
     */
    public function plan()
    {
        return Plan::retrieve($this->plan);
    }

    /**
     * Create a new subscription
     *
     * @param array $options
     *
     * @return \Epay\Subscription
     */
    public static function create(array $options)
    {
        static::validate($options);

        $plan = Plan::retrieve($options['plan']);

        return $plan->signup($options['customer']);
    }

    /**
     * Fetch subscriptions by the plan
     *
     * @param  integer $plan_id
     *
     * @return array
     */
    public static function byPlan($plan_id)
    {
        $payload = [
            'recurringplan' => [
                'recurringplanid' => $plan_id,
            ],
        ];

        return static::all($payload);
    }

    /**
     * Fetch subscriptions by the customer
     *
     * @param  integer $customer_id
     *
     * @return array
     */
    public static function byCustomer($customer_id)
    {
        $payload = [
            'subscription' => [
                'subscriptionid' => $customer_id,
            ],
        ];

        return static::all($payload);
    }

    /**
     * Find the subscription by the id
     *
     * @param  array $payload
     *
     * @return array
     * @throws \Epay\Error\EpayException
     */
    public static function all(array $payload = [])
    {
        $response = static::request('listsubscriptionplan', $payload);

        if ($response->result == true && count((array)$response->subscriptionplanlist) > 0) {
            if (is_array($response->subscriptionplanlist->subscriptionplan)) {
                $subscriptions = $response->subscriptionplanlist->subscriptionplan;

                return array_map(function($subscription) {
                    return new self([
                        'id' => $subscription->subscriptionplanid,
                        'plan' => $subscription->recurringplan->recurringplanid,
                        'customer' => $subscription->subscriptionid,
                        'created' => $subscription->created,
                    ]);
                }, $subscriptions);
            } else {
                $subscription = $response->subscriptionplanlist->subscriptionplan;
                return [new self([
                    'id' => $subscription->subscriptionplanid,
                    'plan' => $subscription->recurringplan->recurringplanid,
                    'customer' => $subscription->subscriptionid,
                    'created' => $subscription->created,
                ])];
            }
        }

        throw new EpayException($response->message);
    }

    /**
     * Find the subscription by the id
     *
     * @param $subscription_id
     *
     * @return \Epay\Subscription
     * @throws \Epay\Error\EpayException
     */
    public static function retrieve($subscription_id)
    {
        $payload = [
            'subscriptionplan' => [
                'subscriptionplanid' => $subscription_id
            ],
        ];

        $response = static::request('getsubscriptionplan', $payload);

        if ($response->result == true && count((array)$response->subscriptionplan) > 0) {
            $subscription = $response->subscriptionplan;

            return new self([
                'id' => $subscription_id,
                'plan' => $subscription->recurringplanid,
                'customer' => $subscription->subscriptionid,
                'created' => $subscription->created,
            ]);
        }

        throw new EpayException($response->message);
    }

    /**
     * Find the subscription by the plan and the customer
     *
     * @param $plan
     * @param $customer
     *
     * @return \Epay\Subscription
     * @throws \Epay\Error\EpayException
     */
    public static function getByPlanAndCustomer($plan, $customer)
    {
        $payload = [
            'recurringplan' => [
                'recurringplanid' => $plan,
            ],
            'subscription' => [
                'subscriptionid' => $customer
            ],
        ];

        $response = static::request('listsubscriptionplan', $payload);

        if ($response->result == true && count((array)$response->subscriptionplanlist) > 0) {
            $list = $response->subscriptionplanlist;
            $subscription = $list->subscriptionplan;

            if (is_array($subscription)) {
                return static::retrieve($subscription[count($subscription) - 1]->subscriptionplanid);
            }

            return static::retrieve($subscription->subscriptionplanid);
        }

        throw new EpayException($response->message);
    }
}
