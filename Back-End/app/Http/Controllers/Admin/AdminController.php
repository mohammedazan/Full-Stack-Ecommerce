<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Array_;

class AdminController extends Controller
{
    public function loginAdmin(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->intended('/home');
        }
        return redirect()->back()->with('error', 'Email or password is incorrect');

                // dd(Auth::user()->id->first() );

    }


    public function loginView()
    {
        return view('adminPanel.login');
    }

    public function logOutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect()->intended('/');
    }
    public function adminDelete(Request $request){
        Admin::where('id',$request->id)->delete();
        return redirect()->back()->with('success', 'Successfully admin deleted');

    }

    public function adminRole()
    {
        $common_data = new Array_();
        $common_data->title = 'Role creation';
        return view('adminPanel.role.create_role')->with(compact('common_data'));
    }

    public function adminStore(Request $request)
    {
        $info = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'admin_type' => $request->role_id,
        ]);
        if ($info) {
            return redirect()->back()->with('success', 'Successfully Created User');
        } else {
            return redirect()->back()->with('error', 'Internal Error');
        }
    }

    public function adminCreate() {
        $common_data = new Array_();
        $common_data->title = 'List admin';
        // Retrieve roles where status is 1
        $role = Role::where('status', 1)->get();
        // Retrieve all admins with their associated roles
        $admin = Admin::with('role')->get();
        // Pass the data to the view
        return view('adminPanel.role.create_admin', compact('common_data', 'role','admin'));
    }


    public function adminRoleStore(Request $request)
    {
        $role = new Role();
        $role->name = $request->role_name;
        $role->access_role_list = implode(",", $request->role_id);
        $role->save();
        return redirect()->back()->with('success', 'Successfully Created Role');
    }

    
    public function roleDelete(Request $request){
        // Find the role by id
        $role = Role::find($request->id);
    
        // Check if the role is linked to any admin
        if ($role->admins()->exists()) {
            // Return with error message
            return redirect()->back()->with('success', 'Cannot delete role because it is linked to an admin.');
        }
    
        // Delete the role if not linked to any admin
        $role->delete();
    
        // Return with success message
        return redirect()->back()->with('success', 'Successfully deleted role.');
    }

    public function listRole() {
        $listrole = Role::get();
        // dd($listrole);
        // access_role_list
        return view('adminPanel.role.list_roles', compact('listrole'));
    }
    
    public function listuser(){
        $listuser = User::get();
        return view('adminPanel.role.user_list', compact('listuser'));
    }

    
    // Delete the user
    public function destroy($id)
    {
        $user = User::findOrFail($id); 
        $user->delete(); 

        return redirect()->route('admin.user.list')->with('success', 'User deleted successfully.');
    }
}
