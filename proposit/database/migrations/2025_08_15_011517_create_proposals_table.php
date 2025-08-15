<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // palestrante que submeteu
            $table->foreignId('proposal_status_id')->constrained('proposal_statuses')->default(1); // pendente por padrão
            $table->string('title');
            $table->text('abstract'); // resumo da talk
            $table->text('details')->nullable(); // descrição mais detalhada
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proposals');
    }
}

