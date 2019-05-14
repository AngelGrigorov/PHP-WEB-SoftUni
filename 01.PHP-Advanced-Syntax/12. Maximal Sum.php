<?php
$matrixSize = explode(' ',readline());
$rowSize = $matrixSize[0];
$colSize = $matrixSize[1];
$matrix = [];
for($row = 0; $row < $rowSize;$row++){
    $matrix[$row] = array_map("intval",explode(" ",readline()));
}
$maxSum = 0;
$startRow = 0;
$startCol = 0;
for($row = 0; $row < count($matrix) - 3; $row++){
    for($col = 0;$col < count($matrix[$row]) - 3;$col++){
        $currentSum = $matrix[$row][$col]
            + $matrix[$row][$col+1]
            + $matrix[$row][$col+2]
            + $matrix[$row+1][$col]
            + $matrix[$row+1][$col+1]
            + $matrix[$row+1][$col+2]
            + $matrix[$row+2][$col]
            + $matrix[$row+2][$col+1]
            + $matrix[$row+2][$col+2];
        if($currentSum > $maxSum){
            $maxSum = $currentSum;
            $startRow = $row;
            $startCol = $col;
        }
    }
}
echo "Sum = $maxSum" . PHP_EOL;
for($row = $startRow; $row < $startRow + 3; $row++) {
    for ($col = $startCol; $col < $startCol + 3; $col++) {
        echo $matrix[$row][$col] . " ";
    }
    echo PHP_EOL;
}

