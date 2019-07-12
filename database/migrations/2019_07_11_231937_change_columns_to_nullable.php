<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archive', function (Blueprint $table) {
            DB::statement('ALTER TABLE `archive` MODIFY `league_champ_team` VARCHAR(255) NULL;');
            DB::statement('ALTER TABLE `archive` MODIFY `most_points_team` VARCHAR(255) NULL;');
            DB::statement('ALTER TABLE `archive` MODIFY `most_points_score` VARCHAR(255) NULL;');
            DB::statement('ALTER TABLE `archive` MODIFY `highest_week_team` VARCHAR(255) NULL;');
            DB::statement('ALTER TABLE `archive` MODIFY `highest_week_score` VARCHAR(255) NULL;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('archive', function (Blueprint $table) {
            DB::statement('ALTER TABLE `archive` MODIFY `league_champ_team` VARCHAR(255) NOT NULL;');
            DB::statement('ALTER TABLE `archive` MODIFY `most_points_team` VARCHAR(255) NOT NULL;');
            DB::statement('ALTER TABLE `archive` MODIFY `most_points_score` VARCHAR(255) NOT NULL;');
            DB::statement('ALTER TABLE `archive` MODIFY `highest_week_team` VARCHAR(255) NOT NULL;');
            DB::statement('ALTER TABLE `archive` MODIFY `highest_week_score` VARCHAR(255) NOT NULL;');
        });
    }
}
