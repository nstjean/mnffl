<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDocumentColumnToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archive', function (Blueprint $table) {
            DB::statement('ALTER TABLE `documents` MODIFY `description` VARCHAR(255) NULL;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nullable', function (Blueprint $table) {
            DB::statement('ALTER TABLE `documents` MODIFY `description` VARCHAR(255) NOT NULL;');
        });
    }
}
