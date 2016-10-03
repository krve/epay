<?php

namespace Epay;

use Epay\Customer;

class SubscriptionTest extends TestCase
{
    /** @test */
    public function it_can_create_a_subscription()
    {
        $plan = Plan::retrieve(getenv('PLAN_ID'));

        $customer = Customer::retrieve(getenv('SUBSCRIPTION_ID'));

        $subscription = Subscription::create([
            'customer' => $customer->id,
            'plan' => $plan->id
        ]);

        $this->assertNotNull($subscription);

        $subscription->delete();
    }

    /** @test */
    public function it_can_retrieve_a_subscription()
    {
        $plan = Plan::retrieve(getenv('PLAN_ID'));

        $customer = Customer::retrieve(getenv('SUBSCRIPTION_ID'));

        $subscription = Subscription::create([
            'customer' => $customer->id,
            'plan' => $plan->id
        ]);

        $foundSubscription = Subscription::retrieve($subscription->id);

        $this->assertNotNull($foundSubscription);

        $subscription->delete();
    }

}
