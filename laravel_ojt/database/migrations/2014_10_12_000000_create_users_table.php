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
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->text('password');
            $table->string('profile');
            $table->string('type', 1)->default(1);
            $table->string('phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->date('dob')->nullable();
            $table->integer('create_user_id');
            $table->integer('updated_user_id');
            $table->integer('deleted_user_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
