/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/test.js ***!
  \******************************/
fetch('/api/test').then(function (response) {
  return response.json();
}).then(function (users) {
  return console.log(users);
});
/******/ })()
;