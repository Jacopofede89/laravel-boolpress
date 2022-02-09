<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeingKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('posts', function (Blueprint $table) {
        $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::table('post_tag', function (Blueprint $table) {
        $table ->foreign('post_id', 'post_tag')
               ->references('id')
               ->on('posts');
        
        $table ->foreign('tag_id', 'tag_post')
               ->references('id')
               ->on('tags');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_category_id_foreign');
        });
        Schema::table('post_tag', function (Blueprint $table) {
            $table ->dropForeign('post_tag');
            $table ->dropForeign('tag_id');
        });
    }
}
