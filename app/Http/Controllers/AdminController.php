<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('admin');
    }

    /**
     * Show the dashboard-page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $users = User::where('role', '!=', 'admin')
                     ->orderBy('created_at', 'desc')
                     ->get();

        // Ajax response
        if ($request->ajax()) {
            return response()->json([
                'table' => view("admin.admin-standard", ['users' => $users])->render(),
            ]);
        }                      

        return view('admin.index', ['users' => $users]);
    }

    /**
     * Delete item from the dashboard-page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();

        //return $this->index($request);
    } 

    /**
     * Store a newly created user in storage.
     *
     * @param  \App\Http\Requests\CartRequest $request
     * @return \Illuminate\Http\Response
     */      
    public function store(Request $request)
    {
       //...
    }  

    /**
     * Edit-view for selected user.
     *
     * @param  ...
     * @return \Illuminate\Http\Response
     */      
    public function show(User $user)
    {
       //...
    }  

    /**
     * Update selected user in storage.
     *
     * @param  \App\Http\Requests\CartRequest $request
     * @return \Illuminate\Http\Response
     */      
    public function update(Request $request, User $user)
    {
       //...
    }      
}
