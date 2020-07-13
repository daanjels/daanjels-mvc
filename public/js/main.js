function showDetail(selected) {
  document.getElementById('main').style.display = 'none';
  var details = document.getElementById('details').getElementsByTagName('figure');
  for (count = 0; count < details.length; count++) {
    details[count].style.display = 'none';
  }
  document.getElementById(selected).style.display = 'block';

  window.onkeydown = keyPressed;
  function keyPressed(e) {
    if (document.getElementById('main').style.display === 'none') {
      if (e.keyCode === 27) {
        // Escape
        hideDetail(selected);
        return;
      }
      if (e.keyCode === 37) {
        // Left arrow
        var buttons = document.getElementById(selected).getElementsByTagName('button');
        var prev = buttons[0].getAttributeNode('onclick').value;
        prev = prev.substr(11, prev.length - 12);
        console.log(prev);
        showDetail(prev);
        return;
      }
      if (e.keyCode === 39) {
        // Right arrow
        var buttons = document.getElementById(selected).getElementsByTagName('button');
        var prev = buttons[1].getAttributeNode('onclick').value;
        console.log(prev);
        prev = prev.substr(11, prev.length - 12);
        console.log(prev);
        showDetail(prev);
        return;
      }
    }
  }
}

function hideDetail(selected) {
  document.getElementById('main').style.display = 'block';
  document.getElementById(selected).style.display = 'none';
}