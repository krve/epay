<?php

use Epay\Customer;

class CustomerTest extends TestCase
{
    /**
     * Make sure that it can retrieve a customer
     *
     * @test
     */
    public function it_can_retrieve_a_customer()
    {
        $customer = Customer::retrieve(getenv('CUSTOMER_ID'));

        $this->assertNotNull($customer);
    }

    /**
     * Make sure that you can retrieve a customer's subscriptions
     *
     * @test
     */
    public function it_can_fetch_its_subscriptions()
    {
        $customer = Customer::retrieve(getenv('CUSTOMER_ID'));

        $this->assertNotNull($customer->subscriptions());
    }
}
