<?php

use Epay\Plan;

class PlanTest extends TestCase
{
    /**
     * Test that it you can create a plan
     *
     * @test
     */
    public function it_can_create_a_plan()
    {
        $plan = Plan::create([
            'amount' => 2000,
            'interval' => 'yearly',
            'name' => 'Test Plan',
        ]);

        $this->assertTrue($plan->id != null);

        $plan->delete();
    }

    /**
     * Make sure that it throws an exception when missing required options
     *
     * @test
     * @expectedException \Epay\Error\OptionRequired
     */
    public function it_throws_an_error_when_missing_options()
    {
        Plan::create([
            'amount' => 2000,
            'name' => 'Test Plan',
        ]);
    }

    /**
     * Test that you can retrieve a plan's subscriptions
     *
     * @test
     */
    public function it_can_get_its_subscriptions()
    {
        $plan = Plan::retrieve(getenv('PLAN_ID'));

        $this->assertNotNull($plan->subscriptions());
    }
}
