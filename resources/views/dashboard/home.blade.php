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
                                class="info-box-icon info-box-icon-hover rounded-circle p-3 bg-primary elevation-1 d-flex justify-content-center align-items-center"
                                style="width: 100px; height: 100px;">
                                <i class="fas fa-comment fa-3x"></i>
                            </span>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center align-items-center mb-4 mb-md-0">
                        <a href="{{ route('dashboard.profile.index') }}">
                            <span
                                class="info-box-icon info-box-icon-hover rounded-circle p-3 bg-secondary elevation-1 d-flex justify-content-center align-items-center"
                                style="width: 100px; height: 100px;">
                                <i class="fas fa-user fa-3x"></i>
                            </span>
                        </a>
                    </div>
                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center align-items-center mb-4 mb-md-0">
                        <a href="{{ route('dashboard.courses.index') }}">
                            <span
                                class="info-box-icon info-box-icon-hover rounded-circle p-3 bg-success elevation-1 d-flex justify-content-center align-items-center"
                                style="width: 100px; height: 100px;">
                                <i class="fas fa-book fa-3x"></i>
                            </span>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center align-items-center">
                        <a href="{{ route('dashboard.announcements.index') }}">
                            <span
                                class="info-box-icon info-box-icon-hover rounded-circle p-3 bg-danger elevation-1 d-flex justify-content-center align-items-center"
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
