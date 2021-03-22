<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Checklist;
use App\User;

class AdminController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct()
    {
        $this->middleware(['role:admin|super-admin']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $user = User::find(Auth::id());

        $roles = $user->getRoleNames();

        return view('adminpanel', compact('roles'));
    }

    public function showUserslist()
    {
        $users = User::role(['user', 'blocked'])->get();

        return view('userslist', compact('users'));
    }

    public function showAdminslist()
    {
        $admins = User::role('admin')->get();

        return view('adminslist', compact('admins'));
    }

    public function allChecklists()
    {
        $checklists = Checklist::all();

        return view('allchecklists', compact('checklists'));
    }

    public function showTasks($checklist_id)
    {
        $tasks = Checklist::find($checklist_id)->tasks;

        return view('usertasks', compact('checklist_id', 'tasks'));
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::find($id);

        $user->max_checklist = $request->max_checklist;
        $user->save();

        return back();
    }

    public function roleUpdate(Request $request, $id)
    {
        $user = User::find($id);

        foreach ($user->getRoleNames() as $role) {
            $user->removeRole($role);
        }
        $user->assignRole($request->role);

        return back();
    }

    public function permissionUpdate(Request $request, $id)
    {
        $admin = User::find($id);

        if ($admin->hasPermissionTo($request->permission)) {

            $admin->revokePermissionTo($request->permission);
        } else {

          $admin->givePermissionTo($request->permission);
        }

        return back();
    }
}
