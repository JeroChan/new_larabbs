<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\User;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request, Topic $topic, User $user, Link $link)
    {
        $topics = $topic->withOrder($request->order)
            ->where('category_id', $category->id)
            ->paginate(20);
        $active_users = $user->getActiveUsers();
        $links = $links = $link->getAllCached();

        return view('topics.index', compact('topics', 'category', 'active_users', 'links'));
    }
}
