<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shop = Shop::all();
        $user = User::all();
        return view('shop.index', compact('shop', 'user'));
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
            'shop_name' => 'required|max:128|string|min:5',
            'shop_desc' => 'required',
            'shop_category' => 'required',
            'opening_day' => 'required|array',
            'holiday' => 'required|string',
            'opening_time' => 'required|date_format:H:i',
            'shop_pic' => 'required|mimes:jpeg, jpg, png, svg',
        ]);
        if($validation->fails())
        {
            return back()->withErrors($validation)->withInput();
        }
        
       

        if($request->hasFile('shop_pic'))
        {
            $folder = 'public/images/shop'; //membuat folder penyimpanan
            $image = $request->file('shop_pic'); //mengambil data dari request profile_pic
            $img_name = $image->getClientOriginalName(); //untuk memberikan nama pada file
            $path = $request->file('shop_pic')->storeAs($folder, $img_name); //mengirim gambar ke folder
            $data['shop_pic'] = $img_name; //memberikan nama yang dikirim ke database
        };

         // input untuk hari
         $day = implode(',', $request->input('opening_day'));
         $input['opening_day'] = $day;
        
        Shop::create($input);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Shop::find($id);
        return view('shop.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
