<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Video;
use App\Models\Service;
use App\Models\TourPackage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TourPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TourPackage::create([
            'name' => 'Agroteknologi',
            'description' => 'Jelajahi dunia pertanian modern! Pelajari teknik terbaru dalam hidroponik, vertikultur, dan budidaya tanaman dengan teknologi canggih.',
            'is_visible' => true,
            'price' => 10000,
            'image_icon' => 'background/background_1.png',
            'discount' => 5,
            'tour_package_code' => (new TourPackage())->generateTourPackageCode()
        ]);

        TourPackage::create([
            'name' => 'Peternakan Modern',
            'description' => 'Temukan inovasi di dunia peternakan! Saksikan langsung sistem kandang tertutup, teknologi pakan otomatis, dan manajemen kesehatan hewan modern.',
            'is_visible' => true,
            'price' => 10000,
            'image_icon' => 'background/background_5.png',
            'discount' => 10,
            'tour_package_code' => (new TourPackage())->generateTourPackageCode()
        ]);

        TourPackage::create([
            'name' => 'Edukasi',
            'description' => 'Nikmati pengalaman edukasi yang menyenangkan dan mendalam dengan Paket Edukasi kami. Cocok untuk pelajar dan keluarga yang ingin belajar sambil berwisata.',
            'is_visible' => true,
            'price' => 10000,
            'image_icon' => 'background/background_5.png',
            'discount' => 15,
            'tour_package_code' => (new TourPackage())->generateTourPackageCode()
        ]);

        TourPackage::create([
            'name' => 'VIP',
            'description' => 'Pengalaman eksklusif dengan fasilitas premium! Nikmati tur privat, hidangan istimewa, dan konsultasi personal dengan pakar kami.',
            'is_visible' => true,
            'price' => 50000,
            'image_icon' => 'background/background_6.png',
            'discount' => 10,
            'tour_package_code' => (new TourPackage())->generateTourPackageCode()
        ]);

         // Array of services without tour_package_id
         $services = [
            ['name' => 'Pemandu Wisata Berpengalaman'],
            ['name' => 'Transportasi Selama Tour'],
            ['name' => 'Tiket Masuk Semua Wahana'],
            ['name' => 'Makan Siang'],
            ['name' => 'Snack dan Minuman'],
            ['name' => 'Asuransi Perjalanan'],
            ['name' => 'Fotografer Profesional'],
            ['name' => 'Perlengkapan Keamanan'],
        ];

        Service::insert($services);

        $tourPackageServices = [
            // For Tour Package ID 1
            1 => [
                'Pemandu Wisata Berpengalaman',
                'Transportasi Selama Tour',
            ],
            2 => [
                'Tiket Masuk Semua Wahana',
                'Makan Siang',
            ],
            3 => [
                'Snack dan Minuman',
                'Asuransi Perjalanan',
            ],
            4 => [
                'Fotografer Profesional',
                'Perlengkapan Keamanan',
            ],
        ];

        foreach ($tourPackageServices as $tourPackageId => $serviceNames) {
            $serviceIds = Service::whereIn('name', $serviceNames)->pluck('id');
            $tourPackage = TourPackage::find($tourPackageId);
            if ($tourPackage) {
                $tourPackage->services()->attach($serviceIds);
            }
        }

        $images = [
            ['tour_package_id' => 1, 'image_url' => 'background/background_1.png'],
            ['tour_package_id' => 2, 'image_url' => 'background/background_5.png'],
            ['tour_package_id' => 3, 'image_url' => 'background/background_8.png'],
            ['tour_package_id' => 4, 'image_url' => 'background/background_6.png'],
        ];
        Image::insert($images);

        $videos = [
            ['tour_package_id' => 1, 'video_url' => 'https://www.youtube.com/watch?v=contoh-video-1', 'title' => 'Video Tour 1', 'description' => 'Deskripsi Video 1'],
            ['tour_package_id' => 3, 'video_url' => 'https://www.youtube.com/watch?v=contoh-video-2', 'title' => 'Video Tour 2', 'description' => 'Deskripsi Video 2'],
        ];
        Video::insert($videos);
    }
}
