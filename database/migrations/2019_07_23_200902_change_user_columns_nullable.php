<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUserColumnsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            DB::statement('ALTER TABLE `users` MODIFY `team_name` VARCHAR(255) NULL;');
            DB::statement('ALTER TABLE `users` MODIFY `profile_pic` VARCHAR(255) NULL;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `users` MODIFY `team_name` VARCHAR(255) NOT NULL;');
        DB::statement('ALTER TABLE `users` MODIFY `profile_pic` VARCHAR(255) NOT NULL;');
    }
}
