<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<?php if ($_SESSION['userData']['nama']=='irfan nugraha') { ?> 
  <a href="/academy/list">
<?php } ?>
<section class="streaming">
  <div class="d-flex">
    <div id="streaming__main">
      <header class="streaming__header clearfix">
        <?php if ($lastestEpisode['isSelesai']) { ?>
          <a href="/onlineCourse/tandaiSelesai?id=<?=$_GET['id']?>&course=<?=$_GET['course']?>&episode=<?= $lastestEpisode['id'] ?>" class="streaming__header-btn" style="pointer-events: none;cursor: default;">Selesai</a>
        <?php }else{ ?>
          <a href="/onlineCourse/tandaiSelesai?id=<?=$_GET['id']?>&course=<?=$_GET['course']?>&episode=<?= $lastestEpisode['id'] ?>" class="streaming__header-btn" id="mark-as-done">Tandai selesai</a>
        <?php } ?>
        <div class="streaming__header-content">
          <h2 class="streaming__header-episode-title">
            <?= $lastestEpisode['judul'] ?>
          </h2>
          <h3 class="streaming__header-section-title">
            Section: <?= $lastestEpisode['judulSection'] ?>
          </h3>
        </div>
      </header>
      <main class="streaming__header-player">
        <iframe class="streaming__header-video"
          src="https://www.youtube.com/embed/<?= $lastestEpisode['linkVideo'] ?>?origin=https://plyr.io&autoplay=1&cc_load_policy=1&rel=0&modestbranding=1&playsinline=1&showinfo=0&enablejsapi=1"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen></iframe>
      </main>
      <a href="<?= $linkMateri ?>" target="_blank"
        class="streaming__btn" id="download">Download Materi
        Kelas</a>
      <a href="<?= $linkTelegram ?>" class="streaming__btn">Bergabung ke Grup</a>
      <a href="#review-course" class="streaming__btn">Berikan Ulasan</a>
      <?php if($isCanDownSertif){ ?>
        <a href="<?= '/onlineCourse/getSertifikat?id='.$_GET['id'].'&course='.$_GET['course'] ?>" target="_blank" class="streaming__btn">Download Sertifikat</a>
      <?php }else{ ?>
        <a href="#" class="streaming__btn" style="pointer-events: none;cursor: default; background-color: grey;">Download Sertifikat</a>
      <?php } ?>
    </div>
    <aside class="streaming__sidebar">
      <div class="clearfix">
        <div class="collapser-btn float-start">
          <div class="short-bar"></div>
        </div>
        <a href="/index.html" class="go-home">Back to home &rarr;</a>
      </div>
      <div class="streaming__videos-list">
        <button class="streaming__intro-button" data-video-id="Mmhv4XRgwiw" style="display: none;">Pengenalan Kelas PDF Automation</button>

        <?php foreach ($section as $key => $value) { ?>
          <button class="accordion__button" type="button">
            <div class="d-flex justify-content-between">
              <h3 class="section-title"><?= $value['judul'] ?></h3>
              <i class="fas fa-plus-circle align-self-center"></i>
            </div>
            <p class="section-total"><?= $value['jumlahEps'] ?> episodes</p>
          </button>
          <div class="accordion__content">
            <ul class="accordion__list">

              <?php foreach ($value['episode'] as $key1 => $value1) { ?>
                <li class="episode-item" data-episode-id=<?= $value1['id'] ?> data-is-done="<?= ($value1['isSelesai'])?'true':'false' ?>" data-video-id="<?= $value1['linkVideo'] ?>">
                  <div class="d-flex">
                    <i class="fas episode-is-done"></i>
                    <div class="episodes">
                      <p class="episodes__title">
                        <?= $value1['judul'] ?>
                      </p>
                      <p class="episodes__duration"><?= $value1['durasi'] ?></p>
                    </div>
                  </div>
                </li>
              <?php } ?>

            </ul>
          </div>
        <?php } ?>

      </div>
    </aside>
  </div>
