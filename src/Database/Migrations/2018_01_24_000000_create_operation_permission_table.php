<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('operation_permission', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('role_id')->unsigned()->nullable()->index('role_id');
             $table->foreign('role_id')->references('id')
                 ->on('roles')
                 ->onUpdate('cascade')
                 ->onDelete('cascade');
             $table->integer('permission_id')->unsigned()->nullable()->index('permission_id');
             $table->foreign('permission_id')->references('id')
                 ->on('permissions')
                 ->onUpdate('cascade')
                 ->onDelete('cascade');
             $table->string('operation')->nullable();
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
        Schema::dropIfExists('operation_permission');
    }
}
