<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            // Kiểm tra và thêm các cột cơ bản
            if (!Schema::hasColumn('news', 'title')) {
                $table->string('title');
            }
            if (!Schema::hasColumn('news', 'slug')) {
                $table->string('slug')->unique();
            }
            if (!Schema::hasColumn('news', 'content')) {
                $table->longText('content');
            }
            if (!Schema::hasColumn('news', 'excerpt')) {
                $table->text('excerpt')->nullable();
            }
            if (!Schema::hasColumn('news', 'image')) {
                $table->string('image')->nullable();
            }

            // Thêm các cột thời gian
            if (!Schema::hasColumn('news', 'date')) {
                $table->timestamp('date')->nullable();
            }
            if (!Schema::hasColumn('news', 'published_at')) {
                $table->timestamp('published_at')->nullable();
            }

            // Thêm cột trạng thái
            if (!Schema::hasColumn('news', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }

            // Thêm các cột SEO
            if (!Schema::hasColumn('news', 'meta_title')) {
                $table->string('meta_title')->nullable();
            }
            if (!Schema::hasColumn('news', 'meta_description')) {
                $table->text('meta_description')->nullable();
            }
            if (!Schema::hasColumn('news', 'meta_keywords')) {
                $table->string('meta_keywords')->nullable();
            }

            // Thêm timestamps và soft deletes nếu chưa có
            if (!Schema::hasColumn('news', 'created_at')) {
                $table->timestamps();
            }
            if (!Schema::hasColumn('news', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'slug',
                'content',
                'excerpt',
                'image',
                'date',
                'published_at',
                'is_active',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'deleted_at'
            ]);
        });
    }
};
