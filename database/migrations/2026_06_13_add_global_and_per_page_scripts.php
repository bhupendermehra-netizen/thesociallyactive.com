<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Create site_settings table for global scripts (single row)
        if (!Schema::hasTable('site_settings')) {
            Schema::create('site_settings', function (Blueprint $table) {
                $table->id();
                $table->longText('global_head_script')->nullable();
                $table->longText('global_body_script')->nullable();
                $table->timestamps();
            });

            // Insert the single default row
            DB::table('site_settings')->insert([
                'global_head_script' => null,
                'global_body_script' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Add per-page columns
        if (!Schema::hasColumn('pages', 'head_script')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->longText('head_script')->nullable()->after('custom_meta_tags');
                $table->longText('body_script')->nullable()->after('head_script');
            });
        }

        // Add per-blog columns
        if (!Schema::hasColumn('blogs', 'head_script')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->longText('head_script')->nullable()->after('custom_meta_tags');
                $table->longText('body_script')->nullable()->after('head_script');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['head_script', 'body_script']);
        });
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['head_script', 'body_script']);
        });
    }
};
