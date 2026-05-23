<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->json('title_translatable')->nullable();
            $table->json('short_description_translatable')->nullable();
            $table->json('description_translatable')->nullable();
            $table->json('meta_title_translatable')->nullable();
            $table->json('meta_description_translatable')->nullable();
            $table->json('meta_keywords_translatable')->nullable();
        });

        // Copy dữ liệu cũ vào trường JSON mới với locale 'vi'
        DB::table('projects')->get()->each(function ($project) {
            DB::table('projects')
                ->where('id', $project->id)
                ->update([
                    'title_translatable'            => json_encode(['vi' => $project->title]),
                    'short_description_translatable' => json_encode(['vi' => $project->short_description]),
                    'description_translatable'       => json_encode(['vi' => $project->description]),
                    'meta_title_translatable'        => json_encode(['vi' => $project->meta_title]),
                    'meta_description_translatable'  => json_encode(['vi' => $project->meta_description]),
                    'meta_keywords_translatable'     => json_encode(['vi' => $project->meta_keywords]),
                ]);
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'title_translatable',
                'short_description_translatable',
                'description_translatable',
                'meta_title_translatable',
                'meta_description_translatable',
                'meta_keywords_translatable',
            ]);
        });
    }
};
