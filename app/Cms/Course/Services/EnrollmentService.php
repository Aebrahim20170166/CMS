<?php

namespace Cms\Course\Services;

use Cms\Course\Models\Enrollment;
use Cms\Course\Models\Course;
use Cms\Base\Traits\GeneralTrait;
use Cms\Course\Requests\enrollCourse;
use Cms\User\Services\UserService;
use Cms\Course\Requests\storeEnrollment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class EnrollmentService {
    use GeneralTrait;

    public function __construct(private CourseService $courseService, private UserService $userService)
    {
    }
    public function enroll(enrollCourse $request)
    {
        $user = $request->user();
        $enrollment = Enrollment::where('user_id', $user->id)->
        where('course_id', $request->course_id)->first();
        if (!$enrollment)
        {
            $enrollment = new Enrollment();
            $enrollment->user_id = $user->id;
            $enrollment->course_id = $request->course_id;

            $courseName = $this->courseService->getCourseById($request->course_id)->name;
            $enrollment->save();
            return $this->returnSuccess(ResponseAlias::HTTP_OK, "You are enrolled successfully in $courseName course successfully");
        }
        $courseName = $this->courseService->getCourseById($request->course_id)->name;
        return $this->returnSuccess(ResponseAlias::HTTP_OK, "You already enrolled in $courseName course successfully");

    }

    public function joinCourse(storeEnrollment $request)
    {
        $user = $request->user();
        $role = $user->role->name;
        if ($role == "instructor" && !Enrollment::where('user_id', $request->user_id)->
        where('course_id', $request->course_id)->first())
        {
            $enrollment = new Enrollment();
            $enrollment->user_id = $user->id;
            $enrollment->course_id = $request->course_id;

            $courseName = $this->courseService->getCourseById($request->course_id)->name;
            $enrollment->save();
            return $this->returnSuccess(ResponseAlias::HTTP_OK, "You are joined $courseName course successfully");
        }
        else if($role == "instructor" && Enrollment::where('user_id', $request->user_id)->
        where('course_id', $request->course_id)->first() != null)
        {
            $courseName = $this->courseService->getCourseById($request->course_id)->name;
            return $this->returnSuccess(ResponseAlias::HTTP_OK, "You already joined $courseName course successfully");
        }
        return $this->returnError(ResponseAlias::HTTP_NOT_ACCEPTABLE, "You Are Not allowed To Do This Action");

    }

    public function getEnrolledStudent(Request $request)
    {
        $course = Course::find($request->course_id);
        $students = $course->users;
        return $this->returnData('students', $students, "All Enrolled Students in $course->name course");
        // return response()->json([
        //     "status" => true,
        //     "students" => $students
        // ]);
    }


}
