<?php
require_once 'autoload.php';

$obj = new Bayes();

$jumTrue = $obj->sumTrue();
$jumFalse = $obj->sumFalse();
$jumData = $obj->sumData();

$a1 = $_POST['absen'];
$a2 = $_POST['uts'];
$a3 = $_POST['uas'];
$a4 = $_POST['praktek'];
$a5 = $_POST['uh'];
//TRUE
$absen = $obj->probAbsen($a1,1);
$uh = $obj->probUH($a5,1);
$uts = $obj->probUts($a2,1);
$uas = $obj->probUas($a3,1);
$praktek = $obj->probPraktek($a4,1);

//FALSE
$absen2 = $obj->probAbsen($a1,0);
$uh2 = $obj->probUH($a5,0);
$uts2 = $obj->probUts($a2,0);
$uas2 = $obj->probUas($a3,0);
$praktek2 = $obj->probPraktek($a4,0);

//result
$paT = $obj->hasilTrue($jumTrue,$jumData,$absen,$uh,$uts,$uas,$praktek);
$paF = $obj->hasilFalse($jumTrue,$jumData,$absen2,$uh2,$uts2,$uas2,$praktek2);
// echo "absen ",$absen ,"<br>";
// echo "absen 2 ",$absen2 ,"<br>";
echo "
<div class='jumbotron jumbotron-fluid' id='hslPrekdiksinya'>
  <div class='container'>
    <h1 class='display-4 tebal'>Hasil Prediksi</h1>
    <p class='lead'>Berikut ini adalah hasil prediksi berdasarkan masukan nilai siswa menggunakan metode naive bayes.</p>
  </div>
</div>
";

echo "
<div class='card' style='width: 25rem;'>
  <div class='card-header' style='background-color:#17a2b8;color:#fff'>
    <b>Informasi Siswa</b>
  </div>
  <ul class='list-group list-group-flush'>
    <li class='list-group-item'>absen : &nbsp;&nbsp;<b>$a1</b></li>
    <li class='list-group-item'>ulangan harian : &nbsp;&nbsp;<b>$a5</b></li>
    <li class='list-group-item'>uts : &nbsp;&nbsp;<b>$a2</b></li>
    <li class='list-group-item'>uas : &nbsp;&nbsp;<b>$a3</b></li>
    <li class='list-group-item'>praktek : &nbsp;&nbsp;<b>$a4</b></li>
  </ul>
</div><br>
<hr>
";

echo "<br>
<table class='table table-bordered' style='font-size:18px;text-align:center'>
  <tr style='background-color:#17a2b8;color:#fff'>
    <th>Jumlah True</th>
    <th>Jumlah False</th>
    <th>Jumlah Total Data</th>
  </tr>
  <tr>
    <td>$jumTrue</td>
    <td>$jumFalse</td>
    <td>$jumData</td>
  </tr>
</table>
";

echo "<br>
<table class='table table-bordered' style='font-size:18px;text-align:center'>
  <tr style='background-color:#17a2b8;color:#fff'>
    <th></th>
    <th>True</th>
    <th>False</th>
  </tr>
  <tr>
    <td>pA</td>
    <td>$jumTrue / $jumData</td>
    <td>$jumFalse / $jumData</td>
  </tr>
  <tr>
    <td>Absen</td>
    <td>$absen / $jumTrue</td>
    <td>$absen2 / $jumFalse</td>
  </tr>
  <tr>
    <td>Ulangan Harian</td>
    <td>$uh / $jumTrue</td>
    <td>$uh2 / $jumFalse</td>
  </tr>
  <tr>
    <td>UTS</td>
    <td>$uts / $jumTrue</td>
    <td>$uts2 / $jumFalse</td>
  </tr>
  <tr>
    <td>UAS</td>
    <td>$uas / $jumTrue</td>
    <td>$uas2 / $jumFalse</td>
  </tr>
  <tr>
    <td>Praktek</td>
    <td>$praktek / $jumTrue</td>
    <td>$praktek2 / $jumFalse</td>
  </tr>
</table>
";

echo "<br>
  <table class='table table-bordered' style='font-size:18px;text-align:center;'>
    <tr style='background-color:#17a2b8;color:#fff'>
      <th>Presentasi Berprestasi</th>
      <th>Presentasi Tidak Berprestasi</th>
    </tr>
    <tr>
      <td>$paT</td>
      <td>$paF</td>
    </tr>
  </table>
";
// var_dump("\nA1 = " .$a1. "\n" );
// var_dump("jumTrue = ".$jumTrue , "jumData = " .$jumData, "absen = ".$absen, "uts = ".$uts, "uas = ".$uas,"praktek = ".$praktek."\n");
// var_dump("paT 2 " . $paT);
// var_dump("paF 2 " . $paF);
if ($paT != 0 && $paF != 0){
  $result = $obj->perbandingan($paT,$paF);

  if($paT > $paF){
    echo "<br>
    <h3 class='tebal'>PRESENTASI <span class='badge badge-success' style='padding:10px'><b>BERPRESTASI</b></span> LEBIH BESAR DARI PADA PRESENTASI TIDAK BERPRESTASI</h3><br>";
    echo "<h4><br>Presentasi berprestasi sebanyak : <b>".round($result[1],2)." %</b> <br>Presentasi tidak berprestasi sebanyak : <b>".round($result[2],2)." % </b></h4>";
  }else if($paF > $paT){
    echo "<br>
    <h3 class='tebal'>PRESENTASI <span class='badge badge-danger' style='padding:10px'><b>TIDAK BERPRESTASI</b></span> LEBIH BESAR DARI PADA PRESENTASI BERPRESTASI</h3><br>";
    echo "<h4><br>Presentasi tidak berprestasi sebanyak : <b>".round($result[1],2)." %</b> <br>Presentasi berprestasi sebanyak : <b>".round($result[2],2)." % </b></h4>";
  }
  
  
  if($result[0] == "BERPRESTASI"){
    echo "
    <div class='alert alert-success mt-5' role='aler'>
      <h4 class='alert-heading'>Kesimpulan : $result[0] </h4>
      <p>Selamat ! berdasarkan hasil prediksi , anda dinyatakan <b>berprestasi!</b></p>
      <hr>
      <p class='mb-0'>Kerja Bagus!</p>
    </div>";
  }else{
    echo"
    <div class='alert alert-danger mt-5' role='aler'>
    <h4 class='alert-heading'>Kesimpulan : $result[0] </h4>
    <p>Maaf, berdasarkan hasil prediksi , anda dinyatakan <b>tidak berprestasi!</p>
    <hr>
    <p class='mb-0'>Tetap Semangat!</p>
    </div>";
  }
}

 ?>
