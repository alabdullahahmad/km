<?php

use App\Http\Core\Const\Messages\ErrorMessages;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\Console\RetryCommand;
use Illuminate\Support\Facades\Storage;

        // check Password function
        if (! function_exists('checkPassWord')) {
            function checkPassWord($password , $hashedPassword) :bool {
                return Hash::check($password, $hashedPassword);
            }
        }

        // create Token function
        function getToken($user) :String {
         return $user->createToken('API Token')->accessToken;
        }


        // hash data function
        function hashData($data) : String{
            return Hash::make($data);
        }

        // make Exception function
        function make_exception( $message , $code = 500 ){
            throw new Exception(  $message , $code );
        }

        function setCatch($key, $value) : void{

            if(!Cache::put($key, $value, 600)){
                make_exception(ErrorMessages::getKey(ErrorMessages::$SomeThingWentWrong));
            }

        }

        function getCatch($key){
            return Cache::get($key);
        }

        //store image
        function storeImage($photo , string $prefix ="/" , ?string $oldPath = null){

            $name = time() . "_." . $photo->getClientOriginalExtension() ;
            $path = $photo->storeAs($prefix,$name);

            $newPath = Storage::url($path);

            if ($oldPath) {
               removeImage($oldPath);
            }

            return $newPath;
        }

        //delete image
        function removeImage($path){
            return  Storage::delete(substr(parse_url($path, PHP_URL_PATH),9));
        }


        function create_file_and_add_content($path , $content) :bool{
            if (file_exists($path)) {
                return false;
             }
             else {
                $fh = fopen($path, 'wb');
                fwrite($fh, $content);
                fclose($fh);
                chmod($path, 0777);
                return true;
            }

        }



        // function authSession($force=false){
        //     $session = new \App\Models\User;
        //     if($force){
        //         $user = \Auth::user()->getRoleNames();
        //         \Session::put('auth_user',$user);
        //         $session = \Session::get('auth_user');
        //         return $session;
        //     }
        //     if(\Session::has('auth_user')){
        //         $session = \Session::get('auth_user');
        //     }else{
        //         $user = \Auth::user();
        //         \Session::put('auth_user',$user);
        //         $session = \Session::get('auth_user');
        //     }
        //     return $session;
        // }

        function add_spacename_and_function($path , $namespace ,$function) :bool{
            if (!file_exists($path)) {
                echo "file not exit";
                return false;
             }
             else {
                $lines = file($path);
                $fileContent = '';

                $inClass = false;
                $not_read = true;
                if ($lines === false) {
                    echo "Error reading the file.";
                } else {
                    foreach ($lines as $line) {
                        if (!$inClass && strpos(strtolower($line), "class") !== false) {
                            $fileContent .= $namespace;
                            $fileContent .= $line . "\n";
                            $fileContent .="\t".$function;
                            $inClass = true;
                            if($inClass && $not_read && strpos(strtolower($line), "{")){
                                $not_read = false;
                                // $fileContent .= $line;
                                // $fileContent .= $content;
                            }
                        }
                        else{

                            if($inClass && $not_read && strpos(strtolower($line), "{")){
                                $not_read = false;
                                $fileContent .= $line;
                                $fileContent .= $function;
                            }
                            else{
                            $fileContent .=$line;
                            }
                        }

                    }
                }
                // $fr = fopen($path, 'r');
                // $fileRead = file_get_contents($path);
                $fh = fopen($path, 'w');
                // $content = substr($fileRead,0,strrpos($fileRead, '}'))."\n".$content."\n}";
                fwrite($fh, $fileContent);
                fclose($fh);
                chmod($path, 0777);
                return true;
            }

        }



        function createDirectories($path , $separator) : string {
          //  $path = substr($path, 1);
            $directories = explode($separator, $path);
            $currentPath = '';
            $first = true;
           // print_r($directories);
            foreach ($directories as $directory) {
                if ($directory !== '') {
                    $first ? $currentPath .= $directory : $currentPath .= $separator . $directory;
                    $first = false;
                    if (!is_dir($currentPath)) {
                        mkdir($currentPath, 0777, true);
                    }
                }
            }
            return $currentPath."\\";
        }


//         function comman_message_response( $message, $status_code = 200){
//             return response()->json( [ 'message' => $message ], $status_code );
//         }

//         function comman_custom_response( $response, $status_code = 200 ){
//             return response()->json($response,$status_code);
//         }


//         function demoUserPermission(){
//             if(\Auth::user()->hasAnyRole(['demo_admin'])){
//                 return true;
//             }else{
//                 return false;
//             }
//         }



// function getSingleMedia($model, $collection = 'profile_image', $skip=true   ){
//     if (!\Auth::check() && $skip) {
//         return asset('images/user/user.png');
//     }
//     $media = null;
//     if ($model !== null) {
//         $media = $model->getFirstMedia($collection);
//     }

//     if (getFileExistsCheck($media)) {
//         return $media->getFullUrl();
//     }else{

//         switch ($collection) {
//             case 'image_icon':
//                 $media = asset('images/user/user.png');
//                 break;
//             case 'profile_image':
//                 $media = asset('images/user/user.png');
//                 break;
//             case 'service_attachment':
//                 $media = asset('images/default.png');
//                 break;
//             case 'site_logo':
//                 $media = asset('images/fleet.png');
//                 break;
//             case 'site_favicon':
//                 $media = asset('images/favicon.png');
//                 break;
//             case 'app_image':
//                 $media = asset('images/frontend/mb-serv-1.png');
//                 break;
//             case 'app_image_full':
//                 $media = asset('images/frontend/mb-serv-full.png');
//                 break;
//             case 'footer_logo':
//                 $media = asset('landing-images/logo/logo.png');
//                 break;
//             case 'logo':
//                 $media = asset('images/fleet.png');
//                 break;
//             case 'favicon':
//                 $media = asset('images/favicon.png');
//                 break;
//             case 'loader':
//                 $media = asset('images/loader.gif');
//                 break;
//             default:
//                 $media = asset('images/default.png');
//                 break;
//         }
//         return $media;
//     }
// }


// function imageSession($type='get'){
//     if(\Session::get('images_data') == ''){
//         $type='set';
//     }
//     switch ($type){
//         case "set" :
//             $settings = \App\Models\Setting::where('type','theme-setup')->where('key','theme-setup')->first();
//             \Session::put('images_data',$settings);
//             break;
//         default :
//             break;
//     }
//     return \Session::get('images_data');
// }

// function getFileExistsCheck($media){
//     $mediaCondition = false;

//     if($media) {
//         if($media->disk == 'public') {
//             $mediaCondition = file_exists($media->getPath());
//         } else {
//             $mediaCondition = \Storage::disk($media->disk)->exists($media->getPath());
//         }
//     }

//     return $mediaCondition;
// }
