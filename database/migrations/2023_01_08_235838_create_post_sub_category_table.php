<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_sub_category', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained('posts');
            $table->foreignId('sub_category_id')->constrained('sub_categories');

            // primarikey (agar tidak duplikat)
            $table->primary(['post_id','sub_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_sub_category');
    }
};
