<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $data = $request->all();
        $validation = Validator::make($data,[
            'phone_num' => 'required|max:15',
            'birth_day' => 'required|date',
            'gender' => 'required',
            'profile_pic' => 'required|mimes:png,jpg,jpeg,heic',


        ]);
        
        if($validation->fails())
        {
            return back()->withErrors($validation)->withInput();
        };

        if($request->hasFile('profile_pic'))
        {
            $folder = 'public/images/profile'; //membuat folder penyimpanan
            $image = $request->file('profile_pic'); //mengambil data dari request profile_pic
            $img_name = $image->getClientOriginalName(); //untuk memberikan nama pada file
            $path = $request->file('profile_pic')->storeAs($folder, $img_name); //mengirim gambar ke folder
            $data['profile_pic'] = $img_name; //memberikan nama yang dikirim ke database
        };

        Profile::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
