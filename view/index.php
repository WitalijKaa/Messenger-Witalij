<?php
/* @var $temp array */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Witalij Kaa</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/tips/php.js"></script>
    <script src="/tips/hh.js"></script>
</head>
<body>

<div class="container">
    <h1>код для души и тела</h1>
    <h2>вы на главной странице</h2>
    <a href="/login">Login</a>
</div>
<?php var_dump($temp['kv']) ?><br>

<script>
    var temp = {};
    var tempArr = [];
    console.log(php.is_object(temp));
    console.log(php.is_array(tempArr));
    var unixTime = 1491990067;
    console.log(hh.unixtimeToHourMinut(unixTime));
</script>

</body>
</html>
