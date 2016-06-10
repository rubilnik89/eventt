<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    public function eventsList(Request $request)
    {

        $token = env("TOKEN");

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
                'token'=>$token,],
            'verify' => false,
            ]);

        $body = $response->getBody();
        $evenz = json_decode($body);

        foreach ($evenz->events as $event){

            $event->phone_number='555-55-55';
            $event->rating=rand(1,5);
        }

        $result = json_encode($evenz);
        //return $result;
        return $body;
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function seatgeek(Request $request)
    {

        $client_secret  = env("client_secret");
        $client_id      = env("client_id");

        $city           = $request->query('city');
        $startDate      = $request->query('startDate');//YYYY-MM-DDTHH:MM:SS
        $endDate        = $request->query('endDate');
        $within         = $request->query('within');
        $category       = $request->query('category');
        $longitude      = $request->query('longitude');
        $latitude       = $request->query('latitude');
        $page_number    = $request->query('page_number');


        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.seatgeek.com/2/events', [
            'query'=>[
                //          'per_page'      =>сколько на странице будет событий
                //          'q'              =>поиск по ключевому слову
    // https://api.seatgeek.com/2/taxonomies узнать категории
    // https://api.seatgeek.com/2/events?client_secret=ff_sFMj8WmsbV2TNab70sS0ewk8eoP5oej5KL4_M&client_id=NDkyNzU3OHwxNDY1NDcxMjQ0
                'taxonomies.id'     => $category,
                'datetime_utc.gt'   => $startDate,
                'datetime_utc.lt'   => $endDate,
                'venue.city'        => $city,
                'page'              => $page_number,
                'range'             => $within,//range работает с миляти добавлять к числу вконце напр 30mi
                'lat'               => $latitude,
                'lon'               => $longitude,
                'client_secret'     => $client_secret,
                'client_id'         => $client_id,],
            'verify' => false,

        ]);

        $body = $response->getBody();
        $evenz = json_decode($body);

    //        foreach ($evenz->events as $event){
    //
    //            $event->phone_number='555-55-55';
    //            $event->rating=rand(1,5);
    //
    //        }

        $result = json_encode($evenz);
        //var_dump($evenz);
        //return $result;
        return $body;

    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}



/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 27.05.2016
 * Time: 11:05
 */