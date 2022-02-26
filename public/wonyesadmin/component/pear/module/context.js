layui.define(['jquery', 'element'], function(exports) {
    "use strict";

    var MOD_NAME = 'context',
        $ = layui.jquery,
        element = layui.element;

    var context = new function() {

        this.put = function(key, value) {
            var typestr = Object.prototype.toString.call(value);
            if (typestr == '[object Array]' || typestr == '[object Object]') {
                value = JSON.stringify(value);
            }
            localStorage.setItem(key, value);
            return this;
        }

        this.get = function(key) {
            var res = localStorage.getItem(key);
            if (/^[\{\[]/.test(res)) {
                try {
                    return JSON.parse(res);
                } catch (e) {}
            }
            return res;
        }
        this.remove = function(key) {
            localStorage.removeItem(key);
            return this;
        }
    }
    exports(MOD_NAME, context);
});