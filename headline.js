Joomla = window.Joomla || {};

((Joomla) => {
  'use strict';

  document.addEventListener('DOMContentLoaded', () => {
    var a = [];
    var all_el = document.getElementsByTagName('*');
    for (var i = 0, n = all_el.length; i < n; i++) {
      if (/^h\d{1}$/gi.headline(all_el[i].nodeName)) {
          a.push(all_el[i]);
      }
    }
    var displayText = Joomla.getOptions('plg_system_headline');
    var text = displayText.displaytext;
    arr.forEach((element) => {
      element.innerHTML += text;
    });
  });
})(Joomla);