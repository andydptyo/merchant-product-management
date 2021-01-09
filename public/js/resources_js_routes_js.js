(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_routes_js"],{

/***/ "./resources/js/routes.js":
/*!********************************!*\
  !*** ./resources/js/routes.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _views_categories_routes__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./views/categories/routes */ "./resources/js/views/categories/routes.js");
/* harmony import */ var _views_products_routes__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./views/products/routes */ "./resources/js/views/products/routes.js");
/* harmony import */ var _views_merchants_routes__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./views/merchants/routes */ "./resources/js/views/merchants/routes.js");
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }





var Home = function Home() {
  return __webpack_require__.e(/*! import() */ "resources_js_views_Home_vue").then(__webpack_require__.bind(__webpack_require__, /*! ./views/Home */ "./resources/js/views/Home.vue"));
};

var routes = [{
  path: '/',
  component: Home,
  name: 'home'
}].concat(_toConsumableArray(_views_categories_routes__WEBPACK_IMPORTED_MODULE_0__.default), _toConsumableArray(_views_products_routes__WEBPACK_IMPORTED_MODULE_1__.default), _toConsumableArray(_views_merchants_routes__WEBPACK_IMPORTED_MODULE_2__.default));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (routes);

/***/ }),

/***/ "./resources/js/views/categories/routes.js":
/*!*************************************************!*\
  !*** ./resources/js/views/categories/routes.js ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
var CategoryIndex = function CategoryIndex() {
  return __webpack_require__.e(/*! import() */ "resources_js_views_categories_Index_vue").then(__webpack_require__.bind(__webpack_require__, /*! ./Index */ "./resources/js/views/categories/Index.vue"));
};

var CategoryCreate = function CategoryCreate() {
  return __webpack_require__.e(/*! import() */ "resources_js_views_categories_Create_vue").then(__webpack_require__.bind(__webpack_require__, /*! ./Create */ "./resources/js/views/categories/Create.vue"));
};

var CategoryShow = function CategoryShow() {
  return __webpack_require__.e(/*! import() */ "resources_js_views_categories_Show_vue").then(__webpack_require__.bind(__webpack_require__, /*! ./Show */ "./resources/js/views/categories/Show.vue"));
};

var CategoryEdit = function CategoryEdit() {
  return __webpack_require__.e(/*! import() */ "resources_js_views_categories_Edit_vue").then(__webpack_require__.bind(__webpack_require__, /*! ./Edit */ "./resources/js/views/categories/Edit.vue"));
};

var CategoryRoutes = [{
  path: '/categories',
  component: CategoryIndex,
  name: 'CategoryIndex',
  children: [{
    path: '/categories/create',
    component: CategoryCreate,
    name: 'CategoryCreate'
  }, {
    path: '/categories/:id',
    component: CategoryShow,
    name: 'CategoryShow'
  }, {
    path: '/categories/:id/edit',
    component: CategoryEdit,
    name: 'CategoryEdit'
  }]
}];
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (CategoryRoutes);

/***/ }),

/***/ "./resources/js/views/merchants/routes.js":
/*!************************************************!*\
  !*** ./resources/js/views/merchants/routes.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
var MerchantIndex = function MerchantIndex() {
  return __webpack_require__.e(/*! import() */ "resources_js_views_merchants_Index_vue").then(__webpack_require__.bind(__webpack_require__, /*! ./Index */ "./resources/js/views/merchants/Index.vue"));
};

var MerchantCreate = function MerchantCreate() {
  return __webpack_require__.e(/*! import() */ "resources_js_views_merchants_Create_vue").then(__webpack_require__.bind(__webpack_require__, /*! ./Create */ "./resources/js/views/merchants/Create.vue"));
};

var MerchantShow = function MerchantShow() {
  return __webpack_require__.e(/*! import() */ "resources_js_views_merchants_Show_vue").then(__webpack_require__.bind(__webpack_require__, /*! ./Show */ "./resources/js/views/merchants/Show.vue"));
};

var MerchantEdit = function MerchantEdit() {
  return __webpack_require__.e(/*! import() */ "resources_js_views_merchants_Edit_vue").then(__webpack_require__.bind(__webpack_require__, /*! ./Edit */ "./resources/js/views/merchants/Edit.vue"));
};

var MerchantRoutes = [{
  path: '/merchants',
  component: MerchantIndex,
  name: 'MerchantIndex',
  children: [{
    path: '/create',
    component: MerchantCreate,
    name: 'MerchantCreate'
  }, {
    path: '/:id',
    component: MerchantShow,
    name: 'MerchantShow'
  }, {
    path: '/:id/edit',
    component: MerchantEdit,
    name: 'MerchantEdit'
  }]
}];
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (MerchantRoutes);

/***/ }),

/***/ "./resources/js/views/products/routes.js":
/*!***********************************************!*\
  !*** ./resources/js/views/products/routes.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
var ProductIndex = function ProductIndex() {
  return __webpack_require__.e(/*! import() */ "resources_js_views_products_Index_vue").then(__webpack_require__.bind(__webpack_require__, /*! ./Index */ "./resources/js/views/products/Index.vue"));
};

var ProductCreate = function ProductCreate() {
  return __webpack_require__.e(/*! import() */ "resources_js_views_products_Create_vue").then(__webpack_require__.bind(__webpack_require__, /*! ./Create */ "./resources/js/views/products/Create.vue"));
};

var ProductShow = function ProductShow() {
  return __webpack_require__.e(/*! import() */ "resources_js_views_products_Show_vue").then(__webpack_require__.bind(__webpack_require__, /*! ./Show */ "./resources/js/views/products/Show.vue"));
};

var ProductEdit = function ProductEdit() {
  return __webpack_require__.e(/*! import() */ "resources_js_views_products_Edit_vue").then(__webpack_require__.bind(__webpack_require__, /*! ./Edit */ "./resources/js/views/products/Edit.vue"));
};

var ProductRoutes = [{
  path: '/products',
  component: ProductIndex,
  name: 'ProductIndex',
  children: [{
    path: '/create',
    component: ProductCreate,
    name: 'ProductCreate'
  }, {
    path: '/:id',
    component: ProductShow,
    name: 'ProductShow'
  }, {
    path: '/:id/edit',
    component: ProductEdit,
    name: 'ProductEdit'
  }]
}];
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ProductRoutes);

/***/ })

}]);