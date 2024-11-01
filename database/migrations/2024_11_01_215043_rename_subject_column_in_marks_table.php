<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('marks', function (Blueprint $table) {
            $table->renameColumn('subject', 'subject_name');
        });
    }

    public function down()
    {
        Schema::table('marks', function (Blueprint $table) {
            $table->renameColumn('subject_name', 'subject');
        });
    }
};
