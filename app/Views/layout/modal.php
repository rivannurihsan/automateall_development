<?php
if (!isset($_SESSION['isKirim'])) {
  $_SESSION['isKirim'] = 'NotYet';
}
?>

<!-- Modal perubahan pasword terkirim sukses -->
  <div class="modal fade message-sent noselect" id="sentLupasPassEmailSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body p-0 text-center">
          <img src="/img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
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
          <img src="/img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
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

<!-- Modal Register Success -->
  <div class="modal fade message-sent noselect" id="VerifyMessagSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body p-0 text-center">
          <img src="/img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
          <p>Link Verifikasi telah dikirim ke <?php if(isset($_SESSION['userData'])){ echo $_SESSION['userData']['email']; } ?></p>
          <button type="button" class="btn" data-dismiss="modal">OK</button>
          <img src="/img/vector/ellipse.png" class="img-fluid ellipse" alt="ellipse">
        </div>
      </div>
    </div>
  </div>

  <?php if (isset($_SESSION['isKirim']) && $_SESSION['isKirim'] == 'VerifyMessageSend') { ?>
    <script>
      $(document).ready(function() {
        $('#VerifyMessagSuccessModal').modal('show');
      });
    </script>
  <?php } ?>
<!-- Akhir Modal Register Success -->

<!-- Modal Verify Account Success -->
  <div class="modal fade message-sent noselect" id="sentVerifyAccountSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body p-0 text-center">
          <img src="/img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
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
          <img src="/img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
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
          <img src="/img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
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
          <img src="/img/vector/cancel.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
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

<!-- Modal kupon digunakan berhasil -->
  <div class="modal fade message-sent noselect" id="sentSuccessCouponApplied" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body p-0 text-center">
          <img src="/img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
          <p>Kupon Berhasil Digunakan</p>
          <button type="button" class="btn" data-dismiss="modal">OK</button>
          <img src="/img/vector/ellipse.png" class="img-fluid ellipse" alt="ellipse">
        </div>
      </div>
    </div>
  </div>

  <?php if (isset($_SESSION['isKirim']) && $_SESSION['isKirim'] == 'CouponAppliedSend') { ?>
    <script>
      $(document).ready(function() {
        $('#sentSuccessCouponApplied').modal('show');
      });
    </script>
  <?php } ?>
<!-- Akhir kupon digunakan berhasil -->

<!-- Modal daftar Academy berhasil -->
  <div class="modal fade message-sent noselect" id="sentSuccessDaftarAcademyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body p-0 text-center">
          <img src="/img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
          <p>Pendaftaran academy berhasil</p>
          <button type="button" class="btn" data-dismiss="modal">OK</button>
          <img src="/img/vector/ellipse.png" class="img-fluid ellipse" alt="ellipse">
        </div>
      </div>
    </div>
  </div>

  <?php if (isset($_SESSION['isKirim']) && $_SESSION['isKirim'] == 'DaftarAcademySend') { ?>
    <script>
      $(document).ready(function() {
        $('#sentSuccessDaftarAcademyModal').modal('show');
      });
    </script>
  <?php } ?>
<!-- Akhir daftar Academy berhasil -->

<!-- Modal kupon terbuat berhasil -->
  <div class="modal fade message-sent noselect" id="CreateCouponSendSuccess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body p-0 text-center">
          <img src="/img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
          <p>Kupon Telah Dikirim ke Email</p>
          <button type="button" class="btn" data-dismiss="modal">OK</button>
          <img src="/img/vector/ellipse.png" class="img-fluid ellipse" alt="ellipse">
        </div>
      </div>
    </div>
  </div>

  <?php if (isset($_SESSION['isKirim']) && $_SESSION['isKirim'] == 'CreateCouponSend') { ?>
    <script>
      $(document).ready(function() {
        $('#CreateCouponSendSuccess').modal('show');
      });
    </script>
  <?php } ?>
<!-- Akhir kupon terbuat berhasil -->

<!-- Modal checkout sukses berhasil -->
  <div class="modal fade message-sent noselect" id="CreateCheckoutAcademySendFreeSuccess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body p-0 text-center">
          <img src="/img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
          <p>Terimakasih, akan kami verifikasi</p>
          <button type="button" class="btn" data-dismiss="modal">OK</button>
          <img src="/img/vector/ellipse.png" class="img-fluid ellipse" alt="ellipse">
        </div>
      </div>
    </div>
  </div>

  <?php if (isset($_SESSION['isKirim']) && $_SESSION['isKirim'] == 'CheckoutAcademySendFree') { ?>
    <script>
      $(document).ready(function() {
        $('#CreateCheckoutAcademySendFreeSuccess').modal('show');
      });
    </script>
  <?php } ?>
<!-- Akhir checkout sukses berhasil -->

<!-- Modal daftar Course berhasil -->
<div class="modal fade message-sent noselect" id="sentSuccessDaftarCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body p-0 text-center">
          <img src="/img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
          <p>Pendaftaran Course berhasil</p>
          <button type="button" class="btn" data-dismiss="modal">OK</button>
          <img src="/img/vector/ellipse.png" class="img-fluid ellipse" alt="ellipse">
        </div>
      </div>
    </div>
  </div>

  <?php if (isset($_SESSION['isKirim']) && $_SESSION['isKirim'] == 'sendCourseDaftarSuccess') { ?>
    <script>
      $(document).ready(function() {
        $('#sentSuccessDaftarCourseModal').modal('show');
      });
    </script>
  <?php } ?>
<!-- Akhir daftar Course berhasil -->

<!-- Modal Technical Error -->
  <div class="modal fade message-sent noselect" id="sentFailedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body p-0 text-center">
          <img src="/img/vector/cancel.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
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

<?php
  $_SESSION['isKirim'] = 'NotYet';
?>