<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ProjectTranslateController extends Controller
{
    public function setUpClient()
    {
       $apiKey = "0xf8eImlPH953YY2TZs_Pkrz25lwSobYP_24BmImVyVN";
       $apiUrl = "https://api.eu-gb.language-translator.watson.cloud.ibm.com/instances/72078851-f2fb-4836-843f-c5eedb48f316";
       return $credentials = ['apiKey'=>$apiKey, 'apiUrl'=>$apiUrl];
    }

    public function translate()
    {
        $credentials = $this->setUpClient();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $credentials['apiUrl'].'/v3/translate?version=2018-05-01');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"text": ["Language Translator translates text from one language to another"], "model_id":"en-hi"}');
        curl_setopt($ch, CURLOPT_USERPWD, 'apikey' . ':' . $credentials['apiKey']);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch); dd($result);
    }

    public function translateUrl()
    {
        $credentials = $this->setUpClient();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $credentials['apiUrl'].'/v3/translate?version=2018-05-01');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $post = array(
            'file' => 'https://technodeviser.com/',
            'source' => 'en',
            'target' => 'hi'
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_USERPWD, 'apikey' . ':' . $credentials['apiKey']);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);dd($result);
    }
}
