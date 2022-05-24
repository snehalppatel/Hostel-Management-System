<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInDateOutingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outings', function (Blueprint $table) {
            $table->date('in_date')->nullable();
            $table->date('out_date')->nullable();

            $table->string('roll_number')->nullable();            
           $table->integer('security_id')->nullable();                        
        });
            Schema::table('leaves', function (Blueprint $table) {
                $table->text('comment')->nullable();
            });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outings', function (Blueprint $table) {
            //
        });
    }
}
