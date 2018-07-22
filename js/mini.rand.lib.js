//
var __ucwords = (function (str) {
    return function (str) {
        return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
            return $1.toUpperCase();
        });
    }
})();

//
var __strtolower = (function (str) {
    return function (str) {
        return (str+'').toLowerCase();
    }
})();

//
var __numberWithCommas = (function (str) {
  return function(str) {
    return str.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }
})();

//
document.addEventListener ("keydown", function (zEvent) {
    if (zEvent.ctrlKey &&  zEvent.code === "KeyS") {
      $('#searchText').focus();
    }
});
