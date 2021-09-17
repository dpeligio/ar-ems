<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')
				->on('students')
				->onDelete('cascade')
				->onUpdate('cascade');
            $table->unsignedBigInteger('election_id');
            $table->foreign('election_id')->references('id')
				->on('elections')
				->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')->references('id')
                ->on('positions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('created_by')->nullable();
			$table->unsignedBigInteger('updated_by')->nullable();
			$table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
