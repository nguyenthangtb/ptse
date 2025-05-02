<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->json('name_translatable')->nullable();
            $table->json('description_translatable')->nullable();
            $table->json('short_description_translatable')->nullable();
            $table->json('meta_title_translatable')->nullable();
            $table->json('meta_description_translatable')->nullable();
            $table->json('meta_keywords_translatable')->nullable();
        });

          // Copy dữ liệu cũ vào trường JSON mới
        DB::table('products')->get()->each(function ($product) {
            DB::table('products')
                ->where('id', $product->id)
                ->update([
                    'name_translatable' => json_encode(['vi' => $product->name]),
                    'description_translatable' => json_encode(['vi' => $product->description]),
                    'short_description_translatable' => json_encode(['vi' => $product->short_description]),
                    'meta_title_translatable' => json_encode(['vi' => $product->meta_title]),
                    'meta_description_translatable' => json_encode(['vi' => $product->meta_description]),
                    'meta_keywords_translatable' => json_encode(['vi' => $product->meta_keywords]),
                ]);
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
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
