<!doctype html>
<html lang="{{ config('app.locale') }}" ng-app="main-App">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{!! csrf_token() !!}"/>

        <title>Laravel</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->

        <link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap.css') }}">

        <script src="{{ URL::asset('public/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ URL::asset('public/js/bootstrap.min.js') }}"></script>

        <!-- Angular JS -->
        <script src="{{ URL::asset('public/js/angular.min.js') }}"></script>  
        <script src="{{ URL::asset('public/js/dirPagination.js') }}"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="#/">Home</a></li>
                        <li><a href="#/products">Product</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container" id="listing" ng-controller="listing">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h1>Product Management</h1>
                    </div>
                    <div class="pull-right" style="padding-top:30px">
                        <div class="box-tools" style="display:inline-table">
                          <div class="input-group">
                              <input type="text" class="form-control input-sm ng-valid ng-dirty" placeholder="Search" ng-model="search" name="table_search" title="" tooltip="" data-original-title="Min character length is 3">
                              <span class="input-group-addon">Search</span>
                          </div>
                        </div>
                        <button class="btn btn-success" data-toggle="modal" ng-click="createUser()" data-target="#create-user">Create New</button>
                    </div>
                </div>
            </div>


            <table class="table table-bordered pagin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th width="220px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr dir-paginate="value in data|filter:search|itemsPerPage:pageSize " current-page="currentPage">
                        <td>[[ $index + 1 ]] </td>
                        <td>[[ value.name ]]</td>
                        <td>[[ value.detail ]]</td>
                        <td>
                        <button data-toggle="modal" ng-click="edit(value.id)" data-target="#create-user" class="btn btn-primary">Edit</button>
                        <button data-toggle="modal" ng-click="remove(value.id,false)" data-target="#delete-confirm" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <dir-pagination-controls boundary-links="true" class="pull-right" on-page-change="pageChanged(newPageNumber)" template-url="templates/dirPagination.tpl.html" ></dir-pagination-controls>

            <!-- Create Modal -->
            <div class="modal" id="create-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" name="addProduct" id="addProduct" role="form" ng-submit="saveAdd()">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Create Product</h4>
                            </div>
                            <div class="modal-body">
                            
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Name : </strong>
                                        <div class="form-group">
                                            <input type="text" value="[[ name ]]" placeholder="Name" id="product_name" name="product_name" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Details : </strong>
                                        <div class="form-group" >
                                            <textarea  id="product_detail" name="product_detail" class="form-control" required>[[ details ]]
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" ng-disabled="addProduct.$invalid" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <!--<div class="modal fade" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" name="editProduct" role="form" ng-submit="saveEdit()">
                            <input ng-model="form.id" type="hidden" placeholder="Name" name="name" class="form-control" />
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Product</h4>
                        </div>
                        <div class="modal-body">
                          
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                           <input ng-model="form.name" type="text" placeholder="Name" name="name" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                           <textarea ng-model="form.details" class="form-control" required>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" ng-disabled="editProduct.$invalid" class="btn btn-primary create-crud">Submit</button>
                            
                        </div>
                        </form>
                    </div>
                </div>
            </div>-->
            <!--Delete Modal-->
            <div class="modal" id="delete-confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" ng-click="remove(remove_id,true)" class="btn btn-primary">Delete</button>
                            <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->

    </body>
</html>
<script type="text/javascript">
    $.ajaxSetup({
       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    app = angular.module('main-App', ['angularUtils.directives.dirPagination']);
    
    app.config(['$interpolateProvider', function($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    
    app.controller('listing', function ($rootScope, $scope, $http) {
        
        /*FETCHING THE DATA TO DISPLAY*/
        /*END*/
        $scope.clearModalFields = function()
        {
            //$('#'+modalId).find("input,textarea,select").val(' ').end();
            $scope.name    = '';
            $scope.details = '';
        }

        $scope.data = <?= json_encode($listing)?>;
        $scope.currentPage = 1;
        $scope.pageSize = 5;
        
        $scope.saveAdd = function()
        {
            
            if($scope.is_edit)/*code for updating existing product*/
            {
                $.ajax({
                    url: 'list/savenewproducts',
                    type: "POST",
                    data: {'_token' : $('input[name=_token]').val(), 'name':$("#product_name").val(), 'details':$("#product_detail").val(),'edit_id':$scope.edit_id
                    },
                    success: function (data) {
                        
                        $('#create-user').modal('hide');
                        $scope.clearModalFields();
                        $scope.data = data;
                        $scope.$apply($scope.data);
                        
                    }
                });
            }
            else /*code for saving new product*/
            {
                $scope.edit_id = '';
                $.ajax({
                    url: 'list/savenewproducts',
                    type: "POST",
                    data: {'_token' : $('input[name=_token]').val(), 'name':$("#product_name").val(), 'details':$("#product_detail").val(), 'edit_id':$scope.edit_id
                    },
                    success: function (data) {
                        
                        $('#create-user').modal('hide');
                        $scope.clearModalFields();
                        $scope.data = data;
                        $scope.$apply($scope.data);
                        
                    }
                });
            }
        }

        $scope.edit = function(edit_id)
        {
            $scope.editdata = <?= json_encode($edit_listing)?>;

            $scope.name    = $scope.editdata[edit_id].name;
            $scope.details = $scope.editdata[edit_id].detail;
            $scope.is_edit = 1;
            $scope.edit_id = edit_id;
        }

        $scope.createUser = function()
        {
            $scope.clearModalFields();
            $scope.is_edit = 0;
            $scope.edit_id = '';
        }

        $scope.remove = function(remove_id,is_remove)
        {
            $scope.remove_id = remove_id;

            if(is_remove)
            {
                $.ajax({
                    url: 'list/deleteproducts',
                    type: "POST",
                    data: {'id':$scope.remove_id},
                    success: function (data) {
                        $scope.data = data;
                        $scope.$apply($scope.data);
                        
                    }
                });
            }
        }
    });
    /*$('#create-user').on('hidden.bs.modal', function () {

        angular.element('#listing').scope().clearModalFields('create-user');
    })*/
</script>
