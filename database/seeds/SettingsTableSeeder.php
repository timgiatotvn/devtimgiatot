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
                    'name' => 'NewIA',
                    'logo_top' => '1',
                    'logo_footer' => 1,
                    'email' => 1,
                    'hotline' => 'new',
                    'address' => 1,
                    'zalo' => 1,
                    'facebook' => 1,
                    'skype' => 1,
                    'google' => 1,
                    'telephone' => 1,
                    'code_header' => 1,
                    'code_body' => 1,
                    'code_footer' => 1,
                    'title_seo' => 'New IA',
                    'meta_des' => 1,
                    'meta_key' => 1,
                    'content_footer' => 1,

                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s"),
                ],

            ]
        );
    }
}
