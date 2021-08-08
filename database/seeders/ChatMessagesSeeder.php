<?php

namespace Database\Seeders;

use App\Models\ChatMessage;
use Illuminate\Database\Seeder;

class ChatMessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChatMessage::create([
            'author_name' => '张三',
            'message' => '随手试下，支持多语言么？',
            'lang' => 'zh_CN',
        ]);
        ChatMessage::create([
            'author_name' => '滑滑',
            'message' => '有哦，可適應不同語言文字。有的語言標點符號要放下方，也有的要放中間；有的語言由左至右書寫，也有的語言由右至左書寫！',
            'lang' => 'zh_TW',
        ]);
        ChatMessage::create([
            'author_name' => 'אביגיל',
            'message' => 'שלום לכולם. שמי אביגיל. אני מישראל. נעים להכיר אותך. אני משתמש בתרגום מכונות.',
            'lang' => 'he',
        ]);
    }
}
