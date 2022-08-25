<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Courses;
use Hash;
class ScreeningController extends Controller
{
    //
    public function index()
    {
    //$data['categories'] = Category::orderBy('id','desc')->paginate(5)
    $id = Auth::user()->id;
    $user = User::findOrFail($id);   
    $course = Courses::all();          
    return view('admin\screening.index',compact('user','course'));
    }
}
