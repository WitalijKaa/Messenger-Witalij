var php = {
    in_array: function (needle, haystack) {
        if (php.is_array(haystack)) {
            if (haystack.indexOf(needle) != -1) { return true; }
        }
        else if (php.is_object(haystack)) {
            for (var elem in haystack) {
                if (haystack.hasOwnProperty(elem)) {
                    if (haystack[needle] == elem) { return true; }
                }
            }
        } return false;
    },
    unset: function (needle, haystack) {
        if (php.is_array(haystack)) {
            var ix = haystack.indexOf(needle);
            if (0 <= ix) { haystack.splice(ix, 1); }
        }
    },
    is_object: function (theVar) {
        return Object.prototype.toString.call(theVar) === '[object Object]';
    },
    is_array: function (theVar) {
        return Object.prototype.toString.call(theVar) === '[object Array]';
    }
};
