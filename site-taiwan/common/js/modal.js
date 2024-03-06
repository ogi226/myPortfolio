'use strict';
//  モーダルウィンドウ動作開始

//要素を取得
//ボタン本体の要素を取得
const modal = document.querySelector('.modal_style');
//ボタン全てを取得
const button = document.querySelectorAll('.modal_button');
//閉じるボタンを取得
const close = document.querySelector('#modal_closebutton');
//モーダルの内容を取得
const title = document.getElementById('modal_title');
const text = document.getElementById('modal_text');
const subtext = document.getElementById('modal_subtext');
const img = document.getElementById('modal_img1');
const img2 = document.getElementById('modal_img2');
//開く動作をしたい
function modalopen() {
  //ボタンにactive_1という名前のclassを追加
  modal.classList.add('active_1');
} //閉じる動作をしたい
function modalclose() {
  modal.classList.remove('active_1');
}
//button(対象要素).addEventListener(イベントを実行する)(種類=イベントの種類,関数=function,false=イベントの伝搬式をture or falseに指定可)
//グルメモーダルの画像を置き換える
function changeImage(target, path) {
  target.src = path;
}
//ofを置くと繰り返しが実行。変数boxの後ろに.addEventListener('click',modalopen)を置くとbutton[0]の中が繰り返される。
if (button) {
  for (let box of button) {
    box.addEventListener('click', function () {
      changeImage(img, this.dataset.img);
      if (this.dataset.img2) {
        changeImage(img2, this.dataset.img2);
      }
      if (this.dataset.title) {
        title.textContent = this.dataset.title;
      }
      if (this.dataset.text) {
        text.textContent = this.dataset.text;
      }
      if (this.dataset.subtext) {
        subtext.textContent = this.dataset.subtext;
      }
      modalopen();
    });
  }
}
//関数宣言し、クラスを削除を実行
if (close) {
  close.addEventListener('click', modalclose);
}
//クリックされると閉じる動作が実行される。

//台北モーダルウィンドウ
