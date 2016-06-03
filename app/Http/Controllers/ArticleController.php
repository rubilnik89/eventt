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
        return $body;
    }
}
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 27.05.2016
 * Time: 11:05
 */