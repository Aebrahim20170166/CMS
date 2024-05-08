<?php

namespace App\Http\Controllers;

use Cms\Course\Requests\StoreCourseRequest;
use Cms\Course\Services\CourseService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CourseController extends Controller
{
    public function __construct(private CourseService $courseService)
    {

    }

    public function index()
    {
        $courses = $this->courseService->getCourses();
        if (!$courses)
        {
            return $this->courseService->returnError(ResponseAlias::HTTP_NOT_FOUND, "Course Not Found");
        }
        return $this->courseService->returnData("courses", $courses);
    }

    public function show($id)
    {
        $course = $this->courseService->getCourseById($id);
        if (!$course)
        {
            return $this->courseService->returnError(ResponseAlias::HTTP_NOT_FOUND, "Course Not Found");
        }
        return $this->courseService->returnData("course", $course);
    }

    public function store(StoreCourseRequest $request)
    {
        return $this->courseService->createCourse($request);
    }

    public function update(int $id, StoreCourseRequest $request)
    {
        return $this->courseService->updateCourse($request, $id);
    }

    public function destroy(int $id)
    {
        return $this->courseService->deleteCourse($id);
    }
}
