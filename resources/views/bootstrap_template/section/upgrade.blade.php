@extends('bootstrap_template.layout')

@section('title', 'Upgrade')

@section('titleSection', 'Upgrade')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-header text-center" data-background-color="purple">
                        <h4 class="title">Material Dashboard PRO</h4>
                            <p class="category">Are you looking for more components? Please check our Premium Version of Material Dashboard.</p>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive table-upgrade">
                            <table class="table">
                                <thead>
                                <th></th>
                                <th class="text-center">Free</th>
                                <th class="text-center">PRO</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Components</td>
                                    <td class="text-center">60</td>
                                    <td class="text-center">200</td>
                                </tr>
                                <tr>
                                    <td>Plugins</td>
                                    <td class="text-center">2</td>
                                    <td class="text-center">15</td>
                                </tr>
                                <tr>
                                    <td>Example Pages</td>
                                    <td class="text-center">3</td>
                                    <td class="text-center">27</td>
                                </tr>
                                <tr>
                                    <td>Login, Register, Pricing, Lock Pages</td>
                                    <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fa fa-check text-success"></td>
                                </tr>
                                <tr>
                                    <td>DataTables, VectorMap, SweetAlert, Wizard, jQueryValidation, FullCalendar etc...</td>
                                    <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fa fa-check text-success"></td>
                                </tr>
                                <tr>
                                    <td>Mini Sidebar</td>
                                    <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fa fa-check text-success"></td>
                                </tr>
                                <tr>
                                    <td>Premium Support</td>
                                    <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fa fa-check text-success"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-center">Free</td>
                                    <td class="text-center">Just $49</td>
                                </tr>
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-round btn-fill btn-default disabled">Current Version</a>
                                    </td>
                                    <td class="text-center">
                                        <a target="_blank" href="http://www.creative-tim.com/product/material-dashboard-pro/?ref=md-free-upgrade-archive" class="btn btn-round btn-fill btn-info">Upgrade to PRO</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('functionJavascript')

@endsection