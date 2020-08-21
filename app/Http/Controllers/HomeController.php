<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Common;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use Auth;
use App;
use Session;
use Route;
use App\Models\Currency;
use App\Models\PropertyType;
use App\Models\Page;
use App\Models\Settings;
use App\Models\StartingCities;
use App\Models\Banners;
use App\Models\language;
use App\Models\Admin;
use App\Models\Properties;
use App\Models\TopDestination;
use Twilio\Rest\Client;

require base_path() . '/vendor/autoload.php';

class HomeController extends Controller
{
    private $helper;
    
    public function __construct()
    {
        $this->helper = new Common;
    }
     
    public function index()
    {
        $data['starting_cities']     = StartingCities::where('status', 'Active')->get();
        $data['top_destinations']     = TopDestination::where('status', 'Active')->get();
        $data['propertyType']     = PropertyType::where('status', 'Active')->get();
        $data['city_count']          = StartingCities::where('status', 'Active')->get()->count();
        $data['banners']             = Banners::where('status', 'Active')->get();
        $data['featuredProperties']  = Properties::where('featured', '1')->take(8)->get();
        $sessionLanguage             = Session::get('language');
        $language                    = Settings::where(['name'=>'default_language','type'=>'general'])->first();
        
        $languageDetails             = language::where(['id'=>$language->value])->first();
        if (!(@$sessionLanguage)) {
            Session::pull('language');
            Session::put('language', $languageDetails->short_name);
            App::setLocale($languageDetails->short_name);
        }
        $pref = Settings::where('type', 'preferences')->get();
        if (!empty($pref)) {
            foreach ($pref as $value) {
                $prefer[$value->name] = $value->value;
            }
            Session::put($prefer);
        }
        //dd($data['propertyType']);
        return view('home.home', $data);
    }
    
    public function phpinfo()
    {
        echo phpinfo();
    }

    public function login()
    {
        return view('home.login');
    }
   
    public function setSession(Request $request)
    {
        if ($request->currency) {
            Session::put('currency', $request->currency);
            $symbol = Currency::code_to_symbol($request->currency);
            Session::put('symbol', $symbol);
        } elseif ($request->language) {
            Session::put('language', $request->language);
            App::setLocale($request->language);
        }
    }

    public function cancellation_policies()
    {
        return view('home.cancellation_policies');
    }
 
    public function staticPages(Request $request)
    {
        $pages          = Page::where(['url'=>$request->name, 'status'=>'Active']);
        if (!$pages->count()) {
            abort('404');
        }
        $pages           = $pages->first();
        $data['content'] = str_replace(['SITE_NAME', 'SITE_URL'], [SITE_NAME, url('/')], $pages->content);
        $data['title']   = $pages->url;

        return view('home.static_pages', $data);
    }
}
