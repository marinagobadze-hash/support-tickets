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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
    
   
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('priority_id')->constrained()->onDelete('cascade');
    
            $table->string('status')->default('New'); // სტატუსი
            $table->text('admin_comment')->nullable(); // ადმინისტრაციის კომენტარი
            $table->timestamp('resolved_at')->nullable(); 
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
