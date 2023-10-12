<?php include('../includes/database.php') ?>

<header class="header">
  <section class="brand-container">
    <img src="https://via.placeholder.com/250x40" alt="example brand icon">
    <h1>Taskion</h1>
  </section>
  <ul class="menu">
    <?php 
      $result = executeQuery(true, "SELECT * FROM routes");
      foreach($result as $row) {
        $route_name = $row['route_name'];
        $route_path = $row['route_path'];

        echo 
        "<li class='item'>
          <a class='item-link' href='$route_path.php'>$route_name</a>
        </li>";
      }
    ?>
  </ul>
</header>