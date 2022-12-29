<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pages;
use Illuminate\Support\Str;

class Pagescontroller extends Controller
{
 
    public function index(){

        $pages = pages::all();
        return view('admin.pages.index', compact('pages'));
    }


    public function create(){

     return view('admin.pages.create');

}


public function store(Request $request){


    $request->validate([
        'titlw' => 'required',
        'slug'      => 'required',
        'body'=>'required',
        ]);

    $pages = pages::create([

        'title' => $request->title,
        'body'  => $request->body,
        'slug'  => str::slug($request->slug),

    ]);

    if($pages){

        request()->session()->flash('success','Page Created Succesfully !');
    }
    else{

        request()->session()->flash('error','Error creating page !');
    }



    return redirect()->route('admin.pages.index');
}

public function edit($id){

    $pages = pages::findorfail($id);
    return view('admin.pages.edit',compact('pages'));

}


public function update(Request $request,$id){

 $pages = pages::findorfail($id);

 $pages->title = $request->title;
 $pages->body  = $request->body;
 $pages->slug = Str::slug($request->slug);

 $pages->save();
 return redirect()->route('admin.pages.index')
        ->with('success','Page Has Been updated successfully');   

}
public function destroy($id){

    $pages_destroy = pages::destroy($id);

    return redirect()->route('admin.pages.index')->with('success','Courses Has Been updated successfully');

}

public function display(){

    $pages = pages::select('body')->where('slug','about-us')->get();

    return view ('front.about',compact('pages'));
}
public function refund(){

    $pages = pages::select('body')->where('slug','refund-policy')->get();

    return view ('front.refundpolicy',compact('pages'));
}

public function contact(){

    $pages = pages::select('body')->where('slug','contact-us')->get();

    return view ('front.contact',compact('pages'));
}
public function industry(){

    $pages = pages::select('body')->where('slug','industry')->get();

    return view ('front.industry',compact('pages'));
}
public function research(){

    $pages = pages::select('body')->where('slug','research')->get();

    return view ('front.research',compact('pages'));
}
public function academics(){

    $pages = pages::select('body')->where('slug','academic')->get();

    return view ('front.academic',compact('pages'));
}

public function viewpage(string $pages_slug){


    $page = pages::select('body','title')->where('slug',$pages_slug)->first();

    return view ('front.page.view',compact('page'));

}


}