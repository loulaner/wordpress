/*! jQuery UI - v1.8.21 - 2012-06-05
 * https://github.com/jquery/jquery-ui
 * Includes: jquery.ui.core.js
 * Copyright (c) 2012 AUTHORS.txt; Licensed MIT, GPL */
(function (a, b) {
    function c(b, c) {
        var e = b.nodeName.toLowerCase();
        if ("area" === e) {
            var f = b.parentNode,
                g = f.name,
                h;
            return !b.href || !g || f.nodeName.toLowerCase() !== "map" ? !1 : (h = a("img[usemap=#" + g + "]")[0], !! h && d(h))
        }
        return (/input|select|textarea|button|object/.test(e) ? !b.disabled : "a" == e ? b.href || c : c) && d(b)
    }

    function d(b) {
        return !a(b).parents().andSelf().filter(function () {
            return a.curCSS(this, "visibility") === "hidden" || a.expr.filters.hidden(this)
        }).length
    }
    a.ui = a.ui || {};
    if (a.ui.version) return;
    a.extend(a.ui, {
        version: "1.8.21",
        keyCode: {
            ALT: 18,
            BACKSPACE: 8,
            CAPS_LOCK: 20,
            COMMA: 188,
            COMMAND: 91,
            COMMAND_LEFT: 91,
            COMMAND_RIGHT: 93,
            CONTROL: 17,
            DELETE: 46,
            DOWN: 40,
            END: 35,
            ENTER: 13,
            ESCAPE: 27,
            HOME: 36,
            INSERT: 45,
            LEFT: 37,
            MENU: 93,
            NUMPAD_ADD: 107,
            NUMPAD_DECIMAL: 110,
            NUMPAD_DIVIDE: 111,
            NUMPAD_ENTER: 108,
            NUMPAD_MULTIPLY: 106,
            NUMPAD_SUBTRACT: 109,
            PAGE_DOWN: 34,
            PAGE_UP: 33,
            PERIOD: 190,
            RIGHT: 39,
            SHIFT: 16,
            SPACE: 32,
            TAB: 9,
            UP: 38,
            WINDOWS: 91
        }
    }), a.fn.extend({
        propAttr: a.fn.prop || a.fn.attr,
        _focus: a.fn.focus,
        focus: function (b, c) {
            return typeof b == "number" ? this.each(function () {
                var d = this;
                setTimeout(function () {
                    a(d).focus(), c && c.call(d)
                }, b)
            }) : this._focus.apply(this, arguments)
        },
        scrollParent: function () {
            var b;
            return a.browser.msie && /(static|relative)/.test(this.css("position")) || /absolute/.test(this.css("position")) ? b = this.parents().filter(function () {
                return /(relative|absolute|fixed)/.test(a.curCSS(this, "position", 1)) && /(auto|scroll)/.test(a.curCSS(this, "overflow", 1) + a.curCSS(this, "overflow-y", 1) + a.curCSS(this, "overflow-x", 1))
            }).eq(0) : b = this.parents().filter(function () {
                return /(auto|scroll)/.test(a.curCSS(this, "overflow", 1) + a.curCSS(this, "overflow-y", 1) + a.curCSS(this, "overflow-x", 1))
            }).eq(0), /fixed/.test(this.css("position")) || !b.length ? a(document) : b
        },
        zIndex: function (c) {
            if (c !== b) return this.css("zIndex", c);
            if (this.length) {
                var d = a(this[0]),
                    e, f;
                while (d.length && d[0] !== document) {
                    e = d.css("position");
                    if (e === "absolute" || e === "relative" || e === "fixed") {
                        f = parseInt(d.css("zIndex"), 10);
                        if (!isNaN(f) && f !== 0) return f
                    }
                    d = d.parent()
                }
            }
            return 0
        },
        disableSelection: function () {
            return this.bind((a.support.selectstart ? "selectstart" : "mousedown") + ".ui-disableSelection", function (a) {
                a.preventDefault()
            })
        },
        enableSelection: function () {
            return this.unbind(".ui-disableSelection")
        }
    }), a.each(["Width", "Height"], function (c, d) {
        function h(b, c, d, f) {
            return a.each(e, function () {
                c -= parseFloat(a.curCSS(b, "padding" + this, !0)) || 0, d && (c -= parseFloat(a.curCSS(b, "border" + this + "Width", !0)) || 0), f && (c -= parseFloat(a.curCSS(b, "margin" + this, !0)) || 0)
            }), c
        }
        var e = d === "Width" ? ["Left", "Right"] : ["Top", "Bottom"],
            f = d.toLowerCase(),
            g = {
                innerWidth: a.fn.innerWidth,
                innerHeight: a.fn.innerHeight,
                outerWidth: a.fn.outerWidth,
                outerHeight: a.fn.outerHeight
            };
        a.fn["inner" + d] = function (c) {
            return c === b ? g["inner" + d].call(this) : this.each(function () {
                a(this).css(f, h(this, c) + "px")
            })
        }, a.fn["outer" + d] = function (b, c) {
            return typeof b != "number" ? g["outer" + d].call(this, b) : this.each(function () {
                a(this).css(f, h(this, b, !0, c) + "px")
            })
        }
    }), a.extend(a.expr[":"], {
        data: function (b, c, d) {
            return !!a.data(b, d[3])
        },
        focusable: function (b) {
            return c(b, !isNaN(a.attr(b, "tabindex")))
        },
        tabbable: function (b) {
            var d = a.attr(b, "tabindex"),
                e = isNaN(d);
            return (e || d >= 0) && c(b, !e)
        }
    }), a(function () {
        var b = document.body,
            c = b.appendChild(c = document.createElement("div"));
        c.offsetHeight, a.extend(c.style, {
            minHeight: "100px",
            height: "auto",
            padding: 0,
            borderWidth: 0
        }), a.support.minHeight = c.offsetHeight === 100, a.support.selectstart = "onselectstart" in c, b.removeChild(c).style.display = "none"
    }), a.extend(a.ui, {
        plugin: {
            add: function (b, c, d) {
                var e = a.ui[b].prototype;
                for (var f in d) e.plugins[f] = e.plugins[f] || [], e.plugins[f].push([c, d[f]])
            },
            call: function (a, b, c) {
                var d = a.plugins[b];
                if (!d || !a.element[0].parentNode) return;
                for (var e = 0; e < d.length; e++) a.options[d[e][0]] && d[e][1].apply(a.element, c)
            }
        },
        contains: function (a, b) {
            return document.compareDocumentPosition ? a.compareDocumentPosition(b) & 16 : a !== b && a.contains(b)
        },
        hasScroll: function (b, c) {
            if (a(b).css("overflow") === "hidden") return !1;
            var d = c && c === "left" ? "scrollLeft" : "scrollTop",
                e = !1;
            return b[d] > 0 ? !0 : (b[d] = 1, e = b[d] > 0, b[d] = 0, e)
        },
        isOverAxis: function (a, b, c) {
            return a > b && a < b + c
        },
        isOver: function (b, c, d, e, f, g) {
            return a.ui.isOverAxis(b, d, f) && a.ui.isOverAxis(c, e, g)
        }
    })
})(jQuery);;
/*! jQuery UI - v1.8.21 - 2012-06-05
 * https://github.com/jquery/jquery-ui
 * Includes: jquery.ui.widget.js
 * Copyright (c) 2012 AUTHORS.txt; Licensed MIT, GPL */
