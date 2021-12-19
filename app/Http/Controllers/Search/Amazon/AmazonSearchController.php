<?php

namespace App\Http\Controllers\Search\Amazon;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AmazonSearchController extends Controller
{
    public function __construct()
    {
        $this->ApiKey="5C01557F15184D6DB8234870E00FF03B";
        $this->ApiUrl="https://api.rainforestapi.com/request";
    }

    public function SearchByTerm(Request $request)
    {
        $data=array();
        $client=new Client();
# set up the request parameters
        $queryString = http_build_query([
            'api_key' => '5C01557F15184D6DB8234870E00FF03B',
            'type' => 'search',
            'amazon_domain' => 'amazon.com',
            'search_term' => 'opc',
            'output' => 'json'
        ]);

# make the http GET request to Rainforest API
        $ch = curl_init(sprintf('%s?%s', 'https://api.rainforestapi.com/request', $queryString));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $api_result = curl_exec($ch);
        curl_close($ch);

# print the JSON response from Rainforest API
        dd( json_decode($api_result, true));
        $res=$client->request("Get","https://api.rainforestapi.com/request?api_key=5C01557F15184D6DB8234870E00FF03B&type=search&amazon_domain=amazon.com&search_term=opc&output=json");
        dd(json_decode($res));
        try {
            if(isset($request->amazonUrl))
                $data['amazonUrl']=$request->amazonUrl;
            if(isset($request->categoryId))
                $data['categoryId']=$request->categoryId;
            $data['searchTerm']=$request->searchTerm;
        //    $this->makeApiquery($data);

            return response()->json($res,200);
        }
        catch (\Exception $e)
        {
            return response(["msg"=>$e],500);
        }

    }

    private function getamazonurl()
    {
        return "amazon.de";
    }
    private function makeApiquery($data)
    {
        $this->ApiUrl.="?api_key=".$this->ApiKey;
        $this->ApiUrl.="&type=search";
        $this->ApiUrl.="&amazon_domain=".$data['amazonUrl'];
        $this->ApiUrl.="&search_term=".$data['searchTerm'];
        $this->ApiUrl.="&output=json";
        dd($this->ApiUrl);

    }
}
