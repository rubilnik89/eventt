<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function articlelist(Request $request)
    {
        //$environment = App::environment();
        //$token = $environment["API_TOKEN"];

        $city = $request->query('city');
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');
        $within = $request->query('within');
        $category = $request->query('category');
        $longitude = $request->query('longitude');
        $latitude = $request->query('latitude');
        $page_number = $request->query('page_number');

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://www.eventbriteapi.com/v3/events/search/' , [
            'query'=>[
                'location.address' => $city,
                'start_date.range_start' => $startDate,
                'start_date.range_end' => $endDate,
                'location.within' => $within,
                'location.latitude' => $latitude,
                'location.longitude' => $longitude,
                'categories' => $category,
                'page' => $page_number,
                'expand'=>'category,venue,ticket_classes',
                'token'=>'OSUKWVGNBKZJWDBWKBIC',],
            'verify' => false,
            // todo: move token in .env
            //    'token'=>'OSUKWVGNBKZJWDBWKBIC',
        ]);

        $body = $response->getBody();
        $evenz = json_decode($body);
        return $body;



        /////////////////login:evenz@mail.ua
        /////////////////password:Cjjuio60387

    }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//    public function articlelist(Request $request)
//    {
//
//
//        $city = $request->query('city');
//        $startDate = $request->query('startDate');
//        $endDate = $request->query('endDate');
//        $within = $request->query('within');
//        $category = $request->query('category');
//        $longitude = $request->query('longitude');
//        $latitude = $request->query('latitude');
//        $page_number = $request->query('page_number');
//
//        $location_address="location.address=$city&";
//        $start_date_range_start="start_date.range_start=$startDate&";
//        $start_date_range_end="start_date.range_end=$endDate&";
//        $location_within="location.within=$within&";
//        $location_latitude="location.latitude=$latitude&";
//        $location_longitude="location.longitude=$longitude";
//        $categories="categories=$category&";
//
//
//        $client = new \GuzzleHttp\Client();
//        $response = $client->request('GET', 'https://www.eventbriteapi.com/v3/events/search/?verify=false&token=OSUKWVGNBKZJWDBWKBIC'.$location_address.$start_date_range_start.$start_date_range_end.$location_within.$location_latitude.$location_longitude.$categories.$page_number);
//        //$response = $client->request('GET', 'https://www.eventbriteapi.com/v3/events/search/?token=OSUKWVGNBKZJWDBWKBIC'.[
////            'location.address' => $city,
////            'start_date.range_start' => $startDate,
////            'start_date.range_end' => $endDate,
////            'location.within' => $within,
////            'location.latitude' => $latitude,
////            'location.longitude' => $longitude,
////            'categories' => $category,
////            'verify' => false,
////            'page' => $page_number,
////
////            // todo: move token in .env
////            //   'token'=>'OSUKWVGNBKZJWDBWKBIC',]);
//
//
//
//        $body = $response->getBody();
//        $evenz = json_decode($body);
//        var_dump($evenz);
//
//    }//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//        $page_count = 0;
//        $page_size = 50;
//
//        $all_events = [];
//        foreach ($evenz->events as $event) {
//            array_push($all_events, $event);
//
//        }
//
//        // 200 events returned from server
//        // page_size = 50
//        // page_number = 2
//        // page_size * (page_number - 1) = result (last not sent event number) (50)
//        // result + page_size - 1 = last event number (99)
//
//        // events = from result to last event number
////        for ($index = 0; $index <= 10; $index++) {
////            // events
////        }
//
//
//
//
//
//
//
//
//
//
//        $pagination['page_count'] = $page_count;
//        $pagination['page_size'] = $page_size;
//        $pagination['page_number'] = $page_number;
//        $main['pagination'] = $pagination;
//
//
//        $events[0] = $all_events;
//        $main['events'] = $events;
//
//
//
//
////        var_dump($main);
////        $json = json_encode($main);
////        return $json;
//    }
/*    public function articlelist(Request $request){

//        if(($request->has('location'))&&($request->has('start_date'))){
        $location = $request->query('location');
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');
//            echo $location . ' ' . $start_date . ' ' . $end_date;

        /////////////
        /////////////$start_date и $end_date надо перекодировать в правильный формат даты. ГУГЛИ.



        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://www.eventbriteapi.com/v3/events/search/?token=OSUKWVGNBKZJWDBWKBIC', [
            'location.address'=>$location,
            'start_date.range_start'=>$start_date,
            'start_date.range_end'=>$end_date,
            // todo: move token in .env
            //                'token'=>'OSUKWVGNBKZJWDBWKBIC',
            //разберись с верификацией ssl
            'verify' => false,
        ]);
//            echo $response->getStatusCode();
//            echo "\n";
        // 200
//            echo $response->getHeaderLine('content-type');
//            echo "\n";
        // 'application/json; charset=utf8'
        $body = $response->getBody();







        $evenz = json_decode($body);


        $arr=[];
        foreach ($evenz->events as $event){
            array_push($arr, $event);


            //    echo $event->name->text . '<br/>';
            //    var_dump($event) . '<br/><br/><br/><br/><br/>';

        }
        //   var_dump($arr) . '<br/><br/><br/><br/><br/>';
//            var_dump($json=json_encode($arr));
//            $evenz->events[0];

//            var_dump($arr);
//            $json = json_encode($arr[0]);
        $json = json_encode($arr);



        // {"type":"User"...'
        // в body json строка.
//            $evenz = json_decode($body);
//            //            var_dump($evenz);
//            foreach ($evenz->events as $event){
//
//                echo $event->name->text . '<br/>';
//            }
        // $evenz->events[0]

//            return $body;

//            response()->json($json);
        return $json;
//        }

    }
*/


    public function index(Request $request){

        $a="hello world";
        echo $a;



//        $articles  = Article::all();
//
//        return response()->json($articles);

    }

    public function getArticle($id){

        $article  = Article::find($id);

        return response()->json($article);
    }

    public function saveArticle(Request $request){

        $article = Article::create($request->all());
/*        try{
            @$article->save();
        } catch (\Exeption $e){
            return response()->json(['save'=> false, 'error'=>$e->getMessage()]);
        }

*/
        return response()->json($article);

    }

    public function deleteArticle($id){
        $article  = Article::find($id);

        $article->delete();

        return response()->json('success');
    }

    public function updateArticle(Request $request,$id){
        $article  = Article::find($id);

        $article->title = $request->input('title');
        $article->content = $request->input('content');

        $article->save();

        return response()->json($article);
    }

}
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 27.05.2016
 * Time: 11:05
 */