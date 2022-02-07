<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue')->index();
            $table->longText('payload');//входящие параметы, например модели
            $table->unsignedTinyInteger('attempts');//ограниченное число попыток
            $table->unsignedInteger('reserved_at')->nullable();//можно запретить одну и туже задачу параллельно
            $table->unsignedInteger('available_at');//задержка
            $table->unsignedInteger('created_at');//момент создания очереди
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
