<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->json('name_translatable')->nullable();
            $table->json('description_translatable')->nullable();
            $table->json('short_description_translatable')->nullable();
            $table->json('meta_title_translatable')->nullable();
            $table->json('meta_description_translatable')->nullable();
            $table->json('meta_keywords_translatable')->nullable();
        });

          // Copy dữ liệu cũ vào trường JSON mới
        DB::table('categories')->get()->each(function ($category) {
            DB::table('categories')
                ->where('id', $category->id)
                ->update([
                    'name_translatable' => json_encode(['vi' => $category->name]),
                    'description_translatable' => json_encode(['vi' => $category->description]),
                    'short_description_translatable' => json_encode(['vi' => $category->short_description]),
                    'meta_title_translatable' => json_encode(['vi' => $category->meta_title]),
                    'meta_description_translatable' => json_encode(['vi' => $category->meta_description]),
                    'meta_keywords_translatable' => json_encode(['vi' => $category->meta_keywords]),
                ]);
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn([
                'name_translatable',
                'description_translatable',
                'short_description_translatable',
                'meta_title_translatable',
                'meta_description_translatable',
                'meta_keywords_translatable',
            ]);
        });

    }
};
