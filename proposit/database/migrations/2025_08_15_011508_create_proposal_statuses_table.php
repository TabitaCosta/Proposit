<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('proposal_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Ex: pendente, aprovado, rejeitado
            $table->timestamps();
        });

        // Opcional: já inserir os status básicos
        DB::table('proposal_statuses')->insert([
            ['name' => 'pendente', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'aprovado', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'rejeitado', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('proposal_statuses');
    }
}

