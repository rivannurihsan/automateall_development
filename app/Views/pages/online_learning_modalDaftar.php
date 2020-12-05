<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="headline" style="margin-top: 150px;">
<!-- Button trigger modal -->
<button
      type="button"
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#exampleModalCenter"
    >
      Launch demo modal
    </button>
<!-- Modal -->
<div
      class="modal fade"
      id="exampleModalCenter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      
      <div class="modal-dialog modal-dialog__daftar modal-dialog-centered" role="document" id="modalDaftar">
        <div class="modal-content modalContent__daftar">
          <div class="modal-body modal-body__daftar">
            <div class="container">
              <div class="row">
                <div class="col content__pageModal">
                  <div class="btn__exitModal">
                    <button
                      type="button"
                      class="close"
                      data-dismiss="modal"
                      aria-label="Close"
                    >
                      <span aria-hidden="true" class="btn__exitModal">&times;</span>
                    </button>
                  </div>
                  <h5 class="h5__registrasiModal mb-3">
                    Registrasi part 1 - learn to Build Robots
                  </h5>
                  <h6 class="h6__registrasiModal">
                    Mohon isi data di bawah dengan benar
                  </h6>
                  <form name="myForm" class="form__modalDaftar"  onsubmit="return(validateForm())">
                    <div class="form-group form-groupModal">
                      <label for="name" class="input__labelModal">Nama</label>
                      <input
                        type="text"
                        class="form-control input__valueModal"
                        id="name"
                        placeholder="masukan nama"
                      />
                    </div>
                    <div class="form-group form-groupModal">
                      <label for="whatsapp" class="input__labelModal"
                        >Nomor whatsapp</label
                      >
                      <input
                        type="text"
                        class="form-control input__valueModal"
                        id="whatsapp"
                        placeholder="08xxxxxxxxxxx"
                      />
                    </div>
                    <div class="form-group form-groupModal">
                      <label for="institusi" class="input__labelModal"
                        >Perusahaan / institusi</label
                      >
                      <input
                        type="text"
                        class="form-control input__valueModal"
                        id="institusi"
                        placeholder="masukan nama perusahaan / institusi"
                      />
                    </div>
                    <div class="form-group form-groupModal">
                      <label for="other" class="input__labelModal"
                        >Dari mana saudara mengetahui kegiatan ini</label
                      >
                      <br /><small class="small__otherModal"
                        >Jika saudara diajak oleh orang lain, harap tulis
                        namanya</small
                      >
                      <input
                        type="text"
                        class="form-control input__valueModal"
                        id="other"
                        placeholder="masukan nama perusahaan / institusi"
                      />
                    </div>

                    <div class="btn__inputWrapperModal">
                      <p class="p__sureModal">
                        pastikan data telah sesuai sebelum melakukan submit
                      </p>
                      <div>
                          <input
                          type="submit"
                          value="Submit"
                          class="btn btn-primary btn__inputModal"
                        />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <script>
        $(document).ready(function () {
            $('#modalDaftar').modal('show');
        }); -->
    </script>
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

</div>

<?= $this->endSection(); ?>