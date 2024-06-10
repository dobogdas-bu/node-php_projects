<?php

define('TAX_RATES',
  array(
    'Single' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,9700,39475,84200,160725,204100,510300),
      'MinTax' => array(0, 970,4543,14382,32748,46628,153798)
      ),
    'Married_Jointly' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,19400,78950,168400,321450,408200,612350),
      'MinTax' => array(0, 1940,9086,28765,65497,93257,164709)
      ),
    'Married_Separately' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,9700,39475,84200,160725,204100,306175),
      'MinTax' => array(0, 970,4543,14382.50,32748.50,46628.50,82354.75)
      ),
    'Head_Household' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,13850,52850,84200,160700,204100,510300),
      'MinTax' => array(0, 1385,6065,12962,31322,45210,152380)
      )
    )
);

// Fill in the code for the following function

function incomeTax($taxableIncome, $status) {
  $incTax = 0.0;
  // get the rates, ranges, and mintax arrays for the given status
  $ranges = TAX_RATES[$status]['Ranges'];
  $rates = TAX_RATES[$status]['Rates'];
  $mins = TAX_RATES[$status]['MinTax'];


  // loop through to get index where range criteria satisfied, then use index to get other values for calculation
  for ($i = 0; $i < count($ranges); $i++) {
      if ($taxableIncome <= $ranges[$i]) {
          $rate = $rates[$i - 1];
          $minTax = $mins[$i - 1];
          $range = $ranges[$i - 1];
          $extra = $taxableIncome - $range;
          $incTax = $minTax + ($extra * ($rate / 100));
          break;
      }
  }

  return $incTax;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HW4 Part2 - LastName</title>

  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">

    <h3>Income Tax Calculator</h3>

    <form class="form-horizontal" method="post">

      <div class="form-group">
        <label class="control-label col-sm-2">Enter Net Income:</label>
        <div class="col-sm-10">
          <input type="number"  step="any" name="netIncome" placeholder="Taxable  Income" required autofocus>
        </div>
      </div>
      <div class="form-group"> 
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>

    </form>

    <?php

        // Fill in the rest of the PHP code for form submission results

        if(isset($_POST['netIncome'])) {

          $income = $_POST['netIncome'];
          echo 'With a net taxable income of $'.number_format($income,2);
          // get tax value for each status and format accordingly
          $taxSingle = number_format(incomeTax($income, 'Single'),2);
          $taxMarriedJoint = number_format(incomeTax($income, 'Married_Jointly'),2);
          $taxMarriedSeparate = number_format(incomeTax($income, 'Married_Separately'),2);
          $taxHead = number_format(incomeTax($income, 'Head_Household'),2);
          echo '
            <table class="table">
                <tr>
                    <th>Status</th>
                    <th>Tax</th>
                </tr>
                <tr>
                    <td>Single</td>
                    <td>$'.$taxSingle.'</td>
                </tr>
                <tr>
                    <td>Married Filing Jointly</td>
                    <td>$'.$taxMarriedJoint.'</td>
                </tr>
                <tr>
                    <td>Married Filing Separately</td>
                    <td>$'.$taxMarriedSeparate.'</td>
                </tr>
                <tr>
                    <td>Head of Household</td>
                    <td>$'.$taxHead.'</td>
                </tr>
            </table>';


        }

    ?>

    

    <h3>2019 Tax Tables</h3>

    <?php
    
    foreach (TAX_RATES as $status => $data) {
      $status = str_replace('_', ' ',$status);
      // format with $ and 2 decimal places
      $formattedDataRange1= '$'.number_format($data['Ranges'][1],2);
      //first row for each status
      
        echo <<<HTML
        <h3>$status</h3>
        <table class="table table-striped">
        <tr>
            <th>Taxable Income</th>
            <th>Tax Rate</th>
        </tr>
        <tr>
            <td>$0 - $formattedDataRange1</td>
            <td>10%</td>

        </tr>
        HTML;
        // middle rows
        $count = count($data['Ranges'])-1;
        for($i =1; $i< $count; $i++){
          //format values for display in table
          $lowRangeFormatted = '$'.number_format($data['Ranges'][$i],2);
          $lowRangeFormattedPlusOne = '$'.number_format($data['Ranges'][$i] +1,2);
          $highRangeFormatted = '$'.number_format($data['Ranges'][$i+1],2);
          $minTaxFormatted = '$'.number_Format($data['MinTax'][$i],2);
          $rateFormatted = $data['Rates'][$i].'%';
        echo <<<HTML
        <tr>
          <td>
            $lowRangeFormattedPlusOne - $highRangeFormatted
          </td>
          <td>
            $minTaxFormatted plus $rateFormatted of the amount over $lowRangeFormatted
        </td>


        </tr>
        HTML;

        }
        // last row
        $formattedDataRange6 ='$'.number_format($data['Ranges'][6]+1,2);
        $formattedDataRange5 ='$'.number_format($data['Ranges'][5],2);
        echo <<<HTML
        <tr>
            <td>$formattedDataRange6 or more</td>
            <td>$formattedDataRange5 plus 37% of the amount over $formattedDataRange6</td>

        </tr>
      
        HTML;
        echo '</table>';
    
    }
    
    

    ?>

   
       
</div>

</body>
</html>