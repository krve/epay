<?php

use Epay\Plan;

class PlanTest extends TestCase
{
    /** @test */
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
}
