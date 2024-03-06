'use strict';
window.onload = () => {
  const loadingWindow = document.getElementById('loading');
  function timeout() {
    loadingWindow.style.opacity = '0';
    setTimeout(clear, 500);
  }
  function clear() {
    loadingWindow.style.display = 'none';
  }
  //ローカルでテストしているとローディング画面が出てるのかわかりづらいためタイムアウト設定してます
  // setTimeout(timeout, 3000);
  if (loadingWindow) {
    timeout();
  }
};
