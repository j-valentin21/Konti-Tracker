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

/***/ "./resources/js/scripts/intersection.js":
/*!**********************************************!*\
  !*** ./resources/js/scripts/intersection.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

//INTERSECTION OBSERVER-INDEX
window.onload = function () {
  //DOM selection
  var caraImg = document.querySelector(".carousel-inner");
  var nav = document.querySelector(".navbar__logo");
  var navbar = document.querySelector("#navbar__bg");
  var home = document.querySelector(".homepage__bg");
  var cardLeft = document.querySelectorAll(".card-animation__left");
  var cardRight = document.querySelectorAll(".card-animation__right"); //Options for new observer object

  var options = {
    root: null,
    rootMargin: '0px 0px 0px 0px',
    threshold: 0
  }; //Observer for navigation logo

  observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (!entry.intersectionRatio > 0) {
        nav.classList.add("navbar__alt");
        home.classList.add("homepage__bgcolor");
        navbar.classList.add("navbar__bg");
      } else {
        nav.classList.remove("navbar__alt");
        home.classList.remove("homepage__bgcolor");
        navbar.classList.remove("navbar__bg");
      }
    });
  }, options);
  observer.observe(caraImg); //Observer for konti-tracker(left)
  //Options for new observer object

  var option = {
    root: null,
    rootMargin: '-100px 0px -200px 0px',
    threshold: 0
  };
  observe = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.style.animation = "slideInLeft 1.75s ease, gradient 7.5s ease infinite";
        entry.target.style.visibility = "visible";
      } else {
        entry.target.style.animation = "none";
        entry.target.style.visibility = "hidden";
      }
    });
  }, option);
  cardLeft.forEach(function (image) {
    observe.observe(image);
  }); //Observer for konti-card(right)
  //Options for new observer object

  observeRight = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.style.animation = "slideInRight 1.75s ease, gradient 7.5s ease infinite";
        entry.target.style.visibility = "visible";
      } else {
        entry.target.style.animation = "none";
        entry.target.style.visibility = "hidden";
      }
    });
  }, option);
  cardRight.forEach(function (image) {
    observeRight.observe(image);
  });
};

/***/ }),

/***/ 2:
/*!****************************************************!*\
  !*** multi ./resources/js/scripts/intersection.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/parallels/Desktop/Konti-Tracker/resources/js/scripts/intersection.js */"./resources/js/scripts/intersection.js");


/***/ })

/******/ });