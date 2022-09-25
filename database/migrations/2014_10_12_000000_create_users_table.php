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
            // discord shit
            $table->string("id")->primary();
            $table->string('username');
            $table->string('discriminator');
            $table->string('email');
            $table->string('avatar')->nullable();
            $table->boolean('verified');
            $table->string('locale');
            $table->boolean('mfa_enabled');
            $table->string('refresh_token')->nullable();
            $table->rememberToken();

            $table->string('slug');
            $table->text("challonge_username");
            $table->text("pronouns");
            $table->text("timezone");
            $table->text("availability");

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
