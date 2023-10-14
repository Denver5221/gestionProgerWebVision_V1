<?php
namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{   

    public function Permission(Request $request)
    {   

        $user_permission = Permission::where('slug', 'create-tasks')->first();
        $admin_permission = Permission::where('slug', 'edit-users')->first();
    
        $user_role = new Role();
        $user_role->nom = 'User_Name';
        $user_role->slug = 'user';
        $user_role->save();
        $user_role->permissions()->attach($user_permission);
    
        $admin_role = new Role();
        $admin_role->nom = 'Admin_Name';
        $admin_role->slug = 'admin';
        $admin_role->save();
        $admin_role->permissions()->attach($admin_permission);
    
		$user_role = Role::where('slug', 'user')->first();
        $admin_role = Role::where('slug', 'admin')->first();

		$createTasks = new Permission();
		$createTasks->slug = 'create-tasks';
		$createTasks->nom = 'Create Tasks';
		$createTasks->save();
		$createTasks->roles()->attach($user_role);

		$editUsers = new Permission();
		$editUsers->slug = 'edit-users';
		$editUsers->nom = 'Edit Users';
		$editUsers->save();
		$editUsers->roles()->attach($admin_role);

		$user_role = Role::where('slug', 'user')->first();
        $admin_role = Role::where('slug', 'admin')->first();
		$user_perm = Permission::where('create-tasks','slug')->first();
		$admin_perm = Permission::where('edit-users','slug')->first();

		$user = new User();
		$user->nom = 'Test_User';
		$user->email = 'test_user@gmail.com';
		$user->password = bcrypt('1234567');
		$user->save();
		$user->roles()->attach($user_role);
		$user->permissions()->attach($user_perm);

		$admin = new User();
		$admin->nom = 'Test_Admin';
		$admin->email = 'test_admin@gmail.com';
		$admin->password = bcrypt('admin1234');
		$admin->save();
		$admin->roles()->attach($admin_role);
		$admin->permissions()->attach($admin_perm);


        $user = $request->user();
        dd($user->hasRole('user')); //will return true, if user has role
        dd($user->givePermissionsTo('create-tasks'));// will return permission, if not null
        dd($user->can('create-tasks'));
		
		return redirect()->back();
    }
}