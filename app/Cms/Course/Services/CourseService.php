<?php

namespace Cms\Course\Services;

use Cms\Course\Models\Course;
use Cms\Base\Traits\GeneralTrait;
use Cms\Course\Requests\StoreCourseRequest;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CourseService {

    use GeneralTrait;
    public function getCourses()
    {
        return Course::all(["name", "discription", "code"]);
    }

    public function getCourseById(int $id)
    {
        return Course::find($id);
    }

    public function createCourse(StoreCourseRequest $request)
    {
        $course = new Course();
        $course->name = $request->name;
        $course->description = $request->description;
        $course->code = $request->code;
        $course->save();
        return response()->json([
            "status" => true,
            "message" => "Course created successfully"
        ]);
    }

    public function updateCourse(StoreCourseRequest $request, int $id)
    {
        $course = Course::find($id);
        if (!$course)
        {
            return response()->json([
                "status" => false,
                "message" => "Course not found"
            ]);
        }
        $course->name = $request->name;
        $course->description = $request->description;
        $course->code = $request->code;
        $course->save();
        return response()->json([
            "status" => true,
            "message" => "Course updated successfully"
        ]);
    }

    public function deleteCourse(int $id)
    {
        $course = Course::find($id);
        if (!$course)
        {
            return response()->json([
                "status" => false,
                "message" => "Course not found"
            ]);
        }
        $course->delete();
        return response()->json([
            "status" => true,
            "message" => "Course deleted successfully"
        ]);
    }
}
