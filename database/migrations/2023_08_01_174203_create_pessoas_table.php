<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
             $table->foreignId('id_endereco')->constrained('enderecos');
              $table->foreignId('id_contato')->constrained('contatos');
            $table->string('nome');
            $table->string('email');
            $table->string('senha');
            $table->string('cpf',11);
            $table->date('dt_nascimento');
            $table->integer('idade');
            $table->enum('sexo',['M','F','O']);
            $table->char('status',1);

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
        Schema::dropIfExists('pessoas');
    }
}
