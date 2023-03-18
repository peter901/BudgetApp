<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    protected $user;

    use CreatesApplication;

    protected function setUp():void{
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->signIn($this->user);
    }

    protected function signIn($user){
        $this->actingAs($user);
        return $this;
    }

    protected function signOut(){
        $this->post('/logout');
        return $this;
    }
}
