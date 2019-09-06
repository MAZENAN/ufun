// JavaScript Document
(function($) {
    $.extend({objTostr: function(obj) {
            function __typeof(objClass) {
                if (objClass && objClass.constructor) {
                    var strFun = objClass.constructor.toString();
                    var className = strFun.substr(0, strFun.indexOf('('));
                    className = className.replace('function', '');
                    return className.replace(/(^\s*)|(\s*$)/ig, '');
                }
                return typeof (objClass);
            }
            function OutJsObject(Arr, Tab) {
                var Rstr = new Array();
                Tab += "   ";
                for (var i in Arr) {
//if(typeof(Arr[i])=="function")continue;
                    var Item = Tab + "   [" + i + "]=>" + OutJsVal(Arr[i], Tab);
                    Rstr.push(Item);
                }
                return{Rstr: Rstr.join("\n"), Tab: Tab};
            }
            function OutJsVal(Obj, Tab)
            {
                var Typ = typeof (Obj);
                if (Obj == null)
                    return null;
                if (Typ == "function") {
                    return "[function]";
                }
                if (Typ == "number" || Typ == "boolean" || Typ == "string") {
                    return Obj;
                }
                if (Typ == "object") {
                    if (Obj instanceof Number || Obj instanceof Boolean || Obj instanceof String) {
                        return Obj.toString();
                    }
                    else if (Obj instanceof Array || __typeof(Obj) == 'Array') {
                        var Sd = OutJsObject(Obj, Tab);
                        var Tb = Sd.Tab;
                        return "Array\n" + Tb + "(\n" + Sd.Rstr + "\n" + Tb + ")";
                    }
                    else if (Obj.toString() != "[object Object]")
                    {
                        return Obj.toString();
                    }
                    else {
                        var Tname = __typeof(Obj);
                        var Sd = OutJsObject(Obj, Tab);
                        var Tb = Sd.Tab;
                        return Tname + " Object\n" + Tb + "(\n" + Sd.Rstr + "\n" + Tb + ")";
                    }
                }
                return "";
            }
            var Str = OutJsVal(obj, "");
            return Str;
        }, trace: function(obj) {
            alert(this.objTostr(obj));
        }});
    $.fn.extend({trace: function(obj) {
            this.html("<pre>" + $.objTostr(obj) + "</pre>");
        }});
})(jQuery);