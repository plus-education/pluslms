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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Exercise.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Exercise.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['activity', 'students'],
  data: function data() {
    return {
      isShowExercise: false,
      studentExercise: Object,
      student: Object
    };
  },
  mounted: function mounted() {},
  methods: {
    showExercise: function showExercise(student) {
      this.studentExercise = JSON.parse(student.activity.text).questions;
      this.student = student;
      this.isShowExercise = true;
      console.log(this.studentExercise);
    },
    backToListOfStudents: function backToListOfStudents() {
      this.student = Object;
      this.studentExercise = Object;
      this.isShowExercise = false;
    },
    save: function save() {
      var data = {
        'activityId': this.activity.id,
        'exercice': {
          questions: this.studentExercise
        }
      };
      console.log(data);
      axios.post('/student/exercise', data).then(function (response) {
        location.reload();
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Tool.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Tool.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Exercise__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Exercise */ "./resources/js/components/Exercise.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    Exercise: _Exercise__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  props: ['resourceName', 'resourceId', 'panel'],
  data: function data() {
    return {
      activity: Object,
      students: Object
    };
  },
  mounted: function mounted() {
    this.activity = this.panel.fields[0].model;
    this.getStudents();
  },
  methods: {
    getStudents: function getStudents() {
      var _this = this;

      Nova.request({
        url: "/courses/usersByActivity/".concat(this.activity.id),
        method: 'get'
      }).then(function (response) {
        _this.students = response.data;
      });
    },
    saveScore: function saveScore(student) {
      if (student.activity.score > this.activity.score) {// student.activity.score = this.activity.score
      }

      Nova.request().post("/courses/saveActivity", {
        activity_id: this.activity.id,
        student_id: student.id,
        comment: student.activity.comment,
        score: student.activity.score
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Exercise.vue?vue&type=template&id=0339297a&":
/*!***********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Exercise.vue?vue&type=template&id=0339297a& ***!
  \***********************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    !_vm.isShowExercise
      ? _c("div", { staticClass: "card mb-6" }, [
          _c("table", { staticClass: "table w-full rounded-lg" }, [
            _vm._m(0),
            _vm._v(" "),
            _c(
              "tbody",
              _vm._l(_vm.students, function(student) {
                return _c("tr", { key: student.id }, [
                  _c(
                    "td",
                    { staticClass: "py-4", staticStyle: { width: "75px" } },
                    [
                      _c("img", {
                        staticClass: "w-full rounded-full",
                        attrs: { src: student.profile_photo_url, alt: "" }
                      })
                    ]
                  ),
                  _vm._v(" "),
                  _c("td", [
                    _vm._v(
                      "\n                    " +
                        _vm._s(student.name) +
                        "\n                "
                    )
                  ]),
                  _vm._v(" "),
                  _c("td", [
                    _vm._v(
                      "\n                    " +
                        _vm._s(student.activity.created_at) +
                        "\n                "
                    )
                  ]),
                  _vm._v(" "),
                  _c("td", { staticClass: "text-center" }, [
                    _vm._v(
                      "\n                    " +
                        _vm._s(student.activity.score) +
                        "\n                "
                    )
                  ]),
                  _vm._v(" "),
                  _c("td", [
                    _c(
                      "button",
                      {
                        on: {
                          click: function($event) {
                            return _vm.showExercise(student)
                          }
                        }
                      },
                      [
                        _c(
                          "svg",
                          {
                            staticClass: "fill-current",
                            attrs: {
                              xmlns: "http://www.w3.org/2000/svg",
                              width: "22",
                              height: "18",
                              viewBox: "0 0 22 16",
                              "aria-labelledby": "view",
                              role: "presentation"
                            }
                          },
                          [
                            _c("path", {
                              attrs: {
                                d:
                                  "M16.56 13.66a8 8 0 0 1-11.32 0L.3 8.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95-.01.01zm-9.9-1.42a6 6 0 0 0 8.48 0L19.38 8l-4.24-4.24a6 6 0 0 0-8.48 0L2.4 8l4.25 4.24h.01zM10.9 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"
                              }
                            })
                          ]
                        )
                      ]
                    )
                  ])
                ])
              }),
              0
            )
          ])
        ])
      : _c(
          "div",
          { staticClass: "bg-white shadow p-4" },
          [
            _c("h3", [
              _vm._v("Respuesta de " + _vm._s(_vm.student.name) + " ")
            ]),
            _vm._v(" "),
            _vm._l(_vm.studentExercise, function(question, index) {
              return _c("div", { staticClass: "mt-4 px-8" }, [
                _c(
                  "div",
                  { staticClass: "border-b border-gray-200 px-8 py-2" },
                  [
                    _c("div", { staticClass: "flex items-center" }, [
                      _c("div", { staticClass: "flex-shrink" }, [
                        _c(
                          "svg",
                          {
                            staticClass: "w-8 text-green-400 mr-2",
                            attrs: {
                              xmlns: "http://www.w3.org/2000/svg",
                              fill: "none",
                              viewBox: "0 0 24 24",
                              stroke: "currentColor"
                            }
                          },
                          [
                            _c("path", {
                              attrs: {
                                "stroke-linecap": "round",
                                "stroke-linejoin": "round",
                                "stroke-width": "2",
                                d:
                                  "M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                              }
                            })
                          ]
                        )
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "flex-1" }, [
                        _c("h2", { staticClass: "font-bold" }, [
                          _vm._v(_vm._s(question.name))
                        ])
                      ])
                    ]),
                    _vm._v(" "),
                    _c("div", {
                      domProps: { innerHTML: _vm._s(question.html) }
                    }),
                    _vm._v(" "),
                    question.options != null
                      ? _c(
                          "div",
                          { staticClass: "w-full mt-2 ml-10" },
                          _vm._l(question.options, function(
                            option,
                            indexOption
                          ) {
                            return _c(
                              "div",
                              {
                                key: option.id,
                                class: {
                                  "bg-green-200":
                                    option.isCorrect && option.isTrue,
                                  "bg-red-500":
                                    !option.isCorrect && option.isChecked
                                }
                              },
                              [
                                _c("input", {
                                  attrs: { type: "checkbox", disabled: "" },
                                  domProps: { checked: option.isChecked }
                                }),
                                _vm._v(" "),
                                _c("label", { attrs: { for: "" } }, [
                                  _vm._v(_vm._s(option.label))
                                ])
                              ]
                            )
                          }),
                          0
                        )
                      : _c("div", { staticClass: "w-auto mt-2 mx-10 p-4" }, [
                          _c(
                            "textarea",
                            {
                              staticClass: "w-full h-32 border",
                              attrs: { cols: "50", disabled: "" }
                            },
                            [
                              _vm._v(
                                "                        " +
                                  _vm._s(question.openAnswer) +
                                  "\n                    "
                              )
                            ]
                          ),
                          _vm._v(" "),
                          _c("div", { staticClass: "mt-4" }, [
                            _c("strong", [_vm._v("Calificar: ")]),
                            _vm._v(" "),
                            _c("input", {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.studentExercise[index].result,
                                  expression: "studentExercise[index].result"
                                }
                              ],
                              staticClass: "w-32 border px-4 py-2 text-right",
                              attrs: {
                                type: "number",
                                min: "0",
                                max: question.score
                              },
                              domProps: {
                                value: _vm.studentExercise[index].result
                              },
                              on: {
                                input: function($event) {
                                  if ($event.target.composing) {
                                    return
                                  }
                                  _vm.$set(
                                    _vm.studentExercise[index],
                                    "result",
                                    $event.target.value
                                  )
                                }
                              }
                            }),
                            _vm._v(
                              "\n                        / " +
                                _vm._s(question.score) +
                                "\n                    "
                            )
                          ])
                        ])
                  ]
                )
              ])
            }),
            _vm._v(" "),
            _vm.isShowExercise
              ? _c("div", { staticClass: "flex justify-center my-6" }, [
                  _c("div", [
                    _c(
                      "button",
                      {
                        staticClass: "bg-gray-100 shadow px-6 py-2",
                        on: {
                          click: function($event) {
                            return _vm.backToListOfStudents()
                          }
                        }
                      },
                      [
                        _vm._v(
                          "\n                    Regresar\n                "
                        )
                      ]
                    )
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "ml-6" }, [
                    _c(
                      "button",
                      {
                        staticClass: "bg-green-500 text-white shadow px-6 py-2",
                        on: {
                          click: function($event) {
                            return _vm.save()
                          }
                        }
                      },
                      [
                        _vm._v(
                          "\n                    Calificar\n                "
                        )
                      ]
                    )
                  ])
                ])
              : _vm._e()
          ],
          2
        )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th"),
        _vm._v(" "),
        _c("th", [_vm._v("\n                    Alumno\n                ")]),
        _vm._v(" "),
        _c("th", [_vm._v("Entrega")]),
        _vm._v(" "),
        _c("th", { staticStyle: { width: "200px" } }, [
          _vm._v("\n                    Nota\n                ")
        ]),
        _vm._v(" "),
        _c("th")
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Tool.vue?vue&type=template&id=68ff5483&":
/*!*******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Tool.vue?vue&type=template&id=68ff5483& ***!
  \*******************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("h1", { staticClass: "text-90 font-normal text-2xl mb-3" }, [
        _vm._v("Calificar: ")
      ]),
      _vm._v(" "),
      _vm.activity.type == "EXERCISE"
        ? _c("exercise", {
            attrs: { activity: _vm.activity, students: _vm.students }
          })
        : _c("div", { staticClass: "card mb-6" }, [
            _c("table", { staticClass: "table w-full rounded-lg" }, [
              _c("thead", [
                _c("tr", [
                  _c("th"),
                  _vm._v(" "),
                  _c("th", [
                    _vm._v(
                      "\n                          Alumno\n                      "
                    )
                  ]),
                  _vm._v(" "),
                  _c("th", [_vm._v("Entrega")]),
                  _vm._v(" "),
                  _c("th", [_vm._v("Modificación")]),
                  _vm._v(" "),
                  _c("th", [
                    _vm._v(
                      "\n                          Tarea\n                      "
                    )
                  ]),
                  _vm._v(" "),
                  _c("th", [
                    _vm._v(
                      "\n                          Comentario\n                      "
                    )
                  ]),
                  _vm._v(" "),
                  _c("th", { staticStyle: { width: "200px" } }, [
                    _vm._v(
                      "\n                          Nota\n                      "
                    )
                  ])
                ])
              ]),
              _vm._v(" "),
              _c(
                "tbody",
                _vm._l(_vm.students, function(student) {
                  return _c("tr", { key: student.id }, [
                    _c(
                      "td",
                      { staticClass: "py-4", staticStyle: { width: "75px" } },
                      [
                        _c("img", {
                          staticClass: "w-full rounded-full",
                          attrs: { src: student.profile_photo_url, alt: "" }
                        })
                      ]
                    ),
                    _vm._v(" "),
                    _c("td", [
                      _vm._v(
                        "\n                          " +
                          _vm._s(student.name) +
                          "\n                      "
                      )
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _vm._v(
                        "\n                          " +
                          _vm._s(student.activity.created_at) +
                          "\n                      "
                      )
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _vm._v(
                        "\n                          " +
                          _vm._s(student.activity.update_at) +
                          "\n                      "
                      )
                    ]),
                    _vm._v(" "),
                    _c("td", { staticClass: "text-center" }, [
                      student.activity.hasOwnProperty("file")
                        ? _c("div", [
                            student.activity.file != null ||
                            student.activity.file == "null"
                              ? _c(
                                  "a",
                                  {
                                    staticClass:
                                      "btn text-sm px-4 py-2 btn-default",
                                    attrs: {
                                      href: "/storage/" + student.activity.file,
                                      target: "_blank",
                                      download: ""
                                    }
                                  },
                                  [
                                    _vm._v(
                                      "\n                                  Descargar\n                              "
                                    )
                                  ]
                                )
                              : _vm._e()
                          ])
                        : _vm._e()
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: student.activity.comment,
                            expression: "student.activity.comment"
                          }
                        ],
                        staticClass:
                          "w-full form-control form-input form-input-bordered",
                        attrs: { type: "text" },
                        domProps: { value: student.activity.comment },
                        on: {
                          change: function($event) {
                            return _vm.saveScore(student)
                          },
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              student.activity,
                              "comment",
                              $event.target.value
                            )
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _c("div", { staticClass: "flex items-center" }, [
                        _c("div", { staticClass: "flex-1 mr-2" }, [
                          _c("input", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: student.activity.score,
                                expression: "student.activity.score"
                              }
                            ],
                            staticClass:
                              "w-full form-control form-input form-input-bordered",
                            attrs: { type: "number", max: _vm.activity.score },
                            domProps: { value: student.activity.score },
                            on: {
                              change: function($event) {
                                return _vm.saveScore(student)
                              },
                              input: function($event) {
                                if ($event.target.composing) {
                                  return
                                }
                                _vm.$set(
                                  student.activity,
                                  "score",
                                  $event.target.value
                                )
                              }
                            }
                          })
                        ]),
                        _vm._v(" "),
                        _c("div", { staticClass: "flex-1" }, [
                          _vm._v(
                            "\n                               / " +
                              _vm._s(_vm.activity.score) +
                              "\n                           "
                          )
                        ])
                      ])
                    ])
                  ])
                }),
                0
              )
            ])
          ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () {
        injectStyles.call(
          this,
          (options.functional ? this.parent : this).$root.$options.shadowRoot
        )
      }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functional component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./resources/js/components/Exercise.vue":
/*!**********************************************!*\
  !*** ./resources/js/components/Exercise.vue ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Exercise_vue_vue_type_template_id_0339297a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Exercise.vue?vue&type=template&id=0339297a& */ "./resources/js/components/Exercise.vue?vue&type=template&id=0339297a&");
/* harmony import */ var _Exercise_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Exercise.vue?vue&type=script&lang=js& */ "./resources/js/components/Exercise.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Exercise_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Exercise_vue_vue_type_template_id_0339297a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Exercise_vue_vue_type_template_id_0339297a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Exercise.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Exercise.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./resources/js/components/Exercise.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Exercise_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Exercise.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Exercise.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Exercise_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Exercise.vue?vue&type=template&id=0339297a&":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/Exercise.vue?vue&type=template&id=0339297a& ***!
  \*****************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Exercise_vue_vue_type_template_id_0339297a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Exercise.vue?vue&type=template&id=0339297a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Exercise.vue?vue&type=template&id=0339297a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Exercise_vue_vue_type_template_id_0339297a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Exercise_vue_vue_type_template_id_0339297a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Tool.vue":
/*!******************************************!*\
  !*** ./resources/js/components/Tool.vue ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Tool_vue_vue_type_template_id_68ff5483___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Tool.vue?vue&type=template&id=68ff5483& */ "./resources/js/components/Tool.vue?vue&type=template&id=68ff5483&");
/* harmony import */ var _Tool_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Tool.vue?vue&type=script&lang=js& */ "./resources/js/components/Tool.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Tool_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Tool_vue_vue_type_template_id_68ff5483___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Tool_vue_vue_type_template_id_68ff5483___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Tool.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Tool.vue?vue&type=script&lang=js&":
/*!*******************************************************************!*\
  !*** ./resources/js/components/Tool.vue?vue&type=script&lang=js& ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Tool_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Tool.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Tool.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Tool_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Tool.vue?vue&type=template&id=68ff5483&":
/*!*************************************************************************!*\
  !*** ./resources/js/components/Tool.vue?vue&type=template&id=68ff5483& ***!
  \*************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Tool_vue_vue_type_template_id_68ff5483___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Tool.vue?vue&type=template&id=68ff5483& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Tool.vue?vue&type=template&id=68ff5483&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Tool_vue_vue_type_template_id_68ff5483___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Tool_vue_vue_type_template_id_68ff5483___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/tool.js":
/*!******************************!*\
  !*** ./resources/js/tool.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Nova.booting(function (Vue, router, store) {
  Vue.config.devtools = true;
  Vue.component('activity-scores', __webpack_require__(/*! ./components/Tool */ "./resources/js/components/Tool.vue")["default"]);
});

/***/ }),

/***/ 0:
/*!************************************!*\
  !*** multi ./resources/js/tool.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/jonathanrodas/proyectos/pluslms/nova-components/ActivityScores/resources/js/tool.js */"./resources/js/tool.js");


/***/ })

/******/ });