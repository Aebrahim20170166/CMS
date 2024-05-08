<?php

namespace Cms\Course\Services;

use Cms\Course\Models\Course;
use Cms\Base\Traits\GeneralTrait;
use Cms\Course\Models\Grade;
use Cms\Course\Requests\assignGrade;
use Cms\Course\Requests\StoreCourseRequest;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

use Illuminate\Http\Request;

class GradeService {

    use GeneralTrait;

    public function __construct(private AssignmentService $assignmentService)
    {

    }
    public function getGrades(Request $request)
    {
        $userRole = $request->user()->role->name;
        if ($userRole !== "instructor")
        {
            return $this->returnError(ResponseAlias::HTTP_BAD_REQUEST, "You Are Not Allowed");
        }
        //dd($request->assignment_id);
        $grades = Grade::where("assignment_id", $request->assignment_id)->get();
        return $this->returnData('data', ['grades' => $grades], "Assignment Grades");
    }

    public function getGradeById(Request $request, int $id)
    {
        $userRole = $request->user()->role->name;
        if ($userRole !== "instructor")
        {
            return $this->returnError(ResponseAlias::HTTP_BAD_REQUEST, "You Are Not Allowed");
        }
        return Grade::find($id);
    }

    public function createGrade(assignGrade $request)
    {
        $userRole = $request->user()->role->name;
        if ($userRole !== "instructor")
        {
            return $this->returnError(ResponseAlias::HTTP_BAD_REQUEST, "You Are Not Allowed");
        }


        $assignmnet = $this->assignmentService->getAssignmentById($request, $request->assignment_id);
        if (!$assignmnet)
        {
            return response()->json([
                "status" => false,
                "message" => "Assignment not found"
            ]);
        }

        $grade = new Grade();
        $grade->grade = $request->grade;
        $grade->assignment_id = $request->assignment_id;
        $grade->student_id = $request->user_id;
        $grade->save();
        return $this->returnData('data', ['grade' => $grade], "Grade Saved Successfully");
        // return response()->json([
        //     "status" => true,
        //     "message" => "Grade Saved successfully"
        // ]);
    }

    public function updateGrade(assignGrade $request, int $id)
    {
        $userRole = $request->user()->role->name;
        if ($userRole !== "instructor")
        {
            return $this->returnError(ResponseAlias::HTTP_BAD_REQUEST, "You Are Not Allowed");
        }

        $grade = Grade::find($id);
        if (!$grade)
        {
            return response()->json([
                "status" => false,
                "message" => "Grade not found"
            ]);
        }
        $assignmnet = $this->assignmentService->getAssignmentById($request, $request->assignment_id);
        if (!$assignmnet)
        {
            return response()->json([
                "status" => false,
                "message" => "Assignment not found"
            ]);
        }
        $grade->grade = $request->grade;
        $grade->assignment_id = $request->assignment_id;
        $grade->student_id = $request->user_id;
        $grade->save();
        return $this->returnData('data', ['grade' => $grade], "Grade Updated Successfully");
        // return response()->json([
        //     "status" => true,
        //     "message" => "Grade Saved successfully"
        // ]);
    }

    public function deleteGrade(Request $request, int $id)
    {
        $userRole = $request->user()->role->name;
        if ($userRole !== "instructor")
        {
            return $this->returnError(ResponseAlias::HTTP_BAD_REQUEST, "You Are Not Allowed");
        }

        $grade = Grade::find($id);
        if (!$grade)
        {
            return response()->json([
                "status" => false,
                "message" => "Grade not found"
            ]);
        }
        $grade->delete();
        return response()->json([
            "status" => true,
            "message" => "Grade deleted successfully"
        ]);
    }
}
