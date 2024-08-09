<?php
require_once 'autoload.php';

$obj = new Bayes();

// echo $obj->sumData()."<br>";
// echo $obj->sumTrue()."<br>";
// echo $obj->sumFalse()."<br>";
// echo $obj->probUmur(21,0)."<br>";

$jumTrue = $obj->sumTrue();
$jumFalse = $obj->sumFalse();
$jumData = $obj->sumData();

// $a1 = 20;
// $a2 = "st";
// $a3 = "kurus";
// $a4 = "sehat";
// $a5 = "smk";

//TRUE
$absen = $obj->probUmur($a1,1);
$uts = $obj->probTinggi($a2,1);
$uas =$obj->probUas($a3,1);
$praktek = $obj->probPraktek($a4,1);

//FALSE
$absen2 = $obj->probUmur($a1,0);
$uts2 = $obj->probTinggi($a2,0);
$uas2 = $obj->probBeratB($a3,0);
$praktek2 = $obj->probPraktek($a4,0);

//result
$paT = $obj->hasilTrue($jumTrue,$jumData,$absen,$uts,$uas,$praktek);
$paF = $obj->hasilFalse($jumTrue,$jumData,$absen2,$uts2,$uas2,$praktek2);

echo "
======================================<br>
absen : $a1<br>
uts : $a2<br>
uas : $a3<br>
praktek : $a4<br>
=======================================<br><br>
";

echo "
======================================<br>
kemungkinan true : <br>
jumlah true : $jumTrue <br>
jumlah data : $jumData <br>
=======================================<br><br>
";

echo "
======================================<br>
kemungkinan false : <br>
jumlah false : $jumFalse <br>
jumlah data : $jumData <br>
=======================================<br><br>
";

echo "
======================================<br>
pATrue : $jumTrue / $jumData<br>
absen true : $absen / $jumTrue <br>
uts true : $uts / $jumTrue <br>
uas true : $uas /$jumTrue <br>
praktek true : $praktek /$jumTrue <br>
=======================================<br><br>
";

echo "
======================================<br>
pAFalse : $jumFalse / $jumData<br>
absen false : $absen2 / $jumFalse <br>
uts false : $uts2 / $jumFalse <br>
uas false : $uas2 / $jumFalse <br>
praktek false : $praktek2 / $jumFalse <br>
=======================================<br><br>
";

echo "
======================================<br>
presentasi yes : $paT<br>
presentasi no : $paF<br>
=======================================<br><br>
";

if($paT > $paF){
  echo "
  ======================================<br>
  PRESENTASI YES LEBIH BESAR DARI PADA PRESENTASI NO<br>
  =======================================
  <br><br>";
}else if($paF > $paT){
  echo "
  ======================================<br>
  PRESENTASI NO LEBIH BESAR DARI PADA PRESENTASI YES<br>
  =======================================
  <br><br>";
}

// echo $obj->hasilTrue($jumTrue,$jumData,$absen,$uts,$uas,$praktek)."<br>";
// echo $obj->hasilFalse($jumTrue,$jumData,$absen2,$uts2,$uas2,$praktek2,$pendidikan2)."<br><br>";

// var_dump("\npaT " . $paT);
// var_dump("paF " . $paF);
$result = $obj->perbandingan($paT,$paF);
echo " Status : $result[0] <br>Presentasi diterima sebanyak : ".round($result[1],2)." % <br>Presentasi diolak sebanyak : ".round($result[2],2)." % ";
 ?>
