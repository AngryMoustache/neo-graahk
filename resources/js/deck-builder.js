(function(){
  fitCardBuilder = function () {
    const elements = document.getElementsByClassName('card')
    for (var i = 0; i < elements.length; i++) {
      elements[i].style.height = (elements[i].clientWidth * 1.4) + 'px'
    }
  }
})()
