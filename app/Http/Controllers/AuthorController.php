<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;

/**
 * Class AuthorController
 *
 * @package App\Http\Controllers
 */
class AuthorController extends Controller
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
        $authors = User::where('is_author', true)->get();

        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:3',
                'email' =>  'required|unique:users',
                'password' =>   'required|confirmed|min:6'
            ]
        );

        User::create(
            [
                'name'  => $request->name,
                'email' =>  $request->email,
                'password'  =>  $request->password,
                'is_author' => true
            ]
        );

        return redirect(route('all_authors'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = User::find($id);
        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->is_author) {
            return back()->with('access_denied', 'Sorry, but you haven\'t permissions to edit user');
        }

        $user = User::find($id);
        return view('authors.edit', compact('user'));
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
        $this->validate(
            $request,
            [
                'name' => 'required|min:3',
                'password' =>   'required|confirmed|min:6'
            ]
        );
        $user = User::find($id);
        $user->name = $request->name;
        $user->password = $request->password;
        $user->save();

        return redirect(route('all_authors'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!auth()->user()->is_author && auth()->user()->id != $id) {
            $user->delete();
        }
        return redirect(route('all_authors'))->with('access_denied', 'Sorry, but you haven\'t permissions to delete user');
    }
}
