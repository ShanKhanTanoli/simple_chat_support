<?php

use App\Helpers\Message;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\SupportTicket;
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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();

            //User foreign key
            $table->unsignedBigInteger('user_id')
                ->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            //Support ticket foreign key
            $table->unsignedBigInteger('support_ticket_id')
                ->nullable();
            $table->foreign('support_ticket_id')
                ->references('id')
                ->on('support_tickets')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            //Parent ID for chat threads
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->longText('body')->nullable();

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
        Schema::dropIfExists('chats');
    }
};
