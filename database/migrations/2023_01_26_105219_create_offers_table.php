<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignIdFor(\App\Models\Apartment::class, 'apartment_id')
                ->constrained('apartments');

            $table->foreignIdFor(\App\Models\User::class, 'offer_by_user_id')
                ->constrained('users');

            $table->unsignedInteger('amount');
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
};
