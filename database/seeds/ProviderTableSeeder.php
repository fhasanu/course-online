<?php

use Illuminate\Database\Seeder;

class ProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

/*
kursusin::DATABASE=> select * from ak_course_age;
 ak_course_age_id | ak_course_age_name_id | ak_course_age_name_eng
------------------+-----------------------+------------------------
                1 | ANAK-ANAK             | KIDS
                2 | REMAJA                | TEENS
                3 | DEWASA                | ADULT
(3 rows)

kursusin::DATABASE=> select * from ak_course_level;
 ak_course_level_id | ak_course_level_name
--------------------+----------------------
                  1 | PEMULA
                  2 | MENENGAH
                  3 | MAHIR
(3 rows)

kursusin::DATABASE=> select * from ak_course_schedule;
 ak_course_schedule_id | ak_course_schedule_detid | ak_course_schedule_day | ak_course_schedule_time
-----------------------+--------------------------+------------------------+-------------------------
                     1 |                        1 | senin                  | 13:00:00
                     2 |                        1 | selasa                 | 13:00:00
                     3 |                        2 | rabu                   | 14:00:00
                     4 |                        2 | kamis                  | 14:00:00
                     5 |                        3 | jumat                  | 15:00:00
                     6 |                        3 | sabtu                  | 15:00:00
                     7 |                        4 | senin                  | 10:00:00
                     8 |                        4 | senin                  | 11:00:00
                     9 |                        5 | selasa                 | 10:00:00
                    10 |                        5 | selasa                 | 11:00:00
(10 rows)
*/

    public function run()
    {
        DB::table('ak_course')->insert([
            [
            'ak_course_name' => '', 
            'ak_course_cat_id' => , 
            'ak_course_prov_id' => '',
            ],
        ]);
        DB::table('ak_course_detail')->insert([
        	[
        	'ak_course_id'=> '',
        	 'ak_course_detail_name'=>'',
        	 'ak_course_detail_price'=> '',
        	 'ak_course_detail_level'=> '',
        	 'ak_course_detail_age'=> '',
        	 'ak_course_detail_size'=> '',
        	 'ak_course_detail_desc'=> '',
        	 ],
        ]);

        DB::table('ak_course_schedule')->insert([
            [
            'ak_course_schedule_detid' => '', 
            'ak_course_schedule_day' => , 
            'ak_course_schedule_time' => '',
            ],
        ]);

        DB::table('ak_provider')->insert([
        	[
        	 'ak_provider_firstname'=> '',
        	 'ak_provider_lastname'=>'',
        	 'ak_provider_email'=> '',
        	 'ak_provider_password'=> '',
        	 'ak_provider_region'=> '',
        	 'ak_provider_address'=> '',
        	 'ak_provider_zipcode'=> '',
        	 'ak_provider_description'=> '',
        	 'ak_provider_telephone'=> '',
        	 'ak_provider_last_activity'=> '',
        	 ],
        ]);

        DB::table('ak_provider_img')->insert([
            [
            'ak_provider_id' => '', 
            'ak_provider_img_path' => , 
            ],
        ]);

    }
}
