function toggleMenu() {
  var menuWrapper = document.querySelector('.menu-wrapper');
  var menuButton = document.querySelector('.menu-open');
  if (document.querySelector('.is-closed')) {
    menuWrapper.classList.remove('is-closed');
    menuButton.classList.add('is-opened');
  } else {
    menuWrapper.classList.add('is-closed');
    menuButton.classList.remove('is-opened');
  }
}

function detailKeys() {
  window.onkeydown = keyPressed;
  function keyPressed(e) {
    if (e.keyCode === 27) {
      // Escape
      console.log('Escape');
      window.location.href='index';
      return;
    }
    if (e.keyCode === 37) {
      // Left arrow
      var prev = document.getElementById('prev');
      url = prev.getAttribute('href');
      window.location.href=url;
      return;
    }
    if (e.keyCode === 39) {
      // Right arrow
      var next = document.getElementById('next');
      url = next.getAttribute('href');
      window.location.href=url;
      return;
    }
  }
}