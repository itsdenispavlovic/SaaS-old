<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->string('name');
            $table->string('slug');
            $table->string('menu_name')->nullable();
            $table->string('canonical_url')->nullable();
            $table->text('short_description')->nullable();
            $table->text('content')->nullable();
            $table->integer('position')->default(0);
            $table->string('image')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('is_menu')->default(false);
            $table->boolean('is_sitemap')->default(true);
            $table->boolean('is_homepage')->default(false);
            $table->enum('access_type', ['public', 'private'])->default('public');
            $table->string('node_type')->nullable();
            $table->text('node_properties')->nullable();
            $table->dateTime('display_at')->nullable();
            $table->dateTime('ends_at')->nullable();

            $table->index(['parent_id', 'position']);
            $table->index(['parent_id', 'published', 'is_sitemap', 'position']);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('nodes', function(Blueprint $table)
        {
            $table->foreign("parent_id")->references("id")->on("nodes")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nodes', function(Blueprint $table)
        {
            $table->dropForeign(["parent_id"]);
            $table->dropForeign(["default_language_node_id"]);
        });
        Schema::dropIfExists('nodes');
    }
}
