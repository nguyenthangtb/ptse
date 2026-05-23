<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Bước 1: thêm cột JSON tạm
        Schema::table('projects', function (Blueprint $table) {
            $table->json('client_translatable')->nullable();
            $table->json('location_translatable')->nullable();
        });

        // Bước 2: copy dữ liệu cũ vào JSON với locale 'vi'
        DB::table('projects')->get()->each(function ($project) {
            DB::table('projects')
                ->where('id', $project->id)
                ->update([
                    'client_translatable'   => json_encode(['vi' => $project->client]),
                    'location_translatable' => json_encode(['vi' => $project->location]),
                ]);
        });

        // Bước 3: xóa cột cũ
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['client', 'location']);
        });

        // Bước 4: đổi tên cột JSON về tên gốc
        Schema::table('projects', function (Blueprint $table) {
            $table->renameColumn('client_translatable', 'client');
            $table->renameColumn('location_translatable', 'location');
        });
    }

    public function down(): void
    {
        // Không rollback để tránh mất dữ liệu
    }
};
