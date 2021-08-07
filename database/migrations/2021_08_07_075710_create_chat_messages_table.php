<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            // 依一般匿名聊天室性質，傳送者名稱大概最多只要 20 字。
            $table->string('author_name', 20)->comment('傳送者名稱');
            // 依一般匿名聊天室性質，訊息長度最長暫定 100。
            $table->string('message', 100)->comment('訊息內容');
            // 每一則訊息的語言代碼，適用於傳送者名稱及訊息。最長不知道有多少，暫時用 20。
            $table->string('lang', 20)->comment('語言代碼');
            // 希望依訊息發送時間排序及查詢。若採用預設精確度，太容易遇到無法分辨訊息前後的情形。
            $table->timestamp('created_at', 3)->index();
            $table->timestamp('updated_at', 3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_messages');
    }
}
