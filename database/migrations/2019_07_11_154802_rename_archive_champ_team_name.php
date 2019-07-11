<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameArchiveChampTeamName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archive', function(Blueprint $table) {
            $table->renameColumn('leage_champ_team', 'league_champ_team');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('archive', function(Blueprint $table) {
            $table->renameColumn('league_champ_team', 'leage_champ_team');
        });
    }
}
