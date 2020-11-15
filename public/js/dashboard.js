/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/dashboard.js":
/*!***********************************!*\
  !*** ./resources/js/dashboard.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var traveled_km_chart = new Chartisan({
  el: '#traveled_km_chart',
  url: "api/chart/km_traveled_chart",
  loader: {
    color: '#247ba0',
    size: [30, 30],
    type: 'bar',
    textColor: '#000000',
    text: 'Зареждам данни...'
  },
  error: {
    color: '#247ba0',
    size: [30, 30],
    text: 'Възникна грешка...',
    textColor: '#247ba0',
    type: 'general',
    debug: true
  },
  hooks: new ChartisanHooks() // .title('Изминати километри!')
  .colors(['#ECC94B', '#4299E1']) // .datasets([ 'bar', {type: 'bar', color : 'red'}])
  .legend(true).tooltip(true)
});
var number_of_trucks = new Chartisan({
  el: '#number_of_trucks',
  url: "api/chart/number_of_trucks_chart",
  loader: {
    color: '#247ba0',
    size: [30, 30],
    type: 'bar',
    textColor: '#000000',
    text: 'Зареждам данни...'
  },
  error: {
    color: '#247ba0',
    size: [30, 30],
    text: 'Възникна грешка...',
    textColor: '#247ba0',
    type: 'general',
    debug: true
  },
  hooks: new ChartisanHooks().datasets([{
    type: 'pie',
    color: '#4299E1',
    radius: ['30%', '60%']
  }]).axis(false)
});
var avg_fuel_consumption = new Chartisan({
  el: '#avg_fuel_consumption_chart',
  url: "api/chart/avg_fuel_consumption_chart",
  loader: {
    color: '#247ba0',
    size: [30, 30],
    type: 'bar',
    textColor: '#000000',
    text: 'Зареждам данни...'
  },
  error: {
    color: '#247ba0',
    size: [30, 30],
    text: 'Възникна грешка...',
    textColor: '#247ba0',
    type: 'general',
    debug: true
  },
  hooks: new ChartisanHooks().datasets([{
    type: 'line'
  }]).legend().tooltip(true)
});
var avg_fuel_price = new Chartisan({
  el: '#avg_fuel_price_chart',
  url: "api/chart/avg_fuel_price_chart",
  loader: {
    color: '#247ba0',
    size: [30, 30],
    type: 'bar',
    textColor: '#000000',
    text: 'Зареждам данни...'
  },
  error: {
    color: '#247ba0',
    size: [30, 30],
    text: 'Възникна грешка...',
    textColor: '#247ba0',
    type: 'general',
    debug: true
  },
  hooks: new ChartisanHooks().datasets([{
    type: 'line'
  }]).colors(['#4299E1']).tooltip(true)
});
var paid_trips = new Chartisan({
  el: '#paid_trips_chart',
  url: "api/chart/paid_trips_chart",
  loader: {
    color: '#247ba0',
    size: [30, 30],
    type: 'bar',
    textColor: '#000000',
    text: 'Зареждам данни...'
  },
  error: {
    color: '#247ba0',
    size: [30, 30],
    text: 'Възникна грешка...',
    textColor: '#247ba0',
    type: 'general',
    debug: true
  },
  hooks: new ChartisanHooks().datasets([{
    type: 'line'
  }]).colors(['#32527B', '#6B8EB7', '#BCD3E7']).tooltip(true).legend(true)
});

/***/ }),

/***/ 1:
/*!*****************************************!*\
  !*** multi ./resources/js/dashboard.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\tb\transport-business\resources\js\dashboard.js */"./resources/js/dashboard.js");


/***/ })

/******/ });