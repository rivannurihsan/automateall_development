<?= $this->extend('layout/template');?>

<?= $this->section('content');?>

<!-- Carousel Courses -->
<section class="academy noselect">
    <div class="container">
        <div class="row">
            <div class="col text-center academy-list-title">
                <h1>Online Learning</h1>
                <p class="mx-auto">Workshop</p>
            </div>
        </div>
        <div class="row online-learning-list">
            <div class="col">
                <div class="card mt-5 mx-auto">
                    <img class="card-img-top crop-img" src="/img/onlineCourse/Learn%20To%20Build%20Robot.jpg" />
                    <div class="card-body">
                        <h2 class="card-title">Part 1 - Learn to Build Robots</h2>
                        <div class="card-text">
                            <p><span class="price-course">Price: </span> Free</p>
                            <div class="detail-course">
                                <img src="/img/vector/calendar.png" />
                                <p>4 & 5 December 2020</p>
                            </div>
                            <div class="detail-course">
                                <img src="/img/vector/clock.png" />
                                <p>13:00 - 15:00 WIB</p>
                            </div>
                            <div class="detail-course">
                                <img src="/img/vector/location.png" />
                                <p>Google Meet</p>
                            </div>
                            <button class="btn btn-daftar">Daftar</button>
                            <button class="btn btn-detail">Detail</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mt-5 mx-auto">
                    <img class="card-img-top crop-img" src="/img/onlineCourse/Learn%20PDF%20Automation.png" />
                    <div class="card-body">
                        <h2 class="card-title">Part 3 - Learn Excel Automation</h2>
                        <div class="card-text">
                            <p><span class="price-course">Price: </span> Rp. 99.000</p>
                            <div class="detail-course">
                                <img src="/img/vector/calendar.png" />
                                <p>6 December 2020</p>
                            </div>
                            <div class="detail-course">
                                <img src="/img/vector/clock.png" />
                                <p>13:00 - 15:00 WIB</p>
                            </div>
                            <div class="detail-course">
                                <img src="/img/vector/location.png" />
                                <p>Google Meet</p>
                            </div>
                            <button class="btn btn-daftar">Daftar</button>
                            <button class="btn btn-detail">Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>
<!-- Akhir Section Our Services -->
<?= $this->endSection();?>