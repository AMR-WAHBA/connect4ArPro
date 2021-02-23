<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 50)->unique();
            $table->string('password', 255);
            $table->string('fullname', 50);
            $table->enum('type', [
                Admin::TYPE_MANGER,
                Admin::TYPE_SUPER_MANGER,
                Admin::TYPE_ADMIN,
                Admin::TYPE_SUPER_ADMIN,
            ]);
            $table->string('remember_token', 100)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('admins');
    }
}
