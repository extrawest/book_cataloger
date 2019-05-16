<?php

namespace App\Http\Controllers\Api;

use App\Helpers;
use App\Publisher;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * Class PublisherController
 *
 * @package App\Http\Controllers\Api
 */
class PublisherController extends Controller
{
    protected $helpers;
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->helpers = new Helpers();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::all();

        return response()->json($publishers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->json()->all(),
            [
            'title' => 'required|min:3',
            'url' =>   'required|url'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $publisher = Publisher::create(
            [
                'title' => $request->title,
                'url'   => $request->url
            ]
        );
        $this->helpers->logRecorder($publisher);

        return response()->json($publisher);
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
        $validator = Validator::make(
            $request->json()->all(),
            [
                'title' => 'required|min:3',
                'url' =>   'required|url'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $publisher = Publisher::find($id);
        $publisher->title = $request->title;
        $publisher->url = $request->url;
        $publisher->save();
        $this->helpers->logRecorder($publisher);
        return response()->json($publisher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publisher = Publisher::find($id);
        if ($publisher == null) {
            return response()->json(['message' => "This publisher doesn't exist"]);
        }

        $this->helpers->logRecorder($publisher);
        $publisher->delete();

        return response()->json(['message' => 'Publisher was deleted successfully']);
    }
}
