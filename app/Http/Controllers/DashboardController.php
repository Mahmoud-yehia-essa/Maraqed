<?php

namespace App\Http\Controllers;

use App\Models\Tomb;
use App\Models\User;
use App\Models\Block;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {


    $users = User::where('role', '!=', 'admin')->latest()->get();

    // $category = Category::latest()->get();

    $tombs = Tomb::latest()->get();

    $blocks = Block::latest()->get();

    // $games = Game::latest()->get();

    // $questions = Question::latest()->get();

    return view('admin.index',compact('users','tombs','blocks'));

    }
}
