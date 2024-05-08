<?php

namespace App\Http\Controllers;

use Cms\Base\Requests\StoreRoleRequest;
use Illuminate\Http\Request;
use Cms\Base\Services\RoleService;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
class RoleController extends Controller
{
    public function __construct(private RoleService $roleService)
    {

    }

    public function index()
    {
        $roles = $this->roleService->index();
        if (!$roles)
        {
            return $this->roleService->returnError(ResponseAlias::HTTP_NOT_FOUND, "Not Roles Found");
        }
        return $this->roleService->returnData("Roles", $roles);
    }

    public function show(int $id)
    {
        $role = $this->roleService->show($id);
        if (!$role)
        {
            return $this->roleService->returnError(ResponseAlias::HTTP_NOT_FOUND, "Not Role Found");
        }
        return $this->roleService->returnData("Role", $role);
    }
    public function store(StoreRoleRequest $request)
    {
        return $this->roleService->store($request);
    }

    public function update(StoreRoleRequest $request, int $id)
    {
        return $this->roleService->update($request, $id);
    }

    public function destroy(int $id)
    {
        return $this->roleService->destroy($id);
    }
}
