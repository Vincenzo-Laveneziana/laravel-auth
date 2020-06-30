<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Mail\NewPost;
use App\Mail\UpdatePost;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{   

    //Admin User


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->orderBy('created_at', 'asc')->paginate(5);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules());

        $data = $request->all();    

        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['title'], '-');

        //set image
        if (!empty($data['path_img'])) {
            $data['path_img'] = Storage::disk('public')->put('images', $data['path_img']);
        }

        $newPost = new Post();
        $newPost->fill($data);
        $saved = $newPost->save();

        if ($saved) {

            Mail::to('laveneziana.vincenzo@gmail.com')->send(new NewPost($newPost));
            return redirect()->route('admin.posts.show', $newPost->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate($this->validationRules());

        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');

        if (!empty($data['path_img'])) {
            
            //delete img
            if (!empty($post->path_img)) {
                Storage::disk('public')->delete($post->path_img);
            }

            //remplace img
            $data['path_img'] = Storage::disk('public')->put('images', $data['path_img']);
        }

        $updated = $post->update($data);

        if ($updated){
            Mail::to('laveneziana.vincenzo@gmail.com')->send(new UpdatePost($post));
            return redirect()->route('admin.posts.show', $post->id);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (empty($post)) {
            abort('404');
        }

        $title = $post->title;
        $deleted = $post->delete();

        if ($deleted) {

            //delet image
            if (!empty($post->path_img)) {
                Storage::disk('public')->delete($post->path_img);
            }

            return redirect()->route('admin.posts.index')->with('post-deleted', $title);
        }
    }

    /* 
    Validaton rules
    */

    private function validationRules(){
        return [
            'title' => 'required',
            'body' => 'required',
            'path_img' => 'image',
        ];
    }
}
