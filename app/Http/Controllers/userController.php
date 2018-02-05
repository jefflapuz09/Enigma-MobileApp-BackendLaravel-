<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Validator;
use Redirect;
use Carbon\Carbon as Carbon;
use Illuminate\Validation\Rule;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = User::where('isActive',1)->get();
        
        return view('User.index',compact('post'));
    }

    public function userResp()
    {
        $items = User::all()->toJson();
        return response($items,200)
        ->header("Access-Control-Allow-Origin", "*")
        ->header('Content-Type', 'application/json');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'gender' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Name',
            'email' => 'Email Address',
            'password' => 'Password',
            'gender' => 'Gender'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else{
            $cpass = $request->password_confirmation;
            $pass = $request->password;
            if($cpass == $pass)
            {
              
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'password' => bcrypt($request->password),
                    'description' => $request->description,
                    'role' => 1,
                ]);
               
                return redirect('/user')->withSuccess('Successfully inserted into the database.');
            }
            else
            {
                return Redirect::back()->withErrors($validator);
            }
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = User::find($id);
        return view('User.update',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'gender' => 'required',
            'email' => ['required','string','email','max:255',Rule::unique('users')->ignore($id)],
            'password' => 'required|string|min:6|confirmed',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Name',
            'email' => 'Email Address',
            'password' => 'Password',
            'gender' => 'Gender'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else{
            $cpass = $request->password_confirmation;
            $pass = $request->password;
            if($cpass == $pass)
            {
              
                User::find($id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'password' => bcrypt($request->password),
                    'description' => $request->description,
                    'role' => 1,
                ]);
               
                return redirect('/user')->withSuccess('Successfully inserted into the database.');
            }
            else
            {
                return Redirect::back()->withErrors($validator);
            }
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->update(['isActive' => 0]);
        return redirect('/user');
    }

    public function soft()
    {
        $post = User::where('isActive',0)->get(); 
        return view('User.soft',compact('post'));
    }

    public function reactivate($id)
    {
        User::find($id)->update(['isActive' => 1]);
        return redirect('/user');
    }
}
