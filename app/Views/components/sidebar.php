<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link <?php echo (uri_string() == '') ? "" : "collapsed" ?>" href="/">
        <i class="bi bi-house-fill"></i>
        <span>Home</span>
      </a>
    </li><li class="nav-item">
      <a class="nav-link <?php echo (uri_string() == 'keranjang') ? "" : "collapsed" ?>" href="keranjang">
        <i class="bi bi-cart-fill"></i>
        <span>Keranjang</span>
      </a>
    </li><?php if (session()->get('role') == 'admin') : ?>
    <li class="nav-item">
      <a class="nav-link <?php echo (uri_string() == 'produk') ? "" : "collapsed" ?>" href="produk">
        <i class="bi bi-bag-fill"></i>
        <span>Produk</span>
      </a>
    </li><?php endif; ?>
    <li class="nav-item">
    <a class="nav-link <?php echo (uri_string() == 'history') ? "" : "collapsed" ?>" href="history">
        <i class="bi bi-person"></i>
        <span>History</span>
    </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo (uri_string() == 'profile') ? "" : "collapsed" ?>" href="profile">
        <i class="bi bi-person-fill"></i>
        <span>Profile</span>
      </a>
    <li class="nav-item">
      <a class="nav-link <?php echo (uri_string() == 'faq') ? "" : "collapsed" ?>" href="faq">
        <i class="bi bi-question-circle"></i>
        <span>F.A.Q</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo (uri_string() == 'contact') ? "" : "collapsed" ?>" href="contact">
        <i class="bi bi-envelope"></i>
        <span>Contact</span>
      </a>
    </li>

  </ul>

</aside>
  <!-- End Sidebar-->