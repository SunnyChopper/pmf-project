@extends('layouts.app')

@section('content')
	<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Main Dashboard</h2>
                    <button class="au-btn au-btn-icon au-btn--blue">
                        <i class="zmdi zmdi-plus"></i>New Idea</button>
                </div>
            </div>
        </div>

        <div class="row m-t-25">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="overview-item overview-item--c1">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-globe"></i>
                            </div>
                            <div class="text">
                                <h2>249</h2>
                                <span>Total Impressions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="overview-item overview-item--c2">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-account"></i>
                            </div>
                            <div class="text">
                                <h2>23</h2>
                                <span>Total Signups</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="overview-item overview-item--c4">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-apps"></i>
                            </div>
                            <div class="text">
                                <h2>3</h2>
                                <span>Total Landing Pages</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table--no-card m-b-40">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>Starting Date</th>
                                <th>Idea Campaign</th>
                                <th>Landing Pages</th>
                                <th>Impressions</th>
                                <th>Signups</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>August 3rd, 2018</td>
                                <td>Product-Market Fit Software Tool</td>
                                <td>2</td>
                                <td>249</td>
                                <td>23</td>
                                <td><a href="" class="btn btn-warning">Edit</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <p>Copyright © 2018 {{ config('app.name') }}. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                </div>
            </div>
        </div>
    </div>
@endsection