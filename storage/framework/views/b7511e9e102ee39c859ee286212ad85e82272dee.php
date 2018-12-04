<?php $__env->startSection('content'); ?>
    <header id="home" class="masthead">
        <div class="container" id="page-top">
            <div class="intro-text">
                <div class="intro-lead-in">Welcome To IIUC Transport Management Website!</div>
                <div class="intro-heading text-uppercase">It's Nice To Meet You</div>
                <div class="nextBus">
                    <div class="nextBus-info">
                        <table class="table table-responsive-lg">
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
                                        ( Day : <i> <?php echo $today; ?> </i>, Time: <?php echo $now; ?> )
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
                                <td><?php echo $fromRouteM; ?></td>
                                <td><?php echo "IIUC CAMPUS"; ?></td>
                                <td><?php echo $toIIUCMale; ?></td>
                            </tr>

                            <tr>
                                <td><?php echo "IIUC CAMPUS"; ?></td>
                                <td><?php echo $toRouteM; ?></td>
                                <td><?php echo $toCityMale; ?></td>
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
                                <td><?php echo $fromRouteF; ?></td>
                                <td><?php echo "IIUC CAMPUS"; ?></td>
                                <td><?php echo $toIIUCFemale; ?></td>
                            </tr>

                            <tr>
                                <td><?php echo "IIUC CAMPUS"; ?></td>
                                <td><?php echo $toRouteF; ?></td>
                                <td><?php echo $toCityFemale; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Todays Bus Schedule -->
    <section id="about">
        <div id="schedule" class="container">
            <?php if($day!= null): ?>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Today's Bus Schedule</h2>
                        <h3 class="section-subheading text-muted">Here is '<?php echo $day->dayname; ?>' bus schedule</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="timeline">
                            <?php $flagSchedules = 0;$sl = 0;?>
                            <?php $__currentLoopData = $times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php   $schedules = App\Schedule::where('day', $day->id)
                                    ->where('time', $time->id)
                                    ->first(); ?>
                                <?php if($schedules): ?>
                                    <?php $flagSchedules = 1;?>
                                    <li class="<?php echo ($sl+=1)%2 == 0? "timeline-inverted":""; ?>">
                                        <div class="timeline-image">
                                            
                                            <h4><?php echo \Carbon\Carbon::parse(App\Time::where('id',$time->id)->first()->time)->format('g:i A'); ?>

                                                <br>
                                                

                                                <?php $male = App\Schedule::where('day', $day->id)
                                                    ->where('time', $time->id)
                                                    ->where('male', '1')
                                                    ->get();
                                                $female = App\Schedule::where('day', $day->id)
                                                    ->where('time', $time->id)
                                                    ->where('female', '1')
                                                    ->get();?>

                                                <?php echo count($male)? 'Male':''; ?>

                                                <?php if(count($male) && count($female)): ?>
                                                    <?php echo "<br>"; ?>

                                                <?php endif; ?>
                                                <?php echo count($female)? 'Female':''; ?>

                                            </h4>
                                        </div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                
                                                Destination:
                                                <h4>
                                                    <?php $toiiuc = App\Schedule::where('day', $day->id)
                                                        ->where('time', $time->id)
                                                        ->where('toiiuc', '1')
                                                        ->get();
                                                    $fromiiuc = App\Schedule::where('day', $day->id)
                                                        ->where('time', $time->id)
                                                        ->where('fromiiuc', '1')
                                                        ->get();?>
                                                    <?php echo count($toiiuc)? 'To IIUC Campus':''; ?>

                                                    <?php if(count($toiiuc) && count($fromiiuc)): ?>
                                                        <?php echo ","; ?>

                                                    <?php endif; ?>
                                                    <?php echo count($fromiiuc)? 'From IIUC Campus':''; ?>

                                                </h4>
                                                Routes:
                                                <h4 class="subheading">

                                                    
                                                    <?php $routes = App\Schedule::where('day', $day->id)
                                                        ->where('time', $time->id)
                                                        ->get();
                                                    if (count($routes) > 1) {
                                                        $routeFlag = count($routes) - 1;
                                                    } else {
                                                        $routeFlag = 0;
                                                    }?>
                                                    <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo \App\BusRoute::where('id',$route->route)->first()->routename; ?>

                                                        <?php if($routeFlag): ?>
                                                            <?php echo ", "; ?>

                                                        <?php endif; ?>
                                                        <?php $routeFlag -= 1;?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </h4>
                                            </div>
                                            <div class="timeline-body">
                                                
                                                
                                                
                                                
                                            </div>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($flagSchedules == 0): ?>
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
                            <?php endif; ?>

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
            <?php else: ?>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Bus Schedule For Today</h2>
                        <h3 class="section-subheading text-muted">No Bus Today! Sorry For That! </h3>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>


    <!-- Notice Board -->

    <section id="portfolio" class="bg-light">
        <div id="notice" class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase"><?php echo $noticetitle; ?></h2>
                    <h3 class="section-subheading text-muted"><?php echo $description; ?></h3>
                </div>
            </div>

            <div class="row">
                <?php if(count($notices) > 0): ?>
                    <?php $count = 0; ?>
                    <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $count = $count + 1; ?>
                        
                        <div class="col-md-4 col-sm-6 portfolio-item">
                            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal<?php echo $count; ?>">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content">
                                        <i class="fa fa-eye fa-2x">Read Me</i>
                                    </div>
                                </div>
                                <img class="img-fluid" src="/storage/<?php echo $notice->cover_image; ?>"
                                     alt="<?php echo $notice->title; ?>"> </a>
                            <div class="portfolio-caption">
                                <h4><?php echo $notice->title; ?></h4>
                                <small>
                                    <p class="text-muted">
                                        Posted By:
                                        <i>
                                            <?php echo DB::table('admin_users')->where('id', $notice->user_id)->first()->name; ?>

                                        </i><br>
                                        Posted
                                        At: <?php echo \Carbon\Carbon::parse($notice->created_at)->format('l, d-M-Y g:i: A'); ?>

                                    </p>
                                </small>
                            </div>
                        </div>

                        
                        
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <h4>No notices found</h4>
                <?php endif; ?>

            </div>
            <?php echo $notices->links(); ?>

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

                <?php if(count($emergency)>0): ?>
                    <?php $__currentLoopData = $emergency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                        <div class="col-md-4">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-image">
                                        <img class="auto rounded-circle img-fluid"
                                             src="/storage/<?php echo $person->photo?$person->photo:''; ?>"
                                             alt="<?php echo $person->name; ?>">
                                    </div>
                                </li>
                            </ul>
                            <h4 class="service-heading"> <?php echo $person->name; ?> </h4>
                            <p class="text"><i class="fa fa-mobile"></i> <?php echo $person->contact; ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="col-md-4">
                        <h4 class="service-heading">No Person Found</h4>
                    </div>

                <?php endif; ?>
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
                    <?php echo Form :: open(['action'=>'PagesController@report','id'=>'contactForm', 'method' => 'POST',
                    'enctype' => 'multipart/form-data','name'=>'sentMessage', 'novalidate']); ?>

                    <?php echo csrf_field(); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form :: text('name' , '', ['id' => 'name','class' => 'form-control', 'placeholder' => 'Your Name *',
                                   'required','data-validation-required-message'=>'Please enter your your name.']); ?>

                                <p class="help-block text-danger"></p>
                            <!-- <?php if($errors->has('name')): ?>
                                <small class="form-text invalid-feedback"><?php echo $errors->first('name'); ?></small>
                                        <?php endif; ?> -->
                            </div>
                            <div class="form-group">
                                <?php echo Form :: email('email' , '', ['id' => 'email','class' => 'form-control', 'placeholder' => 'Your Email *',
                                           'required','data-validation-required-message'=>'Please enter your email address.']); ?>

                                <p class="help-block text-danger"></p>
                            <!-- <?php if($errors->has('email')): ?>
                                <small class="form-text invalid-feedback"><?php echo $errors->first('email'); ?></small>
                                        <?php endif; ?> -->
                            </div>
                            <div class="form-group">
                                <?php echo Form :: tel('phone' , '', ['id' => 'phone','class' => 'form-control', 'placeholder' => 'Your Phone *',
                                           'required','data-validation-required-message'=>'Please enter your phone number.']); ?>

                                <p class="help-block text-danger"></p>
                            <!-- <?php if($errors->has('phone')): ?>
                                <div class="form-text invalid-feedback"><?php echo $errors->first('phone'); ?></div>
                                        <?php endif; ?> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form :: textarea('message' , '', ['id' => 'message','class' => 'form-control', 'placeholder' => 'Your Message *',
                                'required','data-validation-required-message'=>'Please enter your message.']); ?>

                                <p class="help-block text-danger"></p>
                            <!-- <?php if($errors->has('message')): ?>
                                <small class="form-text invalid-feedback"><?php echo $errors->first('message'); ?></small>
                                        <?php endif; ?> -->
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 text-center">
                            <div id="success">
                                <?php if(Session::has('success_flash_message')): ?>
                                    <div class="alert alert-success">
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                                            &times;
                                        </button>
                                        <strong>
                                            <?php echo Session::get('success_flash_message'); ?>

                                        </strong>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php echo Form :: submit('Send Message',['class' => 'btn btn-primary btn-xl text-uppercase','id'=>'sendMessageButton']); ?>

                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </section>

    <!-- Team -->


    
    <section class="bg-light" id="team">
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

        

        <div id="about-us" class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Supervised By</h2>
                    <h3 class="section-subheading text-muted"> This project is supervised by Mohammed Shamsul
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
    <?php if(count($notices) > 0): ?>
        <?php $count = 0; ?>
        <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $count = $count + 1; ?>
            
            <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $count; ?>" tabindex="-1" role="dialog"
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

                                        <h2 class="text-uppercase"><?php echo $notice->title; ?></h2>
                                        <p class="item-intro text-muted">Posted
                                            By: <?php echo DB::table('admin_users')->where('id', $notice->user_id)->first()->name; ?></p>
                                        <img class="img-fluid d-block mx-auto"
                                             src="/storage/<?php echo $notice->cover_image; ?>"
                                             alt="<?php echo $notice->title; ?>">
                                        <div style="text-align:left;">
                                            <?php echo $notice->body; ?>

                                        </div>
                                        <br><br>
                                        <ul class="list-inline" style="text-align:left;">
                                            <li>
                                                <small>
                                                    Date: <?php echo $notice->created_at; ?>

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
            
            
            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>