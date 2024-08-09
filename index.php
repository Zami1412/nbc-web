<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/x-icon" href="img/nbc.png" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />

  <!-- font awsome -->
  <link rel="stylesheet" href="css/fontawesome.css" />
  <link rel="stylesheet" href="css/brands.css" />
  <link rel="stylesheet" href="css/solid.css" />

  <link rel="stylesheet" href="css/gaya.css">

  <!-- google font -->
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap" rel="stylesheet">

  <title>Naive Bayes Classifier</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <!-- <img src="img/nbc.png" alt="" width=50 height=50> -->
        <p>Naive Bayes Classifier</p>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Klasifikasi
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data_simulasi.php">Data Latih</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container" style='margin-top:90px'>
    <div class="row">
      <div class="col-12 mt-4">
        <h3 class="tebal">Simulasi Probabilitas Siswa Berprestasi</h3>
      </div>

      <div class="col-6">
        <form method="POST" class="mt-3">
          <div class="form-group">
            <label for="absen">Absen :</label>
            <input class="form-control selBox" required="required" type="number" name="absen" id="absen">
          </div>
          <div class="form-group">
            <label for="uh">Ulangan Harian :</label>
            <input class="form-control selBox" required="required" type="number" name="uh" id="uh">
          </div>

          <div class="form-group">
            <label for="uts">UTS :</label>
            <input class="form-control selBox" required="required" type="number" name="uts" id="uts">
          </div>

          <div class="form-group">
            <label for="uas">UAS :</label>
            <input class="form-control selBox" required="required" type="number" name="uas" id="uas">
          </div>

          <div class="form-group">
            <label for="praktek">Praktek :</label>
            <input class="form-control selBox" required="required" type="number" name="praktek" id="praktek">
          </div>
          <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-primary mt-3" id="dor" onclick="return simulasi()" />
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-12 mt-5 mb-5">
        <div id="hasilSIM" style="margin-bottom:30px;">

        </div>
      </div>
    </div>

  </div>

  <!-- Footer -->
  <footer class="page-footer font-small abu1">

    <!-- Footer Elements -->
    <div class="container">
    </div>

  </footer>
  <!-- Footer -->


  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery.js"></script>
  <script src="jspopper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <!-- validasi -->
  <script>
    $(document).ready(function() {
      $('.toggle').click(function() {
        $('ul').toggleClass('active');
      });
    });
  </script>

  <script>
    function simulasi() {
      var absen = $("#absen").val();
      var uh = $("#uh").val();
      var uts = $("#uts").val();
      var uas = $("#uas").val();
      var praktek = $("#praktek").val();
      //validasi
      var ab = document.getElementById("absen");
      var uha = document.getElementById("uh");
      var ut = document.getElementById("uts");
      var ua = document.getElementById("uas");
      var pt = document.getElementById("praktek");

      if (ab.selectedIndex == 0) {
        alert("Jumlah Absen Tidak Boleh Kosong");
        return false;
      }
      if (uha.selectedIndex == 0) {
        alert("Nilai Ulangan Harian Tidak Boleh Kosong");
        return false;
      }

      if (ut.selectedIndex == 0) {
        alert("Nilai UTS Tidak Boleh Kosong");
        return false;
      }

      if (ua.selectedIndex == 0) {
        alert("Nilai UAS Tidak Boleh Kosong");
        return false;
      }

      if (pt.selectedIndex == 0) {
        alert("Nilai Praktek Tidak Boleh Kosong");
        return false;
      }

      //batas validasi

      $.ajax({
        url: 'simulasi.php',
        type: 'POST',
        dataType: 'html',
        data: {
          absen: absen,
          uh: uh,
          uts: uts,
          uas: uas,
          praktek: praktek
        },
        success: function(data) {
          document.getElementById("hasilSIM").innerHTML = data;
        },
      });

      return false;

    }
  </script>

  <script>
    $(document).ready(function() {
      $('#dor').click(function() {
        $('html, body').animate({
          scrollTop: $("#hasilSIM").offset().top
        }, 500);
      });
    });
  </script>
</body>
</html>