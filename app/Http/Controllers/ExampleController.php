<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /*public function latLng(Request $request)
    {
        $coordinates = [
            'lat'=>123,
            'lng'=>321,
        ];
        return json_encode($coordinates);
    }

    public function action(Request $request)
    {
        $country = $request->get('country');
        if (!empty($country)) {
            return $country;
        }
//        var_dump($request);
        return <<<HTML
<form>
<input type="text" name="country"/>
<input type="submit" value="submit"/>
</form>
HTML;
    }

   /* public function search(Request $request)
    {
        $arr[] = $request->json()->all();
        return print_r($arr);
    }*/

}
