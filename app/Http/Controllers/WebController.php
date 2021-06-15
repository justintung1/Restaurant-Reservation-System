<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Validator;	//驗證器
use Log;
use Illuminate\Support\Facades\DB;


class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //$bind = ['title'];
        //return view('index',$bind);
        session()->forget('orderid');
        session()->forget('phone');
        $dump=DB::select('select * from message');
        $collection=collect($dump);
        $bind=['DATA'=>$collection];
        return view('index',$bind);
    }
    public function verifycode(){
        header('Content-type:image/PNG');
		$width=60;
		$height=25;
		$my_image=imagecreatetruecolor($width,$height);
		imagefill($my_image,0,0,0xFFFFFF);
		$x=rand(1,10);
		$y=rand(1,10);
		$rand_string="";
		$arr=array("1","2","3","4","5","6","7","8","9","0","a","b","c","d","e","f","g","h","i","j",
				"k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F",
				"G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
		for($i=1;$i<=5;$i++){
			$t=rand(0,61);
			$rand_string.=$arr[$t];
		}
		//$rand_string=rand(1000,9999);
		imagestring($my_image,5,$x,$y,$rand_string,0x000000);
		
		//session_start();
		session()->put('verify',$rand_string);
		session()->put('num',0);
		//$_SESSION['verify']=$rand_string;
		//$_SESSION['num']=0;
		imagepng($my_image);
		imagedestroy($my_image);
    }
    public function login(){
        header('Content-type:text/html;charset=utf-8');
        $input = request()->all();
        $collection = collect($input);
        $ac = $collection -> get('account');
	    $pw = $collection -> get('password');
        $catch = $collection -> get('check');
        $value = "";

        if(session('verify')!=$catch){
			$val = "驗證碼錯誤";
			// return redirect('/index')->with('val',$val);
            return redirect()->back()->with('val',$val);
		}
        else{
            $users = DB::select('select kn from user where account = ? and password = ?',[$ac,$pw]);
            $dump = DB::select('select * from user where account = ? and password = ?',[$ac,$pw]);
            // $phone = DB::select('select phone from user where account = ? and password = ?',[$ac,$pw]);
            // $phone = DB::table('user')->where('account','=',$ac,'and','password','=',$pw)->value('phone')->get();
            if($users){
                $date=date('Y-m-d');
                $del=DB::table('order_f')->where('date','<',$date)->delete();
                $name = collect($dump);
                // $name3 = $name2 -> get('name');
                // foreach($name2 as $name3){
                //     session()->put('name',$name3);
                // }
                // foreach($name as $name2){
                //     
                // }
                // foreach($phone as $ph){
                //     $phone2 = $ph->phone;
                // }
                // session()->put('mobile' ,$phone2);
                session()->put('name',$name);
                session()->put('account',$ac);
                // $bind = ['DATA' => $name];
                // return view('index', $bind);
                // return redirect('/index');
                return redirect()->back();
            }
            else{
                session()->forget('account');	// session clear
                //return redirect('/manage/logout');
                if($ac==""||$pw==""){
                    $value = "no";
                    $value2 = "帳號或密碼不得為空";
                    // return redirect('/index')->with('value',$value)->with('value2',$value2);
                    return redirect()->back()->with('value',$value)->with('value2',$value2);
                }

                else{
                    $value = "no";
                    // return redirect('/index')->with('value',$value);
                    return redirect()->back()->with('value',$value);
                }
            } 
        }
    }
    public function logout(){
        $date=date('Y-m-d');
        $del=DB::table('order_f')->where('date','<',$date)->delete();
        session()->forget('account');
        session()->forget('name');
        return redirect('/index');
    }
    public function register(){
        return view('register');
    }
    public function validating(){
        $input = request()->all();
        $collection = collect($input);
        $name = $collection -> get('name');
        $ac = $collection -> get('account');
        $pwd = $collection -> get('pwd');
        $check = $collection -> get('check');
        $mobile = $collection -> get('mobile');
        
        if($pwd==$check){
            $dump = DB::select('select account from user');
            $check = collect($dump);
            foreach($check as $ch){
                if($ch->account==$ac){
                    return redirect('/index/register')->with('message','thesame');
                }
            }
            $add = DB::insert("replace into user (account, password, name, phone) values(?,?,?,?)",[$ac,$pwd,$name,$mobile]);
            if($add){
                //$result = 'success';
                return redirect('/index')->with('message','success');
            }
            else{
                return redirect('/index/register')->with('message','fail');
            }
        }
        else{
            return redirect('/index/register')->with('message','notequal');
        }
    }
    public function book(){
        if(session('account')){
            $input = request()->all();
            $collection = collect($input);
            $date = $collection -> get('date');
            $number = $collection -> get('number');
            $mobile = $collection -> get('phone');
            $phone = DB::select('select phone from user where account = ?',[session('account')]);
            foreach($phone as $ph){
                $tel = $ph->phone;
            }
            if($tel!=$mobile){
                return redirect('/index')->with('message','notsame');
            }
            else{
                $orderid='';
                for($i=0;$i<10;$i++){
                    $range=array_merge(range('A','Z'), range('a','z'), range('0','9'));
                    $index=array_rand($range,1);
                    $orderid.=$range[$index];
                }
                $date=str_replace(['年','月'],"/",$date);
                $date=trim($date,"日");
                $add = DB::insert("replace into order_f (mobile, number, orderid, date, time) values(?,?,?,?,?)",[$mobile,$number,$orderid,$date,"12:00"]);
                if($add){
                    session()->put('date',$date);
                    session()->put('orderid',$orderid);
                    // return view('book');
                    return redirect('/index/book2');
                }
            }
        }
        else{
            return redirect('/index')->with('message','nologin');
        }
    }
    public function book2(){
        if(session('account')&&session('orderid')){
            $dump=DB::select('select * from message');
            $collection=collect($dump);
            $bind=['DATA'=>$collection];
            return view('book',$bind);
        }
        else{
            return redirect('/index')->with('message','nologin');
        }
    }
    public function cancel(){
        $orderid=session('orderid');
        $del=DB::table('order_f')->where('orderid',$orderid)->delete();
        session()->forget('orderid');
        return redirect('/index');
    }
    public function order(){
        if(session('account')&&session('orderid')){
            $input = request()->all();
            $collection = collect($input);
            $time = $collection -> get('reservationtime');
            if($time!=""){
                $orderid=session('orderid');
                $update=DB::table('order_f')->where('orderid',$orderid)->update(['time'=>$time]);
                if($update){
                    return redirect('/index/order2');
                } 
            }
            else{
                return redirect()->back()->with('message','noinfo');
            }
        }
        else{
            return redirect('/index')->with('message','nologin');
        }
    }
    public function order2(){
        if(session('orderid')&&session('account')){
            $orderid=session('orderid');
            $dump=DB::select('select * from order_f where orderid = ?',[$orderid]);
            $collection=collect($dump);
            $dump2=DB::select('select * from message');
            $collection2=collect($dump2);
            $bind=['DATA'=>$collection,'DATA2'=>$collection2];
            return view('order',$bind);
        }
        else{
            return redirect('/index')->with('wrong','Error-oriented');
        }
    }
    public function comment(){
        header('Content-type:text/html;charset=utf-8');
        if(session("account")){
            $input=request()->all();
            $collection=collect($input);
            $comment=$collection->get('chat');
            date_default_timezone_set('Asia/Taipei');
            $date=date('Y-m-d H:i:s');
            $ac=session('account');
            $dump=DB::select('select name from user where account = ?',[$ac]);
            $name=collect($dump);
            foreach($name as $n){
                $uname=$n->name;
            }
            $add=DB::insert("replace into message (name, date, texting) values(?,?,?)",[$uname,$date,$comment]);
            if($add){
                return redirect()->back()->with('message','popin');
            }
            else{
                return redirect()->back()->with('message','popfail');
            }
            // $input=request()->all();
            // $collection=collect($input);
            // $talk=$collection -> get('chat');
            // $talk = $request->chat;
            // $date=date('Y-m-d h:i:s');
            // $ac=session('account');
            // $dump=DB::select("select name from user where account = ?",[$ac]);
            // $name=collect($dump);
            // foreach($name as $n){
            //     $getn=$n->name;
            // }
            // $add=DB::insert("replace into message (name, date, texting) values(?,?,?)",[$getn,$date,$talk]);
            // if($add){
            //     echo good;
            // }
        }

    }
    public function search(){
        session()->forget('orderid');
        session()->forget('phone');
        if(session('account')){   
            $dump=DB::select('select * from message');
            $collection=collect($dump);
            $bind=['DATA2'=>$collection];
            return view('search',$bind);
        }
        else{
            return view('search');
        }
    }
    public function search2(){
        $input=request()->all();
        $collection=collect($input);
        $phone=$collection->get('phone');
        $orderid=$collection->get('orderid');
        if($phone==""&&$orderid==""){
            return redirect()->back()->with('message','nothing');
        }
        else{
            session()->put('phone',$phone);
            session()->put('orderid',$orderid);
            return redirect('/index/search3');
        }
    }
    public function search3(){
        session()->forget('pass');
        session()->forget('del');
        if(session('phone')||session('orderid')){
            $phone=session('phone');
            $orderid=session('orderid');
            if(session('account')){
                $dump2=DB::select('select * from message');
                $collection2=collect($dump2);
            }
            if($phone&&$orderid){
                $dump=DB::select('select * from order_f where mobile = ? and orderid = ?',[$phone,$orderid]);
                if($dump){
                    $collection=collect($dump);
                    if(session('account')){
                        $bind=['DATA'=>$collection,'DATA2'=>$collection2];
                        $dump3=DB::select('select phone from user where account = ?',[session('account')]);
                        foreach($dump3 as $p){
                            $ph=$p->phone;
                        }
                        session()->put('pass','pass');
                        session()->put('del',$ph);
                        // foreach($dump as $m){
                        //     $mo=$m->mobile;
                        // }
                        // if($mo==$ph){
                        //     session()->put('del','del');
                        // }
                    }
                    else{
                        $bind=['DATA'=>$collection];
                    }
                    return view('search_order',$bind);
                }
                else{
                    $dump=DB::select('select * from order_f where mobile = ?',[$phone]);
                    if($dump){
                        $collection=collect($dump);
                        if(session('account')){
                            $bind=['DATA'=>$collection,'DATA2'=>$collection2];
                            $dump3=DB::select('select phone from user where account = ?',[session('account')]);
                            foreach($dump3 as $p){
                                $ph=$p->phone;
                            }
                            session()->put('del',$ph);
                            session()->put('pass','pass');
                        }
                        else{
                            $bind=['DATA'=>$collection];
                        }
                        return view('search_order',$bind);
                    }
                    else{
                        $dump=DB::select('select * from order_f where orderid = ?',[$orderid]);
                        if($dump){
                            $collection=collect($dump);
                            if(session('account')){
                                $bind=['DATA'=>$collection,'DATA2'=>$collection2];
                                $dump3=DB::select('select phone from user where account = ?',[session('account')]);
                                foreach($dump3 as $p){
                                    $ph=$p->phone;
                                }
                                session()->put('del',$ph);
                                session()->put('pass','pass');
                            }
                            else{
                                $bind=['DATA'=>$collection];
                            }
                            return view('search_order',$bind);
                        }
                        else{
                            return redirect('/index/search')->with('message','tryagain');
                        }
                    }
                }
            }
            else if($phone){
                $dump=DB::select('select * from order_f where mobile = ?',[$phone]);
                if($dump){
                    $collection=collect($dump);
                    if(session('account')){
                        $bind=['DATA'=>$collection,'DATA2'=>$collection2];
                        $dump3=DB::select('select phone from user where account = ?',[session('account')]);
                        foreach($dump3 as $p){
                            $ph=$p->phone;
                        }
                        session()->put('del',$ph);
                        session()->put('pass','pass');
                    }
                    else{
                        $bind=['DATA'=>$collection];
                    }
                    return view('search_order',$bind);
                }
                else{
                    return redirect('/index/search')->with('message','tryagain');
                }
            }
            else if($orderid){
                $dump=DB::select('select * from order_f where orderid = ?',[$orderid]);
                if($dump){
                    $collection=collect($dump);
                    if(session('account')){
                        $bind=['DATA'=>$collection,'DATA2'=>$collection2];
                        $dump3=DB::select('select phone from user where account = ?',[session('account')]);
                        foreach($dump3 as $p){
                            $ph=$p->phone;
                        }
                        session()->put('del',$ph);
                        session()->put('pass','pass');
                    }
                    else{
                        $bind=['DATA'=>$collection];
                    }
                    return view('search_order',$bind);
                }
                else{
                    return redirect('/index/search')->with('message','tryagain');
                }
            }
        }
        else{
            return redirect('/index/search')->with('message','wrongdirect');
        }
    }
    public function del_order($kn){
        if(session('account')&&session('pass')){
            $del=DB::table('order_f')->where('kn',$kn)->delete();
            if($del){
                return redirect()->back()->with('message','delsuccess');
            }
            else{
                return redirect()->back()->with('message','delfail');
            }
        }
        else{
            return redirect('/index/search')->with('message','wrongdirect');
        }
    }
    public function edit_order($kn){
        if(session('account')&&session('pass')){
            $dump=DB::select('select * from order_f where kn = ?',[$kn]);
            $collection=collect($dump);
            $get=collect([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15])->toArray();
            $get2=collect(["11:30:00","12:00:00","12:30:00","13:00:00","17:30:00","18:00:00","18:30:00","19:00:00"])->toArray();
            $dump2=DB::select('select * from message');
            $collection2=collect($dump2);
            $bind=['DATA'=>$collection,'DATA2'=>$collection2,'NUM'=>$get,'TIME'=>$get2];
            return view('edit_order',$bind);
        }
        else{
            return redirect('/index/search')->with('message','wrongdirect');
        }
    }
    public function edit_up(){
        if(session('pass')){
            $input=request()->all();
            $collection=collect($input);
            $number=$collection->get('number');
            $date=$collection->get('date');
            $time=$collection->get('time');
            $kn=$collection->get('kn');

            $update=DB::table('order_f')->where('kn',$kn)->update(['number'=>$number,'date'=>$date,'time'=>$time]);
            if($update){
                return redirect('/index/search3')->with('message','goodup');
            }
            else{
                return redirect('/index/search3')->with('message','badup');
            }
        }
        else{
            return redirect('/index/search')->with('message','wrongdirect');
        }
    }
}

?>