<?php

// Fill in the code for the following four functions


function incomeTaxSingle($taxableIncome) {
    $incTax = 0.0;
    if($taxableIncome <= 9700){
        $incTax = .1 * $taxableIncome;
    } else if ($taxableIncome <= 39475){
        $incTax = 970 + ($taxableIncome-9700)*.12;
    } else if ($taxableIncome <=84200){
        $incTax = 4543 + ($taxableIncome-39475)*.22;
    } else if ($taxableIncome <= 160725){
        $incTax = 14382 + ($taxableIncome - 84200)*.24;
    } else if ($taxableIncome <=204100){
        $incTax = 32748 + ($taxableIncome-160725)*.32;
    } else if ($taxableIncome <= 510300){
        $incTax = 46628 + ($taxableIncome - 204100)*.35;
    } else {
        $incTax = 153798 + ($taxableIncome - 510300)*.37;
    }

    
    return $incTax;

}

function incomeTaxMarriedJointly($taxableIncome) {
    $incTax = 0.0;
    if($taxableIncome <= 19400){
        $incTax = .1 * $taxableIncome;

    } else if ($taxableIncome <= 78950){

        $incTax = 1940 + ($taxableIncome-19400)*.12;

    } else if ($taxableIncome <=168400){

        $incTax = 9086 + ($taxableIncome-78950)*.22;

    } else if ($taxableIncome <= 321450){

        $incTax = 28765 + ($taxableIncome - 168400)*.24;

    } else if ($taxableIncome <=408200){

        $incTax = 65497 + ($taxableIncome-321450)*.32;

    } else if ($taxableIncome <= 612350){

        $incTax = 93257 + ($taxableIncome - 408200)*.35;

    } else {
        $incTax = 164709 + ($taxableIncome - 612350)*.37;
    }
    
    return $incTax;

}

function incomeTaxMarriedSeparately($taxableIncome) {
    $incTax = 0.0;
    if($taxableIncome <= 9700){

        $incTax = .1 * $taxableIncome;

    } else if ($taxableIncome <= 39475){

        $incTax = 970 + ($taxableIncome-9700)*.12;

    } else if ($taxableIncome <=84200){

        $incTax = 4543 + ($taxableIncome-39475)*.22;

    } else if ($taxableIncome <= 160725){

        $incTax = 14382.50 + ($taxableIncome - 84200)*.24;

    } else if ($taxableIncome <=204100){

        $incTax = 32748.50 + ($taxableIncome-160725)*.32;

    } else if ($taxableIncome <= 510300){

        $incTax = 46628.50 + ($taxableIncome - 204100)*.35;

    } else {
        $incTax = 82354.75 + ($taxableIncome - 306175)*.37;
    }
    return $incTax;

}

function incomeTaxHeadOfHousehold($taxableIncome) {
    $incTax = 0.0;
    if($taxableIncome <= 13850){
        $incTax = .1 * $taxableIncome;

    } else if ($taxableIncome <= 52850){

        $incTax = 1385 + ($taxableIncome-13850)*.12;

    } else if ($taxableIncome <=84200){

        $incTax = 6065 + ($taxableIncome-52850)*.22;

    } else if ($taxableIncome <= 160700){

        $incTax = 12962 + ($taxableIncome - 84200)*.24;

    } else if ($taxableIncome <=204100){

        $incTax = 31322 + ($taxableIncome-160700)*.32;

    } else if ($taxableIncome <= 510300){

        $incTax = 45210 + ($taxableIncome - 204100)*.35;

    } else {
        $incTax = 152380 + ($taxableIncome - 510300)*.37;
    }
    
    return $incTax;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HW4 Part1 - LastName</title>

  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

    <h3>Income Tax Calculator</h3>

    <form class="form-horizontal" method="post">

        
        <div class="form-group">
            <label class="control-label col-sm-2" for="netIncome">Your Net Income:</label>
            <div class="col-sm-10">
            <input type="number" step="any" name="netIncome" placeholder="Taxable  Income" required autofocus>
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

            $taxSingle = number_format(incomeTaxSingle($income),2);
            $taxMarriedJoint = number_format(incomeTaxMarriedJointly($income),2);
            $taxMarriedSeparate = number_format(incomeTaxMarriedSeparately($income),2);
            $taxHead = number_format(incomeTaxHeadOfHousehold($income),2);
            echo '<p>With a net taxable income of $'.number_format($income,2);
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

</div>

</body>
</html>