'use strict';

let totalMs; // 入力値の合計ミリ秒
let hours; // 入力値からhに変換後の数値→カウントダウン中の残数値
let min; // 入力値からmに変換後の数値→カウントダウン中の残数値
let sec; // 入力値からsに変換後の数値→カウントダウン中の残数値
let count; // 入力値からhmsに変換後の配列
let countNumber; // カウントダウン用合計秒

let interval; // タイマー停止指示

// ↓表示欄の取得
const displayH = document.getElementById('hour');
const displayM = document.getElementById('min');
const displayS = document.getElementById('sec');

// ↓入力欄の取得
const inputH = document.getElementById('input_h');
const inputM = document.getElementById('input_m');
const inputS = document.getElementById('input_s');

// ↓ボタンの取得
const startbtn = document.getElementById("startbtn");
const stopbtn = document.getElementById("stopbtn");

////★ ↓入力値を表示用に変換して、表示する関数(timeDisplay)
function timeDisplay() {
  // 入力値の合計をミリ秒で算出する  
  totalMs = (inputH.value * 60 * 60 * 1000) + (inputM.value * 60 * 1000)
    + (inputS.value * 1000);

  // 合計ミリ秒をhmsへ変換　↓数値
  hours = Math.floor(totalMs / 1000 / 60 / 60) % 24;
  min = Math.floor(totalMs / 1000 / 60) % 60;
  sec = Math.floor(totalMs / 1000) % 60;
  count = [hours, min, sec]
  // ↓合計秒数
  countNumber = hours * 3600 + min * 60 + sec;

  // ↓文字列で取得　時間・分・秒　タイマー表示させる
  displayH.textContent = String(count[0]).padStart(2, '0');
  displayM.textContent = String(count[1]).padStart(2, '0');
  displayS.textContent = String(count[2]).padStart(2, '0');
}

// ↓入力されたら関数(timeDisplay)を実行する＝(時間が表示される）
inputH.addEventListener('input', timeDisplay);
inputM.addEventListener('input', timeDisplay);
inputS.addEventListener('input', timeDisplay);

// 入力されたらスタートボタンの背景色を削除する
function btncolor() {
  if (totalMs > 0) {
    startbtn.classList.remove("b-color");
  }
}

// ↓入力されたら関数(timeDisplay)を実行する＝(時間が表示される）
inputH.addEventListener('input', btncolor);
inputM.addEventListener('input', btncolor);
inputS.addEventListener('input', btncolor);



////★ ↓カウントダウンする関数(countdown)
function countdown() {
  countNumber--;
  if (countNumber > 0) {
    let hours = Math.floor(countNumber / 60 / 60) % 24;
    let min = Math.floor(countNumber / 60) % 60;
    let sec = Math.floor(countNumber % 60);
    let displyCount = [hours, min, sec]

    // カウントダウン中の時間を表示する
    displayH.textContent = String(displyCount[0]).padStart(2, '0');
    displayM.textContent = String(displyCount[1]).padStart(2, '0');
    displayS.textContent = String(displyCount[2]).padStart(2, '0');
  } else if (countNumber === 0) {
    //↓カウントダウンが終了した時のend関数を呼び出す
    end();
  }
}

////★ ↓スタートボタンを押すと関数(countdown)が開始するという関数     
function start() {
  if (!(totalMs === undefined || totalMs === 0)) {
    // ↓1000ミリ秒ごとに関数(countdown)を繰り替えす 事を「interval」と名づける
    interval = setInterval(countdown, 1000);

    // ↓各入力欄に背景色をつける
    inputH.style.backgroundColor = 'lightgray';
    inputM.style.backgroundColor = 'lightgray';
    inputS.style.backgroundColor = 'lightgray';

    // ストップボタンの背景色を削除する
    stopbtn.classList.remove("b-color");

    // スタートボタンの背景色を付ける
    startbtn.classList.add("b-color");

    // ↓スタートボタンを無効にする
    startbtn.disabled = true; 
  }
}


////★ ↓未入力でスタートボタンを押そうとする時のアラート 
const startWrap = document.querySelector(".message-block");
// ↓アラートメッセージを取得
const popup = document.getElementById("not-entered-message");
// ↓スタートボタンにhoverしたら「msaleart」発火
startWrap.addEventListener('mouseover', msaleart);

