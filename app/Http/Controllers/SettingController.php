<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'getData']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$setting = Setting::first();

        return view('home', compact('setting'));
    }

    public function create()
    {
        return view('settings.create');
    }

    public function store()
    {
        Setting::create(request()->all());

        return redirect()->route('home');
    }

    public function destroyAll()
    {
    	Setting::truncate();

    	return back();
    }

    public function getData()
    {
    	return Setting::first();
    }
}
