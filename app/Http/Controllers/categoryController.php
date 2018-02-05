<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
use Validator;
use Redirect;
use Carbon\Carbon as Carbon;
use Illuminate\Validation\Rule;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Category::where('isActive',1)->get();
        return view('Category.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryResp()
    {
        $items = json_encode(Category::where('isActive',1)->get());
        return response($items,200)
        ->header("Access-Control-Allow-Origin", "*")
        ->header('Content-Type', 'application/json');
    }


    public function create()
    {
        return view('Category.create');
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
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|max:255'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Name',
            'description' => 'Description'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else{
                Category::create([
                    'name' => $request->name,
                    'description' => $request->description
                ]);        
                return redirect('/category')->withSuccess('Successfully inserted into the database.');
            
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
        $post = Category::find($id);
        return view('Category.update',compact('post'));
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
            'name' => ['required','string','max:255',Rule::unique('categories')->ignore($id)],
            'description' => 'nullable|max:255'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Name',
            'description' => 'Description'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else{
                Category::find($id)->update([
                    'name' => $request->name,
                    'description' => $request->description
                ]);        
                return redirect('/category')->withSuccess('Successfully updated into the database.');
            
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
        Category::find($id)->update(['isActive' => 0]);
        return redirect('/category');
    }

    public function soft()
    {
        $post = Category::where('isActive',0)->get(); 
        return view('Category.soft',compact('post'));
    }

    public function reactivate($id)
    {
        Category::find($id)->update(['isActive' => 1]);
        return redirect('/category');
    }
}
