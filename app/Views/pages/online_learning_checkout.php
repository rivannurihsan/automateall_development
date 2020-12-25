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
            <p class="content__textRight" style="margin-top: -5px;">: Part 2 - Learn PDF
              Automation</p>
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
            <p class="content__textRight">: 6 Desember 2020 ,pukul 13.00 WIB </p>
          </div>
        </div>
        <div class="formKode__wrapper">
          <form class="formKode">
            <input class="inputForm" placeholder="inikode" />
            <button class="submitForm" type="submit">Gunakan</button>
          </form>
          <div>
            <p class="text__kode">kode tidak terdaftar</p>
          </div>
        </div>
      </div>
      <div class="col col-lg-5  tabble__wrap">
        <div class="table__wrapper">
          <h1 class="table__summary">Summary</h1>
          <table style="width: 100%; color: #0F4C75;" class="table table-borderless">
            <tr">
              <th width="60%" class="text__th">Harga Tiket</th>
              <td width="40%" class=" text__td">Rp
                99.001</td>
              </tr>
              <tr>
                <th width="60%" style="line-height: 20px;" class="text__th th__diskon"><span>Diskon</span><span class="text-right">-</span></th>
                <td width=" 40%" style="line-height: 20px;" class=" text__td">
                  Rp
                  15.000
                </td>
              </tr>
              <tr>
                <th width="60%" style="line-height: 80px;" class="text__thBayar" style="
                                                      font-weight: 900;">
                  Total Bayar</th>
                <td width="40%" style="line-height: 80px;" class="text__td">
                  Rp 184.001
                </td>
              </tr>
          </table>
          <div class="text__buktiWrapper">
            <div class="text__wrapper">
              <h5 class="text__bukti">Unggah bukti bayar</h5>
            </div>
            <h6 class="text__struk">struk.jpg</h6>
            <button class="btn btn-block btn-primary text-center" data-backdrop="false" data-toggle="modal" data-target="#modaldaftar">Proses</button>
          </div>
         <div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>