<?php

  if(isset($_GET['page']) && $_GET['page'] != '' ){    
    $page = $_GET['page']; // page being requested
  }else{
    $page = 'home'; // default page
  }

  include('head.php');
  include('menu.html');

  // Dynamic page based on query string
  include($page.'.php');

  include('footer.php');

?>