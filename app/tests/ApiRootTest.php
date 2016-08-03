<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class ApiRootTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApiRoot()
    {
        $this
            ->get('/')
            ->seeJson(
                ['data' => ['status' => 'online']]
            );
    }
}
