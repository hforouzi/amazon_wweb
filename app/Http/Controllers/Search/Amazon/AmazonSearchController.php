<?php

namespace App\Http\Controllers\Search\Amazon;

use App\Http\Controllers\Controller;
use App\Models\Search\Amazon\AmazonSearchMeta;
use App\Models\Search\Amazon\AmazonSearchResults;
use App\Models\Search\Amazon\AmazonSearchResultsCategory;
use App\Models\Search\Amazon\AmazonSearchResultsPrice;
use GuzzleHttp\Client;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class AmazonSearchController extends Controller
{
    public function __construct()
    {
        $this->ApiKey="5C01557F15184D6DB8234870E00FF03B";
        $this->ApiUrl="https://api.rainforestapi.com/request";
    }

    public function index()
    {
        return view('search.amazon.amazonsearch');
    }

    public function SearchByTerm(Request $request)
    {
        $request->validate([
            'search_term'=>['required'],

        ]);
        $data=array();
        $response_data=$this->makeApiquery($request->amazon_domain,$request->search_term,$request->category_id,$request->sort_by);
        $metadata=$response_data['request_metadata'];
        $parameter_data=$response_data['request_parameters'];
        $searchId=$this->requestMetaStore($metadata,$parameter_data);
        $search_results=$response_data['search_results'];
//        $searchResult=array(
//            "metaid"=>$searchId,
//            [
//                "position" => 1,
//                "title" => "Isotonix OPC-3, Promotes Cardiovascular Health, Joint Health, Helps Maintain Healthy Cholesterol, Promotes Healthy Blood Vessel Dilation, Market America",
//                "asin" => "B01GXUPDE8",
//                "link" => "https://www.amazon.com/gp/slredirect/picassoRedirect.html/ref=pa_sp_atf_aps_sr_pg1_1?ie=UTF8&adId=A0097416UGU7VKRH65YF&url=%2FIsotonix-OPC-3-Promotes-Cardiovasc",
//                "categories" => array([
//                    "name" => "All Departments",
//                    "id" => "aps"]),
//                "image" => "https://m.media-amazon.com/images/I/61ojjFRtDUL._AC_UL320_.jpg",
//                "rating" => 4.7,
//                "ratings_total" => 502,
//                "sponsored" => true,
//                "prices" => array([
//                    "symbol" => "$",
//                    "value" => 76.95,
//                    "currency" => "USD",
//                    "raw" => "$76.95",
//                    "name" => "$76.95$76.95 ($0.86/Count)",
//                    "asin" => "B01GXUPDE8",
//                    "link" => "https://www.amazon.com/gp/slredirect/picassoRedirect.html/ref=pa_sp_atf_aps_sr_pg1_1?ie=UTF8&adId=A0097416UGU7VKRH65YF&url=%2FIsotonix-OPC-3-Promotes-Cardiovasc "
//                ]),
//                "price" => array([
//                    "symbol" => "$",
//                    "value" => 76.95,
//                    "currency" => "USD",
//                    "raw" => "$76.95",
//                    "name" => "$76.95$76.95 ($0.86/Count)",
//                    "asin" => "B01GXUPDE8",
//                    "link" => "https://www.amazon.com/gp/slredirect/picassoRedirect.html/ref=pa_sp_atf_aps_sr_pg1_1?ie=UTF8&adId=A0097416UGU7VKRH65YF&url=%2FIsotonix-OPC-3-Promotes-Cardiovasc "
//                ]),
//                "delivery" => array([
//                    "tagline" => "Get it Wed, Dec 29 - Tue, Jan 4",
//                    "price" => array([
//                        "raw" => "FREE Shipping",
//                        "symbol" => "$",
//                        "currency" => "USD",
//                        "value" => 0,
//                        "is_free" => true ])
//                ])],
//            [
//                "position" => 5,
//                "title" => "Terry Naturally Clinical OPC Extra Strength - 60 Softgels - French Grape Seed Extract Supplement, Supports Heart & Immune Health, Antioxidant - Non-GMO, Gluten- ▶",
//                "asin" => "B015GA52HO",
//                "link" => "https://www.amazon.com/Terry-Naturally-Clinical-Extra-Strength/dp/B015GA52HO/ref=sr_1_5?keywords=OPC&qid=1639889607&sr=8-5",
//                "categories" => array([
//                    "name" => "All Departments",
//                    "id" => "aps"]),
//                "image" => "https://m.media-amazon.com/images/I/716tEpqB-0L._AC_UL320_.jpg",
//                "amazons_choice" => array(
//                    "link" => "https://www.amazon.com/Terry-Naturally-Clinical-Extra-Strength/dp/B015GA52HO/ref=ice_ac_b_dpb?keywords=OPC&qid=1639889607&sr=8-5",
//                    "keywords" => "OPC"),
//                "is_prime" => true,
//                "rating" => 4.7,
//                "ratings_total" => 528,
//                "prices" => array([
//                    "symbol" => "$",
//                    "value" => 39.96,
//                    "currency" => "USD",
//                    "raw" => "$39.96",
//                    "name" => "$39.96$39.96 ($0.67/Count)",
//                    "asin" => "B015GA52HO",
//                    "link" => "https://www.amazon.com/Terry-Naturally-Clinical-Extra-Strength/dp/B015GA52HO/ref=sr_1_5?keywords=OPC&qid=1639889607&sr=8-5"
//                ]),
//                "price" => array(
//                    "symbol" => "$",
//                    "value" => 39.96,
//                    "currency" => "USD",
//                    "raw" => "$39.96",
//                    "name" => "$39.96$39.96 ($0.67/Count)",
//                    "asin" => "B015GA52HO",
//                    "link" => "https://www.amazon.com/Terry-Naturally-Clinical-Extra-Strength/dp/B015GA52HO/ref=sr_1_5?keywords=OPC&qid=1639889607&sr=8-5"),
//                "delivery" => array(
//                    "tagline" => "Get it as soon as Tue, Dec 21",
//                    "price" => array([
//                        "raw" => "FREE Shipping by Amazon",
//                        "symbol" => "$",
//                        "currency" => "USD",
//                        "value" => 0,
//                        "is_free" => true])
//                )
//            ],
//            [
//                "position" => 12,
//                "title" => "HumanN SuperBeets Heart Chews | Grape Seed Extract and Non-GMO Beet Powder Helps Support Healthy Circulation, Blood Pressure, and Energy, Super Beets Pomegranat ▶",
//                "asin" => "B07SRK1F3Y",
//                "link" => "https://www.amazon.com/gp/slredirect/picassoRedirect.html/ref=pa_sp_search_thematic_aps_sr_pg1_5?ie=UTF8&adId=A07310773724TAZVOMZ61&url=%2FSuperBeets-Circulatio ▶",
//                "categories" => array([ "name" => "All Departments","id" => "aps"]),
//                "image" => "https://m.media-amazon.com/images/I/61yOMLLvZ2L._AC_UL320_.jpg",
//                "bestseller" => array( "link" => "https://www.amazon.com/gp/bestsellers/hpc/3765801/ref=sr_bs_4_3765801_1",
//                    "category" => "Grape Seed Extract Herbal Supplements"),
//                "is_prime" => true,
//                "rating" => 4.5,
//                "ratings_total" => 27415,
//                "is_carousel" => true,
//                "carousel" => array(
//                    "title" => "Highly rated",
//                    "sub_title" => "Based on star rating and number of customer ratings",
//                    "sponsored" => true,
//                    "id" => "loom-desktop-inline-slot_sptw-highly-rated-na",
//                    "total_items" => 5),
//                "sponsored" => true,
//                "prices" => array([
//                    "symbol" => "$",
//                    "value" => 39.95,
//                    "currency" => "USD",
//                    "raw" => "$39.95",
//                    "name" => "$39.95$39.95 ($0.67/Count)",
//                    "asin" => "B07SRK1F3Y",
//                    "link" => "https://www.amazon.com/gp/slredirect/picassoRedirect.html/ref=pa_sp_search_thematic_aps_sr_pg1_5?ie=UTF8&adId=A07310773724TAZVOMZ61&url=%2FSuperBeets-Circulation-Pressure-Pomegranate-60-Count%2Fdp%2FB07SRK1F3Y%2Fref%3Dsxin_13_pa_sp_search_thematic_sspa%3Fcv_ct_cx%3DOPC%26keywords%3DOPC%26pd_rd_i%3DB07SRK1F3Y%26pd_rd_r%3De03f1fb6-b674-493c-b704-a8605bb8ea16%26pd_rd_w%3Dm2IQp%26pd_rd_wg%3DcY4pl%26pf_rd_p%3D4ad71b32-b810-4124-8735-d02a39478d0c%26pf_rd_r%3DBZEPBQWGZVAK8EZFC062%26qid%3D1639889607%26sr%3D1-5-a73d1c8c-2fd2-4f19-aa41-2df022bcb241-spons%26psc%3D1%26smid%3DA1PVHR5Y85DH15&qualifier=1639889607&id=7940980620747592&widgetName=sp_search_thematic"
//                ]),
//                "price" => array(
//                    "symbol" => "$",
//                    "value" => 39.95,
//                    "currency" => "USD",
//                    "raw" => "$39.95",
//                    "name" => "$39.95$39.95 ($0.67/Count)",
//                    "asin" => "B07SRK1F3Y",
//                    "link" => "https://www.amazon.com/gp/slredirect/picassoRedirect.html/ref=pa_sp_search_thematic_aps_sr_pg1_5?ie=UTF8&adId=A07310773724TAZVOMZ61&url=%2FSuperBeets-Circulation-Pressure-Pomegranate-60-Count%2Fdp%2FB07SRK1F3Y%2Fref%3Dsxin_13_pa_sp_search_thematic_sspa%3Fcv_ct_cx%3DOPC%26keywords%3DOPC%26pd_rd_i%3DB07SRK1F3Y%26pd_rd_r%3De03f1fb6-b674-493c-b704-a8605bb8ea16%26pd_rd_w%3Dm2IQp%26pd_rd_wg%3DcY4pl%26pf_rd_p%3D4ad71b32-b810-4124-8735-d02a39478d0c%26pf_rd_r%3DBZEPBQWGZVAK8EZFC062%26qid%3D1639889607%26sr%3D1-5-a73d1c8c-2fd2-4f19-aa41-2df022bcb241-spons%26psc%3D1%26smid%3DA1PVHR5Y85DH15&qualifier=1639889607&id=7940980620747592&widgetName=sp_search_thematic"
//                )]
//        );
        $res=$this->requestResultStore($search_results,$searchId);
        $table="";
        if($res)
        {
            foreach ($search_results as $key=>$item) {

                $table .= "<tr>
                                <td> <a href=' " . $item['link'] . "'>".$item['title']."</a></td>
                                <td>" . $item['asin'] . "</td>
                                <td>" . $item['categories'][0]['name'] . "</td>
                                <td> <img width='50px' height='50px' src='" . $item['image'] . "'></td>";
                if(isset($item['bestseller']))
                    $table.="<td> <a href=' " . $item['bestseller']['link'] . "'>".$item['bestseller']['category']."</a></td>";
                else
                    $table.=                                "<td>None</td>";
                if(isset($item['position']))
                    $table.="  <td>" . $item['position'] . "</td>";
                else
                    $table.="  <td>none</td>";
                if(isset($item['rating']))
                    $table.="  <td>" . $item['rating'] . "</td>";
                else
                    $table.="  <td>nine</td>";
                if(isset($item['ratings_total']))
                $table.=" <td>" . number_format($item['ratings_total']) . "</td>";
                    else
                        $table.=" <td>--</td>";

     if(isset($item['price']['value']))
                $table.=" <td>" . $item['price']['value'].$item['price']['symbol'] . "</td>";
                    else
                        $table.=" <td>--</td>";

                $table.="</tr>";
            }
        }

        return response()->json(["data"=>$table],200);


//        $search_results=$response_data['search_results'];
//        $search_results=
//        $search_results=$response_data['request_parameters'];
//        $related_searches=$response_data['related_searches'];
//        $related_brands=$response_data['related_brands'];
//        $refinements=$response_data['refinements'];
//        $video_blocks=$response_data['video_blocks'];


    }

    public function requestMetaStore($metaData,$parameterData)
    {
        if(isset($metaData) && isset($parameterData))
        {

            try {
                $id=AmazonSearchMeta::create([
                    'meta_create_date'=>$metaData['created_at'],
                    'meta_search_term'=>$parameterData['search_term'],
                ]);
                //    return response()->json(["msg"=>"meta data save","id"=>$id->id],200);
                return $id->id;
            }
            catch (\Exception $exception){
                return response(['message'=>$exception], 500);
            }

        }

    }

    public function requestResultStore($searchResult,$metaid)
    {
        if(isset($searchResult))
        {
            DB::beginTransaction();
            try {
                foreach ( $searchResult as $key=> $item) {
                    $search_id = AmazonSearchResults::create([
                        "search_result_position"=>$item['position'],
                        "search_result_title"=>$item['title'],
                        "search_result_asin"=>isset($item['asin'])?$item['asin']:"0",
                        "search_result_link"=>$item['link'],
                        "search_result_image"=>$item['image'],
                        "meta_id"=>$metaid
                    ]);
                    if (isset($search_id->id))
                    {if(isset($item["categories"])) {
                        foreach ($item["categories"] as $val) {
                            AmazonSearchResultsCategory::create([
                                "search_result_id" => $search_id->id,
                                "search_result_category_name" => $val['name'],
                                "search_result_category_amazon_id" => $val['id']
                            ]);
                        }
                    }
                        if(isset($item['prices'])) {
                            foreach ($item['prices'] as $prices) {
                                AmazonSearchResultsPrice::create([
                                    "search_result_id" => $search_id->id,
                                    "search_result_price_symbol" => $prices['symbol'],
                                    "search_result_price_value" => $prices["value"],
                                    "search_result_price_currency" => $prices["currency"],
                                    "search_result_price_raw" => $prices["raw"],
                                    "search_result_price_asin" => isset($prices['asin']) ? $prices['asin'] : "0",
                                    "search_result_price_link" => isset($prices['link']) ? $prices['link'] : "0"

                                ]);
                            }
                        }

                    }

                }

                DB::commit();
                return true;
            }
            catch (\Exception $exception)
            {
                DB::rollBack();
                return $exception;
            }

        }
    }
    private function getamazonurl()
    {
        return "amazon.de";
    }
    private function makeApiquery($amazon_domain,$search_term,$category_id,$sort)
    {
        # set up the request parameters

        $queryString = http_build_query([
            'api_key' => '5C01557F15184D6DB8234870E00FF03B',
            'type' => 'search',
            'amazon_domain' => $amazon_domain,
            'search_term' => $search_term,
            'sort_by' => $sort,
            (isset($category_id)?"category_id:=>$category_id":null)
        ]);
        # make the http GET request to Rainforest API
        $ch = curl_init(sprintf('%s?%s', 'https://api.rainforestapi.com/request', $queryString));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $api_result = curl_exec($ch);
        curl_close($ch);

# print the JSON response from Rainforest API
        return json_decode($api_result, true);

    }
}
