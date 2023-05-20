@extends('dashboard.layouts.master')

@section('content')
    @if (auth()->user()->isAdmin())
        <section>
            <div class="container-fluid">
                <div class="row" style="margin-top: 5rem">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-shield"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Administrator Accounts</span>
                                <span class="info-box-number">
                                    {{ $adminCount }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-user"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">User Accounts</span>
                                <span class="info-box-number">{{ $userCount }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Courses</span>
                                <span class="info-box-number">{{ $courseCount }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bullhorn"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Announcements</span>
                                <span class="info-box-number">{{ $announcementCount }} /
                                    {{ $activeAnnouncementCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-dark text-light" style="padding: 24.4vh 0 24.4vh 0rem;margin-top: 3rem">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Carousel indicators -->
                        <ol class="carousel-indicators" style="margin-bottom:-5rem">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item active text-center">
                                <h2 class="mx-auto">User Management <span class="ml-2"><i class="fas fa-user"></i></span>
                                </h2>
                                <p class="testimonial mx-auto">This slide can take you to the page where you can manage all
                                    the
                                    users on the application.</p>
                                <a href="{{ route('dashboard.users.index') }}"><button class="btn btn-dark">Manage
                                        Users</button></a>
                            </div>
                            <div class="carousel-item text-center">
                                <h2 class="mx-auto">Course Management <span class="ml-2"><i
                                            class="fas fa-book"></i></span>
                                </h2>
                                <p class="testimonial mx-auto">This slide can take you to the page where you can manage all
                                    the
                                    courses on the application.</p>
                                <a href="{{ route('dashboard.courses.index') }}"><button class="btn btn-dark">Manage
                                        Courses</button></a>
                            </div>
                            <div class="carousel-item text-center">
                                <h2 class="mx-auto">Announcement Management <span class="ml-2"><i
                                            class="fas fa-bullhorn"></i></span></h2>
                                <p class="testimonial mx-auto">This slide can take you to the page where you can manage all
                                    the
                                    announcements on the application.</p>
                                <a href="{{ route('dashboard.announcements.index') }}"><button class="btn btn-dark">Manage
                                        Announcements</button></a>
                            </div>
                        </div>
                        <!-- Carousel controls -->
                        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if (auth()->user()->isUser())
        <section>
            <div class="container-fluid">
                <div class="row" style="margin-top: 5rem">
                    <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center align-items-center mb-4 mb-md-0">
                        <a href="#">
                            <span
                                class="info-box-icon rounded-circle p-3 bg-primary elevation-1 d-flex justify-content-center align-items-center"
                                style="width: 100px; height: 100px;">
                                <i class="fas fa-comment fa-3x"></i>
                            </span>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center align-items-center mb-4 mb-md-0">
                        <a href="{{ route('dashboard.profile.index') }}">
                            <span
                                class="info-box-icon rounded-circle p-3 bg-secondary elevation-1 d-flex justify-content-center align-items-center"
                                style="width: 100px; height: 100px;">
                                <i class="fas fa-user fa-3x"></i>
                            </span>
                        </a>
                    </div>
                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center align-items-center mb-4 mb-md-0">
                        <a href="{{ route('dashboard.courses.index') }}">
                            <span
                                class="info-box-icon rounded-circle p-3 bg-success elevation-1 d-flex justify-content-center align-items-center"
                                style="width: 100px; height: 100px;">
                                <i class="fas fa-book fa-3x"></i>
                            </span>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center align-items-center">
                        <a href="{{ route('dashboard.announcements.index') }}">
                            <span
                                class="info-box-icon rounded-circle p-3 bg-danger elevation-1 d-flex justify-content-center align-items-center"
                                style="width: 100px; height: 100px;">
                                <i class="fas fa-bullhorn fa-3x"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-dark text-light" style="padding: 24.4vh 0 24.4vh 0rem;margin-top: 3rem">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Carousel indicators -->
                        <ol class="carousel-indicators" style="margin-bottom:-5rem">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                            <li data-target="#myCarousel" data-slide-to="4"></li>
                        </ol>
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            @foreach ($latestAnnouncements as $announcement)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }} text-center">
                                    <h2 class="mx-auto">{{ $announcement->title }}</h2>
                                    <p class="testimonial mx-auto">{{ $announcement->body }}</p>
                                    <a href="{{ route('dashboard.announcements.show', $announcement->id) }}"><button
                                            class="btn btn-dark">Check this
                                            Announcement</button></a>
                                </div>
                            @endforeach
                        </div>
                        <!-- Carousel controls -->
                        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

{{-- <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Monthly Recap Report</h5>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                            <i class="fas fa-wrench"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                                            <a href="#" class="dropdown-item">Action</a>
                                            <a href="#" class="dropdown-item">Another action</a>
                                            <a href="#" class="dropdown-item">Something else here</a>
                                            <a class="dropdown-divider"></a>
                                            <a href="#" class="dropdown-item">Separated link</a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="text-center">
                                            <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                        </p>

                                        <div class="chart">
                                            <!-- Sales Chart Canvas -->
                                            <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                                        </div>
                                        <!-- /.chart-responsive -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-4">
                                        <p class="text-center">
                                            <strong>Goal Completion</strong>
                                        </p>

                                        <div class="progress-group">
                                            Add Products to Cart
                                            <span class="float-right"><b>160</b>/200</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-primary" style="width: 80%"></div>
                                            </div>
                                        </div>
                                        <!-- /.progress-group -->

                                        <div class="progress-group">
                                            Complete Purchase
                                            <span class="float-right"><b>310</b>/400</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-danger" style="width: 75%"></div>
                                            </div>
                                        </div>

                                        <!-- /.progress-group -->
                                        <div class="progress-group">
                                            <span class="progress-text">Visit Premium Page</span>
                                            <span class="float-right"><b>480</b>/800</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" style="width: 60%"></div>
                                            </div>
                                        </div>

                                        <!-- /.progress-group -->
                                        <div class="progress-group">
                                            Send Inquiries
                                            <span class="float-right"><b>250</b>/500</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-warning" style="width: 50%"></div>
                                            </div>
                                        </div>
                                        <!-- /.progress-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- ./card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-3 col-6">
                                        <div class="description-block border-right">
                                            <span class="description-percentage text-success"><i
                                                    class="fas fa-caret-up"></i> 17%</span>
                                            <h5 class="description-header">$35,210.43</h5>
                                            <span class="description-text">TOTAL REVENUE</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">
                                        <div class="description-block border-right">
                                            <span class="description-percentage text-warning"><i
                                                    class="fas fa-caret-left"></i> 0%</span>
                                            <h5 class="description-header">$10,390.90</h5>
                                            <span class="description-text">TOTAL COST</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">
                                        <div class="description-block border-right">
                                            <span class="description-percentage text-success"><i
                                                    class="fas fa-caret-up"></i> 20%</span>
                                            <h5 class="description-header">$24,813.53</h5>
                                            <span class="description-text">TOTAL PROFIT</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">
                                        <div class="description-block">
                                            <span class="description-percentage text-danger"><i
                                                    class="fas fa-caret-down"></i> 18%</span>
                                            <h5 class="description-header">1200</h5>
                                            <span class="description-text">GOAL COMPLETIONS</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div> --}}
