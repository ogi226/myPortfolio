'use strict';

document.addEventListener('scroll', () => {
  // ボタンとフッターの要素を取得
  const btn = document.querySelector('.toppage_return');
  const footer = document.querySelector('.footer');
  // ビューポートの高さ
  const viewportHeight = window.innerHeight;
  // フッターの上端までの距離
  const footerTop = footer.getBoundingClientRect().top;
  // フッターがビューポートの下端に触れたかを判定
  if (footerTop <= viewportHeight) {
    // フッターの上にボタンを配置
    btn.style.position = 'absolute';
    if ($(window).outerWidth() > 800) {
      btn.style.bottom = `${footer.offsetHeight + 40}px`;
    } else {
      btn.style.bottom = `${footer.offsetHeight + 24}px`;
    }
  } else {
    // 通常の固定位置に戻す
    btn.style.position = 'fixed';
    btn.style.bottom = '24px'; // 元々のCSSで指定した値
  }
});
// ページトップに戻るボタン
const pagetop_btn = document.querySelector('.toppage_return');
//スクロール150でボタン表示
if (pagetop_btn) {
  window.addEventListener('scroll', () => {
    let scrollY = window.scrollY;
    if (scrollY >= 150) {
      //activeclassを追加
      pagetop_btn.classList.add('active');
    } else {
      //activeclassを削除
      pagetop_btn.classList.remove('active');
    }
  });
}
//スマホ版からPC用に切り替える

// if (window.matchMedia('(max-width:799px)').matches) {
//   //スマホ処理
// } else if (window.matchMedia('(min-width:800)').matches) {
//   //PC処理
// }

//又はif分でfalseの時　スクロール処理終了させる
// if (screenY >= 150) {
//   console.log('ture')
// } else {

// }

//スクロールした時に処理を

// window.addEventListener('scroll',function(){

//   let topbtn =document.querySelector('toppage_return');

//   const y = this.window.screenY
//   console.log(y);

//   const topVisual =this.document.querySelector('.attraction').getBoundingClientRect().bottom;

//   if(topVisual <=0){
// topbtn.classList.add('active')
//   }else {
// topbtn.classList.remove('active');
//   }

// });

//トップへ戻るボタンを取得。スクロールしたらトップボタンに戻るボタンを表示させるのか

// document.addEventListener("DOMContentLoaded", function () {
//   const pagetop = document.querySelector('toppage_return');
//   const scrollThreshold = 150;
// //ページトップに戻る変数
//   function scrollTop() {
//     window.scroll({
//       top: 0,
//       behavior: "smooth",
//     });
//     console.log(pagetop);
//   }
// //スクロールによってトップページに戻るボタンの表示、非表示
//   function scrollEvent() {
//     if (window.scrollY > scrollThreshold) {
//       pageTop.style.opacity = "1";
//     } else {
//       pageTop.style.opacity = "0";
//     }
//   }

//   function Position() {
//     //ページ全体の高さを取得
//     const scrollHeight = document.documentElement.scrollHeight;
//     //現在のスクロール位置を取得
//     const scrollPosition = window.innerHeight + window.scrollY;
//     //フッター要素の高さを取得
//     const footHeight = document.querySelector(".footer").offsetHeight;
// //スクロール位置がフッター手前に来た場合
//     if (scrollHeight - scrollPosition <= footHeight) {
//       //ページトップに戻るボタンの位置を絶対位置に
//       pageTop.style.position = "absolute";
//       pageTop.style.bottom = footHeight + "px";
//     } else {
//       //ページトップボタンの位置を固定位置
//       pageTop.style.position = "fixed";
//       pageTop.style.bottom = "0";

//     }
//   }

//   pagetop.addEventListener("click", scrollTop);
//   window.addEventListener("scroll", scrollEvent);
//   window.addEventListener("scroll", Position);

// });

// //スクロールの現在位置取得
// function Position() {
//   const h = window.scrollY;
//   console.log(h);
//   //コンテンツ内の高さは1258
//   const bodyheight = window.innerHeight;
//   console.log(bodyheight);
//   //フッターの高さは395
//   const footHeight = document.querySelector(".footer").offsetHeight;
//   console.log(footHeight);

//   if (h - bodyheight <= footHeight) {

//   } else {

//   }
// }
