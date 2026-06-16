<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop existing FK if it exists (from users table)
        try {
            DB::statement("ALTER TABLE `blogs` DROP FOREIGN KEY `blogs_author_id_foreign`");
        } catch (\Exception $e) {
            // FK may have different name or not exist
        }

        // Drop column if it already exists
        if (Schema::hasColumn('blogs', 'author_id')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->dropColumn('author_id');
            });
        }

        // Add fresh column referencing authors
        Schema::table('blogs', function (Blueprint $table) {
            $table->foreignId('author_id')->nullable()->constrained('authors')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
        });
    }
};
