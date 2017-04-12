var hh = {
    unixtimeToHourMinut: function (unixTime) {
        var d = new Date(unixTime * 1000);
        var h = ("0" + d.getHours()).substr(-2);
        var m = ("0" + d.getMinutes()).substr(-2);

        return h + ':' + m;
    }
};
