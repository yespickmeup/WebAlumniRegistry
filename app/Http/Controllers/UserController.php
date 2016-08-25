<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use DB;
use Hash;
use App\UserInvolvement;
use App\UserAlumniFamilyMember;
use Intervention\Image\Facades\Image as Image;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }
    public function getUsers()
    {

        $users = User::all();

        return response()->json(['users' => $users]);
    }
    public function userRoles($user_id)
    {
        $userRoles = User::find( $user_id )->roles;
        return response()->json(['roles' =>$userRoles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('display_name', 'id');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function account(Request $request)
    {

        $user = User::find($request['id']);

        return view('users.show', compact('user'));
    }

    public function emailExists($email)
    {
        $user = User::where('email', '=', $email)->first();
        return response()->json(['user' => $user]);
        /*return view('users.show',compact('user'));*/
    }

    public function userSave(Request $request)
    {
        $data = $request->json()->all();
        $userInput = $request->get('user');
        $name = $userInput['first_name'] . ' ' . $userInput['middle_name'] . ' ' . $userInput['last_name'];

        $user = new User();
        $user->alumni_no = '';
        $user->student_no = $userInput['student_no'];
        $user->first_name = $userInput['first_name'];
        $user->middle_name = $userInput['middle_name'];
        $user->last_name = $userInput['last_name'];
        $user->suffix_name = $userInput['suffix_name'];
        $user->civil_status = $userInput['civil_status'];
        $user->gender = $userInput['gender'];
        $user->date_of_birth = $userInput['bday'];
        $user->email = $userInput['email'];
        $user->password = bcrypt($userInput['password']);
        $user->landline_no = $userInput['landline_no'];
        $user->cellphone_no = $userInput['cellphone_no'];
        $user->level = $userInput['level'];
        $user->year = $userInput['year'];
        $user->course = $userInput['course'];
        $user->major = $userInput['major'];
        $user->motto_in_life = $userInput['motto'];
        $user->father_name = $userInput['father'];
        $user->is_father_paulinian = 1;
        $user->father_occupation = $userInput['father_occupation'];
        $user->father_office = $userInput['father_office'];
        $user->mother_name = $userInput['mother'];
        $user->is_mother_paulinian = 1;
        $user->mother_occupation = $userInput['mother_occupation'];
        $user->mother_office = $userInput['mother_office'];
        $user->is_activated = 0;
        $user->status = 1;
        $user->save();

        $user->alumni_no = '000000000' . '' . $user->id;
        $user->save();

        /*Role*/
        $roleuser = Role::where('name', '=', 'user')->first();
        $user->attachRole($roleuser);

        $activities = $request->get('activities');
        $members = $request->get('members');
        $activity_names = [];
        foreach ($activities as $col) {
            $involvement = new UserInvolvement();
            $involvement->involvement = $col['activity'];
            $user->involvement()->save($involvement);
            array_push($activity_names, $col['activity']);
        }
        foreach ($members as $member) {
            $family = new UserAlumniFamilyMember();
            $family->name = $member['name'];
            $family->relation = $member['relation'];
            $family->name_before_married = $member['before_married'];
            $family->address = $member['residence'];
            $family->occupation = $member['occupation'];
            $family->office_address = $member['office'];
            $user->family()->save($family);
        }



       /* $image = $request->file('image1');
        $input['imagename'] =  $user->alumni_no .'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/src/images/uploads');
        $image->move($destinationPath, $input['imagename']);*/

        /* return view('test.test-signup')->compact(['data' => $request->json()->all()]);*/
        return response()->json(['all' => $data, 'user' => $user, 'name' => $name, 'activities' => $activities, 'activity_names' => $activity_names]);
        /*return view('users.show',compact('user'));*/
    }

    public function userUpdate(Request $request)
    {
        $data = $request->json()->all();
        $userInput = $request->get('user');

        $user = User::where('id', '=', $userInput['id'])->first();

        $user->student_no = $userInput['student_no'];
        $user->first_name = $userInput['first_name'];
        $user->middle_name = $userInput['middle_name'];
        $user->last_name = $userInput['last_name'];
        $user->suffix_name = $userInput['suffix_name'];
        $user->civil_status = $userInput['civil_status'];
        $user->gender = $userInput['gender'];
        $user->date_of_birth = $userInput['bday'];
        $user->landline_no = $userInput['landline_no'];
        $user->cellphone_no = $userInput['cellphone_no'];
        $user->level = $userInput['level'];
        $user->year = $userInput['year'];
        $user->course = $userInput['course'];
        $user->major = $userInput['major'];
        $user->motto_in_life = $userInput['motto'];
        $user->father_name = $userInput['father'];
        $user->is_father_paulinian = 1;
        $user->father_occupation = $userInput['father_occupation'];
        $user->father_office = $userInput['father_office'];
        $user->mother_name = $userInput['mother'];
        $user->is_mother_paulinian = 1;
        $user->mother_occupation = $userInput['mother_occupation'];
        $user->mother_office = $userInput['mother_office'];
        if (!$user->save()) {
            return response()->json(['error' => 'record not updated!']);
        }
        return response()->json(['all' => $data, 'user' => $user, 'fname' => $user->first_name]);
    }

    public function userInvolvements($user_id)
    {
        $involvements = UserInvolvement::where('user_id', '=', $user_id)->get();
        return response()->json(['involvements' => $involvements]);
    }

    public function userInvolvementSave(Request $request)
    {

        $userInvolvement = $request->get('user_involvement');
        $user_id = $request->get('user_id');

        $involvement = new UserInvolvement();
        $involvement->user_id = $user_id;
        $involvement->involvement = $userInvolvement;
        if (!$involvement->save()) {
            return response()->json(['response' => 'record not updated!']);
        }
        return response()->json(['response' => $involvement]);
    }

    public function userInvolvementUpdate(Request $request)
    {

        $userInvolvement = $request->get('user_involvement');
        $id = $request->get('id');

        $involvement = UserInvolvement::where('id', '=', $id)->first();
        $involvement->involvement = $userInvolvement;
        if (!$involvement->save()) {
            return response()->json(['response' => 'record not updated!']);
        }
        return response()->json(['response' => $involvement]);
    }

    public function userInvolvementDelete(Request $request)
    {
        $id = $request->get('id');
        $involvement = UserInvolvement::where('id', '=', $id)->first();
        if (!$involvement->delete()) {
            return response()->json(['response' => 'record not updated!']);
        }
        return response()->json(['response' => $involvement]);
    }

    public function userIAlumniFamilyMembers($user_id)
    {
        $family = UserAlumniFamilyMember::where('user_id', '=', $user_id)->get();
        return response()->json(['family' => $family]);
    }

    public function userFamilySave(Request $request)
    {

        $family = new UserAlumniFamilyMember();
        $family->user_id = $request->get('user_id');
        $family->name = $request->get('name');
        $family->relation = $request->get('relation');
        $family->name_before_married = $request->get('before_married');
        $family->address = $request->get('residence');
        $family->occupation = $request->get('occupation');
        $family->office_address = $request->get('office');

        if (!$family->save()) {
            return response()->json(['response' => 'record not updated!']);
        }
        return response()->json(['response' => $family]);
    }

    public function userFamilyUpdate(Request $request)
    {

        $id = $request->get('id');
        $family = UserAlumniFamilyMember::where('id', '=', $id)->first();
        $family->name = $request->get('name');
        $family->relation = $request->get('relation');
        $family->name_before_married = $request->get('before_married');
        $family->address = $request->get('residence');
        $family->occupation = $request->get('occupation');
        $family->office_address = $request->get('office');

        if (!$family->save()) {
            return response()->json(['response' => 'record not updated!']);
        }
        return response()->json(['response' => $family]);
    }

    public function userFamilyDelete(Request $request)
    {
        $id = $request->get('id');
        $family = UserAlumniFamilyMember::where('id', '=', $id)->first();
        if (!$family->delete()) {
            return response()->json(['response' => 'record not updated!']);
        }
        return response()->json(['response' => $family]);
    }

    public function userApprove(Request $request)
    {

        $id = $request->get('id');
        $user = User::where('id', '=', $id)->first();
        $user->is_activated = 1;
        if (!$user->save()) {
            return response()->json(['response' => 'record not updated!']);
        }
        return response()->json(['response' => $user]);
    }

    /*Approvals*/
    public function approval()
    {

        return view('users.approval');
    }

    public function userForApproval()
    {
        $users = User::where('is_activated', '=', '0')->get();
        return response()->json(['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::lists('display_name', 'id');
        $userRole = $user->roles->lists('id', 'id')->toArray();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('role_user')->where('user_id', $id)->delete();


        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}