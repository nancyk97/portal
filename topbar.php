<style>
  .logo {
    /* background: url(assets/img/ABS_LOGO_New.ico); */
    background-repeat: no-repeat;
    padding: 0px;
    margin: 0px;
    /* height: 250px; */
    width: 300px;
    z-index: 10;
  }

  .img {
    height: 100%;
    width: 100%;
  }
</style>

<nav class="navbar navbar-light fixed-top bg-primary" style="padding:0;">
  <div class="container-fluid mt-2 mb-2">
    <div class="col-lg-12">
      <div class="col-md-1 float-left" style="display: flex;">
        <div class="logo">
          <img src="assets/img/ABS-Reverse-Logo-1.png" />
        </div>
      </div>
      <div class="col-md-4 float-left text-white">
        <large><b>ADVANCED BOLTING SOLUTIONS PVT LTD</b></large>
      </div>
      <div class="col-md-2 float-right text-white">
        <a href="ajax.php?action=logout" class="text-white"><?php echo $_SESSION['login_name'] ?> <i class="fa fa-power-off"></i></a>
      </div>
    </div>
  </div>

</nav>