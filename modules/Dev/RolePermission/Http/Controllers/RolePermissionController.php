<?php

namespace Dev\RolePermission\Http\Controllers;

use App\Http\Controllers\Controller;
use Dev\Category\Responses\AjaxResponses;
use Dev\RolePermission\Http\Request\RoleRequest;
use Dev\RolePermission\Http\Request\RoleUpdateRequest;
use Dev\RolePermission\Repository\PermissionRepo;
use Dev\RolePermission\Repository\RolesRepo;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller {
	private RolesRepo      $roles_repo;
	private PermissionRepo $permission_repo;
	
	public function __construct () {
		$this->roles_repo = resolve(RolesRepo::class);
		$this->permission_repo = resolve(PermissionRepo::class);
	}
	
	public function index () {
		$roles = $this->roles_repo->all();
		$permissions = $this->permission_repo->all();
		
		return view('RolePermission::index' , compact('roles' , 'permissions'));
	}
	
	public function store ( RoleRequest $request ) {
		$this->roles_repo->create($request);
		
		return back()->with('success' , __('messages.alert.success'));
	}
	
	public function destroy (int $id) {
		$role = $this->roles_repo->delete($id);
		AjaxResponses::printResult(__('messages.alert.delete'));
	}
	
	public function edit ( Role $role ) {
		$permissions = $this->permission_repo->all();
		
		return view('RolePermission::edit' , compact('role' , 'permissions'));
	}
	
	public function update ( RoleUpdateRequest $request , $id ) {
		
		$this->roles_repo->update($request , $id);
		
		return redirect()
			->route('role-permission.index')
			->with('success' , __('messages.alert.update'));
	}
	
}
