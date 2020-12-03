<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
      Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                  <div class="modal-body">
                        <div class="container">
                              <div class="row">
                                    <div class="col content__page">
                                          <div class="btn__exit">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                </button>
                                          </div>
                                          <h5 class="h5__registrasi mb-3">
                                                Registrasi part 1 - learn to Build Robots
                                          </h5>
                                          <h6 class="h6__registrasi">
                                                Mohon isi data di bawah dengan benar
                                          </h6>
                                          <form name="myForm" onsubmit="return(validateForm())">
                                                <div class="form-group">
                                                      <label for="name" class="input__label">Nama</label>
                                                      <input type="text" class="form-control input__value" id="name" placeholder="masukan nama" />
                                                </div>
                                                <div class="form-group">
                                                      <label for="whatsapp" class="input__label">Nomor whatsapp</label>
                                                      <input type="text" class="form-control input__value" id="whatsapp" placeholder="08xxxxxxxxxxx" />
                                                </div>
                                                <div class="form-group">
                                                      <label for="institusi" class="input__label">Perusahaan / institusi</label>
                                                      <input type="text" class="form-control input__value" id="institusi" placeholder="masukan nama perusahaan / institusi" />
                                                </div>
                                                <div class="form-group">
                                                      <label for="other" class="input__label">Dari mana saudara mengetahui kegiatan ini</label>
                                                      <br /><small class="small__other">Jika saudara diajak oleh orang lain, harap tulis
                                                            namanya</small>
                                                      <input type="text" class="form-control input__value" id="other" placeholder="masukan nama perusahaan / institusi" />
                                                </div>

                                                <div class="btn__inputWrapper">
                                                      <p class="p__sure">
                                                            pastikan data telah sesuai sebelum melakukan submit
                                                      </p>
                                                      <div>
                                                            <input type="submit" value="Submit" class="btn btn-primary btn__input" />
                                                      </div>
                                          </form>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>

<script>
      function validateForm() {
            var getName = document.forms["myForm"]["name"].value;
            if (getName == "") {
                  alert("Nama harus diisi terlebih dahulu");
                  return false;
            }

            var getWa = document.forms["myForm"]["whatsapp"].value;
            if (getWa == "") {
                  alert("Whatsapp harus diisi terlebih dahulu");
                  return false;
            }

            var getName = document.forms["myForm"]["institusi"].value;
            if (getName == "") {
                  alert("institusi harus diisi terlebih dahulu");
                  return false;
            }
      }
</script>

<?= $this->endSection(); ?>