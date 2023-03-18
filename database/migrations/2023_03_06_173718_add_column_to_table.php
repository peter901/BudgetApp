<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\App;

class AddColumnToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (App::environment() === 'production') {
            // Prevent running migrations in production environment
            return;
        }

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('categories','id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (App::environment() === 'production') {
            // Prevent running migrations in production environment
            return;
        }
        
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['categroy_id']);
        });
    }
}
