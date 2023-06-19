 <link rel="stylesheet" href="css/bootstrap.min.css">
 <link rel="stylesheet" href="css/fontawesome.min.css">
 <link rel="stylesheet" href="css/solid.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" type="text/css" href="css/header.css?v=<?php echo time(); ?>">



 <body>
   <div class="header">
     <span class="snake1"></span>
     <span class="snake2"></span>

     <div class="inner_header">
       <div class="logo_container">
         <span class="btnmenu" onclick="openNav()">&#9776; Menu</span>
         <button class="btn1 info" onClick="location.href='LoginForm.php'">Login</button>
         <!-- <button class="btn2 info" onClick="location.href='RegisterForm.php'">Register</button> -->
       </div>
     </div>
   </div>


   <!-- navigation bar -->

   <div id="mySidenav" class="sidenav">
     <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
     <a href="index.php">HOME</a>
     <a href="coursetable.php">CLASSES</a>
     <a href="offer.php">OFFER</a>
     <a href="contact.php">CONTACT</a>
     <a href="about.php">ABOUT US</a>
     <a href="privacy.php">PRIVACY</a>
     <!-- <a href="https://simm-cw2-wad.000webhostapp.com/index.php">REPORT</a> 
      -->
   </div>

   <!-- script part for menu button -->
   <script type="text/javascript">
     var i = 0;

     function openNav() {
       if (!i) {
         document.getElementById("mySidenav").style.width = "250px";
         document.getElementById("main").style.marginLeft = "250px";
         document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
         i = 1;
       }
     }

     function closeNav() {
       document.getElementById("mySidenav").style.width = "0";
       document.getElementById("main").style.marginLeft = "0";
       document.body.style.backgroundColor = "white";
       i = 0;
     }
   </script>

 </body>