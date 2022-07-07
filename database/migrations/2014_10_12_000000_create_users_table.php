<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['support', 'customer']);
            $table->rememberToken();
            $table->timestamps();
        });

        for ($support = 1; $support < 4; $support++) {
            User::create([
                'name' => 'Agent' . $support,
                'email' => 'agent' . $support . '@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'support',
            ]);
        }

        for ($customer = 1; $customer < 4; $customer++) {
            User::create([
                'name' => 'Customer' . $customer,
                'email' => 'customer' . $customer . '@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
