<?php require_once 'db_con.php';
?>

<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>courses</title>
  <link rel="stylesheet" href="css/coursetable.css?v=<?php echo time(); ?>" />
  <style>

  </style>
</head>

<body>

  <div id=main>
    <div>
      <?php include('header.php'); ?>


      <br><br>


      <!-- subject table -->

      <p class=" cou">
        Checkout our Classes (AL - Advanced Level / OL - Ordinary Level)
      </p>

      <br>


      <?php
      $query = mysqli_query($db_con, 'SELECT * FROM `class`');
      while ($result = mysqli_fetch_array($query)) { ?>
        <br>
        <button type="button" class="collapsible"> <?php echo $result['batchName'] ?> - <?php echo $result['subName'] ?> </button>
        <div class="content">
          <p></p>
          <p>Rs.<?php echo $result['monthFee'] ?></p>
        </div>
        <br>
      <?php } ?>

      <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
          coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
              content.style.display = "none";
            } else {
              content.style.display = "block";
            }
          });
        }
      </script>



      <a href="index.php" target="">
        <img src="images/home.png" alt="" id="home-btn" /></a>


      <div class="h">
        <?php include('footer.php'); ?>
      </div>

    </div>
  </div>

</body>

</html>