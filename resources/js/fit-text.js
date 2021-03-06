/*!
* FitText.js 1.0 jQuery free version
*
* Copyright 2011, Dave Rupert http://daverupert.com
* Released under the WTFPL license
* http://sam.zoy.org/wtfpl/
* Modified by Slawomir Kolodziej http://slawekk.info
*
* Date: Tue Aug 09 2011 10:45:54 GMT+0200 (CEST)
*/
(function(){

  var addEvent = function (el, type, fn) {
    if (el.addEventListener)
      el.addEventListener(type, fn, false);
		else
			el.attachEvent('on'+type, fn);
  };

  var extend = function(obj,ext){
    for(var key in ext)
      if(ext.hasOwnProperty(key))
        obj[key] = ext[key];
    return obj;
  };

  window.fitText = function (el, kompressor, options) {

    var settings = extend({
      'minFontSize' : -1/0,
      'maxFontSize' : 1/0
    },options);

    var fit = function (el) {
      var compressor = kompressor || 1;

      var resizer = function () {
        var size = Math.max(Math.min(el.clientWidth / (compressor*10), parseFloat(settings.maxFontSize)), parseFloat(settings.minFontSize))
        el.style.fontSize = size + 'px';
        el.style.lineHeight = (size * (3/2.4)) + 'px';
      };

      // Call once to set.
      resizer();

      // Bind events
      // If you have any js library which support Events, replace this part
      // and remove addEvent function (or use original jQuery version)
      addEvent(window, 'resize', resizer);
      addEvent(window, 'orientationchange', resizer);
    };

    if (el.length)
      for(var i=0; i<el.length; i++)
        fit(el[i]);
    else
      fit(el);

    // return set of elements
    return el;
  };
})();


window.resizeCards = function () {
  const cardCosts = document.querySelectorAll('.card-data-cost span')
  const cardNames = document.querySelectorAll('.card-data-name span')
  const cardPowers = document.querySelectorAll('.card-data-power span')
  const cardRarities = document.querySelectorAll('.card-data-rarity span')
  const cardTexts = document.querySelectorAll('.card-data-text span')

  for (let i = 0; i < cardCosts.length; i++) {
    window.fitText(cardCosts[i], 0.15)
  }

  for (let i = 0; i < cardNames.length; i++) {
    window.fitText(cardNames[i], 1.3)
  }

  for (let i = 0; i < cardPowers.length; i++) {
    window.fitText(cardPowers[i], 0.3)
  }

  for (let i = 0; i < cardTexts.length; i++) {
    window.fitText(cardTexts[i], 1.5)
  }

  for (let i = 0; i < cardRarities.length; i++) {
    window.fitText(cardRarities[i], 2.3)
  }
}
