<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->json('title_translatable')->nullable();
            $table->json('description_translatable')->nullable();
        });

          // Copy dữ liệu cũ vào trường JSON mới
        DB::table('services')->get()->each(function ($service) {
            DB::table('services')
                ->where('id', $service->id)
                ->update([
                    'title_translatable' => json_encode(['vi' => $service->title]),
                    'description_translatable' => json_encode(['vi' => $service->description]),
                ]);
        });
    }

    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'title_translatable',
                'description_translatable',
            ]);
        });

    }
};
