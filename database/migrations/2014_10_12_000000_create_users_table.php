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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_picture')->nullable(); 
            $table->boolean('is_admin')->default(false); 
            $table->boolean('is_avatar')->default(true); // Added is_avatar column with default value true
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); 
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropForeign('recipes_user_id_foreign'); // Drop the foreign key constraint
        });
    
        Schema::dropIfExists('users'); // Then drop the users table
    }
    
};
