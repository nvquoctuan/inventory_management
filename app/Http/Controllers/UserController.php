<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Gate;
use App\User;

class UserController extends Controller
{
    public function index(User $user){
        $current_user = $this->currentUser();
        if (Gate::forUser($current_user)->allows('admin-user')) {
            $users = DB::table('users')->get();
            $role = $this->role();
            return view('admin.user.index', ['users' => $users, 'role' => $role]);
        }
        else{
            return redirect('dashboard')->with(['msg' => "You not permission", 'type' => "danger"]);
        }
    }

    public function show($id){
        $user = DB::table('users')->find($id);
        if(is_null($user)) return redirect()->route('dashboard');

    	return view('admin.user.show', ['user' => $user]);
    }

    public function update(EditUserRequest $request, $id){
        $user = DB::table('users')->find($id);
        $current_user = $this->currentUser();

        if(is_null($user)) return back();
        if(Gate::forUser($current_user)->denies('edit-user', $user)) return back();

        DB::table('users')->where('id', $id)->update(['name' => $request->name]);
        return redirect("user/{$id}")->with(['message' => 'update success', 'type' => 'success']);        
    }

    public function updateRole(Request $request, $id){
        $user = DB::table('users')->find($id);
        if(is_null($user)) return response()->json(["msg" => "Update failed!", "type" => "failed"]);

        DB::table('users')->where('id', $id)->update(['role' => $request->role]);
        return response()->json(["msg" => "Update success!", "type" => "success"]);
    }

    public function destroy($id){
        $user = DB::table('users')->find($id);
        if(is_null($user)) return redirect("/user")->with(["msg" => "Delete failed", "type" => "alert"]);
        if(Gate::forUser($current_user)->denies('admin-user')) return back();

        DB::table('users')->where("id", $id)->delete();
        return redirect("/user")->with(['msg' => 'Delete succes', "type" => "success"]);
    }

    private function role(){
        return [["id" => 0, "name" => "Admin"], ["id" => 1, "name" => "Manage"], ["id" => 2, "name" => "User"]];
    }

    private function currentUser(){
        return DB::table('users')->find(session('user'));
    }
}
