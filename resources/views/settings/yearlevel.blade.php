




<div class="panel panel-default col-md-6">
    <div class="alert alert-success fade in" ng-show="showUpdateSuccess">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success! </strong>Account <b>[<%userName%>]</b>, successfully approved!
    </div>
    <div class="panel-body">
        <div class="panel-heading"><h2>Level</h2></div>
        <table st-table="displayedCollection2" st-safe-src="levels"
               class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th colspan="10"><input st-search="" class="form-control" placeholder="Search ..."
                                        type="text"/></th>
            </tr>
            <tr>
                <th  st-sort="level.level">Level</th>
                <th style="width:30px;"></th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="level in displayedCollection2">
                <td><%level.level%></td>
                <td >
                    <button type="button" ng-click="deleteUser(user)"
                            class="btn btn-sm btn-danger">
                        <i class="glyphicon glyphicon-remove-sign">
                        </i>
                    </button>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="10" class="text-center">
                    <div st-pagination="" st-items-by-page="itemsByPage2" st-displayed-pages="7"></div>
                </td>
            </tr>
            </tfoot>
        </table>

    </div>
</div>


<div class="panel panel-default col-md-6">
    <div class="alert alert-success fade in" ng-show="showUpdateSuccess">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success! </strong>Account <b>[<%userName%>]</b>, successfully approved!
    </div>
    <div class="panel-body">
        <div class="panel-heading"><h2>Year</h2></div>
        <table st-table="displayedCollection" st-safe-src="years"
               class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th colspan="10"><input st-search="" class="form-control" placeholder="Search ..."
                                        type="text"/></th>
            </tr>
            <tr>
                <th  st-sort="year.year">Year</th>
                <th style="width:30px;"></th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="year in displayedCollection">
                <td><%year.year%></td>
                <td>
                    <button type="button" ng-click="deleteUser(user)"
                            class="btn btn-sm btn-danger">
                        <i class="glyphicon glyphicon-remove-sign">
                        </i>
                    </button>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="10" class="text-center">
                    <div st-pagination="" st-items-by-page="itemsByPage" st-displayed-pages="7"></div>
                </td>
            </tr>
            </tfoot>
        </table>
        <script>
            var myToken = '{{ Session::token() }}';
        </script>
    </div>
</div>



</hr>

