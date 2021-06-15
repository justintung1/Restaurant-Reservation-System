<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Validator;
use Log;
use Illuminate\Support\Facades\DB;
use Hash;


class ManageController extends Controller{

    public function manage(){
        return view('manage');
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
        $input=request()->all();
        $collection=collect($input);
        $ac=$collection->get('account');
        $pw=$collection->get('pwd');
        $verify=$collection->get('check');
        $value="";

        if(session('verify')!=$verify){
			$val = "驗證碼錯誤";
            return redirect()->back()->with('val',$val);
		}
        else{
            $users = DB::select('select kn from manage where account = ? and password = ?',[$ac,$pw]);
            // $dump = DB::select('select * from user where account = ? and password = ?',[$ac,$pw]);
            if($users){
                // $date=date('Y-m-d');
                // $del=DB::table('order_f')->where('date','<',$date)->delete();
                // $name = collect($dump);
                session()->put('manage_ac',$ac);
                return redirect('/manage/userinfo')->with('message','success');
            }
            else{
                session()->forget('account');	// session clear
                if($ac==""||$pw==""){
                    $value = "no";
                    $value2 = "帳號或密碼不得為空";
                    return redirect()->back()->with('value',$value)->with('value2',$value2);
                }
                else{
                    $value = "no";
                    return redirect()->back()->with('value',$value);
                }
            } 
        }
    }
    public function logout(){
        session()->forget('manage_ac');
        // session()->forget('name');
        return redirect('/manage');
    }

    public function userinfo(){
        if(session('manage_ac')){
            $dump=DB::select('select * from user');
            $collection=collect($dump);
            $bind=['DATA'=>$collection];
            return view('userinfo',$bind);
        }
        else{
            return redirect('/manage')->with('message','wrongdirect');
        }
    }
    public function userinfo_add(){
        if(session('manage_ac')){
            return view('userinfo_add');
        }
        else{
            return redirect('/manage')->with('message','wrongdirect');
        }
    }
    public function userinfo_add2(){
        $input=request()->all();
        $collection=collect($input);
        $ac=$collection->get('account');
        $pw=$collection->get('pwd');
        $name=$collection->get('name');
        $mobile=$collection->get('mobile');
        $dump=DB::select('select * from user');
        foreach($dump as $check){
            if($check->account==$ac || $check->phone==$mobile){
                return redirect('/manage/userinfo_add')->with('message','wrong');
            }
        }
        $add=DB::insert('replace into user (account, password, name, phone) values(?,?,?,?)',[$ac,$pw,$name,$mobile]);
        if($add){
            return redirect('/manage/userinfo_add')->with('message','successful');
        }
        else{
            return redirect('/manage/userinfo_add')->with('message','fail');
        }
    }
    public function userinfo_edit($kn){
        if(session('manage_ac')){
            $dump=DB::select('select * from user where kn = ?',[$kn]);
            $collection=collect($dump);
            $bind=['DATA'=>$collection];
            return view('userinfo_edit',$bind);
        }
        else{
            return redirect('/manage')->with('message','wrongdirect');
        }
    }
    public function userinfo_update(){
        $input=request()->all();
        $collection=collect($input);
        $ac=$collection->get('account');
        $pw=$collection->get('pwd');
        $name=$collection->get('name');
        $mobile=$collection->get('mobile');
        $kn=$collection->get('kn');

        $update=DB::table('user')->where('kn',$kn)->update(['account'=>$ac,'password'=>$pw,'name'=>$name,'phone'=>$mobile]);
        if($update){
            return redirect('/manage/userinfo')->with('message','successful');
        }
        else{
            return redirect('/manage/userinfo')->with('message','fail');
        }
    }
    public function userinfo_del($kn){
        if(session('manage_ac')){
            $del=DB::table('user')->where('kn',$kn)->delete();
            if($del){
                return redirect('/manage/userinfo')->with('message','del');
            }
            else{
                return redirect('/manage/userinfo')->with('message','del2');
            }
        }
        else{
            return redirect('/manage')->with('message','wrongdirect');
        }
    }
    public function orderinfo_add(){
        if(session('manage_ac')){
            return view('orderinfo_add');
        }
        else{
            return redirect('/manage')->with('message','wrongdirect');
        }
    }
    public function orderinfo_add2(){
        $input=request()->all();
        $collection=collect($input);
        $mobile=$collection->get('mobile');
        $number=$collection->get('number');
        $orderid=$collection->get('orderid');
        $date=$collection->get('date');
        $time=$collection->get('time');

        $dump=DB::select('select phone from user');
        foreach($dump as $check){
            if($check->phone==$mobile){
                $add=DB::insert('replace into order_f (mobile, number, orderid, date, time) values(?,?,?,?,?)',[$mobile,$number,$orderid,$date,$time]);
                if($add){
                    return redirect('/manage/orderinfo_add')->with('message','successful');
                }
                else{
                    return redirect('/manage/orderinfo_add')->with('message','fail');
                }
            }
        }
        return redirect('/manage/orderinfo_add')->with('message','wrong');
    }
    public function orderinfo(){
        if(session('manage_ac')){
            $dump=DB::select('select * from order_f');
            $collection=collect($dump);
            $bind=['DATA'=>$collection];
            return view('orderinfo',$bind);
        }
        else{
            return redirect('/manage')->with('message','wrongdirect');
        }
    }

