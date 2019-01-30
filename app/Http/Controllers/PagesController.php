<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class PagesController extends Controller
{
    public function index(){
        $title = 'Index';
        return view('pages.home')->with('title', $title);
    }
    public function pass(){
        
        $Id = Auth::id();
        return view('pages.posts')->with('id', $Id);
    }
    public function services(){
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        return view('pages.services')->with($data);
    }
    
}
