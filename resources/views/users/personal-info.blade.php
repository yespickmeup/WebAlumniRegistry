<!-- NAME -->


<div class="panel panel-default">
    <div class="panel-heading">
        <div class="form-group">
            <input type="button" class="btn btn-default pull-right" value="Clear" ng-click="clearUser(userForm.$valid)"
                   ng-show="clearUser"/>
            <br>
        </div>
    </div>
    <div class="panel-body">
        <div style="margin-left:30px;">
            <div class="form-group">
                <div class="row col-md-3" style="height:140px;width:180px;margin-right:30px;">

                    <div style="background-color: whitesmoke; width:180px; height: 140px;margin-top:0px;">
                        <input type="hidden" ng-model="defaultPicture"
                               value="{{ URL::asset('src/images/sys/picture.jpg') }}">
                        @if(!Auth::guest())
                            <img
                                    class="img-thumbnail imgInp img-responsive"
                                    alt="Cinque Terre"
                                    width="200px" height="120px%;"
                                    ng-src="<%user.imageSource%>"

                            >
                        @else
                            <img src="{{ URL::asset('src/images/sys/picture.jpg') }}"
                                 class="img-thumbnail imgInp img-responsive"
                                 alt="Cinque Terre"
                                 width="200px" height="120px%;"
                                 ng-src="<%imageSource%>"
                            >
                        @endif

                    </div>
                    <div class="row" style="width:180px;margin-top:42px;margin-left:0px; display: inline-block;">
                        <input type="file" name="image" id="image" accept="image/jpeg"
                               class="btn btn-warning form-control image"
                               style="margin-top:20px;" ng-model="imageSource" ngf-max-height="1000"
                               ngf-max-size="100MB"
                               onchange="angular.element(this).scope().fileNameChaged(this)">
                        {{-- <button type="file" ngf-select="uploadFiles($file, $invalidFiles)"
                                 accept="image/*" ngf-max-height="1000" ngf-max-size="10MB">
                             Select File
                         </button>--}}
                    </div>
                </div>
            </div>
            <div class="form-group" ng-class="{'has-error' : !userForm.name.$valid}">
                <div class="row col-md-6" style="width:31%;">
                    <label>Alumni No</label>
                    <input type="text" name="alumni_no" class="form-control" ng-model="user.alumni_no" readonly>
                    @if(!Auth::guest())
                        <input type="hidden" name="id" class="form-control" ng-model="user.id">
                    @endif

                </div>
                <div class="row col-md-6" ng-class="{ 'has-error' : !userForm.student_no.$valid  }">
                    <label>Student No</label>
                    <input type="text" name="student_no" class="form-control" ng-model="user.student_no" required
                           autofocus>
                </div>
                <div class="row col-md-6" style="width:56%;" ng-class="{ 'has-error' : !userForm.first_name.$valid  }">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" ng-model="user.first_name" required>
                </div>
                <div class="row col-md-3">
                    <label>Middle Name</label>
                    <input type="text" name="name" class="form-control" ng-model="user.middle_name">
                </div>
                <div class="row col-md-8 " style="width:72.5%;"
                     ng-class="{ 'has-error' : !userForm.last_name.$valid  }">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" ng-model="user.last_name" required>
                </div>
                <div class="row col-md-1">
                    <label>Suffix</label>
                    <input type="text" name="suffix_name" class="form-control" ng-model="user.suffix_name">
                </div>
            </div>
            <div class="form-group">
                <div class="row col-md-3" style="width:34%;margin-left:180px;">
                    <label>Civil Status</label>
                    <select class="input-large form-control" ng-model="user.civil_status">
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widow">Widow</option>
                        <option value="Divorsed">Divorsed</option>
                        <option value="Annuled">Annuled</option>
                    </select>
                </div>
                <div class="row col-md-3">
                    <label>Gender</label>
                    <select class="input-large form-control" ng-model="user.gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="row col-md-3" ng-class="{ 'has-error' : !userForm.bday.$valid  }">
                    <label>Date of Birth &nbsp;</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar">
                            </i>
                        </div>
                        <input class="form-control" id="bday" name="bday" placeholder="YYYY-MM-DD" type="text"
                               style="width:100%;" ng-model="user.bday" required/>
                    </div>
                </div>
            </div>
            <div class="form-group " ng-class="{ 'has-error' : !userForm.email.$valid}" ng-model="user.emailDiv"
                 style="width:97.5%;">
                <div class="row col-md-12">
                    <label>Email</label>
                    @if(Auth::guest())
                        <input type="email" name="email" class="form-control" ng-model="user.email" required>
                    @else
                        <input type="email" name="email" class="form-control" ng-model="user.email" required readonly>
                    @endif

                </div>
            </div>

            <div class="form-group">
                <div class="form-group" ng-class="{'has-error':!userForm.password.$valid}">
                    <div class="row col-md-6">
                        <label for="user.password">Password</label>
                        @if(Auth::guest())
                            <input class="form-control" type="password" name="password" required
                                   ng-model="user.password" ng-match="user.passwordConfirm"/>
                        @else
                            <input class="form-control" type="password" name="password" required
                                   ng-model="user.password" ng-match="user.passwordConfirm" readonly/>
                        @endif


                    </div>
                </div>
                <div class="form-group" ng-class="{'has-error':!userForm.passwordConfirm.$valid}">
                    <div class="row col-md-6 ">
                        <label for="user.passwordConfirm">Confirm Password</label>
                        @if(Auth::guest())
                            <input class="form-control" type="password" name="passwordConfirm" required
                                   ng-model="user.passwordConfirm" ng-match="user.password"/>
                        @else
                            <input class="form-control" type="password" name="passwordConfirm" required
                                   ng-model="user.passwordConfirm" ng-match="user.password" readonly/>
                        @endif

                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-6">
                    <label for="user.landline_no">Landline No</label>
                    <input class="form-control" type="text" name="landline_no" ng-model="user.landline_no"/>
                </div>
                <div class="row col-md-6">
                    <label for="user.cellphone_no">Cellphone No</label>
                    <input class="form-control" type="text" name="cellphone_no" ng-model="user.cellphone_no"/>
                </div>
            </div>
            <div class="form-group">
                <div class="row col-md-6">
                    <label for="user.level">Level</label>
                    <select class="input-large form-control" ng-model="user.level">
                        <option value="Elementary">Elementary</option>
                        <option value="High School">High School</option>
                        <option value="College">College</option>
                    </select>
                </div>
                <div class="row col-md-6">
                    <label for="user.year">Year</label>
                    <select class="input-large form-control" ng-model="user.year">
                        <option value="First Year">First Year</option>
                        <option value="Second Year">Second Year</option>
                        <option value="Third Year">Third Year</option>
                        <option value="Fourth Year">Fourth Year</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="row col-md-6">
                    <label for="user.course">Course</label>
                    <select class="input-large form-control" ng-model="user.course">
                        <option value="BS Mathematics">BS Mathematics</option>
                        <option value="BS Physics">BS Physics</option>
                        <option value="BS Biology">BS Biology</option>
                        <option value="BS Chemistry">BS Chemistry</option>
                        <option value="BS Marine Biology/Science">BS Marine Biology/Science</option>
                    </select>
                </div>
                <div class="row col-md-6">
                    <label for="user.major">Major</label>

                    <select class="input-large form-control" ng-model="user.major">
                        <option value="Artificial Intelligence">Artificial Intelligence</option>
                        <option value="Calculus">Calculus</option>
                        <option value="Computer Architecture">Computer Architecture</option>
                        <option value="Data Management">Data Management</option>
                        <option value="Information Management">Information Management</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="row col-md-12" style="width:97%;">
                    <label for="user.motto">Motto in Life</label>
                    <input class="form-control" type="text" name="motto" ng-model="user.motto"/>
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-10">
                    <label for="user.password">Father</label>
                    <input class="form-control" type="text" name="father" ng-model="user.father"/>
                </div>
                <div class="row col-md-2">
                    <label for="user.passwordCompare">Is Paulinian?</label>
                    <input class="col-md-8 md" type="checkbox" name="is_father_paulinian"
                           ng-model="user.is_father_paulinian"/>
                </div>
            </div>
            <div class="form-group">
                <div class="row col-md-6">
                    <label for="user.father_occupation">Occupation</label>
                    <input class="form-control" type="text" name="father_occupation" ng-model="user.father_occupation"/>
                </div>
                <div class="row col-md-6">
                    <label for="user.father_office">Office</label>
                    <input class="form-control" type="text" name="father_office" ng-model="user.father_office"/>
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-10">
                    <label for="user.mother">Mother</label>
                    <input class="form-control" type="text" name="mother" ng-model="user.mother"/>
                </div>
                <div class="row col-md-2">
                    <label for="user.is_mother_paulinian">Is Paulinian?</label>
                    <input class="col-md-8 md" type="checkbox" name="is_mother_paulinian"
                           ng-model="user.is_mother_paulinian"/>
                </div>
            </div>
            <div class="form-group">
                <div class="row col-md-6">
                    <label for="user.mother_occupation">Occupation</label>
                    <input class="form-control" type="text" name="mother_occupation" ng-model="user.mother_occupation"/>
                </div>

                <div class="row col-md-6">
                    <label for="user.mother_office">Office</label>
                    <input class="form-control" type="text" name="mother_office" ng-model="user.mother_office"/>

                </div>
                <div class="row col-md-12 text-center" style="margin-bottom:40px;">
                    <br>
                    @if(Auth::guest())
                        <div class="btn-group">
                            <a href="" class="btn btn-default pull-left" ng-click="doBack()">Back</a>
                            <a href="" class="btn btn-primary pull-right" ng-click="selectPersonalActivitiesTab(pane1)">Next</a>
                        </div>

                    @else
                        <div class="btn-group ">
                            <a href="#" class="btn btn-default" ng-click="doBack()">Back</a>
                            <a href="#" class="btn btn-warning" ng-disabled="userForm.$invalid"
                               ng-click="updateUser(userForm.$valid)">Update</a>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>


</div>


<!-- USERNAME -->
<!--   <div class="form-group" ng-class="{ 'has-error' : !userForm.username.$valid }">
      <div class="row col-md-4">
        <label>Username</label>
        <input type="text" name="username" class="form-control" ng-model="user.username" ng-minlength="3" ng-maxlength="100" required>
        <p ng-show="userForm.username.$error.required" class="help-block">Your username is required.</p>
        <p ng-show="userForm.username.$error.minlength" class="help-block">Username is too short.</p>
        <p ng-show="userForm.username.$error.maxlength" class="help-block">Username is too long.</p>
      </div>

  </div> -->
        
        
       

       

        