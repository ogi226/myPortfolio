'use strict';
$(window).on('load', function () {
  // 移動させる対象を取得
  const slide = document.querySelector('.slide_board');
  // ボタンを取得
  const $slideBtn = $('.slide_button');
  // 矢印を取得
  const $slideArrow = $('.slide_arrow');
  //チェック用関数
  function check(x) {
    if (x === 0) console.log(x);
    else {
      x ? console.log(x) : console.log('undef');
    }
  }
  //   スライドショーの表示位置を変更する関数
  function changeSlide(b) {
    slide.style.left = -b + 'px';
  }
  // ボタンの色変更
  function changeBtnSP(a) {
    for (let color of $slideBtn) {
      color.classList.remove('slide_selected');
      $slideBtn[a].classList.add('slide_selected');
    }
  }
  function getslide() {
    return $('.slide_img:first-of-type').outerWidth(true);
  }
  for (let button of $slideBtn) {
    button.addEventListener('click', function () {
      const id = $(this).data('id');
      // SPのスライドショースクリプト
      if ($(window).outerWidth() <= 800) {
        changeSlide(getslide() * id);
        changeBtnSP(id);
      } else {
        const currentPos = $('.slide_selected').data('id');
        switch (id) {
          case 0:
            if (id < currentPos) {
              poschangePC(id);
            }
            break;
          case 1:
            if (id < currentPos) {
              poschangePC(id);
            }
          case 2:
            break;
          case 3:
            if (id > currentPos + 2) {
              poschangePC(id - 2);
            }
            break;
          case 4:
            if (id > currentPos + 2) {
              poschangePC(id - 2);
              break;
            }
        }
      }
    });
  }
  // pc版の表示画像変化させる関数
  function poschangePC(x) {
    changeSlide(x * getslide());
    for (let color of $slideBtn) {
      color.classList.remove('slide_selected');
    }
    $slideBtn[x].classList.add('slide_selected');
    $slideBtn[x + 1].classList.add('slide_selected');
    $slideBtn[x + 2].classList.add('slide_selected');
  }
  if ($(window).outerWidth() > 800) {
    poschangePC(0);
    // 矢印がクリックされた時の処理
    for (let arrow of $slideArrow) {
      arrow.addEventListener('click', function () {
        const btnId = $(this).data('id');
        const currentPos = $('.slide_selected').data('id');
        if (btnId === 'left') {
          currentPos > 0 ? poschangePC(currentPos - 1) : poschangePC(2);
        } else if (btnId === 'right') {
          currentPos < 2 ? poschangePC(currentPos + 1) : poschangePC(0);
        }
      });
    }
  }
  window.addEventListener('resize', sizeCheck);
  function sizeCheck() {
    if ($(window).outerWidth() < 800) {
      changeSlide(0);
      changeBtnSP(0);
    } else {
      poschangePC(0);
    }
  }
});
