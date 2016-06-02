<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->response->getContent(), $this->app->version()
        );
    }
/*
    public function trtr()
    {
        $data= [
            'title'=>'meropriyatie',
            'content'=>'obo vsem',
        ];
        $this->post('api/article', $data)->seeJsonEquals(
            [
                'save' => true
            ]
        );
    }
*/
}
