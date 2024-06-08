<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input,[
            'name' => 'required|max:128|string',
            'level' => 'required',
            'email' => 'required|email|max:100',
            'password' => 'required|min:8|max:30'
        ]);
        if($validation->fails())
        {
            return back()->withErrors($validation)->withInput();
        }
        // $input['password'] = bcrypt();

        User::create($input)->with('success', 'Data succsessfully added');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('user.detail',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $data = $request->all();

        $validation = Validator::make($data,[
            'name' => 'required|max:128|string',
            'level' => 'required',
            'email' => 'required|email|max:100',
            'password' => 'required|min:8|max:30'
        ]);
        if($validation->fails())
        {
            return back()->withErrors($validation)->withInput();
        }

        if($request->input('password')){
            $data['password'] = bcrypt($data['password']);
            
            // jika tanpa bcrypt
            $data['password'] = $data['password'];
        }else{
            $data = Arr::except($data, ['password']);
        }
        $user->update($data);
        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = user::find($id);
        $data->delete();
        return back();
    }
}
