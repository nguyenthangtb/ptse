<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up()
    {
        Schema::table('home_sliders', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'subtitle',
                'button_text',
            ]);
        });

        // Rename columns
        Schema::table('home_sliders', function (Blueprint $table) {
            $table->renameColumn('title_translatable', 'title');
            $table->renameColumn('subtitle_translatable', 'subtitle');
            $table->renameColumn('button_text_translatable', 'button_text');
        });
    }

    public function down()
    {
    }
};
