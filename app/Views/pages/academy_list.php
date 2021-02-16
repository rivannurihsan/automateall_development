<?= $this->extend('layout/template');?>

<?= $this->section('content');?>

<!-- Carousel Courses -->
<section class="academy noselect">
    <div class="container">
        <div class="row">
            <div class="col text-center academy-list-title">
                <h1>Online Learning</h1>
            </div>
        </div>
	</div>
	<!-- AWAL ONLINE COURSE -->
    <div class="onlinecourse">
		<h2 class="learning__category">Courses</h2>
		<section class="course-home">
			<!--<a href="#edit-profile" class="profile">-->
			<!--	<img src="/img/onlineCourse/vectors/profile.svg" alt="Profile Icon" class="profile__img" />-->
			<!--	<p class="profile__text">Lihat Profile</p>-->
			<!--</a>-->
			<!-- Filtering -->
            <div class="course__filter-wrapper">
                <div class="container">
                    <div class="d-flex justify-content-center flex-column mb-4">
                        <ul class="course__category">
                          <li class="course__filter-by">Category:</li>
                          <li data-category-name="all" class="category-btn category-btn--active">
                            All
						  </li>
						  <?php foreach ($kategori as $key => $value) { ?>
							<li data-category-name="<?= $value ?>" class="category-btn">
								<?= $value ?>
							</li>
						  <?php } ?>
                          <li data-category-name="Mobile Development" class="category-btn">
                            Mobile Development
                          </li>
                        </ul>
                        <ul class="course__category">
                            <li data-price-name="free" class="category-text">Free</li>
                            <li data-price-name="premium" class="category-text category-text--active">Premium
                            </li>
                            <li class="search-box">
                                <input type="text" class="search-box__input" placeholder="Ketikan nama kelas" />
                                <div class="search-box__btn">
                                    <img src="/img/onlineCourse/vectors/magnifier.svg" alt="magnifier" class="magnifier" />
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Akhir Filtering -->

			<!-- My Courses -->
			<div class="my-course">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-3">
							<h2 class="course__heading-secondary">Kelas Kamu.</h2>
						</div>
						<div class="col-4 position-relative">
							<p id="expander">
							Tampilkan semuanya <i class="fas fa-arrow-down"></i>
							</p>
						</div>
					</div>
					<div class="row" id="my-items">
						<?php if(isset($userCourse)){ ?>
							<?php for ($i=0; $i < count($userCourse['nama']); $i++) { ?>
							<div class="col-3 item" data-category="RPA Development" data-price="owned" data-code="RPA001">
								<div class="card card--no-border">
									<div class="my-course__img-wrapper">
										<img src="<?= $userCourse['thumbnail'][$i] ?>" alt="Video Thumbnail"
										class="course__img" />
									</div>
									<div class="card-body">
										<h4 class="my-course__title">
										<?= $userCourse['nama'][$i] ?>
										</h4>
										<h3 class="my-course__episode">
										<?= $userCourse['judul'][$i] ?>
										</h3>
										<p class="my-course__mentor">
										<?= $userCourse['namaInstruktur'][$i] ?>
										<span class="mentor-profession">&#40;<?= $userCourse['deskInstruktur'][$i] ?>&#41;</span>
										</p>
										<p class="my-course__access">
										<img src="/img/onlineCourse/vectors/key.svg" alt="Access Icon" />Akses
										Selamanya
										</p>
										<a href="/onlineCourse/streaming?id=<?= $userCourse['id'][$i] ?>&course=<?= $userCourse['course'][$i] ?>" class="stretched-link"></a>
									</div>
								</div>
							</div>
							<?php } ?>
						<?php } ?>

					</div>
				</div>
			</div>
			<!-- Akhir My Courses -->
			<!-- Next Courses -->
			<div class="next-course">
				<div class="container">
					<div class="row">
					    <div class="col-4">
						    <h2 class="course__heading-secondary">Yuk, Pelajari Lainnya!</h2>
					    </div>
					</div>
					<div class="row" id="next-items">
						<?php for ($i=0; $i < count($course['nama']); $i++) { ?>
							<div class="col-3 item" data-category="<?= $course['kategori'][$i] ?>" data-price="<?= $course['priceTag'][$i] ?>" data-code="<?= $course['id'][$i] ?>">
								<div class="card card--no-border">
									<div class="next-course__img-wrapper">
										<img src="<?= $course['thumbnail'][$i] ?>" alt="Card image cap"
										class="course__img" />
									</div>
									<div class="card-body">
										<h3 class="next-course__title">
										<?= $course['nama'][$i] ?>
										</h3>
										<p class="next-course__mentor">
										<?= $course['namaInstruktur'][$i] ?>
											<span class="mentor-profession">&#40;<?= $course['deskInstruktur'][$i] ?>&#41;</span>
										</p>
										<div class="d-flex justify-content-between flex-wrap next-course__additional">
											<p class="next-course__price"><?= $course['biaya'][$i] ?></p>
											<p class="next-course__access"><?= $course['durasiLangganan'][$i] ?></p>
										</div>
										<a class="stretched-link"></a>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<!-- Akhir Next Courses -->
			<div class="benefit">
				<div class="container">
					<div class="row">
						<h2 class="course__heading-secondary text-center">
							Keuntungan yang akan kamu dapat.
						</h2>
					</div>
				</div>
				<div class="container-fluid">
					<div class="row justify-content-around benefit__content">
						<div class="col-2">
							<div class="benefit__img-wrapper">
								<img src="/img/onlineCourse/vectors/hd.svg" alt="video berkualitas hd" class="benefit__img" />
							</div>
							<h5 class="benefit__text">Kualitas Video HD</h5>
						</div>
						<div class="col-2">
							<div class="benefit__img-wrapper">
								<img src="/img/onlineCourse/vectors/idn.svg" alt="bahasa indonesia" class="benefit__img" />
							</div>
							<h5 class="benefit__text">Bahasa Indonesia</h5>
						</div>
						<div class="col-2">
							<div class="benefit__img-wrapper">
								<img src="/img/onlineCourse/vectors/certificate.svg" alt="sertifikat elektronik"
								class="benefit__img" />
							</div>
							<h5 class="benefit__text">E-Certificate</h5>
						</div>
						<div class="col-2">
							<div class="benefit__img-wrapper">
								<img src="/img/onlineCourse/vectors/group.svg" alt="grup konsultasi" class="benefit__img" />
							</div>
							<h5 class="benefit__text">Grup Konsultasi</h5>
						</div>
						<div class="col-2">
							<div class="benefit__img-wrapper">
								<img src="/img/onlineCourse/vectors/download.svg" alt="downloadable" class="benefit__img" />
							</div>
							<h5 class="benefit__text">Dapat Diunduh</h5>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Profile Modal -->
		<div class="modal__overlayy" id="edit-profile">
			<div class="modal__box">
				<a href="#" class="modal__close">&times;</a>
				<div class="modal__heading">Data diri</div>
				<div class="modal__content">
					<form action="#" method="GET">
						<div class="profile-form__group">
							<label for="nama">Nama</label>
							<input type="text" name="nama" id="nama" value="Irfan Nugraha" placeholder="Nama lengkapmu" required />
						</div>
						<div class="profile-form__group">
							<label for="keahlian">Keahlian</label>
							<input type="text" name="keahlian" id="keahlian" value="Programmer" placeholder="Keahlian terbaikmu"
							required />
						</div>
						<div class="profile-form__group">
							<label for="pekerjaan">Pekerjaan</label>
							<input type="text" name="pekerjaan" id="pekerjaan" value="Co Founder Automate All"
							placeholder="Profesi atau status pendidikanmu" required />
						</div>
						<div class="update-btn-container">
							<button type="submit" class="update-btn">Perbarui</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- AKHIR ONLINE COURSE -->

	<div class="container">
		<div class="row">
            <div class="col text-center academy-list-title">
                <p class="mx-auto">Workshop</p>
            </div>
        </div>
	</div>
	<div class="row online-learning-list">
		<?php for ($i=0; $i < count($workshop['idAcademy']); $i++) { ?>
			<div class="col">
				<div class="card mt-5 mx-auto">
					<img class="card-img-top crop-img" src="<?=$workshop['img'][$i]?>" />
					<div class="card-body">
						<h2 class="card-title"><?=$workshop['judul'][$i]?></h2>
						<div class="card-text">
							<p><span class="price-course">Price: </span><?=$workshop['price'][$i]?></p>
							<div class="detail-course">
								<img src="/img/vector/calendar.png" />
								<p><?=$workshop['tanggal'][$i]?></p>
							</div>
							<div class="detail-course">
								<img src="/img/vector/clock.png" />
								<p><?=$workshop['jammulai'][$i]?> - <?=$workshop['jamselesai'][$i]?> WIB</p>
							</div>
							<div class="detail-course">
								<img src="/img/vector/location.png" />
								<p>Google Meet</p>
							</div>
							<button onclick="location.href='/academy/detail?id=<?=$workshop['idAcademy'][$i]?>&openDaftar=1'" class="btn btn-daftar <?php if($workshop['isSelesai'][$i] || !isset($userdata) || !$workshop['isCanDaftar'][$i]){echo 'disabled" disabled';}else{echo '"';}?>>Daftar</button>
							<p"">
							<button class="btn btn-detail" onclick="location.href='/academy/detail?id=<?=$workshop['idAcademy'][$i]?>'">Detail</button>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</section>

<script>
	"use strict";
	function hide(el) {
		el.style.display = "none";
	}
	function show(el, displayValue) {
		el.style.display = displayValue;
	}
	function strLimiter(cssSelector, maxCharacter) {
		document.querySelectorAll(cssSelector).forEach(function (el) {
			let sentence = el.textContent.trim();
			if (sentence.length > maxCharacter) {
				sentence = sentence.substring(0, maxCharacter) + "...";
				el.textContent = sentence;
			}
		});
	}
	
	const rootElement = document.documentElement;

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
	const myCourseEl = document.getElementById("my-items");
	const nextCourseEl = document.getElementById("next-items");
	const myCourseQty = myCourseEl.querySelectorAll(".item").length;
	const nextCourseQty = nextCourseEl.querySelectorAll(".item").length;
	const expanderEl = document.getElementById("expander");
	let category = "all";
	let price = "premium";
	let expanded = false;
	let [myHiddenCourseQty, nextHiddenCourseQty] = [0, 0];

	// EXECUTE FUNCTIONS
	strLimiter(".my-course__title", 52);
	strLimiter(".my-course__episode", 38);
	strLimiter(".next-course__title", 56);
	courseFiltering(".category-btn");
	courseFiltering(".category-text");
	bodyStopScrolling("#edit-profile");
	notExistCourse();

	// INITIAL EXECUTION
	// menyembunyikan kursus gratis selanjutnya, menyembunyikan 5 kebawah kursus saya, dan mengatur expander
	document.querySelectorAll(".item[data-price='free']").forEach((el) => hide(el));
		if (document.querySelectorAll(".my-course .item").length > 4) {
			hideMyCourse();
		} else {
			hide(expanderEl);
	}

	// menambahkan href di setiap kursus saya
	<!--myCourseEl.querySelectorAll(".item").forEach((el) => {-->
	<!--	let dataCategory = el.dataset.category;-->
	<!--	let dataCode = el.dataset.code;-->
	<!--	el.querySelector("a").setAttribute(-->
	<!--		"href",-->
	<!--		"streaming.html?category=" + dataCategory + "&code=" + dataCode + ""-->
	<!--	);-->
	<!--});-->

	// menambahkan href di setiap kursus selanjutnya
	nextCourseEl.querySelectorAll(".item").forEach((el) => {
		let dataCategory = el.dataset.category;
		let dataCode = el.dataset.code;
		el.querySelector("a").setAttribute(
			"href",
			"/onlineCourse/detail?category=" + dataCategory + "&id=" + dataCode + ""
		);
	});

	// Event Listener
	expanderEl.addEventListener("click", function () {
	if (expanded === false) {
		expandMyCourse();
		expanderEl.innerHTML = "Sembunyikan sebagian <i class='fas fa-arrow-up'></i>";
		expanded = true;
	} else {
		hideMyCourse();
		expanderEl.innerHTML =
		"Tampilkan semuanya <i class='fas fa-arrow-down'></i>";
		expanded = false;
	}
	});

	window.addEventListener("hashchange", function () {
		bodyStopScrolling("#edit-profile");
	});
	// Declaring Functions
	// menyembunyikan sebagian kursus saya
	function hideMyCourse() {
		myCourseEl
			.querySelectorAll(".item:not([style*='display: none'])")
			.forEach(function (el, index) {
			if (index > 3) {
				hide(el);
			}
			});
	}
	// menampilkan semua kursus saya
	function expandMyCourse() {
		if (category === "all") {
			myCourseEl.querySelectorAll(".item").forEach((el) => {
			show(el, "block");
			});
		} else {
			myCourseEl
			.querySelectorAll(".item[data-category='" + category + "']")
			.forEach((el) => {
				show(el, "block");
			});
		}
	}

	// mengendalikan tombol peng expand kursus saya
	function handleTheExpander() {
		if (
			myCourseEl.querySelectorAll(".item:not([style*='display: none'])").length <=
			4
		) {
			hide(expanderEl);
		} else {
			show(expanderEl, "block");
			if (expanded === false) {
			hideMyCourse();
			}
		}
	}

	// menampilkan tulisan tidak ada kelas
	function notExistCourse() {
		myHiddenCourseQty = myCourseEl.querySelectorAll(
			".item[style*='display: none']"
		).length;
		nextHiddenCourseQty = nextCourseEl.querySelectorAll(
			".item[style*='display: none']"
		).length;
		const notExistInner =
			`<div class="col-12 text-center">
			    <h4 class='course__not-exist'>Maaf, belum ada kelas untuk pilihan tersebut</h4>
			 </div>`;
		let myNotExistEl = myCourseEl.querySelector(".course__not-exist");
		let nextNotExistEl = nextCourseEl.querySelector(".course__not-exist");

		if (myHiddenCourseQty === myCourseQty) {
			if (myNotExistEl) {
				myNotExistEl.remove();
			}
			myCourseEl.insertAdjacentHTML("afterbegin", notExistInner);
		} else if (myHiddenCourseQty !== myCourseQty) {
			if (myNotExistEl) {
				myNotExistEl.remove();
			}
		}

		if (nextHiddenCourseQty === nextCourseQty) {
			if (nextNotExistEl) {
				nextNotExistEl.remove();
			}
			nextCourseEl.insertAdjacentHTML("afterbegin", notExistInner);
		} else if (nextHiddenCourseQty !== nextCourseQty) {
			if (nextNotExistEl) {
				nextNotExistEl.remove();
			}
		}
	}

	// menampilkan kelas berdasarkan filter
	function courseFiltering(cssSelector) {
		document.querySelectorAll(cssSelector).forEach(function (el) {
			el.addEventListener("click", function () {
				const selectorName = cssSelector.replace(/[#.]/g, "");
				document.querySelectorAll(cssSelector).forEach((el) => {
					if (el.classList.contains(`${selectorName}--active`)) {
						el.classList.remove(`${selectorName}--active`);
					}
				});
				el.classList.add(`${selectorName}--active`);
				if (cssSelector.includes("btn")) {
					category = el.dataset.categoryName;
				} else {
					price = el.dataset.priceName;
				}

				const eachCourses = document.querySelectorAll(".item");
				let [elDataCategory, elDataPrice] = ["", ""];

				if (category === "all") {
					eachCourses.forEach((el) => {
						elDataCategory = el.dataset.category;
						elDataPrice = el.dataset.price;
						if (elDataPrice === price || elDataPrice === "owned") {
							show(el, "block");
						} else {
							hide(el);
						}
					});
					handleTheExpander();
					notExistCourse();
				} else {
					eachCourses.forEach((el) => {
						elDataCategory = el.dataset.category;
						elDataPrice = el.dataset.price;
						if (elDataCategory === category && elDataPrice === price) {
							show(el, "block");
						} else if (elDataCategory === category && elDataPrice === "owned") {
							show(el, "block");
						} else {
							hide(el);
						}
					});
					handleTheExpander();
					notExistCourse();
				}
			});
		});
	}
</script>
<?= $this->endSection();?>