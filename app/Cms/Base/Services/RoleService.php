<?php

namespace Cms\Base\Services;

use Cms\Base\Models\Role;
use Cms\Base\Requests\StoreRoleRequest;
use Cms\Base\Traits\GeneralTrait;

class RoleService
{
    use GeneralTrait;

    public function index()
    {
        return Role::all();
    }

    public function show(int $id)
    {
        return Role::find($id);
    }

    public function getRoleByName(string $name)
    {
        return Role::where('name', $name)->first();
    }

    public function store(StoreRoleRequest $request)
    {
        $Role = new Role();
        $Role->name = $request->name;
        $Role->save();
        return response()->json([
            'status' => true,
            'message' => 'Role Added Successfully'
        ]);
    }

    public function update(StoreRoleRequest $request, int $id)
    {
        $role = Role::find($id);
        if (!$role) {

            return response()->json([
            'status' => false,
            'message' => 'Role Not Found'
            ]);
        }

        $role->name = $request->name;
        $role->save();
        return response()->json([
        'status' => true,
        'message' => 'Role Updated Successfully'
        ]);
    }

    public function destroy(int $id)
    {
        $role = Role::find($id);
        if (!$role) {

            return response()->json([
            'status' => false,
            'message' => 'Role Not Found'
            ]);
        }

        $role->delete();
        return response()->json([
        'status' => true,
        'message' => 'Role Deleted Successfully'
        ]);
    }

}
