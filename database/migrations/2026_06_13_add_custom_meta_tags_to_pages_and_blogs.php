<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('pages', 'custom_meta_tags')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->longText('custom_meta_tags')->nullable()->after('meta_keywords');
            });
        }

        if (!Schema::hasColumn('blogs', 'custom_meta_tags')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->longText('custom_meta_tags')->nullable()->after('seo_description');
            });
        }
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('custom_meta_tags');
        });
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('custom_meta_tags');
        });
    }
};
