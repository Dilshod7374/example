<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Http\Requests\StorePostRequest;
use App\Jobs\ChangePost;
use App\Jobs\UploadBigFile;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Notifications\PostCreated as NotificationsPostCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }

    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(9);;
        // $posts = Post::latest()->get();

        return view('posts.index', compact('posts'));
    }


    public function create()
    {
        return view('posts.create')->with([
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }


    public function store(StorePostRequest $request)
    {
        $requestData = $request->all();

        if ($request->hasFile('photo'))
        {
            $file = $request->file('photo');
            $imageName =$file->getClientOriginalName();
            $file->move('images/', $imageName);
            $requestData['photo'] = $imageName;
        }
            $post = Post::create([
                'user_id' => auth()->user()->id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'short_content' => $request->short_content,
                'content' => $request->content,
                'photo' => $imageName ?? null,
            ]);

            if(isset($request->tags)){
            foreach ($request->tags as $tag)
                {
                    $post->tags()->attach($tag);
                }
            }
        PostCreated::dispatch($post);

        ChangePost::dispatch($post);

        Notification::send(auth()->user(), new NotificationsPostCreated($post));

        return redirect()->route('posts.index');
    }


    public function show($id)
    {
        $posts = Post::find($id);
        $recent_posts = Post::latest()->get()->except($posts->id)->take(5);
        $category = Category::all();
        $tags = Tag::all();
        return view('posts.show', compact('posts','recent_posts','category','tags'));
    }
    public function edit(Post $post)
    {
        if (! Gate::allows('update-post', $post)) {
            abort(403);
        }

        return view('posts.edit')->with(['post' => $post]);
    }

    public function update(StorePostRequest $request, $id)
    {

        $requestData = $request->all();

        if ($request->hasFile('photo'))
        {

            $posts = Post::find($id);

            if (isset($posts->photo) and file_exists(public_path('/images/'.$posts->photo))) {
                unlink(public_path('/images/' . $posts->photo));

                $file = $request->file('photo');
                $imageName = time().'-'.$file->getClientOriginalName();
                $file->move('images/', $imageName);
                $requestData['photo'] = $imageName;
            }

        }

        Post::find($id)->update($requestData);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        if (isset($post->photo) and file_exists(public_path('/images/' . $post->photo))) {
            unlink(public_path('images/' . $post->photo));
        }
        return redirect()->route('posts.index');
    }
}
