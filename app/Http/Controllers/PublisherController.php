<?php

namespace App\Http\Controllers;

use App\Publisher;
use Illuminate\Http\Request;

/**
 * Class PublisherController
 *
 * @package App\Http\Controllers
 */
class PublisherController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::all();

        return view('publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
            'title' => 'required|min:3',
            'url'    =>  'required|url',
            ]
        );

        Publisher::create(
            [
                'title' => $request->title,
                'url'   => $request->url
            ]
        );

        return redirect(route('all_publishers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function edit(Publisher $publisher)
    {
        return view('publishers.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        $this->validate(
            $request,
            [
                'title' => 'required|min:3',
                'url'    =>  'required|url',
            ]
        );

        $publisher->title = $request->title;
        $publisher->url = $request->url;
        $publisher->save();

        return redirect(route('all_publishers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();

        return redirect(route('all_publishers'));
    }
}
