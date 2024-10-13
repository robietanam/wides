<?php

namespace Database\Seeders;

use App\Models\SiteInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteInfo::create([
            'address' => 'Dusun Sumberpinang, Desa Karangharjo, Kec. Silo, Kabupaten Jember, Jawa Timur, POS, 68184',
            'phone_number' => '+62 8233-5351-928',
            'contact_person' => '0895326363837',
            'contact_person_transaction' => '0895326363837',
            'email' => 'wides@gmail.com',
            'facebook' => 'wideskarangharjo',
            'instagram' => 'wideskarangharjo',
            'landing_image' => 'background/background_13.jpg',
            'video_profile' => 'https://www.youtube.com/watch?v=tW5AGeQ_D-c',
            'gallery'=> ['background/background_1.png','background/background_5.png','background/background_8.png'],
            'profile_title' => 'Berkomitmen pada Pembelajaran Berkelanjutan',
            'profile_desc' => 'Ini adalah bagian deskripsi tentang kami. Anda bisa menjelaskan visi misi, nilai-nilai, atau informasi penting lainnya tentang perusahaan atau organisasi Anda. Pastikan deskripsinya informatif dan menarik bagi pengunjung website Anda.',
        ]);
    }
}
