<?php

namespace App\Http\Controllers;

use Cms\Course\Requests\assignGrade;
use Cms\Course\Services\GradeService;
use Illuminate\Http\Request;

class GradeController extends Controller
{

    public function __construct(private GradeService $gradeService)
    {

    }
    public function index(Request $request)
    {
        return $this->gradeService->getGrades($request);

    }
    public function store(assignGrade $request)
    {
        return $this->gradeService->createGrade($request);
    }
    public function show(Request $request, int $id)
    {
        $grade = $this->gradeService->getGradeById($request, $id);
        return $this->gradeService->returnData('data', ['grade' => $grade], "Grade Get Successfully");
    }

    public function update(assignGrade $request, int $id)
    {
        return $this->gradeService->updateGrade($request, $id);
    }
    public function destroy(Request $request, int $id)
    {
        return $this->gradeService->deleteGrade($request, $id);
    }
}
