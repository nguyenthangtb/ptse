<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up()
    {
        Schema::table('careers', function (Blueprint $table) {
            $table->json('title_translatable')->nullable();
            $table->json('description_translatable')->nullable();
            $table->json('short_description_translatable')->nullable();
            $table->json('requirements_translatable')->nullable();
            $table->json('benefits_translatable')->nullable();
            $table->json('location_translatable')->nullable();
            $table->json('department_translatable')->nullable();
        });

          // Copy dữ liệu cũ vào trường JSON mới
        DB::table('careers')->get()->each(function ($career) {
            DB::table('careers')
                ->where('id', $career->id)
                ->update([
                    'title_translatable' => json_encode(['vi' => $career->title]),
                    'description_translatable' => json_encode(['vi' => $career->description]),
                    'short_description_translatable' => json_encode(['vi' => $career->short_description]),
                    'requirements_translatable' => json_encode(['vi' => $career->requirements]),
                    'benefits_translatable' => json_encode(['vi' => $career->benefits]),
                    'location_translatable' => json_encode(['vi' => $career->location]),
                    'department_translatable' => json_encode(['vi' => $career->department]),
                ]);
        });
    }

    public function down()
    {
        Schema::table('careers', function (Blueprint $table) {
            $table->dropColumn([
                'title_translatable',
                'description_translatable',
                'short_description_translatable',
                'requirements_translatable',
                'benefits_translatable',
                'location_translatable',
                'department_translatable',
            ]);
        });

    }
};
