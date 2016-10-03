<?php

namespace Epay;

use Epay\Customer;

class CustomerTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_a_customer()
    {
        $customer = Customer::retrieve(getenv('SUBSCRIPTION_ID'));

        $this->assertNotNull($customer);
    }

}
