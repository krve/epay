<?php

use Epay\Customer;
use Epay\Plan;
use Epay\Subscription;

class SubscriptionTest extends TestCase
{
    /**
     * Test that you can create a subscription
     *
     * @test
     */
    public function it_can_create_a_subscription()
    {
        $plan = Plan::retrieve(getenv('PLAN_ID'));

        $customer = Customer::retrieve(getenv('CUSTOMER_ID'));

        $subscription = Subscription::create([
            'customer' => $customer->id,
            'plan' => $plan->id,
            'email' => 'test@example.com'
        ]);

        $this->assertNotNull($subscription);

        $subscription->cancel();
    }

    /**
     * Test that you can retrieve a subscription
     *
     * @test
     */
    public function it_can_retrieve_a_subscription()
    {
        $plan = Plan::retrieve(getenv('PLAN_ID'));

        $customer = Customer::retrieve(getenv('CUSTOMER_ID'));

        $subscription = Subscription::create([
            'customer' => $customer->id,
            'plan' => $plan->id,
            'email' => 'test@example.com'
        ]);

        $foundSubscription = Subscription::retrieve($subscription->id);

        $this->assertNotNull($foundSubscription);

        $subscription->cancel();
    }

    /**
     * Test that you can retrieve all subscriptions
     *
     * @test
     */
    public function it_can_get_all_subscriptions()
    {
        $subscriptions = Subscription::all();

        $this->assertNotNull($subscriptions);
    }

    /**
     * Test that you can retrieve a subscription's customer
     *
     * @test
     */
    public function it_can_fetch_its_customer()
    {
        $plan = Plan::retrieve(getenv('PLAN_ID'));

        $customer = Customer::retrieve(getenv('CUSTOMER_ID'));

        $subscription = Subscription::create([
            'customer' => $customer->id,
            'plan' => $plan->id,
            'email' => 'test@example.com'
        ]);

        $this->assertEquals($subscription->customer()->id, $customer->id);
    }

    /**
     * Test that you can retrieve a subscription's plan
     *
     * @test
     */
    public function it_can_fetch_its_plan()
    {
        $plan = Plan::retrieve(getenv('PLAN_ID'));

        $customer = Customer::retrieve(getenv('CUSTOMER_ID'));

        $subscription = Subscription::create([
            'customer' => $customer->id,
            'plan' => $plan->id,
            'email' => 'test@example.com'
        ]);

        $this->assertEquals($subscription->plan()->id, $plan->id);
    }
}
