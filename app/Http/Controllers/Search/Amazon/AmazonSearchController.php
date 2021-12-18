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
        $res=$client->request("Get","https://api.rainforestapi.com/request?api_key=5C01557F15184D6DB8234870E00FF03B&type=search&amazon_domain=amazon.de&search_term=OPC&url=d&category_id=wer&refinements=werwr&page=12&sort_by=price_low_to_high&output=json&exclude_sponsored=true&include_html=true&language=de_DE&associate_id=2323
");
        dd($res);
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
