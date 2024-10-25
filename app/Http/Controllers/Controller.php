<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function dashboard() {
        // Example: Fetch data for charts from the database
        $targetData = [
            'years' => ['2024', '2025', '2026', '2027', '2028', '2029'],
            'aboveTarget' => [60, 65, 70, 75, 80, 85],
            'onTarget' => [40, 45, 50, 55, 60, 65],
            'belowTarget' => [30, 35, 40, 45, 50, 55]
        ];
    
        $percentageData = [
            'aboveTarget' => 40,
            'onTarget' => 40,
            'belowTarget' => 20
        ];
    
        return view('dashboard', compact('targetData', 'percentageData'));
    }
}
