@extends('layouts.app')

@section('content')
	<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Main Dashboard</h2>
                    @if(count($ideas) != 0)
                    <a href="/dashboard/idea/create"><button class="au-btn au-btn-icon au-btn--blue"><i class="zmdi zmdi-plus"></i>New Idea</button></a>
                    @endif
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
                                <h2>{{ $stats_array["impressions"] }}</h2>
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
                                <h2>{{ $stats_array["signups"] }}</h2>
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
                                <h2>{{ $stats_array["landing_pages"] }}</h2>
                                <span>Total Landing Pages</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if(count($ideas) != 0)
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table--no-card m-b-40">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>Created On</th>
                                <th>Idea Campaign</th>
                                <th>Landing Pages</th>
                                <th>Impressions</th>
                                <th>Signups</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ideas as $idea)
                                <tr>
                                    <td>{{ $idea->created_at->format('F d, Y') }}</td>
                                    <td>{{ $idea->name }}</td>
                                    <td>{{ $idea->landing_pages }}</td>
                                    <td>{{ $idea->impressions }}</td>
                                    <td>{{ $idea->signups }}</td>
                                    <td><a href="/dashboard/idea/edit/{{ $idea->id }}" class="btn btn-warning">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="well">
                    <h3 class="text-center">Seems like you haven't tested any ideas yet. Click below to get started.</h3>
                    <div class="row">
                        <div class="col-lg-2 offset-lg-5">
                            <a href="/dashboard/idea/create" class="btn btn-primary center-button mt-16">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @include('layouts.footer')
    </div>
@endsection

@section('public_js')
    <script type="text/javascript">
        $(document).ready(function() {
            window.location.reload(true);
        });
    </script>
@endsection