<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
         $data =  User::paginate(10);

       return view(view: 'users.index',data: compact(var_name:'data'));
   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users',
           'password' => 'required|string|min:8',
       ]);

      try {
           User::create([
               'name' => $request->name,
               'email' => $request->email,
               'password' => bcrypt($request->password) ,
           ]);
           return redirect()->back()->with('success', 'User created successfully.');

       } catch (\Exception $e) {
           return dd($e->getMessage());
       }

    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editUser = User::findOrFail($id);
        $data =  User::paginate(10);
        return view('users.index', compact('editUser', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users',
       ]);

      
        $user = User::findOrFail($id);  
            $user ->name= $request->name;
            $user ->email= $request->email;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);  
        $user->delete();

        return redirect()->back();
    }
}
