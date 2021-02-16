<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<div class="onlinecourse">
  <section class="course-detail">
    <div class="course-detail__highlight">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-7">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="/academy/list">Courses</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"></li>
              </ol>
            </nav>
            <h1 class="course-detail__title">
              <?= $nama ?>
            </h1>
            <h3 class="course-detail__short-desc">
              <?= $deskripsiSingkat ?>
            </h3>
            <p class="course-detail__mentor">
              Pengajar :
              <span class="course-detail__mentor-name"><?= $namaInstruktur ?></span>
              <span class="course-detail__mentor-profession">&#40;<?= $keteranganInstruktur ?>&#41;</span>
            </p>
            <span class="course-detail__updated"><img src="/img/onlineCourse/vectors/update.svg" alt="Update Icon" /> Terakhir
              diupdate :
              <span class="course-detail__updated-date"><?= $lastUpdate ?></span></span>
          </div>
          <aside class="course-detail__card">
            <a href="#video-introduction" class="course-detail__thumbnail">
              <img src="<?= $introduction['thumbnail'] ?>" alt="Intro Video Thumbnail" class="course__img" />
              <img src="/img/onlineCourse/vectors/play-button.svg" alt="Play Icon" class="course__img-play" />
            </a>
            <div class="course-detail__content">
              <p class="course-detail__price">Rp <?= $biaya ?></p>
              <div class="text-center"> 
                <?php if(!isset($userdata)){ ?>
                  <a href="" class="course-detail__checkout transition-after-page-load" style="pointer-events: none;cursor: default;">
                    Mohon login
                  </a>
                <?php }elseif($isTerdaftar || $isCheckout){ ?>
                  <a href="/checkout?id=<?= $idDaftar ?>" class="course-detail__checkout transition-after-page-load">
                    Checkout
                  </a>
                <?php }else{ ?>
                  <a class="course-detail__checkout transition-after-page-load" href="javascript:{}" onclick="document.getElementById('daftar').submit()">
                    Beli Sekarang
                  </a>
                  <form id="daftar" method="POST" action="/onlineCourse/daftar" style="display: none;">
                    <input value="<?= $id ?>" name='id' readonly>
                    <input value="<?= $kategori ?>" name='category' readonly>
                  </form>
                <?php } ?>
              </div>
              <h3 class="course-detail__info">Kamu akan mendapat</h3>
              <ul class="course-detail__info-list">
                <?php foreach ($mendapatkan as $key => $value) { ?>
                  <li><?= $value ?></li>
                <?php } ?>
              </ul>
              <h3 class="course-detail__info">Tools</h3>
              <ul class="course-detail__info-list">
                <?php foreach ($tools as $key => $value) {?>
                  <li><?= $value ?></li>
                <?php } ?>
              </ul>
              <h3 class="course-detail__info">Sistem Operasi</h3>
              <p class="course-detail__info-text"><?= $OS ?></p>
              <h3 class="course-detail__info">RAM</h3>
              <p class="course-detail__info-text"><?= $RAM ?></p>
              <h3 class="course-detail__info">Storage Kosong</h3>
              <p class="course-detail__info-text"><?= $storage ?></p>
            </div>
          </aside>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-7">
          <h2 class="course-detail__heading-secondary">
            Akan dipelajari di kelas ini
          </h2>
          <ul class="course-detail__target">
            <?php foreach ($mempelajari as $key => $value) { ?>
              <li>
                <span><?= $value ?></span>
              </li>
            <?php } ?>
          </ul>
          <p class="course-detail__show-or-hide" id="target">
            Tampilkan semuanya <i class="fas fa-arrow-down"></i>
          </p>
          <h2 class="course-detail__heading-secondary">Deskripsi Kelas</h2>
          <p class="course-detail__long-desc">
            <?= $deskripsi ?>
          </p>
          <p class="course-detail__show-or-hide" id="longdesc">
            Tampilkan semuanya <i class="fas fa-arrow-down"></i>
          </p>
          <h2 class="course-detail__heading-secondary">Persyaratan</h2>
          <ul class="requirements__list">
            <?php foreach ($persyaratan as $key => $value) { ?>
              <li><?= $value ?></li>
            <?php } ?>
          </ul>
          <h2 class="course-detail__heading-secondary">Materi Kelas</h2>
          <?php foreach ($section as $key => $value) { ?>
            <button class="accordion__button"><?= $value['judul'] ?></button>
            <div class="accordion__content">
              <ol class="accordion__list">
              <?php foreach ($value['episode'] as $key1 => $value1) { ?>
                <li><?= $value1['judul'] ?></li>
              <?php } ?>
              </ol>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>
  <!-- Video Introduction Modal -->
  <div class="modal__overlayy transition-after-page-load" id="video-introduction">
    <div class="modal__box transition-after-page-load">
      <a href="#" class="modal__close">&times;</a>
      <div class="modal__heading">Pengenalan Kelas</div>
      <div class="modal__content">
        <div class="introduction__video-wrapper">
          <iframe data-link="<?= $introduction['video'] ?>" class="introduction__video" width="560"
            height="315" src="" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        </div>
        <h2 class="introduction__title">
          <?= $introduction['nama'] ?>
        </h2>
      </div>
    </div>
  </div>
  <!-- Floating Element -->
  <div class="buy-now">
    <h2 class="buy-now__title"><?= $nama ?></h2>
    <p class="course-detail__price">Rp <?= $biaya ?></p>
    <div class="text-center">
      <?php if(!isset($userdata)){ ?>
        <a href="" class="course-detail__checkout transition-after-page-load" style="pointer-events: none;cursor: default;">
          Mohon login
        </a>
      <?php }elseif($isTerdaftar || $isCheckout){ ?>
        <a href="/onlineCourse/checkout" class="course-detail__checkout transition-after-page-load">
          Checkout
        </a>
      <?php }else{ ?>
        <a class="course-detail__checkout transition-after-page-load" href="javascript:{}" onclick="document.getElementById('daftar1').submit()">
          Beli Sekarang
        </a>
        <form id="daftar1" method="POST" action="/onlineCourse/daftar" style="display: none;">
          <input value="<?= $id ?>" name='id' readonly>
        </form>
      <?php } ?>
    </div>
  </div>
</div>

<script>
  "use strict";
  const ourYtParams = "?origin=https://plyr.io&autoplay=1&cc_load_policy=1&rel=0&modestbranding=1&playsinline=1&showinfo=0&enablejsapi=1&showinfo=0";
  const youtubeUrl = "https://youtube.com/embed/"
  const rootElement = document.documentElement;

  function isOverflown({
    clientWidth,
    clientHeight,
    scrollWidth,
    scrollHeight,
  }) {
    return scrollHeight > clientHeight || scrollWidth > clientWidth;
  }

  // Membuat body tidak dapat discroll karena ada modal yang muncul
  function bodyStopScrolling(cssSelector) {
    // selector css tanpa dot "." atau "#"
    const selectorName = cssSelector.replace(/[#.]/g, "");
    // Body tidak dapat discroll
    if (window.location.hash.indexOf(selectorName) > -1) {
      rootElement.scrollTo({
        top: 0,
        behavior: "smooth",
      });
      document.body.style.overflow = "hidden";
      document.body.style.height = "100vh";
      document.body.style.paddingRight = "17px";
      // Body dapat discroll
    } else {
      setTimeout(function () {
        document.body.style.removeProperty("overflow");
        document.body.style.removeProperty("height");
        document.body.style.removeProperty("padding-right");
      }, 300);
    }
  }

  function handleEarlyTransition() {
    document
      .querySelectorAll(".transition-after-page-load")
      .forEach(function (el) {
        setTimeout(function () {
          el.classList.remove("transition-after-page-load");
        }, 100);
      });
  }

  // VARIABLES
  const detailTargetEl = document.querySelector(".course-detail__target"); // akan dipelajari di kelas ini
  const detailLongdescEl = document.querySelector(".course-detail__long-desc"); // deskripsi kelas
  // tombol untuk menyembunyikan atau mengexpand
  const targetExpander = document.querySelector(
    ".course-detail__show-or-hide#target"
  );
  const longdescExpander = document.querySelector(
    ".course-detail__show-or-hide#longdesc"
  );
  // tombol accordion atau section materi
  const accordionButton = document.getElementsByClassName("accordion__button");
  const youtubeSrc = youtubeUrl+ document.querySelector("iframe.introduction__video").dataset.link + ourYtParams;

  // Calling Functions
  elCanExpand(detailTargetEl, targetExpander, false);
  elCanExpand(detailLongdescEl, longdescExpander, false);
  bodyStopScrolling("#video-introdcution");
  handleEarlyTransition();

  // EXECUTION
  new URLSearchParams(window.location.search).forEach((value, name) => {
    if (name === "category") {
      document.querySelector(".course-detail .active").textContent = value;
    }
  });

  // menangani accordion
  for (let i = 0; i < accordionButton.length; i++) {
    accordionButton[i].addEventListener("click", function () {
      let accordionContent = this.nextElementSibling;
      this.classList.toggle("is-open");
      if (accordionContent.style.maxHeight) {
        // accordion terbuka, maka akan ditutup
        accordionContent.style.maxHeight = null;
      } else {
        // accordion tertutup, maka akan dibuka
        accordionContent.style.maxHeight = accordionContent.scrollHeight + "px";
      }
    });
  }

  // menangani munculnya modal video introduction
  window.addEventListener("hashchange", function () {
    bodyStopScrolling("#video-introduction");
    if (window.location.hash.indexOf("#video-introduction") > -1) {
      document
        .querySelector("iframe.introduction__video")
        .setAttribute("src", youtubeSrc);
    } else {
      document
        .querySelector("iframe.introduction__video")
        .setAttribute("src", "");
    }
  });

  document
    .querySelector("#video-introduction .modal__close")
    .addEventListener("click", function () {
      document
        .querySelector("iframe.introduction__video")
        .setAttribute("src", "");
    });

  // FUNCTIONS
  // menampilkan semua atau menyembunyikan sebagian konten elemen
  function elCanExpand(element, trigger, isExpanded = false) {
    // simpan tinggi awal el
    const initialHeight = getComputedStyle(element).maxHeight;
    // apakah overflow konten nya?
    if (!isOverflown(element)) {
      trigger.parentNode.removeChild(trigger);
      element.classList.toggle("no-before");
    }
    // tambahkan click event pada elemen yang menjadi trigger seperti tombol
    trigger.addEventListener("click", function () {
      if (!isExpanded) {
        element.style.maxHeight = element.scrollHeight + "px";
        trigger.innerHTML =
          "Sembunyikan sebagian <i class='fas fa-arrow-up'></i>";
        isExpanded = true;
      } else {
        element.style.maxHeight = initialHeight;
        trigger.innerHTML =
          "Tampilkan semuanya <i class='fas fa-arrow-down'></i>";
        isExpanded = false;
      }
      // class ini bila ada akan menghilangkan transparan di bagian bawah konten
      element.classList.toggle("no-before");
    });
  }
</script>

<?= $this->endSection();?>