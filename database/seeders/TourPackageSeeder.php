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
            'name' => 'Paket Wisata Paket Eduwisata 1',
            'description' => 'Paket Eduwisata 1 menawarkan pengalaman edukatif tentang budidaya hidroponik dan maggot. Dalam paket ini, peserta akan mempelajari dasar-dasar hidroponik, termasuk cara menanam dengan metode semai, dan proses pengelolaan maggot sebagai pakan alami yang ramah lingkungan. Selain itu, peserta juga akan berkesempatan memanen maggot secara langsung, memberikan pengalaman praktis dalam dunia pertanian dan pengelolaan sampah organik.',
            'is_visible' => true,
            'price' => 10000,
            'image_icon' => 'background/background_1.png',
            'discount' => 5,
            'tour_package_code' => (new TourPackage())->generateTourPackageCode()
        ]);

        TourPackage::create([
            'name' => 'Paket Wisata Paket Eduwisata 2',
            'description' => 'Paket ini memberikan pengalaman belajar menyeluruh tentang hidroponik dan budidaya maggot. Peserta akan menerima edukasi lengkap mengenai teknik hidroponik, dilanjutkan dengan praktik langsung serta tur di area green house untuk melihat prosesnya lebih dekat. Selain itu, peserta akan diajak mengikuti tur kandang maggot, dengan kesempatan langsung untuk memanen maggot. Paket ini juga dilengkapi dengan makanan berat, memberikan pengalaman eduwisata yang interaktif dan memuaskan.',
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
