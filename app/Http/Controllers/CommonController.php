<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CommonController extends Controller
{
    public function upload(Request $request)
    {
//        dd($request->all());

        $image = $request->file('photo');
        $imageFileName = time() . '.' . $image->getClientOriginalExtension();
        $s3 = Storage::disk('s3');
        $filePath = '/photos/' . $imageFileName;
        $res = $s3->put($filePath, file_get_contents($image), 'public');
        dd($res);

//        $bucket = 'php-face-recognition';
//        $keyname = 'photos';
//
//        $s3 = new S3Client([
//            'version' => 'latest',
//            'region'  => 'eu-west-1'
//        ]);
//
//        try {
//            // Upload data.
//            $result = $s3->putObject([
//                'Bucket' => $bucket,
//                'Key'    => $keyname,
//                'Body'   => $request->input('photo'),
//                'ACL'    => 'public-read'
//            ]);
//
//            // Print the URL to the object.
//            echo $result['ObjectURL'] . PHP_EOL;
//        } catch (S3Exception $e) {
//            echo $e->getMessage() . PHP_EOL;
//        }
    }
}
