/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
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
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/home.js":
/***/ (function(module, exports) {

(function ($) {
    var landing_src = $(".home-cover-img", "#home-cover-slideshow").first().attr("data-src");

    function showHomeCover() {
        $("body").addClass("load");
        $(".home-cover-img", "#home-cover-slideshow").first().css("background-image", "url(" + landing_src + ")").addClass("animate-in--alt").removeAttr("data-src");
        setTimeout(function () {
            $("body").addClass("loaded");
            setTimeout(function () {
                showHomeSlideshow();
            }, 7000);
        }, 400 * 1.5);
    }

    var showHomeSlideshowInterval = function showHomeSlideshowInterval() {
        setTimeout(function () {
            showHomeSlideshow();
        }, 8000);
    };

    function showHomeSlideshow() {
        var $image = $(".home-cover-img[data-src]", "#home-cover-slideshow").first();
        var $images = $(".home-cover-img", "#home-cover-slideshow");
        if ($image.length == 0) {
            if ($images.length == 1) return;
            $images.first().removeClass("animate-in");
            $("#home-cover-slideshow").append($images.first());
            setTimeout(function () {
                $(".home-cover-img:last", "#home-cover-slideshow").addClass("animate-in");
            }, 20);
            setTimeout(function () {
                $(".home-cover-img:not(:last)", "#home-cover-slideshow").removeClass("animate-in");
            }, 4000);
            showHomeSlideshowInterval();
        } else {
            var src = $image.attr("data-src");
            $("<img/>").attr("src", src).on("load error", function () {
                $(this).remove();
                $image.css("background-image", "url(" + src + ")").addClass("animate-in").removeAttr("data-src");
                setTimeout(function () {
                    $(".home-cover-img:not(:last)", "#home-cover-slideshow").removeClass("animate-end animate-in--alt");
                }, 2000);
                showHomeSlideshowInterval();
            });
        }
    }

    if (landing_src) {
        $("<img/>").attr("src", landing_src).on("load error", function () {
            $(this).remove();
            showHomeCover();
        });
    }
})(jQuery);

/***/ }),

/***/ 1:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/home.js");


/***/ })

/******/ });