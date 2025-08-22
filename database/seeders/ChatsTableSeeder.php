<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChatsTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('chats')->insert([
            [
                'user_id' => 1, // sender
                'other_user_id' => 2, // receiver
                'message' => 'Hey, how are you?',
                'group_id' => '1_2',
                'is_read' => false,
                'created_at' => $now->subMinutes(10),
                'updated_at' => $now->subMinutes(10),
            ],
            [
                'user_id' => 2,
                'other_user_id' => 1,
                'message' => 'I am good, thanks! What about you?',
                'group_id' => '1_2',
                'is_read' => true,
                'created_at' => $now->subMinutes(8),
                'updated_at' => $now->subMinutes(8),
            ],
            [
                'user_id' => 1,
                'other_user_id' => 2,
                'message' => 'Doing well, working on the chat app 😃',
                'group_id' => '1_2',
                'is_read' => false,
                'created_at' => $now->subMinutes(5),
                'updated_at' => $now->subMinutes(5),
            ],
        ]);
    }
}
