<?php

use Epay\Charge;

class ChargeTest extends TestCase
{
    /**
     * Test that it can create a charge.
     *
     * @test
     */
    public function it_can_create_a_charge()
    {
        $charge = Charge::create([
            'amount'      => 1000,
            'customer'    => getenv('CUSTOMER_ID'),
            'order'       => uniqid(),
            'description' => 'Charge description',
        ]);

        $this->assertEquals($charge->amount, 1000);
    }

    /**
     * Test that it can specify a custom curreny on a charge.
     *
     * @test
     */
    public function it_can_specify_a_custom_currency()
    {
        $charge = Charge::create([
            'amount'   => 1000,
            'customer' => getenv('CUSTOMER_ID'),
            'order'    => uniqid(),
            'currency' => 840,
        ]);

        $this->assertEquals($charge->currency, 840);
    }

    /**
     * Make sure it throws an error when not specifying the required options.
     *
     * @test
     * @expectedException \Epay\Error\OptionRequired
     */
    public function it_throws_an_error_when_missing_options()
    {
        Charge::create([
            'amount'   => 1000,
            'customer' => getenv('CUSTOMER_ID'),
        ]);
    }
}
