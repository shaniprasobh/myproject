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
        Schema::create('companies', function (Blueprint $table) {
    $table->id();
    $table->string('company_name');
    $table->string('code')->nullable();
    $table->mediumText('address');
    $table->string('zip')->nullable();
    $table->integer('state_id')->nullable();
    $table->integer('country_id')->nullable();
    $table->string('email')->nullable();
    $table->string('mobile_number', 15)->nullable();
    $table->string('landline_number', 15)->nullable();
    $table->string('website')->nullable();
    $table->string('gst_number')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
