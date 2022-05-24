<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('students', function (Blueprint $table) {
        //     $table->id('id');
        //     $table->string('name');
        //     $table->string('email')->nullable();
        //     $table->string('phone');
        //     $table->string('whatsapp_number')->nullable();
        //     $table->integer('pass_outyear')->nullable();
        //     $table->string('city')->nullable();
        //     $table->integer('pin')->nullable();
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students');
    }
}
