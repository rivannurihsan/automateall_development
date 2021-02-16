<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<section class="academy noselect">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h1>Welcome to The Academy!</h1>
                <p>Turn The Dreamer to The Creator</p>
            </div>
        </div>
        <div class="row option justify-content-center">
            <div class="col-xl-3 opt-card">
                <a href="#" onclick="alert('We are working on it, come back later.')">
                    <div class="content-img" style="padding:9px 28px;">
                        <img src="/img/vector/expert.png" alt="RPA Expert">
                    </div>
                    <div class="content-desc text-center">
                        <h2>RPA Expert</h2>
                    </div>
                </a>
            </div>
            <div class="offset-md-1 col-xl-3 opt-card mt-5 mt-md-0">
                <?php if(true){ ?>
                <!--php  if ($_SESSION['userData']['nama']=='Irfan Nugraha' || $_SESSION['userData']['nama']=='Muhammad Alkahfi') { ?> -->
                  <a href="/academy/list">
                <?php }else{ ?>
                  <a href="#" onclick="alert('We are working on it, come back later.')">
                <?php } ?>
                    <div class="content-img" style="padding:42px 15px;">
                        <img src="/img/vector/online.png" alt="Online Course">
                    </div>
                    <div class="content-desc text-center">
                        <h2>Online Learning</h2>
                    </div>
                </a>
            </div>
        </div>

    </div>
</section>


<?= $this->endSection();?>