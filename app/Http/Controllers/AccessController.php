<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('support.agentcontrol', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
       // return view('access', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $user = User::findOrFail($user['id']);

        $this->validate($request, [
            'access_level' => 'required|in:Admin',
        ]);

        $user->access_level = $request->access_level;
        $user->save();

    return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function updateAccessLevel(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->access_level = $request->access_level;
        $user->save();

        return redirect()->back();
    }
    public function accessLevel(Request $request)
    {
        $users = null;

        if($request->has('name')) {
            $name = $request->input('name');
            $users = User::where('name', 'like', "%$name%")->get();
        }

        return view('access', ['users' => $users]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');

        $users = User::where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->get();

        return view('support.agentcontrol', ['users' => $users]);
    }
}
