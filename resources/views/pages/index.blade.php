@extends('layouts.app')
@section('content')

    <header id="home" class="masthead">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in" style="padding:10px 0px;">Welcome To IIUC Transport Website!</div>
                <div class="intro-heading text-uppercase">It's Nice To Meet You</div>
                <div class="nextBus" >
                    <div class="nextBus-info">
                        <table class="table table-responsive-lg">
                            <thead>
                            <td colspan="4">
                                <div class="nextBus-title">
                                    NEXT BUS
                                </div>
                            </td>
                            <tr>
                                <td>Direction</td>
                                <td>Male</td>
                                <td>Female</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td>Towards University</td>
                                <td>12:30 PM</td>
                                <td>01:30 pm</td>
                            </tr>
                            <tr>
                                <td>Towards City</td>
                                <td>09:00 AM</td>
                                <td>08:00 AM</td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Todays Bus Schedule -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 id="schedule" class="section-heading text-uppercase">Today's Bus Schedule</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image">
                                <img class="rounded-circle img-fluid" src="/storage/img/about/1.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>2009-2011</h4>
                                    <h4 class="subheading">Our Humble Beginnings</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt
                                        ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam,
                                        recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium
                                        consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="rounded-circle img-fluid" src="/storage/img/about/2.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>March 2011</h4>
                                    <h4 class="subheading">An Agency is Born</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt
                                        ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam,
                                        recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium
                                        consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image">
                                <img class="rounded-circle img-fluid" src="/storage/img/about/3.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>December 2012</h4>
                                    <h4 class="subheading">Transition to Full Service</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt
                                        ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam,
                                        recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium
                                        consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="rounded-circle img-fluid" src="/storage/img/about/4.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>July 2014</h4>
                                    <h4 class="subheading">Phase Two Expansion</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt
                                        ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam,
                                        recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium
                                        consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <h4>Be Part
                                    <br>
                                    Of Our
                                    <br>
                                    Story!
                                </h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <!-- Notice Board -->

    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 id="notice" class="section-heading text-uppercase">{{$noticetitle}}</h2>
                    <h3 class="section-subheading text-muted">{{$description}}</h3>
                </div>
            </div>

            <div class="row">
                @if(count($notices) > 0)
                    <?php $count = 0; ?>
                    @foreach($notices as $notice)
                        <?php $count = $count + 1; ?>
                        @if($count<=12)
                            <div class="col-md-4 col-sm-6 portfolio-item">
                                <a class="portfolio-link" data-toggle="modal" href="#portfolioModal{{$count}}">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content">
                                            <i class="fa fa-plus fa-3x"></i>
                                        </div>
                                    </div>
                                    <img class="img-fluid" src="/storage/cover_images/{{$notice->cover_image}}"
                                         alt="{{$notice->title}}"> </a>
                                <div class="portfolio-caption">
                                    <h4>{{$notice->title}}</h4>
                                    <p class="text-muted">    
                                    By:
                                    <i> 
                                        {{DB::table('admin_users')->where('id', $notice->user_id)->first()->name}}
                                    </i><br>
                                    At: {{$notice->created_at}}
                                    </p>
                                </div>
                            </div>

                        @else
                            @break
                        @endif
                    @endforeach
                @else
                    <h4>No notices found</h4>
                @endif
            </div>
        </div>
    </section>


    <!-- Emergency Contact -->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 id="services" class="section-heading text-uppercase">Emergency Contact</h2>
                    <h3 class="section-subheading text-muted">Feel Free To Contact With Us</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
            </span>
                    <h4 class="service-heading">Md. Iqbal</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam
                        architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
            </span>
                    <h4 class="service-heading">Md. Habib</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam
                        architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
            </span>
                    <h4 class="service-heading">Md. Shabuj</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam
                        architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Team -->



    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 id="about" class="section-heading text-uppercase">Our Amazing Developers</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <!-- <div class="col-sm-6">
                <div class="team-member">
                    <img class="mx-auto rounded-circle" src="/storage/img/team/3.jpg" alt=""></img>
                    <h4>Mohammed Shamsul Alam </h4>
                    <p class="text-muted">Supervisor</p>
                    <ul class="list-inline social-buttons">
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="team-member">
                    <img class="mx-auto rounded-circle" src="/storage/img/team/3.jpg" alt=""></img>
                    <h4>Soyeb Chowdhury </h4>
                    <p class="text-muted">Co-Supervisor</p>
                    <ul class="list-inline social-buttons">
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div> -->
            <div class="col-sm-6">
                <div class="team-member">
                    <img class="mx-auto rounded-circle" src="/storage/img/team/1.jpg" alt="Towfiqul Islam">
                    <h4>Towfiqul Islam</h4><span>Dept. of CSE, IIUC</span>
                    <p class="text-muted">Full-Stack Developer</p>
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
                    <img class="mx-auto rounded-circle" src="/storage/img/team/2.jpg" alt="Sina Ibn Amin">
                    <h4>Sina Ibn Amin </h4><span>Dept. of CSE, IIUC</span>
                    <p class="text-muted">UI/UX Designer</p>
                    <ul class="list-inline social-buttons">
                        <li class="list-inline-item">
                            <a href="http://twitter.com/TowfiqIslam">
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
                            <a href="http://www.linkedin.com/in/towfiq106/">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <p class="large text-muted">
                This project is developed to automate the transport management system and to reduce hassles
                    regarding transportation. This version is an early release and is being observed to
                    improve the facilities.<br>If you have any query, don't hesitate to contact:<br>
                    <b>info@itms.com || itms@gmail.com</b>
                </p>
            </div>
        </div>

    </section>

    <!-- Clients -->

    <section class="py-5">
        <!-- <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="/storage/img/logos/envato.jpg" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="/storage/img/logos/designmodo.jpg" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="/storage/img/logos/themeforest.jpg" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="/storage/img/logos/creative-market.jpg" alt="">
                    </a>
                </div>
            </div>
        </div> -->
    </section>


    <!-- Contact -->

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Report A Problem</h2>
                    <h3 class="section-subheading text-muted">You can complain us through this message box</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form id="contactForm" name="sentMessage" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" id="name" type="text" placeholder="Your Name *" required
                                           data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="email" type="email" placeholder="Your Email *"
                                           required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="phone" type="tel" placeholder="Your Phone *"
                                           required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" id="message" placeholder="Your Message *" required
                                              data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase"
                                        type="submit">Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>



    <!-- Portfolio Modals -->

    <!-- Modal 1 -->
    @if(count($notices) > 0)
        <?php $count = 0; ?>
        @foreach($notices as $notice)
            <?php $count = $count + 1; ?>
            @if($count<=12)
                <div class="portfolio-modal modal fade" id="portfolioModal{{$count}}" tabindex="-1" role="dialog"
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
                                    <div class="col-lg-8 mx-auto">
                                        <div class="modal-body">

                                            <!-- Project Details Go Here -->

                                            <h2 class="text-uppercase">{{$notice->title}}</h2>
                                            <p class="item-intro text-muted">Posted
                                                By: {{DB::table('admin_users')->where('id', $notice->user_id)->first()->name}}</p>
                                            <img class="img-fluid d-block mx-auto"
                                                 src="/storage/cover_images/{{$notice->cover_image}}"
                                                 alt="{{$notice->title}}">
                                            <p>{{$notice->body}}</p>
                                            <ul class="list-inline">
                                                <li>Date: {{$notice->created_at}}</li>
                                                {{--<li>Client: Threads</li>--}}
                                                {{--<li>Category: Illustration</li>--}}
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
            @else
                @break
            @endif
        @endforeach
    @endif
@endsection

