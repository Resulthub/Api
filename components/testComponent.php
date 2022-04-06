<?php

namespace app\components;

use http\Exception;
use Yii;
use yii\base\Component;
use \GuzzleHttp\Client;
use app\modules\mda\models\ApiTokenModel;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use yii\web\NotFoundHttpException;


class TestComponent extends Component
{
    public function getComments()
    {

        try {

//            $accessToken = Yii::$app->test->getAccessToken();
            $headers = ['Accept' => 'application/json'];

            return $request =   $this->getNewClient()->get(Yii::$app->params["test"]["comments"]);
//            return json_decode($request->getBody()->getContents());


        } catch (ConnectException $e) {
            // Connection exceptions are not caught by RequestException
            Yii::error("Internet, DNS, or other connection error\n" . $e->getMessage());
        }
        catch (RequestException $e) {

            Yii::error("error while fetching MonthlyRequest" . $e->getMessage());
        }


    }

    public function verifyTest()
    {

        $client = new Client;
        $response = $client->get(
            "https://jsonplaceholder.typicode.com/comments" ,       [
                'verify'  =>false,
                'headers' => [
                    "Accept" => 'application/json'
                ],

            ]
        );

        return json_decode($response->getBody()->getContents());
    }


}



?>