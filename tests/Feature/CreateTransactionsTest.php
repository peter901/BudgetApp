<?php

namespace Tests\Feature;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTransactionsTest extends TestCase
{
    
    public function test_can_create_transaction()
    {
        $transaction = Transaction::factory()->make(['user_id'=>$this->user->id]);

        $this->post('/transactions',$transaction->toArray())
        ->assertRedirect('/transactions')
        ->assertSessionHas('status');

        $this->get('/transactions')
        ->assertSee($transaction->description);
    }

    public function test_cannot_create_transaction_without_description(){

        $transaction = Transaction::factory()->make(['description'=>null]);

        $this->post('/transactions',$transaction->toArray())
        ->assertSessionHasErrors('description');
    }

    public function test_cannot_create_transaction_without_category_id(){

        $transaction = Transaction::factory()->make(['category_id'=>null]);

        $this->post('/transactions',$transaction->toArray())
        ->assertSessionHasErrors(['category_id']);
    }

    public function test_cannot_create_transaction_without_amount(){

        $transaction = Transaction::factory()->make(['amount'=>null]);

        $this->post('/transactions',$transaction->toArray())
        ->assertSessionHasErrors(['amount']);
    }

    public function test_valid_amount(){
        $transaction = Transaction::factory()->make(['amount'=>'string amount']);

        $this->post('/transactions',$transaction->toArray())
        ->assertSessionHasErrors(['amount']);
    }
}
