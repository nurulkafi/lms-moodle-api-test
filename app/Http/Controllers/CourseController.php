<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Lib\MoodleRest;
Use Alert;
class CourseController extends Controller
{
    public function getAll()
    {
        $data = [];

        $moodleRest = new MoodleRest();
        $moodleRest->setServerAddress(env('MOODLE_SERVER_ADDRESS'));
        $moodleRest->setToken(env('MOODLE_TOKEN'));
        $moodleRest->setReturnFormat(MoodleRest::RETURN_ARRAY);
        $courses = $moodleRest->request('core_course_get_courses', [], 'GET');
        foreach ($courses as $course) {
            $totalStudent = 0;
            $courseData = [
                'id' => $course['id'],
                'name' => $course['fullname'],
                'description' => $course['summary'],
                'instructors' => [],
            ];

            $enrolledUsers = $moodleRest->request('core_enrol_get_enrolled_users', ['courseid' => $course['id']], 'GET');
            foreach ($enrolledUsers as $user) {
                if (!empty($user['roles'])) {
                    if ($user['roles'][0]['roleid'] == 3) {
                        $courseData['instructors'][] = $user['fullname'];
                    } else {
                        $totalStudent++;
                    }
                } else {
                    $totalStudent++;
                }
            }

            $courseData['total_students'] = $totalStudent;
            $data[] = $courseData;
        }

        return view('course.index', compact('data'));
    }
    public function search(Request $request)
    {
        if ($request->search == null) {
            return redirect('/courses');
        } else {
            return redirect('/course/search/' . $request->search);
        }
    }
    public function searchProcess($search)
    {
        $data = [];

        $moodleRest = new MoodleRest();
        $moodleRest->setServerAddress(env('MOODLE_SERVER_ADDRESS'));
        $moodleRest->setToken(env('MOODLE_TOKEN'));
        $moodleRest->setReturnFormat(MoodleRest::RETURN_ARRAY);
        $res = $moodleRest->request('core_course_get_courses',  ['options' => ['ids' => [$search]]], 'GET');
        $courses = [];
        if (!isset($res['exception'])) {
            $courses = $res;
        } else {
            $res = $moodleRest->request('core_course_get_courses',  [], 'GET');
            foreach ($res as $course) {
                $regexPattern = '/\b' . preg_quote($search, '/') . '\b/i'; // Menggunakan \b untuk cocokkan kata secara keseluruhan dan i untuk pencocokan yang tidak peka terhadap huruf besar/kecil

                if (preg_match($regexPattern, $course['fullname'])) {
                    $courses[] = $course;
                }
            }
        }

        foreach ($courses as $course) {
            $totalStudent = 0;
            $courseData = [
                'id' => $course['id'],
                'name' => $course['fullname'],
                'description' => $course['summary'],
                'instructors' => [],
            ];

            $enrolledUsers = $moodleRest->request('core_enrol_get_enrolled_users', ['courseid' => $course['id']], 'GET');
            foreach ($enrolledUsers as $user) {
                if (!empty($user['roles'])) {
                    if ($user['roles'][0]['roleid'] == 3) {
                        $courseData['instructors'][] = $user['fullname'];
                    } else {
                        $totalStudent++;
                    }
                } else {
                    $totalStudent++;
                }
            }

            $courseData['total_students'] = $totalStudent;
            $data[] = $courseData;
        }

        return view('course.index', compact('data','search'));
    }

    public function create()
    {
        $moodleRest = new MoodleRest();
        $moodleRest->setServerAddress(env('MOODLE_SERVER_ADDRESS'));
        $moodleRest->setToken(env('MOODLE_TOKEN'));
        $moodleRest->setReturnFormat(MoodleRest::RETURN_ARRAY);

        $category = $moodleRest->request('core_course_get_categories', [], 'GET');


        return view('course.create',compact('category'));
    }
    public function store(Request $request){

        $moodleRest = new MoodleRest();
        $moodleRest->setServerAddress(env('MOODLE_SERVER_ADDRESS'));
        $moodleRest->setToken(env('MOODLE_TOKEN'));
        $moodleRest->setReturnFormat(MoodleRest::RETURN_ARRAY);

        $courseData = [
            'courses' => [
                [
                    'fullname' => $request->name,
                    'shortname' => $request->name,
                    'categoryid' => $request->category_id,
                    'summary' => $request->description,
                ]
            ]
        ];
        $response = $moodleRest->request('core_course_create_courses', $courseData, 'POST');

        if (!isset($response['exception'])) {
            Alert::success('Information', 'Data Successfully Created');
            return redirect('/courses');
        } else {
            Alert::error('Information', 'Data Failed Created');
            return redirect('/courses');
        }
    }
}
