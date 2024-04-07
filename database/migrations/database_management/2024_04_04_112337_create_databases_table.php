<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('databases', function (Blueprint $table) {
            $table->id();
            $table->string('database_name');
            $table->date('last_restore')->nullable();
            $table->integer('restore_count')->default(0);
            $table->boolean('is_selected')->default(false);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('restored_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('databases');
    }
};
