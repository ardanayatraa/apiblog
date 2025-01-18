<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTagTable extends Migration
{
    public function up()
    {
        Schema::create('blog_tag', function (Blueprint $table) {
            $table->uuid('blog_uuid');
            $table->foreign('blog_uuid')->references('uuid')->on('blogs')->cascadeOnDelete();

            $table->foreignId('tag_id')->constrained('tags')->cascadeOnDelete();

            $table->primary(['blog_uuid', 'tag_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_tag');
    }
}
