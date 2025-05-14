<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up()
    {
        Schema::table('careers', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'description',
                'short_description',
                'requirements',
                'benefits',
                'location',
                'department',
            ]);
        });

        // Rename columns
        Schema::table('careers', function (Blueprint $table) {
            $table->renameColumn('title_translatable', 'title');
            $table->renameColumn('description_translatable', 'description');
            $table->renameColumn('short_description_translatable', 'short_description');
            $table->renameColumn('requirements_translatable', 'requirements');
            $table->renameColumn('benefits_translatable', 'benefits');
            $table->renameColumn('location_translatable', 'location');
            $table->renameColumn('department_translatable', 'department');
        });
    }

    public function down()
    {
    }
};
