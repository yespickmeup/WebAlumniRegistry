<div class="row col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="form-group">
                <input type="button" class="btn btn-default pull-right" value="New" ng-click="clearMember()"/>
                <br>
            </div>

        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="row col-md-12">
                    <div class="row col-sm-9">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name" ng-model="member.name"/>
                    </div>
                    <div class="row col-sm-3 pull-right">
                        <label for="relation">Relation</label>
                        <input class="form-control" type="text" name="relation" id="relation"
                               ng-model="member.relation"/>
                    </div>
                </div>
                <div class="row col-md-12">
                    <label for="name_before_married">Name before married</label>
                    <input class="form-control" type="text" name="name_before_married" id="name_before_married"
                           ng-model="member.before_married"/>
                    <label for="inputInvolvement">Residence Address</label>
                    <input class="form-control" type="text" name="residence" id="residence"
                           ng-model="member.residence"/>
                    <label for="inputInvolvement">Occupation</label>
                    <input class="form-control" type="text" name="occupation" id="occupation"
                           ng-model="member.occupation"/>
                    <label for="inputInvolvement">Office Address</label>
                    <input class="form-control" type="text" name="office" id="office"
                           ng-model="member.office"/>
                    <br>

                </div>

                <a href="" ng-show="showMemberAdd" ng-click="addMember()" class="btn btn-sm btn-primary ">
                    <i class="glyphicon glyphicon-plus">
                    </i> Add
                </a>
                <a href="" ng-show="showMemberUpdate" ng-click="updateMember()" class="btn btn-sm btn-primary ">
                    <i class="glyphicon glyphicon-refresh">
                    </i> Save
                </a>
            </div>

            <br>
            <table st-table="displayedCollection" st-safe-src="members"
                   class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th st-sort="member.name">Name</th>
                    <th st-sort="member.relation" style="width:50px;">Relation</th>
                    <th st-sort="member.residence">Address</th>
                    <th style="width:30px;"></th>
                    <th style="width:30px;"></th>
                </tr>
                {{-- <tr>
                     <th colspan="5"><input st-search="" class="form-control" placeholder="search ..." type="text"/>
                     </th>
                 </tr>--}}
                </thead>
                <tbody>
                <tr ng-repeat="member in displayedCollection">
                    <td><%member.name%></td>
                    <td><%member.relation%></td>
                    <td><%member.residence%></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-default "
                                ng-click="editMember(member)">
                            <i class="glyphicon glyphicon-edit">
                            </i>
                        </button>
                    </td>
                    <td>
                        <button type="button" ng-click="removeMember(member)"
                                class="btn btn-sm btn-danger pull-right">
                            <i class="glyphicon glyphicon-remove-circle">
                            </i>
                        </button>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5" class="text-center">
                        <div st-pagination="" st-items-by-page="itemsByPage" st-displayed-pages="7"></div>
                    </td>
                </tr>
                </tfoot>
            </table>


            <div class="row col-md-offset-6" style="margin-bottom:40px;">
                <a href="" class="btn btn-success btn-lg" ng-disabled="userForm.$invalid"
                   ng-click="submitForm(userForm.$valid)">Submit</a>
            </div>
        </div>
    </div>
</div>

  