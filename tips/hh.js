var hh = {
    unixtimeToHourMinut: function (unixTime) {
        var d = new Date(unixTime * 1000);
        var h = "0" + d.getHours();
        var m = "0" + d.getMinutes();

        return h.substr(-2) + ':' + m.substr(-2);
    }
};