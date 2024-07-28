<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $common_data = new Array_();
            $common_data->title= 'About Us  Details';
            $aboutUs =AboutUs::first();
            return view('adminPanel.AboutUs.aboutus')->with(compact('common_data', 'aboutUs'));
    }


    public function updateAboutUs(Request $request)
    {
        $getinfo = AboutUs::first();
        if ($getinfo) {
            $aboutUs = $getinfo;
        } else {
            $aboutUs = new AboutUs();
        }

        $aboutUs->title = $request->title;
        $aboutUs->history = $request->history;
        $aboutUs->mission = $request->mission;
        $aboutUs->vision = $request->vision;
        $aboutUs->values = $request->values;
        $aboutUs->additional_info = $request->additional_info;
        
        $aboutUs->save();

        return redirect()->back()->with('success', 'Successfully Updated');
    }

    // public function processImage($image)
    // {
    //     if (isset($image) && ($image != '') && ($image != null)) {
    //         $ext = explode('/', mime_content_type($image))[1];

    //         $image_url = "about_us_image-" . time() . rand(1000, 9999) . '.' . $ext;
    //         $image_directory = public_path('storage/about_us_images/');
    //         $filePath = $image_directory;
    //         $image_path = $filePath . $image_url;
    //         $db_image_path = 'storage/about_us_images/' . $image_url;
    //         if (!file_exists($filePath)) {
    //             mkdir($filePath, 0777, true);
    //         }
    //         $image = Image::make(file_get_contents($image));
    //         $image->brightness(8);
    //         $image->contrast(11);
    //         $image->sharpen(5);
    //         $image->encode('webp', 70);
    //         $image->save($image_path);

    //         return $db_image_path;
    //     }
    // }
}
   
    

