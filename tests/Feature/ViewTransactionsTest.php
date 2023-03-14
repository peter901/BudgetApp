<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Transaction;
use App\Models\Category;


class ViewTransactionsTest extends TestCase
{
    use RefreshDatabase;
    
   /**
     * A basic test example.
     *
     * @return void
     */
    public function test_view_all_transactions()
    {
        $id = Transaction::factory()->create()->id;
        $transaction = Transaction::find($id);

        $this->get('/transactions')
        ->assertSee($transaction->description)
        ->assertSee($transaction->category->name);
    }

    public function test_can_filter_transactions_by_category()
    {
        $category = Category::factory()->create();

        $transaction = Transaction::factory()->create(['category_id'=>$category->id]);
        $otherTransaction = Transaction::factory()->create();

        $this->get("/transactions/{$category->id}")
        ->assertSee($transaction->description)
        ->assertDontSee($otherTransaction->description);
    }
}