function msaleart() {
  if (totalMs === undefined || totalMs === 0) {
    // ↓アラートを表示
    popup.style.display = 'block';
    // ↓スタートボタンのカーソルを禁止に変更
    startbtn.style.cursor = 'not-allowed';
    // ↓スタートボタンを無効にする
    startbtn.disabled = true; 

    // ↓スタートボタンを離れたらアラート非表示、カーソルの設定を元に戻す
    startWrap.addEventListener('mouseleave', function () {
    popup.style.display = 'none';
    startbtn.style.cursor = null;
    // ↓スタートボタンを有効に戻す
    startbtn.disabled = false; 
    });
  }
}


// ↓ストップボタンにhoverしたら「aleart」発火
stopbtn.addEventListener('mouseover', aleart);

function aleart() {
  if (totalMs === undefined || totalMs === 0 || totalMs === countNumber * 1000) {
    // ↓ストップボタンのカーソルを禁止に変更
    stopbtn.style.cursor = 'not-allowed';
    // ↓ストップボタンを無効にする
    stopbtn.disabled = true;
  };
  // ↓ストップボタンを離れたらカーソルの設定を元に戻す  
  stopbtn.addEventListener('mouseleave', function () {
  stopbtn.style.cursor = null;
  // ↓ストップボタンを有効に戻す
  stopbtn.disabled = false;
  });
}



////★ ↓ストップボタンを押した時の関数
function stop() {
  // ↓ストップ中は再入力できないように設定  
  inputH.disabled = true;
  inputM.disabled = true;
  inputS.disabled = true;

  // ↓「interval」をキャンセルする
  clearTimeout(interval);

  // ↓スタートボタンからクラス名'b-color'を削除し、背景色を削除する
  startbtn.classList.remove('b-color');
  // ↓ストップボタンにクラス名'b-color'を付与し、背景色をつける
  stopbtn.classList.add('b-color');

  // ↓スタートボタンを有効に戻す
  startbtn.disabled = false; 
}

////★ ↓リセットボタンを押した時の関数
function reset() {
  // ↓「interval」をキャンセルする
  clearTimeout(interval);

  // 関数(countdown)をキャンセルする
  clearTimeout(countdown);

  // ↓00:00:00と表示する
  displayH.textContent = String(0).padStart(2, '0');
  displayM.textContent = String(0).padStart(2, '0');
  displayS.textContent = String(0).padStart(2, '0');

  // ↓入力値をクリアにする
  totalMs = undefined;
  document.getElementById('input_h').value = '';
  document.getElementById('input_m').value = '';
  document.getElementById('input_s').value = '';

  // ↓入力欄の背景色を元に戻す
  inputH.style.backgroundColor = null;
  inputM.style.backgroundColor = null;
  inputS.style.backgroundColor = null;

  // ↓再入力できるように設定
  inputH.disabled = false;
  inputM.disabled = false;
  inputS.disabled = false;

  // ↓合計秒数の値に0を代入する  
  countNumber = 0;

  // スタートボタンとストップボタンにクラス名'b-color'を付与し、背景色を付ける
  startbtn.classList.add('b-color');
  stopbtn.classList.add('b-color');

  // ↓bodyに'flashing'というクラス名が付与されている場合は削除する
  const div = document.getElementById('body');
  div.classList.remove('flashing');

  // ↓スタートボタンを有効に戻す
  startbtn.disabled = false; 
  // ↓ストップボタンを有効に戻す
  stopbtn.disabled = false;
}


////★↓カウントダウンが終了した時の関数
function end() {
  // ↓「interval」をキャンセルする
  clearTimeout(interval);

  // 関数(countdown)をキャンセルする
  clearTimeout(countdown);

  // ↓00:00:00と表示する
  displayH.textContent = String(0).padStart(2, '0');
  displayM.textContent = String(0).padStart(2, '0');
  displayS.textContent = String(0).padStart(2, '0');

  // ↓入力値をクリアにする
  totalMs = undefined;

  // ↓合計秒数の値に0を代入する  
  countNumber = 0;

  // ↓カウントダウンが終了したら、bodyに'flashing'というクラス名が付与される
  const div = document.getElementById('body');
  div.classList.add('flashing');

  // スタートボタンとストップボタンからクラス名'b-color'を削除し、背景色を削除する
  startbtn.classList.remove('b-color');
  stopbtn.classList.remove('b-color');

  // ↓スタートボタンを無効にする
  startbtn.disabled = true; 
  // ↓ストップボタンを無効にする
  stopbtn.disabled = true;
}

// 各ボタンの発火
// １．スタートボタンをクリックしたら関数(start)発火
startbtn.addEventListener('click', start);
// ２．ストップボタンをクリックしたら関数(stop)発火
stopbtn.addEventListener('click', stop);
// ３．Resetボタンをクリックしたら関数(reset)発火
resetbtn.addEventListener('click', reset);
