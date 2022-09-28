<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('link', 100);
            $table->enum('status', ['active', 'inactive']);
            $table->integer('ordering');
            $table->enum('type_menu', ['link', 'category_article']);
            $table->enum('type_open', ['current', 'new_window', 'new_tab']);
            $table->string('created')->nullable();
            $table->string('created_by')->nullable();
            $table->string('modified')->nullable();
            $table->string('modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
