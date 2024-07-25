@extends('layouts.master')
@section('content')

<!-- MAIN CONTENT -->
<div class="panel panel-profile">
    <div class="clearfix">
        <!-- LEFT COLUMN -->
        <div class="profile-left">
            <!-- PROFILE HEADER -->
            <div class="profile-header">
                <div class="overlay"></div>
                <div class="profile-main">
                    <img src="{{asset('assets/img/user-medium.png')}}" class="img-thumbnail" alt="Avatar">
                    <h3 class="name">{{$barang->nama}}</h3>
                </div>
                <div class="profile-stat">
                    <div class="row">
                        <div class="col-md-4 stat-item">
                            {{$barang->ok}} <span>OK</span>
                        </div>
                        <div class="col-md-4 stat-item">
                            {{$barang->us}} <span>U/S</span>
                        </div>
                        <div class="col-md-4 stat-item">
                            {{$barang->ok + $barang->us}} <span>Jumlah</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE HEADER -->
            <!-- PROFILE DETAIL -->
            <div class="profile-detail">
                <div class="profile-info">
                    <h4 class="heading">Basic Info</h4>
                    <ul class="list-unstyled list-justify">
                        <li>Birthdate <span>24 Aug, 2016</span></li>
                        <li>Mobile <span>(124) 823409234</span></li>
                        <li>Email <span>samuel@mydomain.com</span></li>
                        <li>Website <span><a href="https://www.themeineed.com">www.themeineed.com</a></span>
                        </li>
                    </ul>
                </div>
                <div class="text-center">
                    <a href="/inventory/{{$barang->id}}/edit" class="btn btn-primary">
                        Edit Inventory</a>
                </div>
            </div>
            <!-- END PROFILE DETAIL -->
        </div>
        <!-- END LEFT COLUMN -->
        <!-- RIGHT COLUMN -->
        <div class="profile-right">
            <h4 class="heading">History</h4>
            <!-- TABBED CONTENT -->
            <div class="custom-tabs-line tabs-line-bottom left-aligned">
                <ul class="nav" role="tablist">
                    <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Recent
                            Activity</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab-bottom-left1">
                    <ul class="list-unstyled activity-timeline">
                        <li>
                            <i class="fa fa-comment activity-icon"></i>
                            <p>Commented on post <a href="#">Prototyping</a> <span class="timestamp">2
                                    minutes ago</span></p>
                        </li>
                        <li>
                            <i class="fa fa-cloud-upload activity-icon"></i>
                            <p>Uploaded new file <a href="#">Proposal.docx</a> to project <a href="#">New
                                    Year Campaign</a> <span class="timestamp">7 hours ago</span></p>
                        </li>
                        <li>
                            <i class="fa fa-plus activity-icon"></i>
                            <p>Added <a href="#">Martin</a> and <a href="#">3 others colleagues</a> to
                                project repository <span class="timestamp">Yesterday</span></p>
                        </li>
                        <li>
                            <i class="fa fa-check activity-icon"></i>
                            <p>Finished 80% of all <a href="#">assigned tasks</a> <span class="timestamp">1
                                    day ago</span></p>
                        </li>
                    </ul>
                    <div class="margin-top-30 text-center"><a href="#" class="btn btn-default">See all
                            activity</a></div>
                </div>
            </div>
            <!-- END TABBED CONTENT -->
        </div>
        <!-- END RIGHT COLUMN -->
    </div>
</div>
<!-- END MAIN CONTENT -->

@endsection