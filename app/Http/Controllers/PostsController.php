<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\XMLWriter;
use Auth;
use App\Post;
use Cookie;
class PostsController extends Controller


{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oldpass = Auth::user()->password;
        if (Cookie::get('curtpass') === null || (Cookie::get('curtpass') === false)){
            Cookie::queue('curtpass', $oldpass, 10000);
            $uid = Auth::id();
                $posts = Post::where('uid', $uid)->get();
                $pass = Auth::user()->password;
                return view('posts.index')->with('posts', $posts)->with('passes', $pass);
            }
        else {
                $cook = cookie::get('curtpass');
                if ($cook !== $oldpass){
                $uid = Auth::id();
                $post2s = Post::where('uid', $uid)->get();
                foreach ($post2s as $post)
                PostsController::passout($post);
        }
                $uid = Auth::id();
                $posts = Post::where('uid', $uid)->get();
                $pass = Auth::user()->password;
                return view('posts.index')->with('posts', $posts)->with('passes', $pass);
    
            }
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $uid = Auth::id();
        $this->validate($request, [
            'website' => 'required|active_url',
            'email' => 'required|email',
            'password' => ['required', 
               'min:6', 
               'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/'],

        ]);
        //create Post
        $post = new Post;
        $post->uid =  $uid;
        $post->website = $request->input('website');
        $post->email = $request->input('email');
        $data = $request->input('password');
        function encrypt($data){
        $key = Auth::user()->password;
        // Remove the base64 encoding from our key
        $encryption_key = base64_decode($key);
        // Generate an initialization vector
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
        // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
        return base64_encode($encrypted . '::' . $iv);
        }
        $post->password = encrypt($data);
        $post->save();

        return redirect('/posts')->with('success', 'Login created');
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
        $post = Post::find($id);
        $pass = Auth::user()->password;
        return view('posts.edit')->with('post', $post)->with('passes', $pass);
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
        $uid = Auth::id();
        $this->validate($request, [
            'website' => 'required|active_url',
            'email' => 'required|email',
            'password' => ['required', 
               'min:6', 
               'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/'],

        ]);
        //create Post
        $post = Post::find($id);
        $post->uid =  $uid;
        $post->website = $request->input('website');
        $post->email = $request->input('email');
        $data = $request->input('password');
        function encrypt($data){
            $key = Auth::user()->password;
            // Remove the base64 encoding from our key
            $encryption_key = base64_decode($key);
            // Generate an initialization vector
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
            // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
            $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
            // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
            return base64_encode($encrypted . '::' . $iv);
            }
            $post->password = encrypt($data);
        $request->input('password');
        $post->save();

        return redirect('/posts')->with('success', 'Login updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = POST::find($id);
        $post->delete();
        return redirect('/posts')->with('success', 'Login deleted');
    }

    public function search(Request $request)
    {
        $uid = Auth::id();
        $pass = Auth::user()->password;
        $q = $request->get('search');
        $posts = Post::where([['website', 'like', '%'.$q.'%'],['uid', $uid]])->orWhere([['email', 'like', '%'.$q.'%'],['uid', $uid]])->get();
        if(count($posts) >= 1)
        return view ('posts.index', ['posts' => $posts])->with('passes', $pass);
       else{
       return redirect('/posts');
       }
        
}
public function my_decrypt($oldpas, $key) {
    //$key = $passes;
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
    // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
    list($encrypted_data, $iv) = explode('::', base64_decode($oldpas), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
} 
public function encrypt($data){
    $cookie = Auth::user()->password;
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($cookie);
    // Generate an initialization vector
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
    return base64_encode($encrypted . '::' . $iv);
    }
public function passout($post){
        $post->uid;
        //$uid = Auth::id();
        $key = $cookie = cookie::get('curtpass');
        $post->website;
        $post->email;
        $oldpas = $post->password;
        $plainpas = PostsController::my_decrypt($oldpas, $key);
        $newpas = PostsController::encrypt($plainpas);
        $post->password = $newpas;
        $post->save();
        Cookie::queue(Cookie::forget('curtpass'));
        return redirect('/posts')->with('success', 'Logins updated');
}

public function exportxml(){
    $uid = Auth::id();
    $posts = Post::where('uid', $uid)->get();

    try
    {
        $xml = new XMLWriter();
        $xml->openURI('documents/mailouts/example.xml');
        $xml->startDocument('1.0');
        $xml->startElement('sales');
        foreach ($posts as $post){
            $xml->startElement('post');

            $xml->writeElement('id', $post->id);
            $xml->writeElement('uid', $post->uid);
            $xml->writeElement('website', $post->website);
            $xml->writeElement('email', $post->email);
            $xml->writeElement('password', $post->password);

            $xml->endElement();
        }
        $xml->endElement();
        $xml->endDocument();
        $xml->flush();
        return redirect('/posts')->with('success', 'Logins exported');
    }
    catch(Exception $e)
    {
        return redirect('/posts')->with('failure', 'Logins not exported');  
    }
}
}
