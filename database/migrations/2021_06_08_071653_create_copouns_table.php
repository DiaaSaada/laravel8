<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCopounsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copouns', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index()->unique();
            $table->boolean('is_private')->default(0);
            $table->integer('max_allowed')->default(1);
            $table->integer('actual_usage')->default(0);
            $table->enum('type', array('PERCENTAGE','VALUE'))->index();
            $table->decimal('value', 8, 2);
            $table->decimal('total_deducted', 8, 2)->nullable()->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamp('expiry_date')->nullable();
            $table->foreignId('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('copouns');
    }
}
