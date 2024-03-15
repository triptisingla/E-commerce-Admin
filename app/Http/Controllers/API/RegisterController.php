<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use DB;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
            'city' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        // dd($request->file('file'));
        if($request->file('file'))
        {
            $imageurl = cloudinary()->upload($request->file('file')->getRealPath())->getSecurePath();
            $input['profilepic'] = $imageurl;
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('token')->accessToken;
        $success['name'] = $user->name;
        return view('login');
        // return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // $user = User::find(Auth::user()->id);
            $user = Auth::user();
            // dd($user->createToken('token'));
            // $success = [];
            $success['token'] = $user->createToken('token')->accessToken;
            $success['name'] = $user->name;


            return redirect()->route('dashboard');
            // return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function logout(Request $request)
    {
        // dd($request);
        if (Auth::user()) {
            Auth::logout();
            // $request->user()->token()->revoke();
            return redirect()->route('login');
            // return response()->json(["success"=>true]);
            // return $this->sendResponse('', 'Logged out successfully.');
        }
        return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    }

    public function updateprofileform(Request $request)
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);

            return view('updateprofile', compact('user'));
        }
        return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);

    }


    public function updateprofile(Request $request)
    {

        if (Auth::user()) {
            $userDetails['name'] = $request['name'];
            $userDetails['email'] = $request['email'];
            $userDetails['city'] = $request['city'];
            if ($request['file']) {
                // $imageurl="hii";
                $imageurl = cloudinary()->upload($request->file('file')->getRealPath())->getSecurePath();
                $userDetails['profilepic'] = $imageurl;
            }
            // dd($userDetails);

            $userUpdated = User::where('id', Auth::user()->id)->update($userDetails);
            return redirect()->route('dashboard');
            // return $this->sendResponse($userUpdated, 'User updated successfully.');
        }
    }

    public function groupby(Request $request)
    {
        $users = DB::table('users')
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MIN(id)'))
                    ->from('users')
                    ->groupBy('city');
            })
            ->get();

        // ->where('city', 'New Delhi')
        dd($users);
    }
}
