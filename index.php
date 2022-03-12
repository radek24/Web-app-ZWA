<!doctype html>
<html lang="cs">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-dark-5@1.1.3/dist/css/bootstrap-night.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    
    <title>WebApp</title>
</head>

<body>

<nav class="navbar navbar-expand-lg" style="position:absolute; background-color:var(--bs-body-bg);width:100%; z-index: 20;">
  <a class="navbar-brand" href="#">RATER</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

    <div class="band-container">
        <div class="container pt-5 ">
            <div class="text-center">
                <h1 class="display-1" style="font-weight: bold; padding-top:10%">BAND</h1>

                <div class="container" >
                    <div class="row text-muted">

                        <div class="col-sm-6 ">
                            <h4>X ALBUMS</h4>
                        </div>
                        <div class="col-sm-6">
                            <h4>X SONGS</h4>
                        </div>
                    </div>
                </div>
                <h4 class="py-5">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Incidunt dolores voluptates sint sed expedita cupiditate, quia porro maiores laborum deleniti nesciunt! Neque sapiente non maxime impedit beatae nisi error aut.
                </h4>
            </div>
        </div>

    </div>
    <div class="container pt-5 ">
        <div class="text-center">


        </div>
        <?php
        for ($i = 1; $i <= 4; $i++) {
    require(".\card.phtml");
}
?>

    </div>
    </div>
    </div>
    <footer id="sticky-footer" class="flex-shrink-0 py-3 bg-dark text-white-50 mt-5">
        <div class="container text-center">
            <small>Copyright 2022&copy; RATER</small>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-dark-5@1.1.3/dist/js/darkmode.min.js"></script>
</body>

</html>