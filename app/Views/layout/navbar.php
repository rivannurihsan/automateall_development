<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('/');?>">
            <img src="/img/logo/autoall.png" alt="Automate All" class="img-fluid" width="1160" height="328">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav d-flex align-items-center text-center">
                <li class="nav-item <?php if($title=='Welcome to Automate All'){echo 'active';}?>">
                    <a class="nav-link" href="<?= base_url('/');?>" title="Home">Home</a>
                </li>
                <li class="nav-item <?php if($title=='Academy' OR $title=='Academy - List' OR $title=='Academy - Detail'){echo 'active';}?>">
                    <a class="nav-link" href="<?= base_url('/academy');?>" title="Academy">Academy</a>
                </li>
                <li class="nav-item <?php if($title=='Products & Services' OR $title=='Detail Product'){echo 'active';}?>">
                    <a class="nav-link" href="<?= base_url('/productsAndServices');?>" title="Products & Services">Products & Services</a>
                </li>
                <li class="nav-item <?php if($title=='Our Main Value'){echo 'active';}?>">
                    <a class="nav-link" href="<?= base_url('/ourMainValue');?>" title="Our Main Value">Our Main Value</a>
                </li>
                <li class="nav-item <?php if($title=='Blog' OR $title=='All Articles' OR $title=='Article Details'){echo 'active';}?>">
                    <a class="nav-link" href="<?= base_url('/blog');?>" title="Blog">Blog</a>
                </li>
                <li class="nav-item <?php if($title=='Contact'){echo 'active';}?>">
                    <a class="nav-link"  href="<?= base_url('/contact');?>" title="Contact">Contact</a>
                </li>
                <li class="nav-item <?php if($title=='Login'){echo 'active';}?>">
                    <?php if(isset($userdata['nama'])){ ?>
                        <div class="dropdown">
                            <a class="nav-link login" data-toggle="dropdown"><?= $userdata['nama'] ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('/logout');?>">Logout</a></li>
                            </ul>
                        </div>
                    <?php }else{ ?>
                        <a class="nav-link login" href="<?= base_url('/login');?>" title="Login">Login</a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Akhir Navbar -->