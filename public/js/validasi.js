function blurLur(){
  var blur = document.getElementById('blurPage');
  blur.classList.toggle('activeBlur')
}
function validateForm() {
  var isString = /^[a-zA-Z ]+$/;
  var getName = document.forms["myForm"]["name"].value;
  if (getName == null || getName == "") {
    // alert("Nama harus diisi terlebih dahulu");
    const formGetMOdal = document.getElementById('groupModal__nama')
    var Nama = document.createElement("p");
    Nama.id = "pNama"
    var textNama = document.createTextNode("Nama harus diisi terlebih dahulu");
    Nama.appendChild(textNama)
    formGetMOdal.appendChild(Nama)
    return false;
  }
  if(!getName.match(isString)){
    const formGetMOdal = document.getElementById('groupModal__nama')
    var Nama = document.createElement("p");
    Nama.id = "pNama"
    var textNama = document.createTextNode("tidak boleh angka");
    Nama.appendChild(textNama)
    formGetMOdal.appendChild(Nama)
    return false;
  }
  
  var number = /^[0-9]+$/;
  var getWa = document.forms["myForm"]["whatsapp"].value;
  if (getWa == null || getWa == "") {
    const formGetMOdal = document.getElementById('groupModal__wa')
    var Nomor = document.createElement("p");
    Nomor.setAttribute('id', "pNomor")
    var textNomor = document.createTextNode("nomor wa tidak boleh kosong");
    Nomor.appendChild(textNomor)
    formGetMOdal.appendChild(Nomor)
    return false;
  }

  if (!getWa.match(number)) {
    const formGetMOdal = document.getElementById('groupModal__wa')
    var Nomor = document.createElement("p");
    Nomor.setAttribute('id', "pNomor");
    var textNomor = document.createTextNode("nomor wa harus angka");
    Nomor.appendChild(textNomor)
    formGetMOdal.appendChild(Nomor)
    return false;
  }

  var getInstitusi = document.forms["myForm"]["institusi"].value;
  if (getInstitusi == null || getInstitusi == "") {
    const formGetMOdal = document.getElementById('groupModal__institusi')
    var Institusi = document.createElement("p");
    Institusi.id = "pInstitusi"
    var textinstitusi = document.createTextNode("nama intitusi tidak boleh kosong");
    Institusi.appendChild(textinstitusi)
    formGetMOdal.appendChild(Institusi)
    return false;
  }
  if(!getInstitusi.match(isString)){
    const formGetMOdal = document.getElementById('groupModal__institusi')
    var Institusi = document.createElement("p");
    Institusi.id = "pInstitusi"
    var textinstitusi = document.createTextNode("institusi tidak boleh angka");
    Institusi.appendChild(textinstitusi)
    formGetMOdal.appendChild(Institusi)
    return false;
  }
}

function onchangeremoveErrorname() {
  const name = document.getElementById('pNama')
  if (name) {
    const groupModal__nama = document.getElementById('groupModal__nama');
    groupModal__nama.removeChild(name)
  }
}

function onchangeremoveErrorwa() {
  const nomor = document.getElementById('pNomor')
  if (nomor) {
    const groupModal__nama = document.getElementById('groupModal__wa');
    groupModal__nama.removeChild(nomor)
  }
}

function onchangeremoveErrorinstitusi() {
  const nomor = document.getElementById('pInstitusi')
  if (nomor) {
    const groupModal__nama = document.getElementById('groupModal__institusi');
    groupModal__nama.removeChild(nomor)
  }
}
function getValue(){
  var getName = document.forms["myForm"]["name"].value;
  var getWa = document.forms["myForm"]["whatsapp"].value;
  var getInstitusi = document.forms["myForm"]["institusi"].value;
  console.log(getName)
  console.log(getWa)
  console.log(getInstitusi)
  if(getName != null && getWa != null && getInstitusi != null && getName != "" && getWa != "" && getInstitusi != ""){
    const btn = document.getElementById('btn__inputModal')
    btn.removeAttribute('disabled')
  }
  else{
    const btn = document.getElementById('btn__inputModal')
    btn.setAttribute('disabled' , "disabled")
  }
}

