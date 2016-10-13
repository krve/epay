<?php

use Epay\Customer;

class CustomerTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_a_customer()
    {
        $customer = Customer::retrieve(getenv('CUSTOMER_ID'));

        $this->assertNotNull($customer);
    }

    /**
     * @test
     */
    public function it_can_fetch_its_subscriptions()
    {
        $customer = Customer::retrieve(getenv('CUSTOMER_ID'));

        $this->assertNotNull($customer->subscriptions());
    }
}
