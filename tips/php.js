var php = {
    in_array: function (needle, haystack) {
        if (Object.prototype.toString.call(haystack) === '[object Array]') {
            if (haystack.indexOf(needle) != -1) { return true; }
        }
        else if ('object' == typeof haystack) {
            for (var elem in haystack) {
                if (haystack.hasOwnProperty(elem)) {
                    if (haystack[needle] == elem) { return true; }
                }
            }
        } return false;
    },
    unset: function (needle, haystack) {
        if (Object.prototype.toString.call(haystack) === '[object Array]') {
            var ix = haystack.indexOf(needle);
            if (0 <= ix) { haystack.splice(ix, 1); }
        }
    }
};