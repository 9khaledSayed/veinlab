<?php

use App\Models\Admin;
use App\Models\Setting;
use App\Notifications\NewNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Translation;
use Illuminate\Support\Facades\Session;
use App\Models\Language;


/*

* updated by ahmed gamal => changed the name to getImagesPath

*/

if(!function_exists('getImagesPath')){
    function getImagesPath($model){
        $model = Str::plural($model);
        $model = Str::ucfirst($model);
        return asset('/storage/Images').'/'.$model.'/';
    }
}

if(!function_exists('getAdminImagesPath')){
    function getAdminImagesPath($model){
        $model = Str::plural($model);
        $model = Str::ucfirst($model);
        return env('ZUMAX_ADMIN_LINK') . 'storage/Images/'.$model.'/';
    }
}




/**
 * Store a newly image .
 *
 * @param  \Illuminate\Http\Request  $request, $model (Model to use it to directory name),
 * @return \Illuminate\Http\Response $imageName
 * Author : Wageh
 * Updated By Wagih @ 7-2-2021
 * Added Path varibale
 * Author : Wageh
 * Updated By Wagih @ 7-2-2021
 * Added Path varibale
 * update by andrew @8-2-2021
 * replace profile_pic to image
 */
if(!function_exists('uploadImage')){

    function uploadImage($request, $model){
        $model = Str::plural($model);
        $model = Str::ucfirst($model);
        $path         = "/Images/".$model;
        $originalName =  $request->getClientOriginalName(); // Get file Original Name
        $imageName    = 'Aglha_'.rand(1000, 9999)  .$originalName;  // Set Image name based on user name and time
        $request->storeAs($path, $imageName,'public');
        return $imageName;
    }
}



/**
 * Delete image .
 *
 * @param  $imageName, $model (Model to use it to directory name),
 * Author : Wageh
 * Updated By Khaled @ 21-3-2021
 * Added condition to prevent delete default.png
 */

if(!function_exists('deleteImage')){

    //$request->file('image')

    function deleteImage($imageName, $model){
        $model = Str::plural($model);
        $model = Str::ucfirst($model);
        if ($imageName != 'default.png'){
            $path = "/Images/".$model.'/'.$imageName;
            Storage::disk('public')->delete($path);
        }
    }
}


if(!function_exists('getTransactionIds')){

    //$request->file('image')

    function getTransactionIds($obj){
        $string = '';
        foreach($obj as $ob){
            $string = $string.$ob['id'].',';
        }
        return rtrim($string, ", ");
    }
}

if(!function_exists('affiliteSetting')){



    function affiliteSetting(){
        return \App\Models\AffiliateSetting::first();
    }
}
if(!function_exists('isTabOpen')){

    //$request->file('image')

    function isTabOpen($path){

        if ( request()->segment(2)  === $path )
            return 'menu-item-open';

    }
}

if(!function_exists('findTemplate')){
    function findTemplate(){
        $templates = ["template1","template2"];
        $url = (string)url()->previous();

        foreach($templates as $temp){
            if(strpos($url, $temp) !== false){
                return $temp;
            }
        }
    }
}


if(!function_exists('isTabActive')){

    //$request->file('image')

    function isTabActive($path){

        if ( request()->segment(2) . request()->segment(3) === $path  ||  request()->segment(2) . '/'. request()->segment(3) === $path )
            return 'menu-item-active';
    }
}

if(!function_exists('isSettingTabActive')){
//    dd(request()->segments());
    function isSettingTabActive($path){

        if ( request()->segment(3) === $path )
            return 'active';
    }
}



if(!function_exists('checkAuthentication')){

    function checkAuthentication(){

        auth()->guard('web')->check() ? null : abort(401);
    }

}



function findPercentage($price,$discountPrice){
    // $discountPrice = $discountPrice + $price;
    return number_format(( ( (float)$discountPrice - (float)$price )  / (float)$price ) * 100,1);
}

function attribute_categories(){
    return App\Models\AttributeCategory::get();
}


/**
 * Get nodel translation .
 * @param  \Illuminate\Http\Request
 * @return \Illuminate\Http\Response
 * Author : Wageh
 * created By Wagih @ 8-3-2021
 * Updated By Wagih @ 8-3-2021
 */
if(!function_exists('getTranslation')){
    function getTranslation($objectId, $model, $languageCode, $languageId){

        $translations = Translation::where([
            ['object_id', '=', $objectId],
            ['model', '=', $model],
            ['language_code', '=', $languageCode],
            ['language_id', '=', $languageId],
        ])->get();
        return $translations;
    }
}


if(!function_exists('getLanguages')){
    function getLanguages(){
        return \App\Models\Language::where('is_default', 0)->get();

    }
}

/**
 * Forcedelete model translations .
 * @param  \Illuminate\Http\Request
 * @return \Illuminate\Http\Response
 * Author : Wageh
 * created By Wagih @ 10-3-2021
 * Updated By Wagih @ 10-3-2021
 */
if(!function_exists('forceDeleteTranslations')){
    function forceDeleteTranslations($objectId, $model){

        $translations = Translation::where([
            ['object_id', '=', $objectId],
            ['model', '=', $model]
        ])->withTrashed()->get();
        foreach($translations as $translation){
            $translation->forceDelete();
        }
        return $translations;
    }
}

/**
 * Add new translation .
 * @param  \Illuminate\Http\Request
 * @return \Illuminate\Http\Response
 * Author : Wageh
 * created By Wagih @ 2-3-2021
 * Updated By Wagih @ 2-3-2021
 */
