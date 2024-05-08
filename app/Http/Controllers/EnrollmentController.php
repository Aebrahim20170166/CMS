<?php

namespace App\Http\Controllers;

use Cms\Course\Requests\enrollCourse;
use Cms\Course\Requests\storeEnrollment;
use Cms\Course\Services\EnrollmentService;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{

    public function __construct(private EnrollmentService $enrollmentService)
    {

    }

    public function enroll(enrollCourse $request)
    {
        return $this->enrollmentService->enroll($request);
    }

    public function joinCourse(storeEnrollment $request)
    {
        return $this->enrollmentService->joinCourse($request);
    }

    public function getAllEnrollments(Request $request)
    {
        return $this->enrollmentService->getEnrolledStudent($request);
    }
}
