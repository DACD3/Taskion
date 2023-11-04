<?php
  $user = $_SESSION['user'];

  $image = base64_encode($user->getAvatar());
  
  $image_alt = substr($user->getName(), 0, 7);

  $avatarEl = "<img class='avatar' title='' width='64' height='64' src='data:image/png;base64,$image' alt='$image_alt avatar' />";
?>

<header class="sidebar" id="sidebar">

  <section class="sidebar-toggler">

    <button class="button" id="toggler" title="sidebar toggler">
      <span class="icon fas fa-bars fa-2xl"></span>
    </button>

  </section>

  <ul class="menu">
    
    <li class="menu-item">
      <span class="icon fas fa-home fa-xl"></span>
      <a href="/" class="menu-link">Inicio</a>
    </li>

    <li class="menu-item">
      <span class="icon fas fa-list-check fa-xl"></span>
      <a href="" class="menu-link">Tareas</a>
    </li>

    <li class="menu-item">
      <span class="icon fas fa-folder-closed fa-xl"></span>
      <a href="" class="menu-link">Proyectos</a>
    </li>

    <li class="menu-item">
      <span class="icon fas fa-sign-out fa-xl"></span>
      <a href="/app?operation=logout" class="menu-link">Salir</a>
    </li>

  </ul>

  <section class="user">
    <img id="userAvatar" class="avatar" width="64" height="64" alt="" src="" />
    <p id="username"></p>
  </section>

</header>
