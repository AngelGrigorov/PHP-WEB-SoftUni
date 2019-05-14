<?php
$matrixSize = explode(', ',readline());
$rowSize = $matrixSize[0];
$colSize = $matrixSize[1];
$matrix = [];
for($row = 0; $row < $rowSize;$row++){
    $matrix[$row] = array_map("intval",explode(", ",readline()));
}
$maxSum = 0;
$startRow = 0;
$startCol = 0;
for($row = 0; $row < count($matrix) - 1; $row++){
    for($col = 0;$col < count($matrix[$row]) - 1;$col++){
        $currentSum = $matrix[$row][$col] + $matrix[$row][$col+1] + $matrix[$row+1][$col] + $matrix[$row+1][$col+1];
        if($currentSum > $maxSum){
            $maxSum = $currentSum;
            $startRow = $row;
            $startCol = $col;
        }
    }
}
for($row = $startRow; $row < $startRow + 2; $row++) {
    for ($col = $startCol; $col < $startCol + 2; $col++) {
        echo $matrix[$row][$col] . " ";
    }
    echo PHP_EOL;
}
echo $maxSum;
