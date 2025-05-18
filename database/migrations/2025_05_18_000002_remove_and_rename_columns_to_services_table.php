<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'description',
            ]);
        });

        // Rename columns
        Schema::table('services', function (Blueprint $table) {
            $table->renameColumn('title_translatable', 'title');
            $table->renameColumn('description_translatable', 'description');
        });
    }

    public function down()
    {
    }
};
