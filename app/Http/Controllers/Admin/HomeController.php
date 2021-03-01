<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HostingPlan;
use App\Models\OrderItems;
use App\Models\Feature;
use App\Mail\Reminder;
use App\Models\User;
use App\Models\Slider;
use Carbon\Carbon;
use Mail;
use DB;


class HomeController extends Controller
{
 
    public function __construct(){

        $this->middleware('auth');
    }



    public function index(){

    	$dates = [];
    	
		$today  = Carbon::now();
    	$from = Carbon::now()->startOfWeek(Carbon::MONDAY)->addWeeks(-1);
		$to   = Carbon::now()->startOfWeek(Carbon::MONDAY)->addWeeks(-1)->addDays(6);
    	
    	$revenue           = $this->revenue();
		$weeklyReport     = $this->getWeekly($from, $to);
    	$totalSpace        = $this->getBeingUsingSpace($today);
    	$totalUsers        = User::where('user_role',"!=",'1')->count();
    	$recentlyNewUsers  = $this->recentlyNewUsers();

        return view('admin.home',compact('revenue','weeklyReport','totalUsers','totalSpace','recentlyNewUsers'));
    }


    public function recentlyNewUsers(){
    	
    	$all = OrderItems::where('status','completed')->orderBy('id', 'desc')->paginate(8);
    	foreach ($all as $key => $value) {
    		$value->user = User::where('id',$value->user_id)->first();
    	}
    	return $all;
    }



    public function revenue(){

    	return  OrderItems::where('status','completed')->sum('total_price');
    }



    public function getBeingUsingSpace($today=null){

    	return OrderItems::leftjoin('hosting_plans','hosting_plans.id','=','order_items.hosting_plan_id')->where('expired_at',"<=",$today)->sum('hosting_plans.storage');
    }



    public function getWeekly($from=null, $to=null){

    	$allDates = array();
    	$dates    = array();

    	$chartDatas = OrderItems::select([

		    DB::raw('DATE(created_at) AS date'),
		    DB::raw('COUNT(id) AS count'),

 		])->whereBetween('created_at', [$from, $to])->groupBy('date')->orderBy('date', 'ASC')->get()->toArray();

 		foreach ($chartDatas as $i => $dates) {

			$allDates[$dates['date']] =  $dates['count'];
		}

		$dates = $this->createRange($from, $to);

		return $allDates;

    }
	
	function createRange($startDate=null, $endDate=null) {

	    $outArray = array();
	    do {
	        $outArray[] = $startDate->format('Y-m-d');
	    }while($startDate->modify('+1 day') <= $endDate);

	    return $outArray;
	}

}

