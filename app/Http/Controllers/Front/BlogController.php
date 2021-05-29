<?php  
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Model\Blog;
use App\Model\BlogComment;
use App\Model\BlogCommentReply;
use App\Model\Tag;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use App\Services\Notification;
class BlogController extends Controller
{

    public function index(){
        $tag=null;
        if(request()->tag){
            $tag=Tag::whereName(request()->tag)->first();
            $blogs=$tag->blogs;
        }
        else{
            $blogs=Blog::where('show',1)->orderBy('created_at','desc')->with('tags')->with('comments')->get();
        }
        
        return view('front.blog.index',compact('blogs','tag'));
    }
    public function show($slug){
        $blog=Blog::whereSlug($slug)->with('tags','comments.replies.user','comments.user')->firstOrFail();
        $blog->update([
            "click"=>$blog->click+1
        ]);
        $latestBlogs=Blog::orderBy('id','desc')->take(5)->get();
        $popularBlogs=Blog::orderBy('click','desc')->take(5)->get();
        $tags=Tag::all()->sortByDesc('blogCount'); 
        return view('front.blog.show',compact('blog','latestBlogs','popularBlogs','tags'));
    }

    public function comment(Request $request,Blog $blog){
        $comment=$blog->comments()->create([
            "user_id"=>auth()->user()->id,
            "text"=>$request->text
        ]);
       
        Notification::adminBlogComment($comment->id);
        return redirect()->back()->with('success',LanguageService::getTranslate('CommentAdded'));
    }
    public function commentReply(Request $request,BlogComment $blogComment){
        $reply=$blogComment->replies()->create([
            "user_id"=>auth()->user()->id,
            "text"=>$request->text
        ]);
        Notification::adminBlogCommentReply($reply->id);
        return redirect()->back()->with('success',LanguageService::getTranslate('ReplyAdded'));
    }

}