    public function orderinfo_edit($kn){
        if(session('manage_ac')){
            $dump=DB::select('select * from order_f where kn = ?',[$kn]);
            $collection=collect($dump);
            $bind=['DATA'=>$collection];
            return view('orderinfo_edit',$bind);
        }
        else{
            return redirect('/manage')->with('message','wrongdirect');
        }
    }
    public function orderinfo_update(){
        $input=request()->all();
        $collection=collect($input);
        $mobile=$collection->get('mobile');
        $number=$collection->get('number');
        $orderid=$collection->get('orderid');
        $date=$collection->get('date');
        $time=$collection->get('time');
        $kn=$collection->get('kn');

        $update=DB::table('order_f')->where('kn',$kn)->update(['mobile'=>$mobile,'number'=>$number,'orderid'=>$orderid,'date'=>$date,'time'=>$time]);
        if($update){
            return redirect('/manage/orderinfo')->with('message','successful');
        }
        else{
            return redirect('/manage/orderinfo')->with('message','fail');
        }
    }
    public function orderinfo_del($kn){
        if(session('manage_ac')){
            $del=DB::table('order_f')->where('kn',$kn)->delete();
            if($del){
                return redirect('/manage/orderinfo')->with('message','del');
            }
            else{
                return redirect('/manage/orderinfo')->with('message','del2');
            }
        }
        else{
            return redirect('/manage')->with('message','wrongdirect');
        }
    }
    
    public function chatinfo(){
        if(session('manage_ac')){
            $dump=DB::select('select * from message');
            $collection=collect($dump);
            $bind=['DATA'=>$collection];
            return view('chatinfo',$bind);
        }
        else{
            return redirect('/manage')->with('message','wrongdirect');
        }
    }
    public function chatinfo_edit($kn){
        if(session('manage_ac')){
            $dump=DB::select('select * from message where kn = ?',[$kn]);
            $collection=collect($dump);
            $bind=['DATA'=>$collection];
            return view('chatinfo_edit',$bind);
        }
        else{
            return redirect('/manage')->with('message','wrongdirect');
        }
    }
    public function chatinfo_update(){
        $input=request()->all();
        $collection=collect($input);
        $name=$collection->get('name');
        $mestime=$collection->get('mestime');
        $text=$collection->get('text');
        $kn=$collection->get('kn');

        $update=DB::table('message')->where('kn',$kn)->update(['name'=>$name,'date'=>$mestime,'texting'=>$text]);
        if($update){
            return redirect('/manage/chatinfo')->with('message','successful');
        }
        else{
            return redirect('/manage/chatinfo')->with('message','fail');
        }
    }
    public function chatinfo_add(){
        if(session('manage_ac')){
            return view('chatinfo_add');
        }
        else{
            return redirect('/manage')->with('message','wrongdirect');
        }
    }
    public function chatinfo_add2(){
        $input=request()->all();
        $collection=collect($input);
        $name=$collection->get('name');
        $mestime=$collection->get('mestime');
        $text=$collection->get('text');

        $check=DB::select('select name from user');
        foreach($check as $ch){
            if($ch->name==$name){
                $add=DB::insert('replace into message (name,date,texting) values(?,?,?)',[$name,$mestime,$text]);
                if($add){
                    return redirect('/manage/chatinfo_add')->with('message','successful');
                }
                else{
                    return redirect('/manage/chatinfo_add')->with('message','fail');
                }
            }
        }
        return redirect('/manage/chatinfo')->with('message','nosamename');
    }
    public function chatinfo_del($kn){
        if(session('manage_ac')){
            $del=DB::table('message')->where('kn',$kn)->delete();
            if($del){
                return redirect('/manage/chatinfo')->with('message','del');
            }
            else{
                return redirect('/manage/chatinfo')->with('message','del2');
            }
        }
        else{
            return redirect('/manage/chatinfo')->with('message','wrongdirect');
        }
    }

}


?>