<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');

            $table->string('subject')->nullable();
            $table->string('predicted_marks')->nullable();
            $table->string('final_grade')->nullable();
            $table->string('present_count')->default(0);
            $table->string('absent_count')->default(0);
            $table->string('classTest_1')->default(0);
            $table->string('lab_test_1')->default(0);
            $table->string('mid_mark')->default(0);
            $table->string('classTest_2')->default(0);
            $table->string('lab_test_2')->default(0);
            $table->string('assignment')->default(0);
            $table->string('external_activity')->default(0);
            $table->string('recommendations')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
