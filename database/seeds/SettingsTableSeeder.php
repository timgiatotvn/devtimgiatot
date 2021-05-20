<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            [
                [
                    'name' => 'Timgiatot.vn',
                    'email' => '',
                    'hotline' => '',
                    'address' => '',
                    'zalo' => '',
                    'facebook' => '',
                    'skype' => '',
                    'google' => '',
                    'telephone' => '',
                    'code_header' => '',
                    'code_body' => '',
                    'code_footer' => '',
                    'title_seo' => 'Timgiatot',
                    'meta_des' => 'Timgiatot',
                    'meta_key' => 'Timgiatot',
                    'content_footer' => '',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s"),
                ],

            ]
        );
    }
}
