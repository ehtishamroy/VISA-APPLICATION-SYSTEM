<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('random_id', 6)->unique(); // 6-digit random ID
            $table->string('name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('passport_number')->unique(); // Ensure this line exists
            $table->string('cnic_number')->unique();
            $table->integer('age');
            $table->string('city');
            $table->string('applied_country');
            $table->string('applied_company');
            $table->string('applied_position');
            $table->enum('test_status', ['Pass', 'Fail'])->default('Pending');
            $table->enum('payment_status', ['Paid', 'Unpaid'])->default('pending');
            $table->enum('cv_status', ['Not Submitted', 'Submitted'])->default('Not Submitted');
            $table->enum('visa_status', ['Pending', 'Accepted', 'Rejected'])->default('Pending');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
