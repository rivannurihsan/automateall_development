<?php
if (!isset($_SESSION['isKirim'])) {
  $_SESSION['isKirim'] = 'NotYet';
}
print($_SESSION['isKirim']);
?>

<!-- Modal perubahan pasword terkirim sukses -->
<div class="modal fade message-sent noselect" id="sentLupasPassEmailSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body p-0 text-center">
        <img src="img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
        <p>If the account has been registered, a password change request has been sent to email <?php if (isset($_SESSION['tryLoginEmail'])) {
                                                                                                  echo $_SESSION['tryLoginEmail'];
                                                                                                } ?></p>
        <button type="button" class="btn" data-dismiss="modal">OK</button>
        <img src="/img/vector/ellipse.png" class="img-fluid ellipse" alt="ellipse">
      </div>
    </div>
  </div>
</div>

<?php if (isset($_SESSION['isKirim']) && $_SESSION['isKirim'] == 'LupassSent') { ?>
  <script>
    $(document).ready(function() {
      $('#sentLupasPassEmailSuccessModal').modal('show');
    });
  </script>
<?php } ?>
<!-- Akhir Modal perubahan pasword terkirim sukses -->

<!-- Modal Register Success -->
<div class="modal fade message-sent noselect" id="sentRegisterAkunSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body p-0 text-center">
        <img src="img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
        <p>Thankyou for joining us</p>
        <button type="button" class="btn" data-dismiss="modal">OK</button>
        <img src="/img/vector/ellipse.png" class="img-fluid ellipse" alt="ellipse">
      </div>
    </div>
  </div>
</div>

<?php if (isset($_SESSION['isKirim']) && $_SESSION['isKirim'] == 'RegisterAccountSend') { ?>
  <script>
    $(document).ready(function() {
      $('#sentRegisterAkunSuccessModal').modal('show');
    });
  </script>
<?php } ?>
<!-- Akhir Modal Register Success -->

<!-- Modal Verify Account Success -->
<div class="modal fade message-sent noselect" id="sentVerifyAccountSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body p-0 text-center">
        <img src="img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
        <p>Your account is verified</p>
        <button type="button" class="btn" data-dismiss="modal">OK</button>
        <img src="/img/vector/ellipse.png" class="img-fluid ellipse" alt="ellipse">
      </div>
    </div>
  </div>
</div>

<?php if (isset($_SESSION['isKirim']) && $_SESSION['isKirim'] == 'VerifyAccountSent') { ?>
  <script>
    $(document).ready(function() {
      $('#sentVerifyAccountSuccessModal').modal('show');
    });
  </script>
<?php } ?>
<!-- Akhir Modal Verify Account Success -->

<!-- Modal Verify Account Success -->
<div class="modal fade message-sent noselect" id="sentPassChangedSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body p-0 text-center">
        <img src="img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
        <p>Your password has changed</p>
        <button type="button" class="btn" data-dismiss="modal">OK</button>
        <img src="/img/vector/ellipse.png" class="img-fluid ellipse" alt="ellipse">
      </div>
    </div>
  </div>
</div>

<?php if (isset($_SESSION['isKirim']) && $_SESSION['isKirim'] == 'PasswordResetedSent') { ?>
  <script>
    $(document).ready(function() {
      $('#sentPassChangedSuccessModal').modal('show');
    });
  </script>
<?php } ?>
<!-- Akhir Modal Verify Account Success -->

<!-- Modal Pesan Terkirim -->
<div class="modal fade message-sent noselect" id="sentSuccessPesanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body p-0 text-center">
        <img src="img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
        <p>The message was successfuly sent!</p>
        <button type="button" class="btn" data-dismiss="modal">OK</button>
        <img src="/img/vector/ellipse.png" class="img-fluid ellipse" alt="ellipse">
      </div>
    </div>
  </div>
</div>

<?php if (isset($_SESSION['isKirim']) && $_SESSION['isKirim'] == 'ContactMessageSent') { ?>
  <script>
    $(document).ready(function() {
      $('#sentSuccessPesanModal').modal('show');
    });
  </script>
<?php } ?>
<!-- Akhir Pesan Terkirim -->

<!-- Modal Link Failed -->
<div class="modal fade message-sent noselect" id="sentFailedLinkModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body p-0 text-center">
        <img src="img/vector/cancel.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
        <p>Your link is invalid, it may have expired. Please contact us if there is a problem</p>
        <button type="button" class="btn" data-dismiss="modal">OK</button>
        <img src="/img/vector/ellipse.png" class="img-fluid ellipse" alt="ellipse">
      </div>
    </div>
  </div>
</div>

<?php if (isset($_SESSION['isKirim']) && $_SESSION['isKirim'] == 'ErrorLinkInvalid') { ?>
  <script>
    $(document).ready(function() {
      $('#sentFailedLinkModal').modal('show');
    });
  </script>
<?php } ?>
<!-- Akhir Link Failed -->

<!-- Modal Technical Error -->
<div class="modal fade message-sent noselect" id="sentFailedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body p-0 text-center">
        <img src="img/vector/cancel.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
        <p>Oops, something went wrong, please contact us</p>
        <button type="button" class="btn" data-dismiss="modal">OK</button>
        <img src="/img/vector/ellipse.png" class="img-fluid ellipse" alt="ellipse">
      </div>
    </div>
  </div>
</div>

<?php if (isset($_SESSION['isKirim']) && $_SESSION['isKirim'] == 'ErrorTechMessage') { ?>
  <script>
    $(document).ready(function() {
      $('#sentFailedModal').modal('show');
    });
  </script>
<?php } ?>
<!-- Akhir Modal Technical Error -->

<?php $_SESSION['isKirim'] = 'NotYet';
print($_SESSION['isKirim']);
?>
<!-- Akhir Modal Technical Error -->

<!-- modal daftar -->
<div class="modal fade message-sent noselect" id="modaldaftar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal__wrapper shadow-lg">
      <div class="modal-body p-0 ">
        <div class="row">
          <div class="col">
            <div class="btn__exitModal" class="close" data-dismiss="modal" aria-label="Close">
              <img src="/img/logo/close.svg" />
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
                <input onchange="return(getValue())" type="text" class="form-control input__valueModal" id="name"  onclick="onchangeremoveErrorname()" />
              </div>
              <div class="form-group form-groupModal" id="groupModal__wa">
                <label for="whatsapp" class="input__labelModal">Nomor whatsapp</label>
                <input onchange="return(getValue())" name="noHp" type="text" class="form-control input__valueModal" id="whatsapp"  onclick="onchangeremoveErrorwa()" />
              </div>
              <div class="form-group form-groupModal" id="groupModal__institusi">
                <label for="institusi" class="input__labelModal">Perusahaan / institusi</label>
                <input onchange="return(getValue())" type="text" class="form-control input__valueModal" id="institusi"  onclick="onchangeremoveErrorinstitusi()" />
              </div>
              <div class="form-group form-groupModal">
                <label for="other" class="input__labelModal">Dari mana saudara mengetahui kegiatan ini</label>
                <br /><small class="small__otherModal">Jika saudara diajak oleh orang lain, harap tulis
                  namanya</small>
                <input onchange="return(getValue())" type="text" class="form-control input__valueModal" id="other"  />
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