(function (a, b) {
    if (a.cleanData) {
        var c = a.cleanData;
        a.cleanData = function (b) {
            for (var d = 0, e;
                (e = b[d]) != null; d++) try {
                a(e).triggerHandler("remove")
            } catch (f) {}
            c(b)
        }
    } else {
        var d = a.fn.remove;
        a.fn.remove = function (b, c) {
            return this.each(function () {
                return c || (!b || a.filter(b, [this]).length) && a("*", this).add([this]).each(function () {
                    try {
                        a(this).triggerHandler("remove")
                    } catch (b) {}
                }), d.call(a(this), b, c)
            })
        }
    }
    a.widget = function (b, c, d) {
        var e = b.split(".")[0],
            f;
        b = b.split(".")[1], f = e + "-" + b, d || (d = c, c = a.Widget), a.expr[":"][f] = function (c) {
            return !!a.data(c, b)
        }, a[e] = a[e] || {}, a[e][b] = function (a, b) {
            arguments.length && this._createWidget(a, b)
        };
        var g = new c;
        g.options = a.extend(!0, {}, g.options), a[e][b].prototype = a.extend(!0, g, {
            namespace: e,
            widgetName: b,
            widgetEventPrefix: a[e][b].prototype.widgetEventPrefix || b,
            widgetBaseClass: f
        }, d), a.widget.bridge(b, a[e][b])
    }, a.widget.bridge = function (c, d) {
        a.fn[c] = function (e) {
            var f = typeof e == "string",
                g = Array.prototype.slice.call(arguments, 1),
                h = this;
            return e = !f && g.length ? a.extend.apply(null, [!0, e].concat(g)) : e, f && e.charAt(0) === "_" ? h : (f ? this.each(function () {
                var d = a.data(this, c),
                    f = d && a.isFunction(d[e]) ? d[e].apply(d, g) : d;
                if (f !== d && f !== b) return h = f, !1
            }) : this.each(function () {
                var b = a.data(this, c);
                b ? b.option(e || {})._init() : a.data(this, c, new d(e, this))
            }), h)
        }
    }, a.Widget = function (a, b) {
        arguments.length && this._createWidget(a, b)
    }, a.Widget.prototype = {
        widgetName: "widget",
        widgetEventPrefix: "",
        options: {
            disabled: !1
        },
        _createWidget: function (b, c) {
            a.data(c, this.widgetName, this), this.element = a(c), this.options = a.extend(!0, {}, this.options, this._getCreateOptions(), b);
            var d = this;
            this.element.bind("remove." + this.widgetName, function () {
                d.destroy()
            }), this._create(), this._trigger("create"), this._init()
        },
        _getCreateOptions: function () {
            return a.metadata && a.metadata.get(this.element[0])[this.widgetName]
        },
        _create: function () {},
        _init: function () {},
        destroy: function () {
            this.element.unbind("." + this.widgetName).removeData(this.widgetName), this.widget().unbind("." + this.widgetName).removeAttr("aria-disabled").removeClass(this.widgetBaseClass + "-disabled " + "ui-state-disabled")
        },
        widget: function () {
            return this.element
        },
        option: function (c, d) {
            var e = c;
            if (arguments.length === 0) return a.extend({}, this.options);
            if (typeof c == "string") {
                if (d === b) return this.options[c];
                e = {}, e[c] = d
            }
            return this._setOptions(e), this
        },
        _setOptions: function (b) {
            var c = this;
            return a.each(b, function (a, b) {
                c._setOption(a, b)
            }), this
        },
        _setOption: function (a, b) {
            return this.options[a] = b, a === "disabled" && this.widget()[b ? "addClass" : "removeClass"](this.widgetBaseClass + "-disabled" + " " + "ui-state-disabled").attr("aria-disabled", b), this
        },
        enable: function () {
            return this._setOption("disabled", !1)
        },
        disable: function () {
            return this._setOption("disabled", !0)
        },
        _trigger: function (b, c, d) {
            var e, f, g = this.options[b];
            d = d || {}, c = a.Event(c), c.type = (b === this.widgetEventPrefix ? b : this.widgetEventPrefix + b).toLowerCase(), c.target = this.element[0], f = c.originalEvent;
            if (f)
                for (e in f) e in c || (c[e] = f[e]);
            return this.element.trigger(c, d), !(a.isFunction(g) && g.call(this.element[0], c, d) === !1 || c.isDefaultPrevented())
        }
    }
})(jQuery);;
/*! jQuery UI - v1.8.21 - 2012-06-05
 * https://github.com/jquery/jquery-ui
 * Includes: jquery.ui.tabs.js
 * Copyright (c) 2012 AUTHORS.txt; Licensed MIT, GPL */
