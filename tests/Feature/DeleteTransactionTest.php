<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Transaction;

class DeleteTransactionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_delete_transaction()
    {
        $transaction = Transaction::factory()->create(['user_id'=>$this->user->id]);

        $this->delete("/transactions/{$transaction->id}")
        ->assertRedirect('/transactions')
        ->assertSessionHas('status');

        $this->get('/transactions')
        ->assertDontSee($transaction->description);

    }
}
