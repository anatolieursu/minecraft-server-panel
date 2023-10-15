<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('username');
            $table->string('discriminator');

            $table->string('email')->nullable()->unique();
            $table->string('avatar')->nullable();

            $table->boolean('verified');
            $table->string('locale');
            $table->boolean('mfa_enabled');
            $table->string('refresh_token')->nullable();

            $table->boolean("staff")->default(false);
            $table->boolean("admin")->default(false);
            $table->longText("about")->nullable();
            $table->boolean("public")->default(true);
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
        Schema::dropIfExists('users');
    }
}
