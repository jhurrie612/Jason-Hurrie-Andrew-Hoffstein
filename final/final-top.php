<?php
$phpSelf = htmlspecialchars($_SERVER['PHP_SELF']);
$pathParts = pathinfo($phpSelf);
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Top Fantasy Football Performers </title>
    <meta name="author" content="Jason Hurrie and Andrew Hoffstein">
    <meta name="description" content="This website will contain relevant information
    about the upcoming 2022 fantasy football season.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/custom.css?version=<?php print time(); ?>" type="text/css">
    <link rel="stylesheet" media="(max-width: 800px)" href="css/custom-tablet.css?version=<?php print time(); ?>" type="text/css">
    <link rel="stylesheet" media="(max-width: 600px)" href="css/custom-phone.css?version=<?php print time(); ?>" type="text/css">
</head>

<?php
print '<body id="' . $pathParts['filename'] . '">';
print '<!-- #################  Body element  ################# -->';
include 'connect-DB.php';
include 'header.php';
include 'nav.php';
?>
