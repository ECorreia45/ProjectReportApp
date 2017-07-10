<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;

class routingController extends Controller
{

    public function home(){
        $page = 'home';
        return view('home', compact('page'));
    }

    public function signup(){
        $page = 'Sign Up';
        $log = session('log');
        if($log == 1 && session('username')){
            return redirect('dashboard/profile');
        }else{
            return view('home', compact('page'));
        }
    }

    public function login(){
        $page = 'Login';
        $log = session('log');
        if($log == 1 && session('username')){
            return redirect('dashboard/profile');
        }else{
            return view('home', compact('page'));
        }

    }

    public function logout(){
        // get current session
        $username = session('username');
        // set the current userlog to 2
        DB::table('users')->where('username',$username)->update(['log'=>2]);
        session()->flush();
        return redirect('login');
    }

    public function formValidation(Request $request){

        if($request->has('login')){

            if($request->has('rememberusername')){
                session(['username' => $request->username]);
            }

            $validator = Validator::make($request->all(), [
                'username'  =>  'required|min:8|alpha|exists:users,username',
                'pass'      =>  'required|min:8|exists:users,pass'
            ]);
            if ($validator->fails()) {
                return redirect('login')
                    ->withErrors($validator)
                    ->withInput();
            }else{
                DB::table('users')->where('username',$request->username)->update(['log'=>1]);
                session(['username' => $request->username]);
                session(['log' => 1]);
                return redirect('dashboard/profile');
            }

        }elseif($request->has('create')){
            $validator = Validator::make($request->all(), [
                'project_name'  =>  'required|min:3|max:28',
                'project_type'  =>  'required|min:3',
                'due'           =>  'required|date_format:Y-n-j',
                'client_name'   =>  'required|min:8|max:45',
                'client_email'  =>  'required|email',
                'brief'         =>  'required|min:120',
                'contract'      =>  'required|file|mimes:docm,docx,pdf,pages,doc',
                'image'         =>  'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect('/dashboard/create')
                    ->withErrors($validator)
                    ->withInput();
            }else{

                $ext1 = $request->image->extension();
                $image = $request->image->storeAs('/', $request->project_name."_".$request->project_type."_image.".$ext1, 'public');
                $ext2= $request->contract->extension();
                $contract = $request->contract->storeAs('/', $request->project_name."_contract.".$ext2, 'public');
                return $this->createProject($request, $image, $contract);
            }
        }elseif($request->has('progress')){
            $validator = Validator::make($request->all(), [
                'title'     =>  'required|min:5|max:45|unique:timeline,title',
                'file'      =>  'required|file|image|mimes:jpeg,png,jpg,svg|max:2048',
                'detail'    =>  'required|min:20'
            ]);

            if ($validator->fails()) {
                return redirect('dashboard/projects/'.$request->progress)
                    ->withErrors($validator, 'progress')
                    ->withInput();
            }else{
                $ext = $request->file->extension();
                $image = $request->file->storeAs('/', $request->title."_progress.".$ext, 'public');
                return $this->addProgress($request, $image);
            }

        }elseif($request->has('feedback')){
            $validator = Validator::make($request->all(), [
                'response'     =>  'required|min:20'
            ]);

            if ($validator->fails()) {
                return redirect('dashboard/projects/'.$request->feedback)
                    ->withErrors($validator, 'feedback')
                    ->withInput();
            }else{
                return $this->addFeedback($request);
            }

        }elseif ($request->has('editprofile')){
            $validator = Validator::make($request->all(), [
                'logo'      =>  'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                'fname'     =>  'required|min:3|max:28',
                'lname'     =>  'required|min:3|max:28',
                'cname'     =>  'required|min:3|max:28',
                'site'      =>  'required|url',
                'email'     =>  'required|email',
                'about'     =>  'required|min:20',
                'facebook'  =>  'required|url',
                'twitter'   =>  'required|url',
                'instagram' =>  'required|url',
            ]);

            if ($validator->fails()) {
                return redirect('dashboard/profile/edit')
                    ->withErrors($validator)
                    ->withInput();
            }else{
                $username = session('username');
                $userid = DB::table('users')->where('username', $username)->value('userid');
                $ext = $request->logo->extension();
                $image = $request->logo->storeAs('/', "storage/".$username."_logo.".$ext, 'public');
                return $this->updateUser($request, $image, $userid);
            }
        }else{

            $validator = Validator::make($request->all(), [
                'email'                     =>  'required|email',
                'firstname'                 =>  'required|min:3|max:45|alpha',
                'lastname'                  =>  'required|min:3|max:45|alpha',
                'username'                  =>  'required|min:8|max:45|unique:users,username',
                'password'                  =>  'required|min:8',
                'password_verification'     =>  'required|min:8|same:password',
                'logo'                      =>  'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect('signup')
                    ->withErrors($validator)
                    ->withInput();
            }else{
                $ext = $request->logo->extension();
                $image = $request->logo->storeAs('/', "storage/".$request->username."_logo.".$ext, 'public');
                return $this->createUser($request, $image);
            }

        }
    }

    public function dashboard(){
        $username = session('username');
        $log = session('log');

        if($log == 1 && $username){
            $page= Route::getFacadeRoot()->current()->uri();
            $user = DB::table('users')->where('username', $username)->get();
            if($page == "dashboard/profile"){
                return view('dashboard', ['page'=>$page, 'user'=>$user]);
            }elseif($page == "dashboard/profile/edit"){
                return view('dashboard', ['page'=>$page]);
            }elseif($page == "dashboard/projects"){
                //get every projects associated with this user
                $projects = DB::select('select * from project where userid = (select userid from users where username = ?)',[$username]);
                return view('dashboard', ['page'=>$page, 'user'=>$user, 'projects'=>$projects]);

            }elseif($page == "dashboard/projects/{project_name}") {
                //get a single project from this user
                $userid = DB::table('users')->where('username', session('username'))->value('userid');
                $project = DB::table('project')->where([
                    ['userid','=',$userid],
                    ['projectname','=',Route::current()->getParameter('project_name')]
                ])->get();
                $timeline = DB::table('timeline')->where('userid',$userid)->get();
                $feedback = DB::table('feedback')->where('userid',$userid)->get();
                return view('dashboard', [
                    'page' => $page,
                    'user' => $user,
                    'project' => $project,
                    'timeline' => $timeline,
                    'feedback' => $feedback
                ]);
            }else{
                return view('dashboard', ['page'=>$page]);
            }
        }else{
            return redirect('login');
        }
    }

    public function createUser($request, $p){
        $creation = Carbon::now();
        DB::table('users')->insert([
            'username'=> $request->username,
            'email'=> $request->email,
            'pass'=> $request->password,
            'firstname'=> $request->firstname,
            'lastname'=> $request->lastname,
            'statusid'=> 1,
            'photo'=> $p,
            'creationdate'=> $creation
        ]);
        DB::table('users')->where('username',$request->username)->get();
        return redirect('/dashboard/profile');
    }

    public function updateUser($r, $i, $u){
        DB::table('users')
            ->where('userid',$u)
            ->update([
                'firstname'=>$r->fname,
                'lastname'=>$r->lname,
                'companyname'=>$r->cname,
                'photo'=>$i,
                'site'=>$r->site,
                'facebook'=>$r->facebook,
                'instagram'=>$r->instagram,
                'twitter'=>$r->twitter,
                'about'=>$r->about,
                'email'=>$r->email,
            ]);
        return redirect('/dashboard/profile');
    }

    public function createProject($request, $i, $c){
        $userid = DB::table('users')->where('username', session('username'))->value('userid');
        $creation = Carbon::now();
        DB::table('client')->insert([
            'statusid'=>1,
            'email'=>$request->client_email,
            'name'=>$request->client_name,
            'creationdate'=>$creation,
            'userid'=>$userid
        ]);
        $clientid = DB::table('client')->where('userid', $userid)->value('clientid');
        DB::table('project')->insert([
            'userid'=> $userid,
            'clientid'=> $clientid,
            'statusid'=> 1,
            'projectname'=> $request->project_name,
            'type'=> $request->project_type,
            'brief'=> $request->brief,
            'contract'=> $c,
            'duedate'=> $request->due,
            'image'=> $i,
            'creationdate'=> $creation
        ]);
        return redirect('/dashboard/projects');
    }

    public function addProgress($request, $f){
        $userid = DB::table('users')->where('username', session('username'))->value('userid');
        $creation = Carbon::now();
        DB::table('timeline')->insert([
            'userid'=> $userid,
            'title'=> $request->title,
            'detail'=> $request->detail,
            'file'=> $f,
            'creationdate'=> $creation,
        ]);
        return redirect('dashboard/projects');
    }

    public function addFeedback($request){
        $userid = DB::table('users')->where('username', session('username'))->value('userid');
        $timelineid = DB::table('timeline')->where([
            ['title', $request->title],
            ['userid', $userid]
        ])->value('timelineid');
        $clientid = DB::table('client')->where('userid', $userid)->value('clientid');
        $creation = Carbon::now();
        DB::table('feedback')->insert([
            'timelineid'=> $timelineid,
            'from'=> $clientid,
            'feedback'=> $request->response,
            'date'=> $creation,
        ]);
        return redirect('dashboard/projects');
    }

    public function delete(){
        $username = session('username');
        $userid = DB::table('users')->where('username', $username)->value('userid');
        DB::table('users')->where('userid',$userid)->delete();
        DB::table('project')->where('userid',$userid)->delete();
        DB::table('timeline')->where('userid',$userid)->delete();
        DB::table('client')->where('userid',$userid)->delete();
        session()->flush();
        return redirect('/');
    }
}
