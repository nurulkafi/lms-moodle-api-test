<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\MoodleRest;
use Alert;

class UsersController extends Controller
{
    //
    public function signUp(){

        return view('users.signup');
    }
    public function signUpPost(Request $request){
        $moodleRest = new MoodleRest();
        $moodleRest->setServerAddress(env('MOODLE_SERVER_ADDRESS'));
        $moodleRest->setToken(env('MOODLE_TOKEN'));
        $moodleRest->setReturnFormat(MoodleRest::RETURN_ARRAY);

        $userData = [
            'users' => [
                [
                    'username' => $request->username,
                    'firstname' => $request->first_name,
                    'lastname' => $request->last_name,
                    'password' => $request->password,
                    'email' =>$request->email,
                ]
            ]
        ];

        // Create new user
        $response = $moodleRest->request('core_user_create_users', $userData,'POST');

        if (!isset($response['exception'])) {
            Alert::success('Information', 'Data Successfully Created');
            return redirect('/courses');
        } else {
            Alert::error('Information', 'Data Failed Created');
            if($response['exception'] == "invalid_parameter_exception"){
                return redirect('sign-up')->withInput()->with('error', $response['debuginfo']);
            }else{
                return redirect('sign-up')->withInput()->with('error', $response['message']);
            }
        }
    }
}
