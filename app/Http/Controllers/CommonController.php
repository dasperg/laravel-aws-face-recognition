<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Aws\Rekognition;

class CommonController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function upload(Request $request)
    {
        // Save image to S3
        $image = $request->file('photo');
        $imageFileName = time() . '.' . $image->getClientOriginalExtension();
        $s3 = Storage::disk('s3');
        $filePath = 'photos/' . $imageFileName;
        $s3->put($filePath, file_get_contents($image), 'public');

        // Recognition
        $client = new Rekognition\RekognitionClient(self::getAWSConfig());
        $result = $client->detectLabels([
          'Image' => [ // REQUIRED
            'S3Object' => [
              'Bucket' => env('AWS_BUCKET'),
              'Name' => $filePath,
            ],
          ],
        ]);
        $image = Storage::url($filePath);

        return view('recognition.index', compact('image', 'result'));
    }

    private static function getAWSConfig()
    {
        return [
          'region' => env('AWS_DEFAULT_REGION'),
          'version' => 'latest',
          'key' => env('AWS_ACCESS_KEY_ID'),
          'secret'  => env('AWS_SECRET_ACCESS_KEY')
        ];
    }
}
