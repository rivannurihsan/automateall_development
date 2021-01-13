<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="headline">
  <div class="container content">
    <div class="row">
      <div class="col text__checkoutWrapper">
        <h1 class="text__checkout">Checkout</h1>
      </div>
    </div>
    <div class="row content__page" style="margin-top: -20px;">
      <div class="col col-lg-7">
        <div class="content_wrapper">
          <div class="content__texWrapperLeft">
            <p class="content__textLeft">Kategori</p>
            <p class="content__textLeft" style="margin-top: -5px;">Nama Kegiatan</p>
          </div>

          <div class="content__texWrapper">
            <p class="content__textRight">: workshop</p>
            <p class="content__textRight" style="margin-top: -5px;">: <?= $namaKegiatan ?></p>
          </div>
        </div>
        <div>
          <p class="content__textLeft" style="margin-top: -5px;">Bayarkan melalui</p>
        </div>
        <div class="row d-flex flex-column">
          <div class="col d-flex justify-content-center align-items-center">
            <div class="imgLogoOvo mr-3">
              <img src="/img/onlineCourse/logo/logo_ovo.png" class="mr-3 img-fluid" />
            </div>
            <div class="imgLogoDana mr-3">
              <img src="/img/onlineCourse/logo/logo_dana.png" class="mr-3 img-fluid " />
            </div>
            <div class="imgLogoShope">
              <img src="/img/onlineCourse/logo/logo_shopePay.png" class="img-fluid " />
            </div>

          </div>
          <div class="col text_anWrapper d-flex justify-content-center align-items-center">
            <p class="text_an">a.n Automate All <span class="text_anSpan">08999-211-425</span>
            </p>
          </div>
        </div>
        <div class="content_wrapper" style="margin-top: -20px;">
          <div class="content__texWrapperLeft">
            <p class="content__textLeft">Bayar sebelum</p>
            <p class="content__textLeft" style="margin-top: -5px;">Kode Kupon</p>
          </div>
          <div class="content__texWrapper">
            <p class="content__textRight">: <?=$maxBayar?> </p>
          </div>
        </div>
        <div class="formKode__wrapper">
        <?php if (!isset($keterangan)) { ?>
          <form class="formKode" method="POST" action="<?= (isset($code))?base_url('/academy/delCoupon?id='.$_GET['id']):base_url('/academy/useCoupon?id='.$_GET['id']) ?>">
        <?php } ?>

            <?php if(!isset($code) && !isset($keterangan)){?>
              <input class="inputForm <?= ($validation->hasError('code'))?'is-invalid':''; ?>" id="code" name="code" placeholder="kode" value="<?= old('code');?>"/>
            <?php }else{?>
              <input class="inputForm" id="code" name="code" placeholder="kode" value="<?= $code ?>" readonly/>
            <?php } ?>

            <?php if (!isset($keterangan)) { ?>
              <button class="submitForm" type="submit"><?= (isset($code))?'Hapus':'Gunakan' ?></button>
            <?php } ?>

            <div class="invalid-feedback">
              <?= $validation->getError('code');?>
            </div>
          </form>
        </div>
        <div class="invalid-feedback">
          <?= $validation->getError('code');?>
        </div>
      </div>
      <div class="col col-lg-5  tabble__wrap">
        <div class="table__wrapper">
          <h1 class="table__summary">Summary</h1>
          <table style="width: 100%; color: #0F4C75;" class="table table-borderless">
            <tr">
              <th width="60%" class="text__th">Harga Tiket</th>
              <td width="40%" class=" text__td">Rp <?= $hargaAwal ?></td>
            </tr>
            <tr>
              <th width="60%" style="line-height: 20px;" class="text__th th__diskon"><span>Diskon</span><span class="text-right">-</span></th>
              <td width=" 40%" style="line-height: 20px;" class=" text__td">Rp <?= $potongan ?></td>
            </tr>
            <tr>
              <th width="60%" style="line-height: 80px;" class="text__thBayar" style="font-weight: 900;">Total Bayar</th>
              <td width="40%" style="line-height: 80px;" class="text__td">Rp <?= $totalHarga ?></td>
            </tr>
          </table>
          <div class="text__buktiWrapper">
              <div class="text__wrapper" <?= (!$isBuktiBayar)?'style="border:0px"':null ?>>
                <?php if (!isset($keterangan)) { ?>
                  <form action="<?=base_url('/academy/checkout?id='.$_GET['id'])?>" name="ajax_form" id="checkout" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <input type="file" name="bukti" id="imageUpload" class="fileBtnHide" accept="image/jpg,image/jpeg,image/png,application/pdf"/>
                  </form>
                <?php } ?>

                <?php if ($isBuktiBayar) { ?>
                  <label for="imageUpload" class="text__bukti">Unggah Bukti Bayar</label>
                <?php } ?>
              </div>
              
              <?php if($validation->getError('bukti')){ ?>
                <h6 class="text__struk" id="filename"><?= $validation->getError('bukti') ?></h6>
              <?php }else { ?>
                <h6 class="text__struk" id="filename"> </h6>
              <?php }?>

              <?php if (isset($keterangan) && $keterangan == 'pengecekan') { ?>
                <button class="btn btn-block btn-primary text-center disabled" disabled>Sedang diverifikasi</button>
              <?php } elseif (isset($keterangan) && $keterangan == 'terverifikasi') { ?>
                <button class="btn btn-block btn-primary text-center disabled" disabled>Terverifikasi</button>
              <?php } else { ?>
                <button form="checkout" type="submit" name="send" class="btn btn-block btn-primary text-center">Proses</button>
              <?php } ?>
          </div>
         <div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- script input file -->
<script>
  document.getElementById('imageUpload').onchange = inputFileOnChange;
    
  function inputFileOnChange() {
      var filename = this.value;
      var lastIndex = filename.lastIndexOf("\\"); 
      if (lastIndex >= 0) {
          filename = filename.substring(lastIndex + 1);
      }
      document.getElementById('filename').innerHTML = filename;
  }
</script>

<?= $this->endSection(); ?>