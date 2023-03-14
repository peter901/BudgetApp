<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\User;


class ViewTransactionsTest extends TestCase
{
    //use RefreshDatabase;

    public function test_only_displays_transactions_that_belong_to_currently_logged_in_user(){
        $otherUser = User::factory()->create();
        $otherTransaction = Transaction::factory()->create(['user_id'=>$otherUser->id]);

        $userTransaction = Transaction::factory()->create(['user_id'=>$this->user->id]);

        $this->get('/transactions')
        ->assertSee($userTransaction->description)
        ->assertDontSee($otherTransaction->description);

    }


    public function test_only_authenticated_user(){
        $this->signOut()
        ->get('/transactions')
        ->assertRedirect('/login');
    }
    
   /**
     * A basic test example.
     *
     * @return void
     */
    public function test_view_all_transactions()
    {
        $id = Transaction::factory()->create(['user_id'=>$this->user->id])->id;
        $transaction = Transaction::find($id);

        $this->get('/transactions')
        ->assertSee($transaction->description)
        ->assertSee($transaction->category->name);
    }

    public function test_can_filter_transactions_by_category()
    {
        $category = Category::factory()->create();

        $transaction = Transaction::factory()->create([
            'category_id'=>$category->id,
            'user_id'=>$this->user->id
            ]);

        $otherTransaction = Transaction::factory()->create();

        $this->get("/transactions/{$category->id}")
        ->assertSee($transaction->description)
        ->assertDontSee($otherTransaction->description);
    }
}
