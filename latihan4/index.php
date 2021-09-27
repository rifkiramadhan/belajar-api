<?php 

  function get_CURL($url) {
    // Mengkoneksikan data API menggunakan teknik cURL
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    // Dapat menggunakan true/1 jika ingin mengembalikan text
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
  
    return json_decode($result, true);
  }

  $result = get_CURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCWnTr75pa6Dd_0sQyNGDpYw&key=AIzaSyC9OegN2u8DDtYIenCVQAIcFKbeD0HWI3k');
  
  $youtubeProfilePic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
  $channelName = $result['items'][0]['snippet']['title'];
  $subscriber = $result['items'][0]['statistics']['subscriberCount'];

  // Untuk latest video
  $urlLatestVideo = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyC9OegN2u8DDtYIenCVQAIcFKbeD0HWI3k&channelId=UCWnTr75pa6Dd_0sQyNGDpYw&maxResults=1&order=date&part=snippet';
  $result = get_CURL($urlLatestVideo);
  $latestVideoId = $result['items'][0]['id']['videoId'];

  // Instagram API (Jika API Instagram sudah didapatkan maka cantumkan pada URL value yang kosong)
  // $clientId = '';
  // $accessToken = '';

  // $result = get_CURL('');
  // $usernameIG = $result['data']['username'];
  // $profilePictureIG = $result['data']['profile_picture'];
  // $followersIG = $result['data']['counts']['followed_by'];

  // // Latest IG Post
  // $result = get_CURL('');

  // $photos = [];
  // foreach($result['data'] as $photo) {
  //   $photos[] = $photo['images']['thumbnail']['url'];
  // }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title>Portfolio Saya</title>
  </head>
  <body class="mt-5">

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Rifki Ramadhan</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Portfolio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Contact</a>
                </li>
              </ul>
            </div>
        </div>
      </nav>

      <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <img src="img/foto.jpg" width="25%" class="rounded-circle img-thumbnail" alt="">
            <h1 class="display-4">Rifki Ramadhan</h1>
            <p class="lead">Web Developer | Gammer.</p>
        </div>
      </div>
      
      <section id="about" class="about">
      <div class="container">
          <div class="row mb-4">
              <div class="col text-center">
                  <h2>About</h2>
              </div>
        </div>

          <div class="row justify-content-center">
              <div class="col-md-5 text-center">
                  <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi dolorum expedita alias fuga nemo non iste dolor voluptas? Vitae similique tenetur, amet inventore totam in non adipisci dolor est! Eaque?</p>
              </div>

              <div class="col-md-5 text-center">
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, repudiandae? Ducimus autem dolor, vel officia deserunt aperiam numquam quia qui! Consectetur repudiandae nulla inventore quibusdam possimus delectus nihil numquam quam.</p>
              </div>
          </div>
      </div>
    </section>

    <!-- Youtube & IG -->
    <section class="social bg-light" id="social">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Social Media</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-4">
                <img src="<?= $youtubeProfilePic; ?>" class="rounded-circle img-thumbnail" width="200" alt="Foto Profile">
              </div>
              <div class="col-md-8">
                <h5><?= $channelName; ?></h5>
                <p><?= $subscriber; ?> Subscribers.</p>
                <div class="g-ytsubscribe" data-channelid="UCWnTr75pa6Dd_0sQyNGDpYw" data-layout="default" data-count="default"></div>
              </div>
            </div>
            <div class="row mt-3 mb-3">
              <div class="col">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $latestVideoId; ?>?rel=0" allowfullscreen></iframe>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-4">
                <img src="img/foto.jpg" class="rounded-circle img-thumbnail" width="200" alt="Foto Profile">
              </div>
              <div class="col-md-8">
                <h5>@rifkiromdons</h5>
                <p>1500 Followers.</p>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col">

                <!-- Aktifkan script ini ketika sudah mendapatkan akses Instagram API -->
                <!-- <?php foreach( $photos as $photo ) : ?>
                <div class="ig-thumbnail">
                  <img src="<?= $photo; ?>" alt="Foto 1">
                </div>
                <?php endforeach; ?> -->

                <div class="ig-thumbnail">
                  <img src="img/portfolio/1.jpg" alt="Foto 1">
                </div>
                <div class="ig-thumbnail">
                  <img src="img/portfolio/2.jpg" alt="Foto 2">
                </div><div class="ig-thumbnail">
                  <img src="img/portfolio/3.jpg" alt="Foto 3">
                </div>
                <div class="ig-thumbnail">
                  <img src="img/portfolio/4.jpg" alt="Foto 4">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="portfolio" class="portfolio pb-4">
      <div class="container">
          <div class="row mb-4 pt-4">
              <div class="col text-center">
                  <h2>Portfolio</h2>
              </div>
          </div>

          <div class="row mb-4">
              <div class="col-md">
                <div class="card">
                    <img class="card-img-top" src="img/portfolio/1.jpg" alt="Card image cap">
                    <div class="card-body">
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                  </div>
              </div>

              <div class="col-md">
                <div class="card">
                    <img class="card-img-top" src="img/portfolio/2.jpg" alt="Card image cap">
                    <div class="card-body">
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                  </div>
              </div>

              <div class="col-md">
                <div class="card">
                    <img class="card-img-top" src="img/portfolio/3.jpg" alt="Card image cap">
                    <div class="card-body">
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                  </div>
              </div>
          </div>

                <div class="row mb-4">
                    <div class="col-md">
                    <div class="card">
                        <img class="card-img-top" src="img/portfolio/4.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        </div>
                    </div>

                    <div class="col-md">
                    <div class="card">
                        <img class="card-img-top" src="img/portfolio/5.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        </div>
                    </div>

                    <div class="col-md">
                    <div class="card">
                        <img class="card-img-top" src="img/portfolio/6.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="contact bg-light mb-5">
            <div class="container">
                <div class="row pt-4 mb-4">
                    <div class="col text-center">
                        <h2>Contact Us</h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="card text-white bg-primary mb-3 text-center">
                            <div class="card-body">
                              <h5 class="card-title">Contact Us</h5>
                              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, exercitationem.</p>
                            </div>
                          </div>

                          <ul class="list-group">
                            <li class="list-group-item"><h1>Location</h1></li>
                            <li class="list-group-item">My Office</li>
                            <li class="list-group-item">Jl. Pagujaten No. 26, Jakarta Selatan</li>
                            <li class="list-group-item">West Java, Indonesia</li>
                          </ul>
                    </div>

                    <div class="col-lg-6">
                        <form>
                            <div class="form-group">
                              <label for="nama">Nama</label>
                              <input type="text" class="form-control" id="nama">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email">
                            </div>

                            <div class="form-group">
                                <label for="pesan">Pesan</label>
                                <textarea name="pesan" id="pesan" class="form-control" cols="30" rows="10"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-primary">Kirim Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-dark text-white">
            <div class="container">
                <div class="row pt-3">
                    <div class="col text-center">
                        <p>Copyright 2021</p>
                    </div>
                </div>
            </div>
        </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://apis.google.com/js/platform.js"></script>
  </body>
</html>