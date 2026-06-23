<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Comment\Entities\Comment;

class BlogCommentController extends Controller
{
    public function index(BlogPost $post)
    {
        $comments = $post->comments()
            ->where('is_approved', true)
            ->whereNull('parent_id')
            ->with(['children' => function($query) {
                $query->where('is_approved', true)->orderBy('created_at', 'asc');
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'comments' => $comments,
            'count' => $comments->count()
        ]);
    }

    public function store(Request $request, BlogPost $post)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
            'rating' => 'nullable|numeric|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Lütfen tüm alanları doğru şekilde doldurun.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $comment = Comment::create([
                'commentable_type' => BlogPost::class,
                'commentable_id' => $post->id,
                'commented_type' => null, // Guest comment
                'commented_id' => null,
                'fullname' => $request->fullname,
                'email' => $request->email,
                'comment' => $request->comment,
                'parent_id' => $request->parent_id,
                'rating' => $request->rating,
                'is_approved' => false, // Yorumlar onay bekliyor
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Yorumunuz başarıyla gönderildi. Onaylandıktan sonra yayınlanacaktır.',
                'comment' => $comment
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Yorum gönderilirken bir hata oluştu. Lütfen tekrar deneyin.'
            ], 500);
        }
    }
}
