<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');        // sender
            $table->unsignedBigInteger('other_user_id');  // receiver
            $table->text('message');
            $table->string('group_id');                   // unique conversation ID
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            // Optional: add foreign keys if your users table is ready
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('other_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
