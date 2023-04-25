 <!-- jQuery -->

 <!--<script src="assets/vendor/jquery.min.js"></script>-->

 <!-- Bootstrap -->
 <script src="assets/vendor/popper.js"></script>
 <script src="assets/vendor/bootstrap.min.js"></script>

 <!-- Simplebar -->
 <!-- Used for adding a custom scrollbar to the drawer -->
 <script src="assets/vendor/simplebar.js"></script>

 <script src="assets/vendor/Chart.min.js"></script>
 <script src="assets/vendor/moment.min.js"></script>
 <script src="assets/vendor/dateformat.js"></script>
 <script src="assets/vendor/bootstrap-datepicker.min.js"></script>

 <script>
     window.theme = "default";
 </script>
 <script src="assets/js/color_variables.js"></script>
 <script src="assets/js/app.js"></script>

 <script src="assets/vendor/dom-factory.js"></script>
 <!-- DOM Factory -->
 <script src="assets/vendor/material-design-kit.js"></script>
 <!-- MDK -->

 <script>
     (function() {
         "use strict";

         // Self Initialize DOM Factory Components
         domFactory.handler.autoInit();

         // Connect button(s) to drawer(s)
         var sidebarToggle = Array.prototype.slice.call(
             document.querySelectorAll('[data-toggle="sidebar"]')
         );

         sidebarToggle.forEach(function(toggle) {
             toggle.addEventListener("click", function(e) {
                 var selector =
                     e.currentTarget.getAttribute("data-target") || "#default-drawer";
                 var drawer = document.querySelector(selector);
                 if (drawer) {
                     drawer.mdkDrawer.toggle();
                 }
             });
         });

         //////////////////////////////////////////
         // BREAK OUT OF ENVATO LIVE DEMO IFRAME //
         //////////////////////////////////////////

         window.top.location.hostname !== window.location.hostname &&
             (window.top.location = window.location);
     })();
 </script>



 <script src="assets/vendor/fullcalendar.min.js"></script>
 <script src="assets/js/calendars.js"></script>
 <script src="assets/js/charts_index.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>

 <script src="assets/vendor/jquery.dataTables.js"></script>
 <script src="assets/vendor/dataTables.bootstrap4.js"></script>
 </body>

 </html>