if(!function_exists('addTranslation')){
    function addTranslation($objectId, $model, $languageCode, $languageId, $string){
        // Check if translated before
        $counter = 0;
        $translation = Translation::where([
            ['object_id', '=', $objectId],
            ['model', '=', $model],
            ['language_code', '=', $languageCode],
            ['language_id', '=', $languageId],
        ])->first();
        // If object is empty then add translation
        if(empty($translation)){
            Translation::create([
                'object_id' => $objectId,
                'model' => $model,
                'language_code' => $languageCode,
                'language_id' => $languageId,
                'string' => serialize($string),
            ]);
        }else{
            $counter++; // else add counter ++
        }

        return $counter;
    }
}

/**
 * push firebase notification .
 * Author : Khaled
 * created By Khaled @ 15-06-2021
 */
if(!function_exists('pushNotification')){
    function pushNotification($title, $icon, $class, $url){
        $date = \Carbon\Carbon::now()->diffForHumans();
        $admin = Admin::first();
        $notification = new NewNotification($title, $date, $icon, $class, $url);
        $admin->notify($notification);

        $firebaseToken = Admin::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = serverKey();

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "alert_title" => $title,
                "title" => $title,
                "date" => $date,
                "alert_icon" => $icon ,
                "icon" => asset('web/img/fav.png'),
                "class" => $class,
                "url" => $url,
                "id" => $admin->notifications->last()->id,
            ]
        ];

        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_exec($ch);

        return $ch;
    }
}

///**
// * Get model translations .
// * Author : khaled
// * created By khaled @ 1-6-2021
// * Updated By khaled @ 1-6-2021
// */
//if(!function_exists('allNotifications')){
//    function allNotifications(){
//
//        $notifications = \App\Models\Admin::first()->notifications;
//        return $notifications;
//    }
//}

/**
 * Get Model Data To data Table .
 * Author : Khaled && Jemmy
 * created By Khaled && Jemmy @ 17-5-2021
 */
if(!function_exists('getModelData')){
    function getModelData(Model $model, Request $request, $relations = [])
    {

//        $model = app('\\App\\Models\\' . $modelName);

        $columns = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());

        $model   = $model->query()->with(array_keys($relations));




        // Define the page and number of items per page
        $page = 1;
        $per_page = 2;

        // Define the default order
        $order_field = 'id';
        $order_sort = 'asc';

        // Get the request parameters
        $params = $request->all();

        // Set the current page
        if(isset($params['pagination']['page'])) {
            $page = $params['pagination']['page'];
        }

        // Set the number of items
        if(isset($params['pagination']['perpage'])) {
            $per_page = $params['pagination']['perpage'];
        }



//         Set the search filter
        if(isset($params['query']['generalSearch'])) {
            foreach ($columns as $column){
                $model->orWhere($column, 'LIKE', "%" . $params['query']['generalSearch'] . "%");
            }

            foreach ($relations as $relation => $columns) {

                $model->orWhereHas($relation, function (Builder $query) use ($columns, $params){
                    foreach ($columns as $column){
                        $query->where($column, 'LIKE', "%" . $params['query']['generalSearch'] . "%");
                    }
                });

            }


        }



        // Set the sort order and field
        if(isset($params['sort']['field'])) {
            $order_field = $params['sort']['field'];
            $order_sort = $params['sort']['sort'];
        }

        // Get how many items there should be
        $total = $model->count();
        $total = $model->limit($per_page)->count();

        // Get the items defined by the parameters


        $orderFieldIsRelation = strpos($order_field, ".") !== false;


        if ($orderFieldIsRelation){

            $orderRelation = explode(".", $order_field)[0];
            $orderField = explode(".", $order_field)[1];

            $model->skip(($page - 1) * $per_page)
                ->take($per_page)->whereHas($orderRelation, function (Builder $query) use ($orderField ,$order_sort){
                    $query->orderBy($orderField, $order_sort);
                })->get();

        }else{

             $model->skip(($page - 1) * $per_page)
                ->take($per_page)->orderBy($order_field, $order_sort)
                ->get();
        }





        $data = $model->get();

        /** if request has filters like status **/
        if(isset($params['query'])) {
            foreach ($columns as $column){
                if (isset($params['query'][$column])){
                    $data = $model->get()->where($column ,$params['query'][$column]);
                }
            }
        }


        $response = [
            'meta' => [
                "page" => $page,
                "pages" => ceil($total / $per_page),
                "perpage" => $per_page,
                "total" => $total,
                "sort" => $order_sort,
                "field" => $order_field
            ],
            'data' => $data
        ];

        return $response;
    }
}


if(!function_exists('sendFirebaseNotification')){
    function sendFirebaseNotification( $notificationBody , $token = null , $tokens = [] ){


        $SERVER_API_KEY = serverKey();

        $data = [
            "notification" => [
                "title" => 'Aglha',
                "body" => $notificationBody,
                "sound"=> "default"
            ],
        ];

        if ($token == null){

            $data['registration_ids'] = $tokens;

        }else{

            $data['to'] = $token;
        }


        Http::withHeaders([
            'Authorization' => 'key=' . $SERVER_API_KEY,
            'Content-Type' => 'application/json'
        ])->post('https://fcm.googleapis.com/fcm/send', $data);

    }
}

if(!function_exists('serverKey')){
    function serverKey(){
        return "AAAAv1cVwJQ:APA91bGMf0m9tBjRyaWFZlvEiqEkT4WqXcjt-N3oLP04V1wdLYFE7YssiGiPWWdz5fVs5-R_2CaB4cHRYdqyt0daxBDbFTBFm5NnoEO8JL4q7fKG-8sDEGAeZE_UK9XzCCHvUYyQ89H8";
    }
}
