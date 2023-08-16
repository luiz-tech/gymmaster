<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pessoa');
            $table->unsignedBigInteger('id_plano');
            $table->foreign('id_pessoa')->references('id')->on('pessoas')->onDelete('cascade');
            $table->foreign('id_plano')->references('id')->on('planos')->onDelete('cascade');
            $table->float('peso');
            $table->float('altura');
            $table->mediumText('objetivos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}
