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
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 45);
/******/ })
/************************************************************************/
/******/ ({

/***/ 45:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(46);


/***/ }),

/***/ 46:
/***/ (function(module, exports) {

$(document).ready(function () {
    $('#create_navigation .check_url input').on('change', function () {
        var checked = $(this).prop('checked');

        if (checked == true) {
            $('.custom-url').show();
            $('.custom-url #custom_url').attr('required', 'required');
            $('.default_links').hide();
            $('.default_links select').removeAttr('required');
        } else {
            $('.custom-url').hide();
            $('.custom-url #custom_url').removeAttr('required');
            $('.default_links').show();
            $('.default_links select').attr('required', 'required');
        }
    });

    $('#check_all').on('click', function () {
        $('.create_perm').each(function () {
            $(this).find('input').prop('checked', true);
        });
    });
    $('#uncheck_all').on('click', function () {
        $('.create_perm').each(function () {
            $(this).find('input').prop('checked', false);
        });
    });

    $('.reply_btn').on('click', function () {
        $(this).parent().find('.comments_form').show();
        $(this).hide();
    });
    $('.edit_btn').on('click', function () {
        $(this).parent().find('.edit_form').show();
        $(this).hide();
    });

    $('.btn_ban').on('click', function () {
        $(this).parent().find('.banned').show();
        $(this).hide();
    });

    $('.close').on('click', function () {
        $(this).parent().hide();
        $(this).parent().parent().find('.btn_ban').show();
    });
});

/***/ })

/******/ });