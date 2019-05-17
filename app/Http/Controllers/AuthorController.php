<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthorController
 *
 * @package App\Http\Controllers
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
        $this->middleware('auth');
        $this->helpers = new Helpers();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = User::where('is_author', true)->paginate(10);

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

        $user = User::create(
            [
                'name'  => $request->name,
                'email' =>  $request->email,
                'password'  =>  Hash::make($request->password),
                'is_author' => true
            ]
        );

        $this->helpers->logRecorder($user);


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
            return back()
                ->with('access_denied', 'Sorry, but you haven\'t permissions to edit user');
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
        if (auth()->user()->is_author) {
            return back()
                ->with('access_denied', 'Sorry, but you haven\'t permissions to edit user');
        }

        $this->validate(
            $request,
            [
                'name' => 'required|min:3',
            ]
        );
        $user = User::find($id);
        $user->name = $request->name;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;

        $user->save();
        $this->helpers->logRecorder($user);

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
            $this->helpers->logRecorder($user);
            $user->delete();
        }
        return redirect(route('all_authors'));
    }
}
