<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoMetadataTable extends Migration
{
    public function up()
    {
        Schema::create('seo_metadata', function (Blueprint $table) {
            $table->id();
            $table->uuid('blog_uuid');
            $table->foreign('blog_uuid')->references('uuid')->on('blogs')->cascadeOnDelete();
            $table->string('meta_title');
            $table->string('meta_description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seo_metadata');
    }
}
