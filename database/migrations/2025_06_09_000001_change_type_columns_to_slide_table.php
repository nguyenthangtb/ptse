<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up()
    {
        Schema::table('home_sliders', function (Blueprint $table) {
            $table->json('title_translatable')->nullable();
            $table->json('subtitle_translatable')->nullable();
            $table->json('button_text_translatable')->nullable();
        });

          // Copy dữ liệu cũ vào trường JSON mới
        DB::table('home_sliders')->get()->each(function ($slide) {
            DB::table('home_sliders')
                ->where('id', $slide->id)
                ->update([
                    'title_translatable' => json_encode(['vi' => $slide->title]),
                    'subtitle_translatable' => json_encode(['vi' => $slide->subtitle]),
                    'button_text_translatable' => json_encode(['vi' => $slide->button_text]),
                ]);
        });
    }

    public function down()
    {
        Schema::table('home_sliders', function (Blueprint $table) {
            $table->dropColumn([
                'title_translatable',
                'subtitle_translatable',
                'button_text_translatable',
            ]);
        });

    }
};
