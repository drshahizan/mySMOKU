<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Stroage;
use App\Models\Product;

class PageController extends Controller
{
    public function uploadpage()
    {
        
        return view('product');
 
    }
 
      public function store(Request $request)
    {
 
            $data=new product();
        
          
                 $file=$request->file;
                 
                $filename=time().'.'.$file->getClientOriginalExtension();
 
                 $request->file->move('assets',$filename);
 
                 $data->file=$filename;
 
 
                 $data->name=$request->name;
                 $data->description=$request->description;
 
                 $data->save();
                 return redirect()->back();
 
 
 
    }
 
 
    public function show()
    {
 
        $data=product::all();
        return view('showproduct',compact('data'));
    }
 
 
       public function download(Request $request,$file)
    {
 
        
 return response()->download(public_path('assets/'.$file));
    }
 
 
 
    public function view($id)
    {
        $data=Product::find($id);
 
        return view('viewproduct',compact('data'));
 
 
    }
 
 
 
    
}
