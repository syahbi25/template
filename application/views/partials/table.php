<?php defined('BASEPATH') OR exit('No direct script access allowed');
// Usage:
// $columns = [ ['label' => 'No', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-12'], ... ];
// $table_part = 'header' | 'footer';
// $no_wrapper = true|false (optional)

if (!isset($table_part) || $table_part !== 'footer') {
    // Render header / open table
    $no_wrapper = isset($no_wrapper) ? $no_wrapper : false;
    if (!$no_wrapper) echo '<div class="bg-white rounded-lg shadow-md overflow-hidden">';
    echo '<div class="overflow-x-auto">';
    echo '<table class="w-full table-auto divide-y divide-gray-200">';
    echo '<thead class="bg-gray-50"><tr>';
    if (!empty($columns) && is_array($columns)) {
        foreach ($columns as $col) {
            $col_class = isset($col['class']) ? $col['class'] : 'px-4 py-3 text-left text-sm font-semibold text-gray-700';
            $label = isset($col['label']) ? $col['label'] : '';
            echo '<th class="' . $col_class . '">' . $label . '</th>';
        }
    }
    echo '</tr></thead>';
    echo '<tbody class="divide-y divide-gray-200">';
} else {
    // Render footer / close table
    echo '</tbody></table></div>';
    $no_wrapper = isset($no_wrapper) ? $no_wrapper : false;
    if (!$no_wrapper) echo '</div>';
}
