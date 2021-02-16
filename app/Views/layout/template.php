<!doctype html>
<html lang="en" prefix="og: http://ogp.me/ns#">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="title" content="Automate All">
    <meta name="description" content="Automate All adalah Startup yang menyediakan produk serta layanan Jasa Automasi On Demand, khususnya di bidang Robotic Process Automation yang dapat memudahkan pekerjaan harian mu. Maksimalkan Pekerjaanmu bersama Automate All!">
    <meta name="keywords" content="RPA, Automation, Bot, Startup, Business, Learning">
    <meta name="author" content="Automate All Developer Team">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Open Graph / Facebook -->
    <meta property="og:site_name" content="Automate All">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://automateall.id/">
    <meta property="og:title" content="Automate All">
    <meta property="og:description" content="Automate All adalah Startup yang menyediakan produk serta layanan Jasa Automasi On Demand, khususnya di bidang Robotic Process Automation yang dapat memudahkan pekerjaan harian mu. Maksimalkan Pekerjaanmu bersama Automate All!">
    <meta property="og:image" content="https://automateall.id/img/vector/automateall-meta.jpg">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="750">
    <meta property="og:image:height" content="690">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://automateall.id/">
    <meta property="twitter:title" content="Automate All">
    <meta property="twitter:description" content="Automate All adalah Startup yang menyediakan produk serta layanan Jasa Automasi On Demand, khususnya di bidang Robotic Process Automation yang dapat memudahkan pekerjaan harian mu. Maksimalkan Pekerjaanmu bersama Automate All!">
    <meta property="twitter:image" content="https://automateall.id/img/vector/automateall-meta.jpg">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css?v=1.4.4">
    <!-- style online-learning -->
    <!-- <link rel="stylesheet" href="/css/online_learning/checkout.css"> -->
    

    <!-- Automate All CSS -->
    <!-- <link rel="stylesheet" href="/css/production/automateall-min.css"> -->
    <link rel="stylesheet" href="/css/development/automateall-dev.css?v=1.4.4">
    <link rel="stylesheet" href="/css/development/modal.css?v=1.4.4">
    
    <!-- Signup Stylesheet-->
    <link rel="stylesheet" href="/css/development/signup.css?v=1.4.4">

    <!-- Academy Stylesheet -->
    <!-- <link rel="stylesheet" href="/css/development/academy_list_new.css"> -->

    <!-- Academy Detail Stylesheet -->
    <!-- <link rel="stylesheet" href="/css/development/academy_detail_new.css"> -->

    <!-- Login Stylesheet -->
    <link rel="stylesheet" href="/css/development/login.css?v=1.4.4">

    <!-- Font Awsome CSS -->
    <!-- <link rel="stylesheet" href="/css/all.css"> -->
    

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Biryani:wght@600;700;800;900&family=Varela&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link rel="shortcut icon" href="/img/vector/small-logo-16.jpg">
    <link rel="shortcut icon" href="/img/vector/small-logo-32.jpg">

    <!-- sal css -->
    <link rel="stylesheet" href="/css/sal.css?v=1.4.4">
    
    <!--Google Adsense-->
    <script data-ad-client="ca-pub-7173084639393935" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <title><?= $title;?></title>

</head>
<?php if (isset($isNotIncFooter) && isset($isNotIncFooter) && (!$isNotIncFooter) && (!$isNotIncFooter) ) {
    $isLogres = 1; 
}
?>

<body <?php if(isset($isLogres)) {echo 'style="background-color: var(--primary-color); background-image: linear-gradient(90deg, var(--primary-color), #0b3754)"';} ?> >
    <!-- JS from jQuery, Popper, Bootstrap, and Font Awesome -->
    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/popper.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- <script src="/js/all.js"></script> -->
    <script src="https://kit.fontawesome.com/011069fc2a.js" crossorigin="anonymous"></script>
	
	<?php 
        if(!isset($isLogres)) {
            // echo $this->include('pages/coba');
            echo $this->include('layout/navbar');
    }?>

	<?= $this->renderSection('content');?>

    <?php 
        if(!isset($isLogres)) {
            echo $this->include('layout/footer');
    }?>
    
    <?php echo $this->include('layout/modal');?>
	
	<!-- My Javascript -->
    <script src="/js/automateall.js"></script>

    <!-- sal js script -->
    <script src="/js/sal.js"></script>
    <script src="/js/validasi.js"></script>

    <script>
        sal({
            threshold: 0.6
        });
    </script>
    
    <!-- Google Adsense -->
    <script data-ad-client="ca-pub-4201353082637569" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</body>
</html>

	