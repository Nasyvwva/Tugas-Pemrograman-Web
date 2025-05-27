<?php
date_default_timezone_set('Asia/Jakarta');

$currentMonth = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
$currentYear = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');

$today = (int)date('d');
$todayMonth = (int)date('m');
$todayYear = (int)date('Y');

$monthNames = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
];

$dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

$prevMonth = $currentMonth - 1;
$prevYear = $currentYear;
if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear--;
}

$nextMonth = $currentMonth + 1;
$nextYear = $currentYear;
if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear++;
}

$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

$firstDayOfMonth = date('w', mktime(0, 0, 0, $currentMonth, 1, $currentYear));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender PHP</title>
    <link rel="stylesheet" href="calendar.css">
</head>
<body>
    <div class="calendar-container">
        <div class="calendar-header">
            <a href="?month=<?php echo $prevMonth; ?>&year=<?php echo $prevYear; ?>" class="nav-button">
                &lt;&lt; Bulan Sebelumnya
            </a>
            <div class="month-title">
                <?php echo $monthNames[$currentMonth] . ' ' . $currentYear; ?>
            </div>
            <a href="?month=<?php echo $nextMonth; ?>&year=<?php echo $nextYear; ?>" class="nav-button">
                Bulan Berikutnya &gt;&gt;
            </a>
        </div>

        <table class="calendar-table">
            <thead>
                <tr>
                    <?php foreach ($dayNames as $day): ?>
                        <th><?php echo $day; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $date = 1;
                $totalCells = ceil(($daysInMonth + $firstDayOfMonth) / 7) * 7;
                
                for ($i = 0; $i < $totalCells; $i += 7) {
                    echo '<tr>';
                    
                    for ($j = 0; $j < 7; $j++) {
                        $cellIndex = $i + $j;
                        
                        if ($cellIndex < $firstDayOfMonth || $date > $daysInMonth) {
                            echo '<td class="empty-cell"></td>';
                        } else {
                            $isToday = ($date == $today && $currentMonth == $todayMonth && $currentYear == $todayYear);
                            $isHighlighted = ($date == $today && ($currentMonth != $todayMonth || $currentYear != $todayYear));
                            
                            $class = '';
                            if ($isToday) {
                                $class = 'today';
                            } elseif ($isHighlighted) {
                                $class = 'today';
                            }
                            
                            echo '<td class="' . $class . '">';
                            echo '<span class="date-number">' . $date . '</span>';
                            echo '</td>';
                            $date++;
                        }
                    }
                    
                    echo '</tr>';
                    
                    if ($date > $daysInMonth) {
                        break;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>