(function (a, b) {
    function e() {
        return ++c
    }

    function f() {
        return ++d
    }
    var c = 0,
        d = 0;
    a.widget("ui.tabs", {
        options: {
            add: null,
            ajaxOptions: null,
            cache: !1,
            cookie: null,
            collapsible: !1,
            disable: null,
            disabled: [],
            enable: null,
            event: "click",
            fx: null,
            idPrefix: "ui-tabs-",
            load: null,
            panelTemplate: "<div></div>",
            remove: null,
            select: null,
            show: null,
            spinner: "<em>Loading&#8230;</em>",
            tabTemplate: "<li><a href='#{href}'><span>#{label}</span></a></li>"
        },
        _create: function () {
            this._tabify(!0)
        },
        _setOption: function (a, b) {
            if (a == "selected") {
                if (this.options.collapsible && b == this.options.selected) return;
                this.select(b)
            } else this.options[a] = b, this._tabify()
        },
        _tabId: function (a) {
            return a.title && a.title.replace(/\s/g, "_").replace(/[^\w\u00c0-\uFFFF-]/g, "") || this.options.idPrefix + e()
        },
        _sanitizeSelector: function (a) {
            return a.replace(/:/g, "\\:")
        },
        _cookie: function () {
            var b = this.cookie || (this.cookie = this.options.cookie.name || "ui-tabs-" + f());
            return a.cookie.apply(null, [b].concat(a.makeArray(arguments)))
        },
        _ui: function (a, b) {
            return {
                tab: a,
                panel: b,
                index: this.anchors.index(a)
            }
        },
        _cleanup: function () {
            this.lis.filter(".ui-state-processing").removeClass("ui-state-processing").find("span:data(label.tabs)").each(function () {
                var b = a(this);
                b.html(b.data("label.tabs")).removeData("label.tabs")
            })
        },
        _tabify: function (c) {
            function m(b, c) {
                b.css("display", ""), !a.support.opacity && c.opacity && b[0].style.removeAttribute("filter")
            }
            var d = this,
                e = this.options,
                f = /^#.+/;
            this.list = this.element.find("ol,ul").eq(0), this.lis = a(" > li:has(a[href])", this.list), this.anchors = this.lis.map(function () {
                return a("a", this)[0]
            }), this.panels = a([]), this.anchors.each(function (b, c) {
                var g = a(c).attr("href"),
                    h = g.split("#")[0],
                    i;
                h && (h === location.toString().split("#")[0] || (i = a("base")[0]) && h === i.href) && (g = c.hash, c.href = g);
                if (f.test(g)) d.panels = d.panels.add(d.element.find(d._sanitizeSelector(g)));
                else if (g && g !== "#") {
                    a.data(c, "href.tabs", g), a.data(c, "load.tabs", g.replace(/#.*$/, ""));
                    var j = d._tabId(c);
                    c.href = "#" + j;
                    var k = d.element.find("#" + j);
                    k.length || (k = a(e.panelTemplate).attr("id", j).addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").insertAfter(d.panels[b - 1] || d.list), k.data("destroy.tabs", !0)), d.panels = d.panels.add(k)
                } else e.disabled.push(b)
            }), c ? (this.element.addClass("ui-tabs ui-widget ui-widget-content ui-corner-all"), this.list.addClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all"), this.lis.addClass("ui-state-default ui-corner-top"), this.panels.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom"), e.selected === b ? (location.hash && this.anchors.each(function (a, b) {
                if (b.hash == location.hash) return e.selected = a, !1
            }), typeof e.selected != "number" && e.cookie && (e.selected = parseInt(d._cookie(), 10)), typeof e.selected != "number" && this.lis.filter(".ui-tabs-selected").length && (e.selected = this.lis.index(this.lis.filter(".ui-tabs-selected"))), e.selected = e.selected || (this.lis.length ? 0 : -1)) : e.selected === null && (e.selected = -1), e.selected = e.selected >= 0 && this.anchors[e.selected] || e.selected < 0 ? e.selected : 0, e.disabled = a.unique(e.disabled.concat(a.map(this.lis.filter(".ui-state-disabled"), function (a, b) {
                return d.lis.index(a)
            }))).sort(), a.inArray(e.selected, e.disabled) != -1 && e.disabled.splice(a.inArray(e.selected, e.disabled), 1), this.panels.addClass("ui-tabs-hide"), this.lis.removeClass("ui-tabs-selected ui-state-active"), e.selected >= 0 && this.anchors.length && (d.element.find(d._sanitizeSelector(d.anchors[e.selected].hash)).removeClass("ui-tabs-hide"), this.lis.eq(e.selected).addClass("ui-tabs-selected ui-state-active"), d.element.queue("tabs", function () {
                d._trigger("show", null, d._ui(d.anchors[e.selected], d.element.find(d._sanitizeSelector(d.anchors[e.selected].hash))[0]))
            }), this.load(e.selected)), a(window).bind("unload", function () {
                d.lis.add(d.anchors).unbind(".tabs"), d.lis = d.anchors = d.panels = null
            })) : e.selected = this.lis.index(this.lis.filter(".ui-tabs-selected")), this.element[e.collapsible ? "addClass" : "removeClass"]("ui-tabs-collapsible"), e.cookie && this._cookie(e.selected, e.cookie);
            for (var g = 0, h; h = this.lis[g]; g++) a(h)[a.inArray(g, e.disabled) != -1 && !a(h).hasClass("ui-tabs-selected") ? "addClass" : "removeClass"]("ui-state-disabled");
            e.cache === !1 && this.anchors.removeData("cache.tabs"), this.lis.add(this.anchors).unbind(".tabs");
            if (e.event !== "mouseover") {
                var i = function (a, b) {
                    b.is(":not(.ui-state-disabled)") && b.addClass("ui-state-" + a)
                }, j = function (a, b) {
                        b.removeClass("ui-state-" + a)
                    };
                this.lis.bind("mouseover.tabs", function () {
                    i("hover", a(this))
                }), this.lis.bind("mouseout.tabs", function () {
                    j("hover", a(this))
                }), this.anchors.bind("focus.tabs", function () {
                    i("focus", a(this).closest("li"))
                }), this.anchors.bind("blur.tabs", function () {
                    j("focus", a(this).closest("li"))
                })
            }
            var k, l;
            e.fx && (a.isArray(e.fx) ? (k = e.fx[0], l = e.fx[1]) : k = l = e.fx);
            var n = l ? function (b, c) {
                    a(b).closest("li").addClass("ui-tabs-selected ui-state-active"), c.hide().removeClass("ui-tabs-hide").animate(l, l.duration || "normal", function () {
                        m(c, l), d._trigger("show", null, d._ui(b, c[0]))
                    })
                } : function (b, c) {
                    a(b).closest("li").addClass("ui-tabs-selected ui-state-active"), c.removeClass("ui-tabs-hide"), d._trigger("show", null, d._ui(b, c[0]))
                }, o = k ? function (a, b) {
                    b.animate(k, k.duration || "normal", function () {
                        d.lis.removeClass("ui-tabs-selected ui-state-active"), b.addClass("ui-tabs-hide"), m(b, k), d.element.dequeue("tabs")
                    })
                } : function (a, b, c) {
                    d.lis.removeClass("ui-tabs-selected ui-state-active"), b.addClass("ui-tabs-hide"), d.element.dequeue("tabs")
                };
            this.anchors.bind(e.event + ".tabs", function () {
                var b = this,
                    c = a(b).closest("li"),
                    f = d.panels.filter(":not(.ui-tabs-hide)"),
                    g = d.element.find(d._sanitizeSelector(b.hash));
                if (c.hasClass("ui-tabs-selected") && !e.collapsible || c.hasClass("ui-state-disabled") || c.hasClass("ui-state-processing") || d.panels.filter(":animated").length || d._trigger("select", null, d._ui(this, g[0])) === !1) return this.blur(), !1;
                e.selected = d.anchors.index(this), d.abort();
                if (e.collapsible) {
                    if (c.hasClass("ui-tabs-selected")) return e.selected = -1, e.cookie && d._cookie(e.selected, e.cookie), d.element.queue("tabs", function () {
                        o(b, f)
                    }).dequeue("tabs"), this.blur(), !1;
                    if (!f.length) return e.cookie && d._cookie(e.selected, e.cookie), d.element.queue("tabs", function () {
                        n(b, g)
                    }), d.load(d.anchors.index(this)), this.blur(), !1
                }
                e.cookie && d._cookie(e.selected, e.cookie);
                if (g.length) f.length && d.element.queue("tabs", function () {
                    o(b, f)
                }), d.element.queue("tabs", function () {
                    n(b, g)
                }), d.load(d.anchors.index(this));
                else throw "jQuery UI Tabs: Mismatching fragment identifier.";
                a.browser.msie && this.blur()
            }), this.anchors.bind("click.tabs", function () {
                return !1
            })
        },
        _getIndex: function (a) {
            return typeof a == "string" && (a = this.anchors.index(this.anchors.filter("[href$='" + a + "']"))), a
        },
        destroy: function () {
            var b = this.options;
            return this.abort(), this.element.unbind(".tabs").removeClass("ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible").removeData("tabs"), this.list.removeClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all"), this.anchors.each(function () {
                var b = a.data(this, "href.tabs");
                b && (this.href = b);
                var c = a(this).unbind(".tabs");
                a.each(["href", "load", "cache"], function (a, b) {
                    c.removeData(b + ".tabs")
                })
            }), this.lis.unbind(".tabs").add(this.panels).each(function () {
                a.data(this, "destroy.tabs") ? a(this).remove() : a(this).removeClass(["ui-state-default", "ui-corner-top", "ui-tabs-selected", "ui-state-active", "ui-state-hover", "ui-state-focus", "ui-state-disabled", "ui-tabs-panel", "ui-widget-content", "ui-corner-bottom", "ui-tabs-hide"].join(" "))
            }), b.cookie && this._cookie(null, b.cookie), this
        },
        add: function (c, d, e) {
            e === b && (e = this.anchors.length);
            var f = this,
                g = this.options,
                h = a(g.tabTemplate.replace(/#\{href\}/g, c).replace(/#\{label\}/g, d)),
                i = c.indexOf("#") ? this._tabId(a("a", h)[0]) : c.replace("#", "");
            h.addClass("ui-state-default ui-corner-top").data("destroy.tabs", !0);
            var j = f.element.find("#" + i);
            return j.length || (j = a(g.panelTemplate).attr("id", i).data("destroy.tabs", !0)), j.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide"), e >= this.lis.length ? (h.appendTo(this.list), j.appendTo(this.list[0].parentNode)) : (h.insertBefore(this.lis[e]), j.insertBefore(this.panels[e])), g.disabled = a.map(g.disabled, function (a, b) {
                return a >= e ? ++a : a
            }), this._tabify(), this.anchors.length == 1 && (g.selected = 0, h.addClass("ui-tabs-selected ui-state-active"), j.removeClass("ui-tabs-hide"), this.element.queue("tabs", function () {
                f._trigger("show", null, f._ui(f.anchors[0], f.panels[0]))
            }), this.load(0)), this._trigger("add", null, this._ui(this.anchors[e], this.panels[e])), this
        },
        remove: function (b) {
            b = this._getIndex(b);
            var c = this.options,
                d = this.lis.eq(b).remove(),
                e = this.panels.eq(b).remove();
            return d.hasClass("ui-tabs-selected") && this.anchors.length > 1 && this.select(b + (b + 1 < this.anchors.length ? 1 : -1)), c.disabled = a.map(a.grep(c.disabled, function (a, c) {
                return a != b
            }), function (a, c) {
                return a >= b ? --a : a
            }), this._tabify(), this._trigger("remove", null, this._ui(d.find("a")[0], e[0])), this
        },
        enable: function (b) {
            b = this._getIndex(b);
            var c = this.options;
            if (a.inArray(b, c.disabled) == -1) return;
            return this.lis.eq(b).removeClass("ui-state-disabled"), c.disabled = a.grep(c.disabled, function (a, c) {
                return a != b
            }), this._trigger("enable", null, this._ui(this.anchors[b], this.panels[b])), this
        },
        disable: function (a) {
            a = this._getIndex(a);
            var b = this,
                c = this.options;
            return a != c.selected && (this.lis.eq(a).addClass("ui-state-disabled"), c.disabled.push(a), c.disabled.sort(), this._trigger("disable", null, this._ui(this.anchors[a], this.panels[a]))), this
        },
        select: function (a) {
            a = this._getIndex(a);
            if (a == -1)
                if (this.options.collapsible && this.options.selected != -1) a = this.options.selected;
                else return this;
            return this.anchors.eq(a).trigger(this.options.event + ".tabs"), this
        },
        load: function (b) {
            b = this._getIndex(b);
            var c = this,
                d = this.options,
                e = this.anchors.eq(b)[0],
                f = a.data(e, "load.tabs");
            this.abort();
            if (!f || this.element.queue("tabs").length !== 0 && a.data(e, "cache.tabs")) {
                this.element.dequeue("tabs");
                return
            }
            this.lis.eq(b).addClass("ui-state-processing");
            if (d.spinner) {
                var g = a("span", e);
                g.data("label.tabs", g.html()).html(d.spinner)
            }
            return this.xhr = a.ajax(a.extend({}, d.ajaxOptions, {
                url: f,
                success: function (f, g) {
                    c.element.find(c._sanitizeSelector(e.hash)).html(f), c._cleanup(), d.cache && a.data(e, "cache.tabs", !0), c._trigger("load", null, c._ui(c.anchors[b], c.panels[b]));
                    try {
                        d.ajaxOptions.success(f, g)
                    } catch (h) {}
                },
                error: function (a, f, g) {
                    c._cleanup(), c._trigger("load", null, c._ui(c.anchors[b], c.panels[b]));
                    try {
                        d.ajaxOptions.error(a, f, b, e)
                    } catch (g) {}
                }
            })), c.element.dequeue("tabs"), this
        },
        abort: function () {
            return this.element.queue([]), this.panels.stop(!1, !0), this.element.queue("tabs", this.element.queue("tabs").splice(-2, 2)), this.xhr && (this.xhr.abort(), delete this.xhr), this._cleanup(), this
        },
        url: function (a, b) {
            return this.anchors.eq(a).removeData("cache.tabs").data("load.tabs", b), this
        },
        length: function () {
            return this.anchors.length
        }
    }), a.extend(a.ui.tabs, {
        version: "1.8.21"
    }), a.extend(a.ui.tabs.prototype, {
        rotation: null,
        rotate: function (a, b) {
            var c = this,
                d = this.options,
                e = c._rotate || (c._rotate = function (b) {
                    clearTimeout(c.rotation), c.rotation = setTimeout(function () {
                        var a = d.selected;
                        c.select(++a < c.anchors.length ? a : 0)
                    }, a), b && b.stopPropagation()
                }),
                f = c._unrotate || (c._unrotate = b ? function (a) {
                    e()
                } : function (a) {
                    a.clientX && c.rotate(null)
                });
            return a ? (this.element.bind("tabsshow", e), this.anchors.bind(d.event + ".tabs", f), e()) : (clearTimeout(c.rotation), this.element.unbind("tabsshow", e), this.anchors.unbind(d.event + ".tabs", f), delete this._rotate, delete this._unrotate), this
        }
    })
})(jQuery);;