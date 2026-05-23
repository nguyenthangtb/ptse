<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Xóa cột cũ (string/text)
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'short_description',
                'description',
                'meta_title',
                'meta_description',
                'meta_keywords',
            ]);
        });

        // Rename *_translatable → tên gốc (giờ là JSON)
        Schema::table('projects', function (Blueprint $table) {
            $table->renameColumn('title_translatable', 'title');
            $table->renameColumn('short_description_translatable', 'short_description');
            $table->renameColumn('description_translatable', 'description');
            $table->renameColumn('meta_title_translatable', 'meta_title');
            $table->renameColumn('meta_description_translatable', 'meta_description');
            $table->renameColumn('meta_keywords_translatable', 'meta_keywords');
        });
    }

    public function down(): void
    {
        // Không rollback để tránh mất dữ liệu
    }
};
