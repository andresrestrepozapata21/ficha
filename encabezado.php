<?php session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" class="theme-default">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>FICHA ACADÉMICA 2023</title>

    <link type="text/css" href="assets/css/index.css" rel="stylesheet" />

    <link type="text/css" href="assets/css/themes/default/vendor-fullcalendar.css" rel="stylesheet" />
    <link type="text/css" href="assets/css/themes/default/vendor-weathericons.css" rel="stylesheet" />
    <link type="text/css" href="assets/css/themes/default/vendor-bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex" />

    <!-- Simplebar -->
    <link type="text/css" href="assets/vendor/simplebar.css" rel="stylesheet" />

    <!-- App CSS -->
    <link type="text/css" href="assets/css/themes/default/app.css" rel="stylesheet" />
    <link type="text/css" href="assets/css/themes/default/custom.css" rel="stylesheet" />

    <!-- DataTable CSS -->
    <link type="text/css" href="assets/css/themes/default/vendor-bootstrap-datatables.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- google maps-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSnx5CZ4b0b4vF_-r8UJHnca6hmMpYyvY&callback=initMap&v=weekly" defer></script>

    <!-- CLUSTER MARKERS-->
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
</head>

<body>