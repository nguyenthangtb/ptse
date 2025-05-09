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
            $table->dropColumn([
                'title',
                'description',
                'short_description',
                'meta_title',
                'meta_description',
                'meta_keywords',
            ]);
        });

        // Rename columns
        Schema::table('solutions', function (Blueprint $table) {
            $table->renameColumn('title_translatable', 'title');
            $table->renameColumn('description_translatable', 'description');
            $table->renameColumn('short_description_translatable', 'short_description');
            $table->renameColumn('meta_title_translatable', 'meta_title');
            $table->renameColumn('meta_description_translatable', 'meta_description');
            $table->renameColumn('meta_keywords_translatable', 'meta_keywords');
        });
    }

    public function down()
    {
    }
};
