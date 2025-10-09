<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            'السعودية', 'الإمارات', 'قطر', 'البحرين', 'الكويت', 'عمان',
            'مصر', 'الأردن', 'المغرب', 'تونس', 'الجزائر', 'السودان',
            'لبنان', 'سوريا', 'العراق', 'فلسطين', 'تركيا', 'فرنسا',
            'إيطاليا', 'ألمانيا', 'إسبانيا', 'المملكة المتحدة', 'أمريكا', 'كندا', 'اليابان',
            'اليمن', 'فلسطين' , 'سوريا'
        ];

        foreach ($countries as $country) {
            DB::table('countries')->insert([
                'name' => $country,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
}
