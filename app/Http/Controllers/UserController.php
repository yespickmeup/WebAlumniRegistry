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
class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('display_name','id');
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
      public function account(Request $request)
    {

        $user = User::find($request['id']);
        
        return view('users.show',compact('user'));
    }

    public function emailExists($email)
    {
        $user = User::where('email' ,'=', $email)->first();
        return response()->json(['user' => $user]);
        /*return view('users.show',compact('user'));*/
    }
    public function userSave(Request $request)
    {
        $data = $request->json()->all();
        $userInput = $request->get('user');
        
        $name = $userInput['first_name'] . ' ' . $userInput['middle_name'] . ' ' . $userInput['last_name']  ;
       

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
       $user->landline_no= $userInput['landline_no'];
       $user->cellphone_no= $userInput['cellphone_no'];
       $user->level= $userInput['level'];
       $user->year= $userInput['year'];
       $user->course= $userInput['course'];
       $user->major= $userInput['major'];
       $user->motto_in_life= $userInput['motto'];
       $user->father_name = $userInput['father'];
       $user->is_father_paulinian =1;
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
       $roleuser = Role::where('name', '=' , 'admin')->first();
       $user->attachRole($roleuser);

        $activities = $request->get('activities');
        $members = $request->get('members');
        $activity_names = [];
        foreach($activities as $col){
            $involvement = new UserInvolvement();
            $involvement->involvement = $col['activity'];
            $user->involvement()->save($involvement);
            array_push($activity_names, $col['activity']);
        }
        foreach($members as $member){
            $family = new UserAlumniFamilyMember();
            $family->name = $member['name'];
            $family->relation = $member['relation'];
            $family->name_before_married = $member['before_married'];
            $family->address = $member['residence'];
            $family->occupation = $member['occupation'];
            $family->office_address = $member['office'];
            $user->family()->save($family);
        }

       
       /* return view('test.test-signup')->compact(['data' => $request->json()->all()]);*/
        return response()->json(['all' => $data,'user' => $user,'name' => $name,'activities'=> $activities , 'activity_names' => $activity_names ]);
        /*return view('users.show',compact('user'));*/
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::lists('display_name','id');
        $userRole = $user->roles->lists('id','id')->toArray();

        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('role_user')->where('user_id',$id)->delete();

        
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}