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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/edit_truck.js":
/*!************************************!*\
  !*** ./resources/js/edit_truck.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(".submit").click(function (e) {
  e.preventDefault();
  var licence_plate = $("input[name=licence_plate]").val();
  var truck_id = $("input[name=truck_id]").val();
  var vin = $("input[name=vin]").val();
  var odometer = $("input[name=odometer]").val();
  var brand = $("input[name=brand]").val();
  var model = $("input[name=model]").val();
  var horse_power = $("input[name=horse_power]").val();
  var emission_class = $("select[name='emission_class']").children('option:selected').val();
  var production_year = $("select[name='production_year']").children('option:selected').val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'POST',
    url: '/truck/' + truck_id,
    data: {
      '_method': 'PUT',
      truck_id: truck_id,
      licence_plate: licence_plate,
      vin: vin,
      odometer: odometer,
      emission_class: emission_class,
      brand: brand,
      model: model,
      production_year: production_year,
      horse_power: horse_power
    },
    success: function success(data) {
      $("input[name=licence_plater]").val('');
      $('#messages').html('');
      $('#messages').append('<div class="alert alert-success">' + data.success + '<button type="button" class="close" data-dismiss="alert">×</button>' + '<div>');
    },
    error: function error(data) {
      $('#messages').html('');
      $.each(data.responseJSON.errors, function (key, value) {
        $('#messages').append('<div class="alert alert-danger">' + value + '<button type="button" class="close" data-dismiss="alert">×</button>' + '</div>');
      });
    }
  });
});

/***/ }),

/***/ 2:
/*!******************************************!*\
  !*** multi ./resources/js/edit_truck.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\transport-business\resources\js\edit_truck.js */"./resources/js/edit_truck.js");


/***/ })

/******/ });