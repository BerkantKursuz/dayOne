<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;

class adminController extends Controller
{
    public function loginPage(){
        if(Session::has('loginKey')) {
            return redirect()->route('panel');
        }
        return view('login');

    }

    public function adminPanel(){
    if(Session::has('loginKey')!=1){
        return redirect()->route('login');
        }else{
        $userName = Session::get('loginKey');
        return view('panel', compact('userName'));
        }
    }
    public function sesExit(){
        Session::flush();
        return redirect()->route('login');
    }
    public function adminLogin(Request $req){
        $userName = trim($req->username);
        $password = trim($req->password);

        $data = [];
        $sorgu = Admin::where('username', $userName);
        if($sorgu->exists()){
            $admin = $sorgu->first();

            if($password != $admin->password){
                $data['durum'] = 0;
                $data['mesaj'] = 'Şifreniz yanlış.';
            }else {
                $data['durum'] = 1;
                $data['mesaj'] = 'Kullanıcı adı ve şifre doğru';
                Session::put('loginKey', $userName);
                return redirect()->route('panel');
            }
        }else{
            $data['durum'] = 0;
            $data['mesaj'] = 'Kullanıcı bulunamadı.';
        }
        return view('login',$data);
    }
}


