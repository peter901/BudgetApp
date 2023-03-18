<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Transaction;

class UpdateTransactionsTest extends TestCase
{
    public function test_can_update_transaction()
    {
        $newTransaction = Transaction::factory()->create(['user_id'=>$this->user->id]);
       
        $updateTransaction = Transaction::factory()->make(['user_id'=>$this->user->id]);

        $this->put("/transactions/{$newTransaction->id}",$updateTransaction->toArray())
        ->assertRedirect('/transactions')
        ->assertSessionHas('status');

        $this->get('/transactions')
        ->assertSee($updateTransaction->description)
        ->assertDontSee($newTransaction->description);
    }

    public function test_cannot_update_transaction_without_description(){

        $newTransaction = Transaction::factory()->create(['user_id'=>$this->user->id]);

        $transaction = Transaction::factory()->make(['description'=>null]);

        $this->put("/transactions/{$newTransaction->id}",$transaction->toArray())
        ->assertSessionHasErrors('description');
    }

    public function test_cannot_update_transaction_without_category_id(){

        $newTransaction = Transaction::factory()->create(['user_id'=>$this->user->id]);

        $transaction = Transaction::factory()->make(['category_id'=>null]);

        $this->put("/transactions/{$newTransaction->id}",$transaction->toArray())
        ->assertSessionHasErrors(['category_id']);
    }

    public function test_cannot_update_transaction_without_amount(){

        $newTransaction = Transaction::factory()->create(['user_id'=>$this->user->id]);

        $transaction = Transaction::factory()->make(['amount'=>null]);

       $this->put("/transactions/{$newTransaction->id}",$transaction->toArray())
        ->assertSessionHasErrors(['amount']);
    }

    public function test_valid_amount(){
        $newTransaction = Transaction::factory()->create(['user_id'=>$this->user->id]);

        $transaction = Transaction::factory()->make(['amount'=>'string amount']);

        $this->put("/transactions/{$newTransaction->id}",$transaction->toArray())
        ->assertSessionHasErrors(['amount']);
    }
}
