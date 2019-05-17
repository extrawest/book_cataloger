<?php

namespace App\Http\Controllers\Api;

use App\Helpers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class AuthorController
 *
 * @package App\Http\Controllers\Api
 */
class AuthorController extends Controller
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
        $authors = User::where('is_author', true)->get();

        return response()->json($authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->json()->all(),
            [
                'name' => 'required|min:3',
                'email' =>  'required|unique:users',
                'password' =>   'required|confirmed|min:6'
            ]
        );

        if ($validator->fails()) {
               return response()->json($validator->errors());
        }

        $author = User::create(
            [
                    'name'  => $request->name,
                    'email' =>  $request->email,
                    'password'  =>  Hash::make($request->password),
                    'is_author' => true
            ]
        );

        $this->helpers->logRecorder($author);

        return response()->json($author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->json()->all(),
            [
                'name' => 'required|min:3'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $author = User::find($id);
        $author->name = $request->name;
        $author->password = $request->password ? Hash::make($request->password) : $author->password;
        $author->save();
        $this->helpers->logRecorder($author);
        return response()->json($author);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = User::find($id);

        if ($author == null) {
            return response()->json(['message' => "This user doesn't exist"]);
        }
        $this->helpers->logRecorder($author);
        $author->delete();

        return response()->json(['message' => 'User was deleted successfully']);
    }
}
