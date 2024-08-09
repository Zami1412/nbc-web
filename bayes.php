<?php
class Bayes
{
  private $data_latih = "data.json";
  // private $jumTrue = 0;
  // private $jumFalse = 0;
  // private $jumData = 0;

  function __construct()
  {

  }

  /*================================================================
  FUNCTION SUM TRUE DAN FALSE
  =================================================================*/
  function sumTrue()
  {
    $data = file_get_contents($this->data_latih);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach($hasil as $hasil)
    {
      if($hasil['status'] == 1){
        $t += 1;
      }
    }

    return $t;
  }

  function sumFalse()
  {
    $data = file_get_contents($this->data_latih);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach($hasil as $hasil)
    {
      if($hasil['status'] == 0){
        $t += 1;
      }
    }
    return $t;
  }

  function sumData()
  {
    $data = file_get_contents($this->data_latih);
    $hasil = json_decode($data,true);
    return count($hasil);
  }

  //=================================================================

  /*================================================================
  FUNCTION PROBABILITAS
  =================================================================*/
  function probAbsen($absen,$status)
  {
    $data = file_get_contents($this->data_latih);
    $hasils = json_decode($data,true);
    $t = 0;
    $c = "Boolean";
    foreach ($hasils as $hasil) {
      if($absen <= $hasil['absen'] && $hasil['status'] == $status){
        $t += 1;
        $c = "True";
      }elseif ($absen <= $hasil['absen'] && $hasil['status'] == $status) {
        $t += 1;
        $c = "False";
      }
    }
    return $t;
  }
  function probUH($uh,$status)
  {
    $data = file_get_contents($this->data_latih);
    $hasils = json_decode($data,true);
    $t = 0;
    $c = "Boolean";
    foreach ($hasils as $hasil) {
      if($uh <= $hasil['uh'] && $hasil['status'] == $status){
        $t += 1;
        $c = "True";
      }elseif ($uh <= $hasil['uh'] && $hasil['status'] == $status) {
        $t += 1;
        $c = "False";
      }
    }
    return $t;
  }

  function probUTS($uts,$status)
  {
    $data = file_get_contents($this->data_latih);
    $hasils = json_decode($data,true);

    $t = 0;
    $c = "Boolean";
    foreach ($hasils as $hasil) {
      if($uts >= $hasil['uts'] && $hasil['status'] == $status){
        $t += 1;
        $c = "True";
      }else if($uts >= $hasil['uts'] && $hasil['status'] == $status){
        $t +=1;
        $c = "False";
      }
    }
    return $t;
  }

  function probUAS($uas,$status)
  {
    $data = file_get_contents($this->data_latih);
    $hasils = json_decode($data,true);
    $c = "Boolean";
    $t = 0;
    foreach ($hasils as $hasil) {
      if($uas >= $hasil['uas'] && $hasil['status'] == $status){
        $t += 1;
        $c = "True";
      }else if($uas >= $hasil['uas'] && $hasil['status']== $status){
        $t +=1;
        $c = "False";
      }
    }
    return $t;
  }

  function probPraktek($praktek,$status)
  {
    $data = file_get_contents($this->data_latih);
    $hasils = json_decode($data,true);
    $c = "Boolean";
    $t = 0;
    foreach ($hasils as $hasil) {
      if($praktek >= $hasil['praktek'] && $hasil['status'] == $status){
        $t += 1;
        $c = "True";
      }else if($praktek >= $hasil['praktek'] && $hasil['status'] == $status){
        $t +=1;
        $c = "False";
      }
    }
    // echo "PRAKTEK ",$c," - ",$t,"<br>";
    return $t;
  }

  function hasilTrue($sTrue = 0 , $sData = 0 ,  $pAbsen = 0 ,$pUh = 0,$pUts = 0, $pUas = 0,$pPraktek = 0)
  {
    $paTrue = $sTrue / $sData;
    $p1 = $pAbsen / $sTrue;
    $p2 = $pUts / $sTrue;
    $p3 = $pUas / $sTrue;
    $p4 = $pPraktek / $sTrue;
    $p5 = $pUh / $sTrue;
    $hsl = $paTrue * $p1 * $p2 * $p3 * $p4 * $p5;


    return $hsl;
  }

  function hasilFalse($sFalse = 0 , $sData = 0 , $pAbsen = 0, $pUh = 0, $pUts = 0, $pUas = 0,$pPraktek = 0)
  {
    $paFalse = $sFalse / $sData;
    $p1 = $pAbsen / $sFalse;
    $p2 = $pUts / $sFalse;
    $p3 = $pUas / $sFalse;
    $p4 = $pPraktek / $sFalse;
    $p5 = $pUh / $sFalse;
    $hsl = $paFalse * $p1 * $p2 * $p3 * $p4 * $p5;

    // echo "hasilFalse ",$hsl ,"<br>";
    return $hsl;
  }

  function perbandingan($pATrue,$pAFalse)
  {

    if($pATrue > $pAFalse){
      $stt = "BERPRESTASI";
      $hitung = ($pATrue / ($pATrue + $pAFalse)) * 100;
      $diterima = 100 - $hitung;
    }elseif($pAFalse >= $pATrue)
    {
      $stt = "TIDAK BERPRESTASI";
      $hitung = ($pAFalse / ($pAFalse + $pATrue)) * 100;
      $diterima = 100 - $hitung;
    }
    $hsl = array($stt,$hitung,$diterima);
    return $hsl;
  }
  //=================================================================
}

?>
