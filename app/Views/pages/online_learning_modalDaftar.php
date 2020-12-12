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
                    <div class="form-group form-groupModal" id="groupModal__nama">
                      <label for="name" class="input__labelModal">Nama</label>
                      <input
                        type="text"
                        class="form-control input__valueModal"
                        id="name"
                        placeholder="masukan nama"
                        onclick="onchangeremoveErrorname()"
                      />
                    </div>
                    <div class="form-group form-groupModal" id="groupModal__wa" > 
                      <label for="whatsapp" class="input__labelModal"
                        >Nomor whatsapp</label
                      >
                      <input
                      
                      name="noHp"
                        type="text"
                        class="form-control input__valueModal"
                        id="whatsapp"
                        placeholder="08xxxxxxxxxxx"
                        onclick="onchangeremoveErrorwa()"
                      />
                    </div>
                    <div class="form-group form-groupModal"  id="groupModal__institusi">
                      <label for="institusi" class="input__labelModal"
                        >Perusahaan / institusi</label
                      >
                      <input
                       
                        type="text"
                        class="form-control input__valueModal"
                        id="institusi"
                        placeholder="masukan nama perusahaan / institusi"
                        onclick="onchangeremoveErrorinstitusi()"
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
          if (getName== null || getName == "") {
            // alert("Nama harus diisi terlebih dahulu");
            const formGetMOdal = document.getElementById('groupModal__nama')
            var Nama = document.createElement("p");
            Nama.id= "pNama"
            var textNama = document.createTextNode("Nama harus diisi terlebih dahulu");
            Nama.appendChild(textNama)
            formGetMOdal.appendChild(Nama)
            return false;
          }
          var number=/^[0-9]+$/;
          var getWa = document.forms["myForm"]["whatsapp"].value;
          if (getWa== null || getWa == "") {
            const formGetMOdal = document.getElementById('groupModal__wa')
            var Nomor = document.createElement("p");
            Nomor.id = "pNomor"
            var textNomor = document.createTextNode("nomor wa tidak boleh kosong");
            Nomor.appendChild(textNomor)
            formGetMOdal.appendChild(Nomor)
            return false;
          }
          if(!getWa.match(number)){
            const formGetMOdal = document.getElementById('groupModal__wa')
            var Nomor = document.createElement("p");
            var textNomor = document.createTextNode("nomor wa harus angka");
            Nomor.appendChild(textNomor)
            formGetMOdal.appendChild(Nomor)
            return false;
          }

          var getInstitusi = document.forms["myForm"]["institusi"].value;
          if (getInstitusi== null || getInstitusi == "") {
            const formGetMOdal = document.getElementById('groupModal__institusi')
            var Institusi = document.createElement("p");
            Institusi.id = "pInstitusi"
            var textinstitusi = document.createTextNode("nama intitusi tidak boleh kosong");
            Institusi.appendChild(textinstitusi)
            formGetMOdal.appendChild(Institusi)
            return false;
          }
        }

        function onchangeremoveErrorname(){
          const name = document.getElementById('pNama')
          if(name){
            const groupModal__nama = document.getElementById('groupModal__nama');
            groupModal__nama.removeChild(name)
          }  
        }
        function onchangeremoveErrorwa(){
          const nomor = document.getElementById('pNomor')
            if(nomor){
              const groupModal__nama = document.getElementById('groupModal__wa');
              groupModal__nama.removeChild(nomor)
              console.log(groupModal__nama)
          }
        }
        function onchangeremoveErrorinstitusi(){
          const nomor = document.getElementById('pInstitusi')
            if(nomor){
              const groupModal__nama = document.getElementById('groupModal__institusi');
              groupModal__nama.removeChild(nomor)
          }
        }
      </script>

</div>

<?= $this->endSection(); ?>