<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="headline" style="margin-top: 150px;">
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" onclick="klik()">
    Launch demo modal
  </button>
  <div class="blur"></div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog__daftar modal-dialog-centered" role="document" id="modalDaftar">
      <div class="modal-content modalContent__daftar">
        <div class="modal-body modal-body__daftar">
          <div class="container">
            <div class="row">
              <div class="col content__pageModal">
                <div class="btn__exitModal">
                  <button id="btn__open-modal-daftar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true" class="btn__exitModal">&times;</span> -->
                    <img src="/img/logo/close.svg"/>
                  </button>
                </div>
                <h5 class="h5__registrasiModal mb-3">
                  Registrasi part 1 - learn to Build Robots
                </h5>
                <h6 class="h6__registrasiModal">
                  Mohon isi data di bawah dengan benar
                </h6>
                <form name="myForm" class="form__modalDaftar" id="form__modalDaftar" onsubmit="return(validateForm())">
                  <div class="form-group form-groupModal" id="groupModal__nama">
                    <label for="name" class="input__labelModal">Nama</label>
                    <input onchange="return(getValue())" type="text" class="form-control input__valueModal" id="name" placeholder="masukan nama" onclick="onchangeremoveErrorname()" />
                  </div>
                  <div class="form-group form-groupModal" id="groupModal__wa">
                    <label for="whatsapp" class="input__labelModal">Nomor whatsapp</label>
                    <input onchange="return(getValue())" name="noHp" type="text" class="form-control input__valueModal" id="whatsapp" placeholder="08xxxxxxxxxxx" onclick="onchangeremoveErrorwa()" />
                  </div>
                  <div class="form-group form-groupModal" id="groupModal__institusi">
                    <label for="institusi" class="input__labelModal">Perusahaan / institusi</label>
                    <input onchange="return(getValue())"  type="text" class="form-control input__valueModal" id="institusi" placeholder="masukan nama perusahaan / institusi" onclick="onchangeremoveErrorinstitusi()" />
                  </div>
                  <div class="form-group form-groupModal">
                    <label for="other" class="input__labelModal">Dari mana saudara mengetahui kegiatan ini</label>
                    <br /><small class="small__otherModal">Jika saudara diajak oleh orang lain, harap tulis
                      namanya</small>
                    <input onchange="return(getValue())" type="text" class="form-control input__valueModal" id="other" placeholder="masukan nama perusahaan / institusi" />
                  </div>

                  <div class="btn__inputWrapperModal">
                    <p class="p__sureModal">
                      pastikan data telah sesuai sebelum melakukan submit
                    </p>
                    <div>
                      <input disabled type="submit" value="Submit" class="btn btn-primary btn__inputModal" id="btn__inputModal" />
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
    

  </script>

</div>

<?= $this->endSection(); ?>