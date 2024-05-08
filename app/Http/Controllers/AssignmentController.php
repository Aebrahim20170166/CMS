<?php

namespace App\Http\Controllers;

use Cms\Course\Requests\StoreAssignment;
use Cms\Course\Services\AssignmentService;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function __construct(private AssignmentService $assignmentService)
    {

    }

    public function index(Request $request)
    {
        return $this->assignmentService->getAssignments($request);
    }

    public function store(StoreAssignment $request)
    {
        return $this->assignmentService->createAssignmnet($request);
    }

    public function show(Request $request, int $id)
    {
        return $this->assignmentService->getAssignmentById($request, $id);
    }

    public function update(Request $request, $id)
    {
        return $this->assignmentService->updateAssignment($request, $id);
    }

    public function destroy(Request $request, int $id)
    {
        return $this->assignmentService->deleteAssignment($request, $id);
    }
}
