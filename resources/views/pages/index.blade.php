@extends('layouts.app')

@section('content')
    <header id="home" class="masthead ">
        <div class="container home-main" id="page-top">
            <div class="intro-text">
                <div class="intro-lead-in">Welcome To IIUC Transport Management Website!</div>
                <div class="intro-heading text-uppercase">It's Nice To Meet You</div>
                @if($special)
                    <h3 style="color: #8bfc1a">Special Bus Available Today</h3>
                @endif
                @if( $regular && !$holiday  && !$suspend)
                    <div class="nextBus">
                        <div class="nextBus-info">
                            <table class="table table-condensed table-responsive-md">
                                <thead>
                                <tr>
                                    <td colspan="4">
                                        <div class="nextBus-title">
                                            <big>
                                                <marquee behavior="alternate">NEXT BUS</marquee>
                                            </big><br>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <div class="nextBus-time">
                                            ( Day : <i> {!! $today !!} </i>, Time: {!! $now !!} )
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Station From</td>
                                    <td>Station To</td>
                                    <td>Time</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="4">
                                        <marquee behavior="alternate">
                                            <div class="nextBus-gender">
                                                MALE
                                            </div>
                                        </marquee>
                                    </td>
                                </tr>

                                <tr>
                                    <td>{!! $fromRouteM !!}</td>
                                    <td>{!! "IIUC CAMPUS" !!}</td>
                                    <td>{!! $toIIUCMale !!}</td>
                                </tr>

                                <tr>
                                    <td>{!! "IIUC CAMPUS" !!}</td>
                                    <td>{!! $toRouteM !!}</td>
                                    <td>{!! $toCityMale !!}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <marquee behavior="alternate">
                                            <div class="nextBus-gender">
                                                FEMALE
                                            </div>
                                        </marquee>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{!! $fromRouteF !!}</td>
                                    <td>{!! "IIUC CAMPUS" !!}</td>
                                    <td>{!! $toIIUCFemale !!}</td>
                                </tr>

                                <tr>
                                    <td>{!! "IIUC CAMPUS" !!}</td>
                                    <td>{!! $toRouteF !!}</td>
                                    <td>{!! $toCityFemale !!}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </header>

    <!-- Todays Bus Schedule -->
    <section id="about">
        <div id="schedule" class="container">
            @if($holiday == True)
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">It's Vacation Time! Enjoy the vacation.</h2>
                    </div>
                </div>
            @elseif($suspend == True)
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">The Regular Schedule is SUSPENDED!</h2>
                    </div>
                </div>

            @elseif($regular == False)
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Regular Bus Schedule is OFF now.</h2>
                    </div>
                </div>

            @elseif($day!= null && $regular == True && $suspend == False)
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Today's Bus Schedule</h2>
                        <h3 class="section-subheading text-muted">Here is '{!! $day->dayname !!}' bus schedule</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="timeline">
                            <?php $flagSchedules = 0;$sl = 0;?>
                            @foreach($times as $time)
                                <?php
                                $filter = $day->id; 
                                  $schedules = App\Schedule::whereHas('day', function($q) use ($filter) {
                                    $q->where('id', $filter);})
                                    ->where('time', $time->id)
                                    ->first(); ?>
                                @if($schedules)
                                    <?php $flagSchedules = 1;?>
                                    <li class="{!! ($sl+=1)%2 == 0? "timeline-inverted":""!!}">
                                        <div class="timeline-image">
                                            {{-- Time --}}
                                            <h4>{!!\Carbon\Carbon::parse(App\Time::where('id',$time->id)->first()->time)->format('g:i A') !!}
                                                <br>
                                                {{--Gender--}}

                                                <?php
                                                $filter =$day->id; 
                                                $male = App\Schedule::whereHas('day', function($q) use ($filter) {
                                                    $q->where('id', $filter);})
                                                    ->where('time', $time->id)
                                                    ->where('male', '1')
                                                    ->get();
                                                $female = App\Schedule::whereHas('day', function($q) use ($filter) {
                        $q->where('id', $filter);})
                                                    ->where('time', $time->id)
                                                    ->where('female', '1')
                                                    ->get();?>

                                                {!! count($male)? 'Male':'' !!}
                                                @if(count($male) && count($female))
                                                    {!! "<br>" !!}
                                                @endif
                                                {!! count($female)? 'Female':'' !!}
                                            </h4>
                                        </div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                {{--Direction--}}
                                                Destination:
                                                <h4>
                                                    <?php 
                                                    $filter = $day->id;
                                                    $toiiuc = App\Schedule::whereHas('day', function($q) use ($filter) {
                                                        $q->where('id', $filter);})
                                                        ->where('time', $time->id)
                                                        ->where('toiiuc', '1')
                                                        ->get();
                                                    $fromiiuc = App\Schedule::whereHas('day', function($q) use ($filter) {
                        $q->where('id', $filter);})
                                                        ->where('time', $time->id)
                                                        ->where('fromiiuc', '1')
                                                        ->get();?>
                                                    {!! count($toiiuc)? 'To IIUC Campus':'' !!}
                                                    @if(count($toiiuc) && count($fromiiuc))
                                                        {!! "," !!}
                                                    @endif
                                                    {!! count($fromiiuc)? 'From IIUC Campus':'' !!}
                                                </h4>
                                                Routes:
                                                <h4 class="subheading">

                                                    {{--Routes--}}
                                                    <?php 
                                                    $filter = $day->id;
                                                    $routes = App\Schedule::whereHas('day', function($q) use ($filter) {
                                                        $q->where('id', $filter);})
                                                        ->where('time', $time->id)
                                                        ->first();
                                                    $routes = $routes->route;
                                                    if (count($routes) > 0) {
                                                        $routeFlag = count($routes) - 1;
                                                    } else {
                                                        $routeFlag = 0;
                                                    }
                                                    ?>
                                                    
                                                    @foreach($routes as $route)
                                                        {{$route->routename}}    
                                                    @if($routeFlag)
                                                            {!! ", " !!}
                                                        @endif
                                                        <?php $routeFlag -= 1;?>
                                                    @endforeach
                                                </h4>
                                            </div>
                                            <div class="timeline-body">

                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                            @if($flagSchedules == 0)
                                <li class="timeline-inverted">
                                    <div class="timeline-image">
                                        <h4>No
                                            <br>
                                            Bus
                                            <br>
                                            Today
                                        </h4>
                                    </div>
                                </li>
                            @endif

                            <li class="timeline-inverted">
                                <div class="timeline-image">
                                    <h4>Have a
                                        <br>
                                        Safe
                                        <br>
                                        Journey
                                    </h4>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Bus Schedule For Today</h2>
                        <h3 class="section-subheading text-muted">No Bus Today! Sorry For That! </h3>
                    </div>
                </div>
            @endif
        </div>
    </section>


    <!-- Notice Board -->

    <section id="portfolio" class="bg-light">
        <div id="notice" class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">{!! $noticetitle !!}</h2>
                    <h3 class="section-subheading text-muted">{!! $description !!}</h3>
                </div>
            </div>

            <div class="row">
                @if(count($notices) > 0)
                    <?php $count = 0; ?>
                    @foreach($notices as $notice)
                        <?php $count = $count + 1; ?>

                        <div class="col-md-4 col-sm-6 portfolio-item">
                            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal{!! $count !!}">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content">
                                        <i class="fa fa-eye fa-2x">Read Me</i>
                                    </div>
                                </div>
                                <img class="img-fluid" src="/storage/{!! $notice->cover_image !!}"
                                     alt="{!! $notice->title !!}"> </a>
                            <div class="portfolio-caption">
                                <h4>{!! $notice->title !!}</h4>
                                <small>
                                    <p class="text-muted">
                                        {{-- Posted By:
                                        <i>
                                            {!! DB::table('admin_users')->where('id', $notice->user_id)->first()->name !!}
                                        </i><br> --}}
                                        Posted
                                        At: {!!  \Carbon\Carbon::parse($notice->created_at)->format('l, d-M-Y g:i: A') !!}
                                    </p>
                                </small>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4>No notices found</h4>
                @endif

            </div>
            {{-- {!! $notices->links() !!} --}}
        </div>
    </section>


    <!-- Emergency Contact -->

    <section id="services">
        <div id="emergency" class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Emergency Contact</h2>
                    <h3 class="section-subheading text-muted">Feel Free To Contact With Us</h3>
                </div>
            </div>
            <div class="row text-center">

                @if(count($emergency)>0)
                    @foreach ($emergency as $person)


                        <div class="col-md-4">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-image">
                                        <img class="auto rounded-circle img-fluid"
                                             src="/storage/{!! $person->photo?$person->photo:'' !!}"
                                             alt="{!! $person->name !!}">
                                    </div>
                                </li>
                            </ul>
                            <h4 class="service-heading"> {!! $person->name !!} </h4>
                            <p class="text"><i class="fa fa-mobile"></i> {!! $person->contact !!}</p>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-4">
                        <h4 class="service-heading">No Person Found</h4>
                    </div>

                @endif
            </div>
        </div>
    </section>

    <!-- Report -->
    <style>

        .invalid-feedback {
            display: block;
        }

    </style>
    <section id="contact">
        <div id="report" class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Report A Problem</h2>
                    <h3 class="section-subheading text-muted">You can complain us through this message box</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    {!! Form :: open(['action'=>'PagesController@report','id'=>'contactForm', 'method' => 'POST',
                    'enctype' => 'multipart/form-data','name'=>'sentMessage', 'novalidate']) !!}
                    {!! csrf_field()  !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form :: text('name' , '', ['id' => 'name','class' => 'form-control', 'placeholder' => 'Your Name *',
                                   'required','data-validation-required-message'=>'Please enter your your name.']) !!}
                                <p class="help-block text-danger"></p>
                            <!-- @if($errors->has('name'))
                                <small class="form-text invalid-feedback">{!! $errors->first('name')  !!}</small>
                                        @endif -->
                            </div>
                            <div class="form-group">
                                {!! Form :: email('email' , '', ['id' => 'email','class' => 'form-control', 'placeholder' => 'Your Email *',
                                           'required','data-validation-required-message'=>'Please enter your email address.']) !!}
                                <p class="help-block text-danger"></p>
                            <!-- @if($errors->has('email'))
                                <small class="form-text invalid-feedback">{!! $errors->first('email')  !!}</small>
                                        @endif -->
                            </div>
                            <div class="form-group">
                                {!! Form :: tel('phone' , '', ['id' => 'phone','class' => 'form-control', 'placeholder' => 'Your Phone *',
                                           'required','data-validation-required-message'=>'Please enter your phone number.']) !!}
                                <p class="help-block text-danger"></p>
                            <!-- @if($errors->has('phone'))
                                <div class="form-text invalid-feedback">{!! $errors->first('phone')  !!}</div>
                                        @endif -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form :: textarea('message' , '', ['id' => 'message','class' => 'form-control', 'placeholder' => 'Your Message *',
                                'required','data-validation-required-message'=>'Please enter your message.']) !!}
                                <p class="help-block text-danger"></p>
                            <!-- @if($errors->has('message'))
                                <small class="form-text invalid-feedback">{!! $errors->first('message')  !!}</small>
                                        @endif -->
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 text-center">
                            <div id="success">
                                @if(Session::has('success_flash_message'))
                                    <div class="alert alert-success">
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                                            &times;
                                        </button>
                                        <strong>
                                            {!! Session::get('success_flash_message')  !!}
                                        </strong>
                                    </div>
                                @endif
                            </div>
                            {!! Form :: submit('Send Message',['class' => 'btn btn-primary btn-xl text-uppercase','id'=>'sendMessageButton'])  !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Team -->



    <section class="bg-light" id="team">

        {{-- Supervised By --}}

        <div id="about-us" class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Supervised By</h2>
                    <h3 class="section-subheading text-muted"> This project is supervised by Professor Mohammed Shamsul
                        Alam. </h3>
                </div>
            </div>

            <div class="">
                <div class="team-member">
                    <img class="mx-auto rounded-circle responsive" src="/storage/img/team/3.jpg"
                         alt="Mohammed Shamsul Alam">
                    <h4>Mohammed Shamsul Alam</h4>
                    <span>Professor</span><br><span>Dept. of CSE, IIUC</span>
                    <p class="text-muted"></p>
                    <ul class="list-inline social-buttons">

                        <li class="list-inline-item">
                            <a href="https://www.facebook.com/alam.cse/">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>

                        <li class="list-inline-item">
                            <a href="https://www.linkedin.com/in/shamsul-alam-11575257/">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
        <br>
        <br>

        {{-- Developed By --}}
        <div id="about-us" class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Developed By</h2>
                    <h3 class="section-subheading text-muted">The frontend and the backend are designed and coded
                        by </h3>
                </div>
            </div>

            <div class="col-sm-6 responsive">
                <div class="team-member">
                    <img class="mx-auto rounded-circle responsive" src="/storage/img/team/1.jpg" alt="Towfiqul Islam">
                    <h4>Towfiqul Islam</h4><span>Dept. of CSE, IIUC</span>
                    <p class="text-muted">Back-end Developer</p>
                    <ul class="list-inline social-buttons">
                        <li class="list-inline-item">
                            <a href="http://twitter.com/TowfiqIslam">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="http://github.com/laziestcoder">
                                <i class="fa fa-github"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="http://facebook.com/towfiq.106">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="http://www.linkedin.com/in/towfiq106/">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="team-member">
                    <img class="mx-auto rounded-circle responsive" src="/storage/img/team/2.jpg" alt="Sina Ibn Amin">
                    <h4>Sina Ibn Amin </h4><span>Dept. of CSE, IIUC</span>
                    <p class="text-muted">Front-end Developer</p>
                    <ul class="list-inline social-buttons">
                        <li class="list-inline-item">
                            <a href="http://twitter.com/">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="http://github.com/sinaibnamin">
                                <i class="fa fa-github"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="http://www.facebook.com/sinaibnamin">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.linkedin.com/in/sina-ibn-3a7091174/">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <br>
        <br>


        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <p class="large text-muted">
                    This project is developed to automate the transport management system and to reduce hassles
                    regarding transportation.
                </p>
                <p class="large text-muted">
                    This version is an early release and is being observed to
                    improve the facilities.<br>If you have any query, don't hesitate to contact:<br>
                    <b><i class="fa fa-envelope"></i> towfiq.106@gmail.com || <i class="fa fa-envelope"></i>
                        towfiq.projects@gmail.com</b> <br>
                    You can also message us through this website '<b><a class="js-scroll-trigger"
                                                                        style="color: #636b6f; font-weight:bold;text-decoration: none;"
                                                                        href="/#report">Reporting Box</a></b>'.
                </p>
            </div>
        </div>
    </section>

    <!-- Portfolio Modals -->

    <!-- Modal 1 -->
    @if(count($notices) > 0)
        <?php $count = 0; ?>
        @foreach($notices as $notice)
            <?php $count = $count + 1; ?>
            {{--@if($count<=12)--}}
            <div class="portfolio-modal modal fade" id="portfolioModal{!! $count !!}" tabindex="-1" role="dialog"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="close-modal" data-dismiss="modal">
                            <div class="lr">
                                <div class="rl"></div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 mx-auto">
                                    <div class="modal-body">

                                        <!-- Project Details Go Here -->

                                        <h2 class="text-uppercase">{!! $notice->title !!}</h2>
                                        <p><br></p>
                                        <p><br></p>
                                        {{-- <p class="item-intro text-muted">Posted
                                            By: {!! DB::table('admin_users')->where('id', $notice->user_id)->first()->name !!}</p> --}}
                                        <img class="img-fluid d-block mx-auto"
                                             src="/storage/{!! $notice->cover_image !!}"
                                             alt="{!! $notice->title !!}">
                                        <div style="text-align:left;">
                                            {!! $notice->body !!}
                                        </div>
                                        <br><br>
                                        <ul class="list-inline" style="text-align:left;">
                                            <li>
                                                <small>
                                                    Date: {!! $notice->created_at !!}
                                                </small>
                                            </li>
                                        </ul>
                                        <button class="btn btn-primary" data-dismiss="modal" type="button">
                                            <i class="fa fa-times"></i>
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    @endif

@endsection

