<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            ['id'=>1,
            'name'=>'admin',
            'type'=>'admin',
            'mobile'=>'9800000000',
            'email'=>'admin@admin.com',
            'password'=>'$2y$10$ezkH875TFrD3w5g4jyfTeeqyxEut1ivQysz447qJGqa/csJ.5UQMe',
            'image'=>'',
            'status'=>1],
            ['id'=>2,
            'name'=>'subadmin',
            'type'=>'subadmin',
            'mobile'=>'9600000000',
            'email'=>'subadmin@subadmin.com',
            'password'=>'$2y$10$ezkH875TFrD3w5g4jyfTeeqyxEut1ivQysz447qJGqa/csJ.5UQMe',
            'image'=>'',
            'status'=>1],
        ];

        DB::table('admins')->insert($adminRecords);
        /* foreach ($adminRecords as $key => $record)
        {
            \App\Admin::create($record);
        } */
    }
}
