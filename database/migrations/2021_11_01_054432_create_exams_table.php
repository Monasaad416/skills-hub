<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_id')->constrained();
            $table->text('name');
            $table->text('DESC');
            $table->string('img', 255);
            $table->tinyInteger('questions_no');
            $table->tinyInteger('difficulty');
            $table->smallInteger('duration_mins');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::table('exams', function (Blueprint $table) {
            $table->renameColumn('DESC', 'desc');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
