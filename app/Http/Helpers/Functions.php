<?php

use App\Admin;
use App\Employee;
use App\Notification;
use App\Setting;
use App\Notifications\NewNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Category;
use App\Translation;
use Illuminate\Support\Facades\Session;
use App\Language;


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



/**
 * push firebase notification .
 * Author : Khaled
 * created By Khaled @ 15-06-2021
 */
if(!function_exists('pushNotification')){
    function pushNotification($patient = null){
        if (!$patient){
            /** Get Admin Last Notification **/
            $notification = Employee::first()->unreadNotifications->first();

            /** push notification only to interest employees if guard is employee**/
            $tokensList = Employee::whereHas('roles', function (Builder $query) use ($notification) {
                $query->where('label', employeeRole($notification->type));
            })->whereNotNull('device_token')->pluck('device_token')->all();
        }else{
            $tokensList = [$patient->device_token];
            $notification = $patient->unreadNotifications->first();
        }




        $SERVER_API_KEY = serverKey();

        $data = [
            "registration_ids" => $tokensList,
            "notification" => [
                "alert_title" => $notification->data['title'],
                "title" => $notification->data['title'],
                "date" => $notification->created_at->diffForHumans(),
                "alert_icon" => $notification->data['icon'] ,
                "icon" => asset(setting('logo_path')),
                "class" => $notification->data['class'],
                "url" => $notification->data['url'],
                "id" => $notification->id,
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



if(!function_exists('serverKey')){
    function serverKey(){
        return "AAAA4aN7mQ0:APA91bH2crrFOJLJt28hsyEgVbycqXN6MBqiSbGshszGr2YvL9HrIRenf1-LYYGpk-xmW3TAmmWHrS30ZQasD3ED6vq0tYv558zxtQ3opm82hyh3V2DwNF1vf6Xn394M1Ge2c_Zmo9yw";
    }
}

if(!function_exists('employeeRole')){
    function employeeRole($notificationType){
        switch ($notificationType){
            case 'App\Notifications\WaitingLabNotification':
                return 'Lab';
            case 'App\Notifications\ResultToDoctor':
                return 'Doctor';
            case 'App\Notifications\HomeVisitNotification':
                return 'Receptionist';
            default :
                return 'Super Admin';
        }    }
}

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
