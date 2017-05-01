<?php

use Illuminate\Database\Seeder;

class articleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 游记模拟数据
        $data = [];

        for ($i = 1; $i < 11; $i ++){
            $tmp = [];
            $tmp['title'] = '游记 #'. $i;
            $tmp['content'] = '内容内容内容内容内容内容内容内容内容内容内容 #'. $i;
            $tmp['user_id'] = 1;
            $tmp['created_at'] = date('Y-m-d H:i:s');
            $tmp['updated_at'] = date('Y-m-d H:i:s');

            $data[] = $tmp;
        }
        DB::table('posts')->insert($data);
    }
}
