'use strict';
// スライドイン******************************************
//スクロール時のイベント
window.addEventListener('scroll', function () {

  //すべての.itemを取得
  const item = document.querySelectorAll('.slideIn');
  // console.log(item);
  //querySelectorAllは配列になるので、for構文で取得
  //配列は0から始まるのでi = 0
  //i < item.lengthで配列の要素よりも数が小さい時　i++(インクリメント)1つずつ増加
  for (let i = 0; i < item.length; i++) {

    //.itemのオフセットの高さを取得
    let targetTop = item[i].offsetTop;
    // console.log(targetTop);
    // console.log(window.scrollY);
    //画面のスクロール量 + 300px > .itemのオフセットの高さを取得
    if (window.scrollY + 300 > targetTop) {

      //書くitemにクラスshowを追加
      item[i].classList.add('show');
    }
  }
});

// **スライドイン終わり*********************************

// **マウスストーカー*********************************
//マウスストーカー用のdivを取得
const stalker = document.getElementById('stalker');

//aタグにホバー中かどうかの判別フラグ
let hovFlag = false;

//マウスに追従させる処理 （リンクに吸い付いてる時は除外する）
document.addEventListener('mousemove', function (e) {
  if (!hovFlag) {
    stalker.style.transform = 'translate(' + e.clientX + 'px, ' + e.clientY + 'px)';
  }
});

//リンクへ吸い付く処理
const linkElem = document.querySelectorAll('a:not(.no_stick_)');
for (let i = 0; i < linkElem.length; i++) {
  //マウスホバー時
  linkElem[i].addEventListener('mouseover', function (e) {
    hovFlag = true;

    //マウスストーカーにクラスをつける
    stalker.classList.add('hov_');

    //マウスストーカーの位置をリンクの中心に固定
    let rect = e.target.getBoundingClientRect();
    let posX = rect.left + (rect.width / 2);
    let posY = rect.top + (rect.height / 2);

    stalker.style.transform = 'translate(' + posX + 'px, ' + posY + 'px)';

  });
  //マウスホバー解除時
  linkElem[i].addEventListener('mouseout', function (e) {
    hovFlag = false;
    stalker.classList.remove('hov_');
  });
}
// **マウスストーカー終わり*********************************