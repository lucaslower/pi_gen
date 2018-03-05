<?php

function gcd($x, $y)
{
    /*This function finds the gcd (greatest common divisor)
    of the two integers $x and $y and returns the gcd
    It uses the Euclidean Algorithm.
    The general form for the Euclidean Algorithm is
    r_k = q_(k+2)*r_(k+1) + r_(k+2)
    Here _ denotes subscripts.
    Above Parentheses indicate that the subscript is more than 1 character long
    for the code I just remove the _ and ()
    initially $r_k = $x and $r_(k+1) = $y
    */
    if ($x == $y)
    {
        return 1;
    }
    elseif ($x == 0 or $y == 0)
    {
        return 1;
    }
    else
    {
        #we assume $x is greater than y. If $y is greater than $x,
        #just switch them
        if ($y > $x)
        {
            $temp = $x;
            $x = $y;
            $y = $temp;
        }
        $rk = $x;
        $rkp1 = $y;
        $rkp2 = $rk%$rkp1;
        if ($rkp2 == 0)
            return $rkp1;
        else
        {
            while ($rkp2 != 0)
            {
                $rk = $rkp1;
                $rkp1 = $rkp2;
                $rkp2 = $rk%$rkp1;
            }
            return $rkp1;
        }
    }
}

$out = '?';

if(isset($_GET['range'])){
  $range = $_GET["range"];
  $trials = $_GET["trials"];

  $gcd = 0;

  for($i=0;$i<$trials;$i++){
    $int_1 = random_int(0,$range);
    $int_2 = random_int(0,$range);

    $gcd_test = gcd($int_1,$int_2);

    if($gcd_test == 1){
      $gcd++;
    }
  }

  $prob = $gcd/$trials;

  $pi = sqrt(6/$prob);

  $error = ($pi - pi())/(pi())*100;

  $out = $pi;

  $time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Pi Gen!</title>
<style>
body{
  padding:50px;
}
form{
  margin-top:40px;
}
</style>
</head>
<body>
  <h1>You've reached lucaslower's Pi Generator! Created 10 days before Pi day 2018.</h1>
    <p>Pop in some parameters below and see how close we can get to pi.<br>This is based on Matt Parker's video from pi day 2017--I will update this with mathematical stuff later.</p>
<form method="get" action="index.php">
<input type="text" name="range" placeholder="Number Range">
<input type="text" name="trials" placeholder="Number of Trials">
<input type="submit" value="Calculate Pi!">
</form>
<h1>&pi;&nbsp;&nbsp;&asymp;&nbsp;&nbsp;<?php echo $out; ?></h1>
<?php if($out != '?'){echo '<h2>Percent error of ' . $error . '! We did it in ' . $time . ' seconds! Nice!';} ?>
</body>
</html>
