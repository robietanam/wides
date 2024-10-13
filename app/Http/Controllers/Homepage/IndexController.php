<?php

namespace App\Http\Controllers\Homepage;

use App\Models\TourPackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\SiteInfo;

class IndexController extends Controller
{
    public function index()
    {
        $tourPackages = TourPackage::all();
        $ratings = Rating::where('is_displayed', true)->get();
        $siteInfo = SiteInfo::first();
        $videoId = null;
        if (strpos($siteInfo->video_profile, 'youtube.com/watch?v=') !== false) {
            $parsedUrl = parse_url($siteInfo->video_profile);
            parse_str($parsedUrl['query'], $queryParams);
            $videoId = $queryParams['v'];
        } 

        elseif (strpos($siteInfo->video_profile, 'youtube.com/shorts/') !== false) {
            $parsedUrl = parse_url($siteInfo->video_profile);

            $pathSegments = explode('/', $parsedUrl['path']);
            $videoId = end($pathSegments);
        }  
        elseif (strpos($siteInfo->video_profile, 'youtu.be') !== false) {
            $parsedUrl = parse_url($siteInfo->video_profile);

            $pathSegments = explode('/', $parsedUrl['path']);
            $videoId = end($pathSegments);
        }
        
        return view('pages.homepage-v2', ['tourPackages' => $tourPackages, 'ratings'=> $ratings, 'siteInfo' => $siteInfo, 'videoId'=>$videoId]);
    }
}
