<?php $__env->startSection('content'); ?>

    <header id="home" class="masthead">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in" style="padding:10px 0px;">Welcome To IIUC Transport Website!</div>
                <div class="intro-heading text-uppercase">It's Nice To Meet You</div>
                <div class="nextBus">
                    <div class="nextBus-info">
                        <table class="table table-responsive-lg">
                            <thead>
                            <tr><td colspan="4">
                                <div class="nextBus-title">
                                    NEXT BUS ( Today :  <?php echo e(\Carbon\Carbon::now()->format('l')); ?>)
                                </div>
                            </td></tr>

                            <tr>
                                <td>Station From</td>
                                <td>Station To</td>
                                <td>Time</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr><td colspan="4">
                                    <div class="nextBus-title" style="text-align: left;">
                                        <i>MALE</i>
                                    </div>
                                </td></tr>
                            <tr>
                                <td><?php echo e($fromRouteM); ?></td>
                                <td><?php echo e("IIUC CAMPUS"); ?></td>
                                <td><?php echo e($toIIUCMale); ?></td>
                            </tr>

                            <tr>
                                <td><?php echo e("IIUC CAMPUS"); ?></td>
                                <td><?php echo e($toRouteM); ?></td>
                                <td><?php echo e($toCityMale); ?></td>
                            </tr>
                            <tr><td colspan="4">
                                    <div class="nextBus-title" style="text-align: left;">
                                        <i>FEMALE</i>
                                    </div>
                                </td></tr>
                            <tr>
                                <td><?php echo e($fromRouteF); ?></td>
                                <td><?php echo e("IIUC CAMPUS"); ?></td>
                                <td><?php echo e($toIIUCFemale); ?></td>
                            </tr>

                            <tr>
                                <td><?php echo e("IIUC CAMPUS"); ?></td>
                                <td><?php echo e($toRouteF); ?></td>
                                <td><?php echo e($toCityFemale); ?></td>
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
                    <h3 class="section-subheading text-muted">Here is today's bus schedule</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image">
                                <!-- <img class="rounded-circle img-fluid" src="/storage/img/about/1.jpg" alt=""> -->
                                <h4>12:30 pm<br>AK KHAN<br>FEMALE</h4>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    
                                    
                                </div>
                                <div class="timeline-body">
                                    
                                        
                                        
                                        
                                </div>
                            </div>
                        </li>

                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <h4>Have a
                                    <br>
                                    Safe
                                    <br>
                                    Journey<br>
                                    :)
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
                    <h2 id="notice" class="section-heading text-uppercase"><?php echo e($noticetitle); ?></h2>
                    <h3 class="section-subheading text-muted"><?php echo e($description); ?></h3>
                </div>
            </div>

            <div class="row">
                <?php if(count($notices) > 0): ?>
                    <?php $count = 0; ?>
                    <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $count = $count + 1; ?>
                        
                        <div class="col-md-3 col-md-3 portfolio-item">
                            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal<?php echo e($count); ?>">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content">
                                        <i class="fa fa-plus fa-3x"></i>
                                    </div>
                                </div>
                                <img class="img-fluid" src="/storage/cover_images/<?php echo e($notice->cover_image); ?>"
                                     alt="<?php echo e($notice->title); ?>"> </a>
                            <div class="portfolio-caption">
                                <h4><?php echo e($notice->title); ?></h4>
                                <small>
                                    <p class="text-muted">
                                        Posted By:
                                        <i>
                                            <?php echo e(DB::table('admin_users')->where('id', $notice->user_id)->first()->name); ?>

                                        </i><br>
                                        Posted At: <?php echo e($notice->created_at); ?>

                                    </p>
                                </small>
                            </div>
                        </div>

                        
                        
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <h4>No notices found</h4>
                <?php endif; ?>

            </div>
            <?php echo e($notices->links()); ?>

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
              <i class="fa fa-headphones fa-stack-1x fa-inverse"></i>
            </span>
                    <h4 class="service-heading">Md. Iqbal</h4>
                    <p class="text-muted"><i class="fa fa-mobile"></i> +8801824979830</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-headphones fa-stack-1x fa-inverse"></i>
            </span>
                    <h4 class="service-heading">Md. Habib</h4>
                    <p class="text-muted"><i class="fa fa-mobile"></i> +8801843471983</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-headphones fa-stack-1x fa-inverse"></i>
            </span>
                    <h4 class="service-heading">Md. Shabuj</h4>
                    <p class="text-muted"><i class="fa fa-mobile"></i> +8801861642510</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Team -->



    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 id="about" class="section-heading text-uppercase">Developed By</h2>
                    <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
                </div>
            </div>

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
    <?php if(count($notices) > 0): ?>
        <?php $count = 0; ?>
        <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $count = $count + 1; ?>
            
            <div class="portfolio-modal modal fade" id="portfolioModal<?php echo e($count); ?>" tabindex="-1" role="dialog"
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

                                        <h2 class="text-uppercase"><?php echo $notice->title; ?></h2>
                                        <p class="item-intro text-muted">Posted
                                            By: <?php echo DB::table('admin_users')->where('id', $notice->user_id)->first()->name; ?></p>
                                        <img class="img-fluid d-block mx-auto"
                                             src="/storage/cover_images/<?php echo $notice->cover_image; ?>"
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


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>