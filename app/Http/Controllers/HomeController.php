<?php

namespace App\Http\Controllers;

use App\Models\UIBlock;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the dynamic homepage.
     */
    public function index()
    {
        $blocks = UIBlock::where('status', true)
            ->orderBy('display_order', 'asc')
            ->get();

        return view('frontend.index', compact('blocks'));
    }
}
