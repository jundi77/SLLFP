<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionTestController extends Controller
{   

    public function index()
    {   
    	$adm_permission = Permission::where('slug','create-tasks')->first();
		$normal_permission = Permission::where('slug', 'edit-users')->first();

		//RoleTableSeeder.php
		$adm_role = new Role();
		$adm_role->slug = 'admin';
		$adm_role->name = 'Admin';
		$adm_role->save();
		$adm_role->permissions()->attach($adm_permission);

		$normal_role = new Role();
		$normal_role->slug = 'normal';
		$normal_role->name = 'User Biasa';
		$normal_role->save();
		$normal_role->permissions()->attach($normal_permission);

		$adm_role = Role::where('slug','admin')->first();
		$normal_role = Role::where('slug', 'normal')->first();

		$createTasks = new Permission();
		$createTasks->slug = 'create-tasks';
		$createTasks->name = 'Create Tasks';
		$createTasks->save();
		$createTasks->roles()->attach($adm_role);

		$editUsers = new Permission();
		$editUsers->slug = 'edit-users';
		$editUsers->name = 'Edit Users';
		$editUsers->save();
		$editUsers->roles()->attach($normal_role);

		$adm_role = Role::where('slug','developer')->first();
		$normal_role = Role::where('slug', 'manager')->first();
		$adm_perm = Permission::where('slug','poll')->first();
		$normal_perm = Permission::where('slug','poll')->first();

		$admin = new User();
		$admin->name = 'Harsukh Makwana';
		$admin->email = 'harsukh21@gmail.com';
		$admin->password = bcrypt('harsukh21');
		$admin->save();
		$admin->roles()->attach($adm_role);
		$admin->permissions()->attach($adm_perm);

		$normal = new User();
		$normal->name = 'Jitesh Meniya';
		$normal->email = 'jitesh21@gmail.com';
		$normal->password = bcrypt('jitesh21');
		$normal->save();
		$normal->roles()->attach($normal_role);
		$normal->permissions()->attach($normal_perm);

		
		return redirect('home');
    }
}