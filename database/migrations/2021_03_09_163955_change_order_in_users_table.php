<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeOrderInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE users MODIFY COLUMN created_at TIMESTAMP NULL AFTER postcode');
        DB::statement('ALTER TABLE users MODIFY COLUMN updated_at TIMESTAMP NULL AFTER created_at');
        DB::statement('ALTER TABLE users MODIFY COLUMN deleted_at TIMESTAMP NULL AFTER updated_at');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
