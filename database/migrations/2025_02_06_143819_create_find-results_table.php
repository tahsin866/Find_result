<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('find-results', function (Blueprint $table) {
            $table->id();
            $table->string('roll_no');
            $table->string('student_name');
            $table->string('class');
            $table->string('exam_year');
            $table->string('level');
            $table->integer('marks');
            $table->enum('status', ['Pass', 'Fail']);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('find-results');
    }
};
