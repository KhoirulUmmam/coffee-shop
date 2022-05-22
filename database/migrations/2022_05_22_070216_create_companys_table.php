<?php

use Database\Seeders\CompanySeeder;

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
        Schema::create('companys', function (Blueprint $table) {
            $table->id();
            $table->string('initial');
            $table->string('description')->nullable();
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('web')->nullable();
            $table->string('email');
            $table->string('telephone')->nullable();
            $table->string('fax')->nullable();
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => CompanySeeder::class,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companys');
    }
};