</section>
<!-- Review Modal -->
<div class="onlinecourse">
  <div class="modal__overlayy" id="review-course">
    <div class="modal__box">
      <a href="#" class="modal__close">&times;</a>
      <div class="modal__heading">Beri Ulasan Kelas</div>
      <p class="modal__heading-secondary">
        PDF Automation using UiPath Studio Pro
      </p>
      <div class="rating__wrapper">
        <div class="star-widget">
          <input form="ulasan" type="radio" name="rate" id="rate-5" value="5" <?= ($rating==5)?'checked':null ?>/>
          <label for="rate-5" class="fas fa-star"></label>
          <input form="ulasan" type="radio" name="rate" id="rate-4" value="4" <?= ($rating==4)?'checked':null ?>/>
          <label for="rate-4" class="fas fa-star"></label>
          <input form="ulasan" type="radio" name="rate" id="rate-3" value="3" <?= ($rating==3)?'checked':null ?>/>
          <label for="rate-3" class="fas fa-star"></label>
          <input form="ulasan" type="radio" name="rate" id="rate-2" value="2" <?= ($rating==2)?'checked':null ?>/>
          <label for="rate-2" class="fas fa-star"></label>
          <input form="ulasan" type="radio" name="rate" id="rate-1" value="1" <?= ($rating==1)?'checked':null ?>/>
          <label for="rate-1" class="fas fa-star"></label>
        </div>
        <form id="ulasan" method="POST" action="/onlineCourse/kirimUlasan?id=<?=$_GET['id']?>&course=<?=$_GET['course']?>">
          <div class="review-text">
            <textarea name="review-desc" cols="40" placeholder="Bagaimana pendapatmu terhadap kelas ini"><?= $ulasan ?></textarea>
          </div>
          <div class="update-btn-container">
            <button type="submit" class="update-btn">Kirim</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  const ourYtParams = "?origin=https://plyr.io&autoplay=1&cc_load_policy=1&rel=0&modestbranding=1&playsinline=1&showinfo=0&enablejsapi=1&showinfo=0";
  
  const rootElement = document.documentElement;
  function strLimiter(cssSelector, maxCharacter) {
    document.querySelectorAll(cssSelector).forEach(function (el) {
      let sentence = el.textContent.trim();
      if (sentence.length > maxCharacter) {
        sentence = sentence.substring(0, maxCharacter) + "...";
        el.textContent = sentence;
      }
    });
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
  // VARIABLES
  const collapser = document.querySelector(".collapser-btn"); // tombol untuk buka tutup sidebar
  const sidebar = document.querySelector(".streaming__sidebar"); // sidebar
  const streamingMain = document.getElementById("streaming__main"); // main, sebelahnya sidebar, hanya untuk memisahkan konten utama dengan sidebar
  const youtubeUrl = "https://www.youtube.com/embed/";
  const mainVideoEl = document.querySelector(".streaming__header-video"); // iframe atau video di tengah
  const introBtnEl = document.querySelector(".streaming__intro-button"); // tombol episode pengenalan kelas
  const videosList = document.querySelector(".streaming__videos-list"); // container di sidebar yang berisikan nama-nama section dan episode
  const sectionEl = document.querySelectorAll(".streaming .accordion__button"); // elemen section yang berupa button dikumpulkan
  const episodeNameEl = document.querySelectorAll(".streaming__videos-list li"); // menangkap elemen tiap episode
  const headerEpisode = document.querySelector(
    ".streaming__header-episode-title"
  ); // nama episode yang berada di header
  const headerSection = document.querySelector(
    ".streaming__header-section-title"
  ); // nama section yang berada di header
  const modalTitle = document.querySelector(".modal__heading-secondary");
  const nextBtnEl = document.getElementById("mark-as-done"); // tombol tandai selesai / next video
  // hanya untuk keperluan css
  const contents = [];
  contents.push(document.querySelector(".go-home"));
  contents.push(document.querySelector(".streaming__videos-list"));

  strLimiter(".section-title", 85);
  bodyStopScrolling("#review-course");
  episodesClickable(episodeNameEl); // buat episode menjadi dapat diklik
  checkDoneVideos(); // tandai video yang telah selesai ditonton di awal
  handleAccordion(sectionEl); // menangani accordion
  highlightAfterRefresh();
  
  const observer = new MutationObserver((changes) => {
    changes.forEach(change => {
      if(change.attributeName.includes('src')){
        setNewMarkLink();
      }
    });
  });
  observer.observe(mainVideoEl, {attributes : true});
  


  function episodesClickable(ElWillBeClicked) {
    introBtnEl.addEventListener("click", function () {
      for (let li of ElWillBeClicked) {
        li.classList.remove("is-selected");
      }
      this.classList.add("is-selected");
      mainVideoEl.src =
        youtubeUrl + this.getAttribute("data-video-id") + ourYtParams;
      headerEpisode.textContent = this.textContent;
    });
    for (let li of ElWillBeClicked) {
      li.addEventListener("click", function (event) {
        introBtnEl.classList.remove("is-selected");
        for (let li of ElWillBeClicked) {
          li.classList.remove("is-selected");
        }
        this.classList.add("is-selected");
        mainVideoEl.src =
          youtubeUrl + this.getAttribute("data-video-id") + ourYtParams;
        headerEpisode.textContent = this.querySelector(
          ".episodes__title"
        ).textContent;
        let sectionTextEl = this.parentElement.parentElement.previousElementSibling.querySelector(
          "h3"
        );
        headerSection.textContent = "Section: " + sectionTextEl.textContent;
      });
    }
  }

  function checkDoneVideos() {
    const allEpisodes = document.querySelectorAll(".episode-item");

    for (let x of allEpisodes) {
      if (x.dataset.isDone === "true" || x.dataset.isDone === "True") {
        x.querySelector("i").classList.add("fa-check-square");
      } else {
        x.querySelector("i").classList.remove("fa-check-square");
      }
    }
  }

  // jika modal tampil ditandai dengan perubahan # pada url, body menjadi tidak dapat discroll
  window.addEventListener("hashchange", function () {
    bodyStopScrolling("#review-course");
  });

  // Event Listener
  collapser.addEventListener("click", () => {
    sidebar.classList.toggle("narrow");
    collapser.classList.toggle("be-left-arrow");
    contents.forEach((el) => {
      if (el.classList.contains("unseen")) {
        setTimeout(function () {
          el.classList.toggle("unseen");
        }, 410);
      } else {
        el.classList.toggle("unseen");
      }
    });
    streamingMain.classList.toggle("large");
    document
      .querySelector(".streaming__header-player")
      .classList.toggle("expanded");
  });

  function handleAccordion(sectionEl) {
    for (let i = 0; i < sectionEl.length; i++) {
      sectionEl[i].addEventListener("click", function () {
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
  }
  
  // ambil videoId main Video
  function getMainId(){
    let mainSrc = mainVideoEl.src.split("?")[0];
    let mainId = mainSrc.substring(mainSrc.lastIndexOf('/')+1);
    return mainId;
  }
    
    // setiap page direfresh, highlight episode yang sedang ditonton dan expand tombol section nya
  function highlightAfterRefresh(){
    let mainId = getMainId();
    episodeNameEl.forEach(eps=>{
      if(eps.dataset.videoId === mainId){
        eps.classList.add("is-selected");
        eps.parentElement.parentElement.previousElementSibling.classList.add("is-open");
        let epsWrapper = eps.parentElement.parentElement;
        if (epsWrapper.style.maxHeight) {
            // accordion terbuka, maka akan ditutup
          epsWrapper.style.maxHeight = null;
        } else {
            // accordion tertutup, maka akan dibuka
          epsWrapper.style.maxHeight = epsWrapper.scrollHeight + "px";
        }
      }  
    });
    setNewMarkLink();
    updateNextButton();      
  }
    
    // perbarui tulisan tombol di atas video
  function updateNextButton(){
    let mainId = getMainId();
    let text = [];
    let final = "";
    let episodesList = document.querySelectorAll(".streaming__videos-list li");
    for(let i = 0;i<episodesList.length;i++){
      if(episodesList[i].dataset.videoId === mainId){
        if(episodesList[i].dataset.isDone==="false"){
          text.push("Tandai Selesai");
        }
        if(episodesList[i+1]){
          text.push("ke Video Selanjutnya");
        } else {
          text = ["Selesai"];
        }
      }
    }
    if(text.length===0){
      text.push("ke Video Selanjutnya");    
    }
    if(text.length===2){
      final = text[0]+" & "+text[1];
    } else {
      final = text[0];
    }
    nextBtnEl.textContent = final;
  }
  
  function setNewMarkLink(){
    let mainId = getMainId();
    let episodeId = "";
    episodeNameEl.forEach(el=>{
      if(el.dataset.videoId === mainId){
        episodeId = el.dataset.episodeId;
      }
    })
    let url = new URL("http:/"+nextBtnEl.getAttribute("href"));
    let searchParam = url.searchParams;
    searchParam.set("episode",episodeId);
    url.search = searchParam.toString();
    let newUrl = url.toString().replace("http:/","");
    nextBtnEl.setAttribute("href",newUrl);
  }
</script>

<?= $this->endSection();?>