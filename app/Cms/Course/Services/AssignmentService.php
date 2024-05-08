<?php

namespace Cms\Course\Services;

use Cms\Course\Models\Assignment;
use Cms\Base\Traits\GeneralTrait;
use Cms\Course\Models\Course;
use Cms\Course\Requests\StoreAssignment;
use Cms\Course\Requests\StoreCourseRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AssignmentService {

    use GeneralTrait;
    public function getAssignments(Request $request)
    {
        $userRole = $request->user()->role->name;
        if ($userRole !== "instructor")
        {
            return $this->returnError(ResponseAlias::HTTP_BAD_REQUEST, "You Are Not Allowed");
        }
        $course = new Course();
        return $course->assignments();
    }

    public function getAssignmentById(Request $request, int $id)
    {
        $userRole = $request->user()->role->name;
        if ($userRole !== "instructor")
        {
            return $this->returnError(ResponseAlias::HTTP_BAD_REQUEST, "You Are Not Allowed");
        }
        return Assignment::find($id);
    }

    public function createAssignmnet(StoreAssignment $request)
    {
        $userRole = $request->user()->role->name;
        if ($userRole !== "instructor")
        {
            return $this->returnError(ResponseAlias::HTTP_BAD_REQUEST, "You Are Not Allowed");
        }
        $assignment = new Assignment();
        $assignment->name = $request->name;
        $assignment->content = $request->content;
        $assignment->course_id = $request->course_id;
        $assignment->save();
        return $this->returnSuccess(ResponseAlias::HTTP_OK, "Assignment created successfully");
        // return response()->json([
        //     "status" => true,
        //     "message" => "Assignment created successfully"
        // ]);
    }

    public function updateAssignment(StoreAssignment $request, int $id)
    {
        $userRole = $request->user()->role->name;
        if ($userRole !== "instructor")
        {
            return $this->returnError(ResponseAlias::HTTP_BAD_REQUEST, "You Are Not Allowed");
        }

        $assignment = Assignment::find($id);
        if (!$assignment)
        {
            return response()->json([
                "status" => false,
                "message" => "Course not found"
            ]);
        }
        $assignment->name = $request->name;
        $assignment->content = $request->content;
        $assignment->course_id = $request->course_id;
        $assignment->save();
        return response()->json([
            "status" => true,
            "message" => "Assignment updated successfully"
        ]);
    }

    public function deleteAssignment(Request $request, int $AssignmnetId)
    {
        $userRole = $request->user()->role->name;
        if ($userRole !== "instructor")
        {
            return $this->returnError(ResponseAlias::HTTP_BAD_REQUEST, "You Are Not Allowed");
        }

        $assignment = Assignment::find($AssignmnetId);
        if (!$assignment)
        {
            return response()->json([
                "status" => false,
                "message" => "Assignment not found"
            ]);
        }
        $assignment->delete();
        return response()->json([
            "status" => true,
            "message" => "Assignment deleted successfully"
        ]);
    }
}
