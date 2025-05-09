<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up()
    {
        Schema::table('solutions', function (Blueprint $table) {
            $table->json('title_translatable')->nullable();
            $table->json('description_translatable')->nullable();
            $table->json('short_description_translatable')->nullable();
            $table->json('meta_title_translatable')->nullable();
            $table->json('meta_description_translatable')->nullable();
            $table->json('meta_keywords_translatable')->nullable();
        });

          // Copy dữ liệu cũ vào trường JSON mới
        DB::table('solutions')->get()->each(function ($solution) {
            DB::table('solutions')
                ->where('id', $solution->id)
                ->update([
                    'title_translatable' => json_encode(['vi' => $solution->title]),
                    'description_translatable' => json_encode(['vi' => $solution->description]),
                    'short_description_translatable' => json_encode(['vi' => $solution->short_description]),
                    'meta_title_translatable' => json_encode(['vi' => $solution->meta_title]),
                    'meta_description_translatable' => json_encode(['vi' => $solution->meta_description]),
                    'meta_keywords_translatable' => json_encode(['vi' => $solution->meta_keywords]),
                ]);
        });
    }

    public function down()
    {
        Schema::table('solutions', function (Blueprint $table) {
            $table->dropColumn([
                'title_translatable',
                'description_translatable',
                'short_description_translatable',
                'meta_title_translatable',
                'meta_description_translatable',
                'meta_keywords_translatable',
            ]);
        });

    }
};
