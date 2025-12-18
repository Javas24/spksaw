<!DOCTYPE html>
<html lang="en">
<?php
require "layout/head.php";
require "include/conn.php"; // koneksi menggunakan $db

// ============================
// 1. Ambil ALTERNATIF AKTIF
// ============================
$alternatives = [];
$sql_alt = mysqli_query($db, "SELECT id_alternative, name FROM saw_alternatives ORDER BY id_alternative");
while ($row = mysqli_fetch_assoc($sql_alt)) {
    $alternatives[$row['id_alternative']] = $row['name'];
}

if (count($alternatives) === 0) {
    echo "<h3 class='text-center text-danger'>Tidak ada data alternatif.</h3>";
    exit;
}

// ============================
// 2. Ambil KRITERIA
// ============================
$criterias = [];
$sql_k = mysqli_query($db, "SELECT id_criteria, weight, attribute FROM saw_criterias ORDER BY id_criteria");
while ($row = mysqli_fetch_assoc($sql_k)) {
    $criterias[] = $row;
}

if (count($criterias) === 0) {
    echo "<h3 class='text-center text-danger'>Tidak ada data kriteria.</h3>";
    exit;
}

// ============================
// 3. Ambil NILAI EVALUASI
// ============================
$values = [];
$sql_eval = mysqli_query($db, "SELECT * FROM saw_evaluations");
while ($row = mysqli_fetch_assoc($sql_eval)) {
    $values[$row['id_alternative']][$row['id_criteria']] = $row['value'];
}

// ============================
// 4. HITUNG NORMALISASI (R)
// ============================
$R = [];

foreach ($criterias as $c) {
    $idc = $c['id_criteria'];

    $col = [];
    foreach ($alternatives as $ida => $name) {
        if (isset($values[$ida][$idc])) {
            $col[] = $values[$ida][$idc];
        }
    }

    if (count($col) === 0) continue;

    $maxVal = max($col);
    $minVal = min($col);

    foreach ($alternatives as $ida => $name) {
        if (!isset($values[$ida][$idc])) {
            $R[$ida][$idc] = 0;
            continue;
        }

        if ($c['attribute'] === 'benefit') {
            $R[$ida][$idc] = $values[$ida][$idc] / $maxVal;
        } else {
            $R[$ida][$idc] = $minVal / $values[$ida][$idc];
        }
    }
}

// ============================
// 5. HITUNG NILAI PREFERENSI (P)
// ============================
$P = [];
foreach ($alternatives as $ida => $name) {
    $total = 0;
    foreach ($criterias as $c) {
        $idc = $c['id_criteria'];
        $w   = $c['weight'];
        $r   = isset($R[$ida][$idc]) ? $R[$ida][$idc] : 0;
        $total += $r * $w;
    }
    $P[$ida] = $total;
}

// ============================
// 6. SORTING RANKING
// ============================
$isRanking = isset($_GET['rank']) && $_GET['rank'] == 1;
if ($isRanking) {
    arsort($P); // DESC
}
?>

<body>
<div id="app">
<?php require "layout/sidebar.php"; ?>
<div id="main">

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3>Nilai Preferensi (P)</h3>
</div>

<div class="page-content">
<section class="row">
<div class="col-12">

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tabel Nilai Preferensi (P)</h4>
    </div>

    <div class="card-content">
        <div class="card-body">
            Nilai preferensi diperoleh dari Σ (R<sub>ij</sub> × W<sub>j</sub>)
        </div>

        <!-- Tombol Ranking -->
        <div class="d-flex justify-content-end mb-3 me-3">
            <a href="preferensi.php?rank=1" class="btn btn-primary btn-sm">
                🔽 Urutkan Ranking
            </a>
            <?php if ($isRanking): ?>
                <a href="preferensi.php" class="btn btn-secondary btn-sm ms-2">
                    ↩ Reset
                </a>
            <?php endif; ?>
        </div>

        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <tr>
                    <th>Rank</th>
                    <th>Alternatif</th>
                    <th>Nilai Preferensi (P)</th>
                </tr>

                <?php
                $rank = 1;
                foreach ($P as $ida => $nilai) {

                    $isBest = ($isRanking && $rank === 1);
                    $rowClass = $isBest ? "table-success fw-bold" : "";
                    $badge = $isBest ? "<span class='badge bg-success ms-2'>Terbaik</span>" : "";

                    echo "
                    <tr class='{$rowClass}'>
                        <td>{$rank}</td>
                        <td>{$alternatives[$ida]} {$badge}</td>
                        <td>".round($nilai, 5)."</td>
                    </tr>";
                    $rank++;
                }
                ?>
            </table>
        </div>
    </div>
</div>

</div>
</section>
</div>

<?php require "layout/footer.php"; ?>
</div>
</div>

<?php require "layout/js.php"; ?>
</body>
</html>
