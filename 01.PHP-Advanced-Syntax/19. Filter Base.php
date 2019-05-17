<?php
$arrayAge = [];
$arraySalary = [];
$arrayPosition = [];
$input = readline();
while ($input !== "filter base") {
    $input = explode(" -> ", $input);
    $name = $input[0];
    if (filter_var($input[1], FILTER_VALIDATE_INT)) {
        $age = $input[1];
        $arrayAge[$name] = $age;
    } else if (filter_var($input[1], FILTER_VALIDATE_FLOAT)) {
        $salary = $input[1];
        $arraySalary[$name] = $salary;
    } else {
        $position = $input[1];
        $arrayPosition[$name] = $position;
    }
    $input = readline();
}
$input = readline();
if ($input === "Age") {
    foreach ($arrayAge as $name => $age) {
        echo "Name: $name" . PHP_EOL;
        echo "Age: $age" . PHP_EOL;
        echo str_repeat("=", 20) . PHP_EOL;
    }
} else if ($input === "Salary") {
    foreach ($arraySalary as $name => $salary) {
        echo "Name: $name" . PHP_EOL;
        printf("Salary: %.02f" . PHP_EOL, $salary);
        echo str_repeat("=", 20) . PHP_EOL;
    }
} else if ($input === "Position") {
    foreach ($arrayPosition as $name => $position) {
        echo "Name: $name" . PHP_EOL;
        echo "Position: $position" . PHP_EOL;
        echo str_repeat("=", 20) . PHP_EOL;
    }
}
