<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale(), false); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="<?php echo e(asset('/vendor/bootstrap/css/bootstrap.css'), false); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/vendor/bootstrap/css/bootstrap.min.css'), false); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('/vendor/bootstrap/css/bootstrap-grid.css'), false); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/vendor/bootstrap/css/bootstrap-grid.min.css'), false); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('/vendor/bootstrap/css/bootstrap-reboot.css'), false); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/vendor/bootstrap/css/bootstrap-reboot.min.css'), false); ?>" rel="stylesheet">

    <link href="<?php echo e(asset ('vendor/font-awesome/css/font-awesome.min.css'), false); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">

    <title><?php echo e(config('app.name', 'ITMS'), false); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css'), false); ?>" rel="stylesheet">
    
    <link href="<?php echo e(asset('css/agency.css'), false); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/agency.min.css'), false); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css'), false); ?>" rel="stylesheet">

    <script src='https://www.google.com/recaptcha/api.js'></script>


</head>
<body>
<div id="app">

<?php echo $__env->make('common.nav', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>
    <footer class="row">
        <?php echo $__env->make('common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </footer>
</div>


<!-- Scripts -->

<script src="<?php echo e(asset('js/app.js'), false); ?>"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('article-ckeditor');
</script>
<?php echo $__env->make('common.script', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>
