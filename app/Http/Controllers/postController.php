<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;
use App\Category;
use App\User;
use Validator;
use Redirect;
use App\faqs;
use Illuminate\Validation\Rule;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = DB::table('posts as p')
        ->join('categories as c','c.id','p.categoryId')
        ->join('users as u','u.id','p.adminId')
        ->select('u.name as admin','p.*','c.name as genre')
        ->where('p.isActive',1)
        ->get();
        return view('Post.index',compact('post'));
    }

    public function postResp($id)
    {
		$adminId = json_encode($id);
        $post = json_encode(DB::table('posts as p')
        ->join('categories as c','c.id','p.categoryId')
        ->join('users as u','u.id','p.adminId')
        ->select('u.name as admin','p.*','c.name as genre','u.gender as gender')
		->where('p.adminId',$id)->where('p.isActive',1)
        ->get());
        return response($post,200)
        ->header("Access-Control-Allow-Origin", "*")
        ->header('Content-Type', 'application/json');
    }
	
	
	public function postGenre($id)
    {
		$adminId = json_encode($id);
        $post = json_encode(DB::table('posts as p')
        ->join('categories as c','c.id','p.categoryId')
        ->join('users as u','u.id','p.adminId')
        ->select('u.name as admin','p.*','c.name as genre','u.gender as gender')
		->where('p.categoryId',$id)->where('p.isActive',1)
        ->get());
        return response($post,200)
        ->header("Access-Control-Allow-Origin", "*")
        ->header('Content-Type', 'application/json');
    }
	
	public function postTuts()
    {
        $post = json_encode(DB::table('posts as p')
        ->join('categories as c','c.id','p.categoryId')
        ->select('p.*','c.name as genre')
		->where('c.name','Tutorials')->where('p.isActive',1)
        ->get());
        return response($post,200)
        ->header("Access-Control-Allow-Origin", "*")
        ->header('Content-Type', 'application/json');
    }
	
	public function faqs()
    {
        $post = json_encode(faqs::where('isActive',1)->get());
        return response($post,200)
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
        $admin = User::where('isActive',1)->get();
        $genre = Category::where('isActive',1)->get();
        return view('Post.create',compact('admin','genre'));
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
            'title' => 'required|string|max:255|unique:posts',
            'adminId' => 'required',
            'categoryId' => 'required',
            'created_at' => 'required',
            'description' => 'required'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'title' => 'Title',
            'adminId' => 'Admin',
            'categoryId' => 'Genre',
            'created_at' => 'Publish Date',
            'description' => 'Post Description'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else{
            $file = $request->file('image');
            $pic = "";
            if($file == '' || $file == null){
                $pic = "img/grey-pattern.png";
            }else{
                $date = date("Ymdhis");
                $extension = $request->file('image')->getClientOriginalExtension();
                $pic = "img/".$date.'.'.$extension;
                $request->file('image')->move("img",$pic);    
                // $request->file('photo')->move(public_path("/uploads"), $newfilename);
            }
            $created = explode('/',$request->created_at); // MM[0] DD[1] YYYY[2] 
            $finalCreated = "$created[2]-$created[0]-$created[1]";
                Post::create([
                    'title' => $request->title,
                    'adminId' => $request->adminId,
                    'categoryId' => $request->categoryId,
                    'description' => $request->description,
                    'created_at' => $finalCreated,
                    'image' => $pic
                ]);
               
                return redirect('/post')->withSuccess('Successfully inserted into the database.');
            
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = User::where('isActive',1)->get();
        $genre = Category::where('isActive',1)->get();
        $post = Post::find($id);
        return view('Post.update',compact('post','admin','genre'));
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
            'title' => ['required','string','max:255',Rule::unique('posts')->ignore($id)],
            'adminId' => 'required',
            'categoryId' => 'required',
            'created_at' => 'required',
            'description' => 'required'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'title' => 'Title',
            'adminId' => 'Admin',
            'categoryId' => 'Genre',
            'created_at' => 'Publish Date',
            'description' => 'Post Description'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else{
            $file = $request->file('image');
            $pic = "";
            if($file == '' || $file == null){
                $pic = "img/grey-pattern.png";
            }else{
                $date = date("Ymdhis");
                $extension = $request->file('image')->getClientOriginalExtension();
                $pic = "img/".$date.'.'.$extension;
                $request->file('image')->move("img",$pic);    
                // $request->file('photo')->move(public_path("/uploads"), $newfilename);
            }
            $created = explode('/',$request->created_at); // MM[0] DD[1] YYYY[2] 
            $finalCreated = "$created[2]-$created[0]-$created[1]";
                Post::find($id)->update([
                    'title' => $request->title,
                    'adminId' => $request->adminId,
                    'categoryId' => $request->categoryId,
                    'description' => $request->description,
                    'created_at' => $finalCreated,
                    'image' => $pic
                ]);
               
                return redirect('/post')->withSuccess('Successfully updated into the database.');
            
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
        Post::find($id)->update(['isActive' => 0]);
        return redirect('/post');
    }

    public function soft()
    {
        $post = DB::table('posts as p')
        ->join('categories as c','c.id','p.categoryId')
        ->join('users as u','u.id','p.adminId')
        ->select('u.name as admin','p.*','c.name as genre')
        ->where('p.isActive',0)
        ->get();
        return view('Post.soft',compact('post'));
    }

    public function reactivate($id)
    {
        Post::find($id)->update(['isActive' => 1]);
        return redirect('/post');
    }
}
