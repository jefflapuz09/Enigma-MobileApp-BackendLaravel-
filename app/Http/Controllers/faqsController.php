<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\faqs;
use Illuminate\Validation\Rule;
use DB;
use Validator;
use Redirect;

class faqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = faqs::where('isActive',1)->get();
        return view('Faqs.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */

    public function faqsResp()
    {
        $items = json_encode(faqs::where('isActive',1)->get());
        return response($items,200)
        ->header("Access-Control-Allow-Origin", "*")
        ->header('Content-Type', 'application/json');
    }

    public function create()
    {
        return view('Faqs.create');
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
            'question' => 'required|string|max:255|unique:faqs',
            'answer' => 'required|max:255'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'question' => 'Question',
            'answer' => 'Answer'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else{
                faqs::create([
                    'question' => $request->question,
                    'answer' => $request->answer
                ]);        
                return redirect('/faqs')->withSuccess('Successfully inserted into the database.');
            
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
        $post = faqs::find($id);
        return view('Faqs.update',compact('post'));
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
            'question' => ['required','string','max:255',Rule::unique('faqs')->ignore($id)],
            'answer' => 'required|max:255'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'question' => 'Question',
            'answer' => 'Answer'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else{
                faqs::find($id)->update([
                    'question' => $request->question,
                    'answer' => $request->answer
                ]);        
                return redirect('/faqs')->withSuccess('Successfully updated into the database.');
            
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
        faqs::find($id)->update(['isActive' => 0]);
        return redirect('/faqs');
    }

    public function soft()
    {
        $post = faqs::where('isActive',0)->get(); 
        return view('Faqs.soft',compact('post'));
    }

    public function reactivate($id)
    {
        faqs::find($id)->update(['isActive' => 1]);
        return redirect('/faqs');
    }
}
