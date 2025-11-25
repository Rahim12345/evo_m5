@extends('front.layouts.master')

@section('title')
    Kurslar
@endsection

@section('css')

@endsection

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">@lang('menu.courses')</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">@lang('menu.home')</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">@lang('menu.courses')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Categories Start -->
    <div class="container-xxl py-5 category">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">@lang('menu.courses')</h6>
                <h1 class="mb-5">@lang('static.Courses Categories')</h1>
            </div>
            <div class="row g-3">
                <div class="col-lg-7 col-md-6">
                    <div class="row g-3">
                        @foreach($categories->take(3) as $category)
                            <div class="col-lg-{{ $loop->first ? '12' : '6' }} col-md-12 wow zoomIn"
                                 data-wow-delay="0.1s">
                                <a class="position-relative d-block overflow-hidden" href="">
                                    <img class="img-fluid" src="{{ asset('files/categories/'.$category->src) }}"
                                         alt="{{ $category->alt }}">
                                    <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3"
                                         style="margin: 1px;">
                                        <h5 class="m-0">{{ $category->name }}</h5>
                                        <small class="text-primary">{{ $category->courses_count }} Courses</small>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                    @foreach($categories->skip(3)->take(1) as $category)
                        <a class="position-relative d-block h-100 overflow-hidden" href="">
                            <img class="img-fluid position-absolute w-100 h-100"
                                 src="{{ asset('files/categories/'.$category->src) }}" alt="{{ $category->alt }}"
                                 style="object-fit: cover;">
                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3"
                                 style="margin:  1px;">
                                <h5 class="m-0">{{ $category->name }}</h5>
                                <small class="text-primary">{{ $category->courses_count }} Courses</small>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Categories Start -->


    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">@lang('menu.courses')</h6>
                <h1 class="mb-5">{{ mb_strtoupper(__('static.Popular Courses')) }}</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="course-item bg-light">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid" src="{{ asset('files/courses/'.$course->src) }}"
                                     alt="{{ $course->alt }}">
                            </div>
                            <div class="text-center p-4 pb-0">
                                <h5 class="mb-4">
                                    {{ $course->name }}
                                </h5>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-user-tie text-primary me-2"></i>{{ $course->getTeacher->name }}
                                </small>
                                <small class="flex-fill text-center py-2"><i class="fa fa-list text-primary me-2"></i>
                                    {{ $course->getCategory->name }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Courses End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Instructors</h6>
                <h1 class="mb-5">Expert Instructors</h1>
            </div>
            <div class="row g-4">
                @foreach($instructors as $instructor)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item bg-light">
                            <div class="overflow-hidden">
                                <img class="img-fluid" src="{{ asset('files/instructors/'.$instructor->src) }}"
                                     alt="{{ $instructor->alt }}">
                            </div>
                            <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                                <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i
                                            class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4">
                                <h5 class="mb-0">{{ $instructor->name }}</h5>
                                <small>{{ $instructor->profession }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Team End -->
@endsection

@section('js')

@endsection
