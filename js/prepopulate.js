'use strict';
{
    const b = django.jQuery;
    b.fn.prepopulate = function (d, f, g) {
        return this.each(function () {
            const a = b(this), h = function () {
                if (!a.data("_changed")) {
                    var e = [];
                    b.each(d, function (a, c) {
                        c = b(c);
                        0 < c.val().length && e.push(c.val())
                    });
                    a.val(URLify(e.join(" "), f, g))
                }
            };
            a.data("_changed", !1);
            a.on("change", function () {
                a.data("_changed", !0)
            });
            if (!a.val()) b(d.join(",")).on("keyup change focus", h)
        })
    }
}
;
