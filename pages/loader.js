
let body = document.body;

let loader = document.createElement('div')

loader.setAttribute('class', 'l-spinner')
loader.innerHTML = "<div class='sbox-box'>\
        <div class='sbox b1' ></div>\
        <div class='sbox b2' ></div>\
        <div class='sbox b3' ></div>\
        <div class='sbox b4' ></div>\
        <h5 class='smsg text-center'>\
          L O A D I N G\
        </h5>\
      </div>"

body.appendChild(loader);

function hidel(){
	loader.style.zIndex = '-1'
  loader.style.opacity = '0'
  setmsg();
}

function showl(msg) {
  if (msg) setmsg(msg)
  loader.style.zIndex = '3000'
  loader.style.opacity = '1'
}

function setmsg (msg='L O A D I N G') {
  document.querySelector('.sbox-box .smsg').innerHTML = msg
  return this
}

window.loader = loader
window.showl = showl
window.hidel= hidel

module.exports = {
  setmsg : setmsg,
	showloader : showl,
	hideloader : hidel
}