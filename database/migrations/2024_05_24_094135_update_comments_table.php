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
        Schema::table('comments', function (Blueprint $table) {
            // Удаление старого столбца author
            $table->dropColumn('author');

            // Добавление нового столбца author_id
            $table->foreignId('author_id')->after('post_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            // Восстановление старого столбца author
            $table->string('author')->after('parent_id');

            // Удаление нового столбца author_id
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
        });
    }
};
