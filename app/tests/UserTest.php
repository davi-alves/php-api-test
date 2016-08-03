<?php

use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * User listing test
     *
     * @return void
     */
    public function testListing()
    {
        factory('App\User')->create();

        $this
            ->get('/user')
            ->seeJsonContains(
                ['data' => ['users' => User::all()->toArray()]]
            );
    }

    /**
     * User store test
     *
     * @return void
     */
    public function testStore()
    {
        $dummy = factory('App\User')->make()->toArray();

        $this->post('/user', $dummy);
        $this->seeInDatabase('users', $dummy);

        /** @var  $user */
        $user = User::find(1);
        $this->seeJsonContains(
            ['data' => ['user' => $user->toArray()]]
        );
    }
}
