<!DOCTYPE html>
<html lang="en">
<?php
require "layout/head.php";
require "include/conn.php";
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
    <h3>Matrik</h3>
</div>

<div class="page-content">
<section class="row">
<div class="col-12">
<div class="card">

<div class="card-header">
    <h4 class="card-title">Matriks Keputusan (X) & Ternormalisasi (R)</h4>
</div>

<div class="card-content">
<div class="card-body">
    <p class="card-text">
        Rumus normalisasi:<br>
        <b>Benefit :</b> Xij / Max(Xj)<br>
        <b>Cost :</b> Min(Xj) / Xij
    </p>
</div>

<button type="button" class="btn btn-outline-success btn-sm m-2" data-bs-toggle="modal"
        data-bs-target="#inlineForm">Isi Nilai Alternatif</button>

<div class="table-responsive">

<?php
//---------------------------------------------------------
// AMBIL DATA KRITERIA
//---------------------------------------------------------
$criterias = [];
$q = $db->query("SELECT id_criteria, criteria, attribute FROM saw_criterias ORDER BY id_criteria");
while ($row = $q->fetch_object()) {
    $criterias[$row->id_criteria] = [
        "name" => $row->criteria,
        "attribute" => $row->attribute
    ];
}
$q->free();

$jumlah_kriteria = count($criterias);


//---------------------------------------------------------
// AMBIL MATRKS X
//---------------------------------------------------------
$sql = "
    SELECT a.id_alternative, b.name, a.id_criteria, a.value
    FROM saw_evaluations a
    JOIN saw_alternatives b ON a.id_alternative = b.id_alternative
    ORDER BY a.id_alternative, a.id_criteria
";
$result = $db->query($sql);

$X = [];        // nilai asli
$normal_basis = []; // min/max untuk tiap kriteria

while ($row = $result->fetch_object()) {
    $X[$row->id_alternative]["name"] = $row->name;
    $X[$row->id_alternative]["values"][$row->id_criteria] = $row->value;

    // kumpulkan untuk min/max
    $normal_basis[$row->id_criteria][] = $row->value;
}
$result->free();


// Hitung min-max tiap kriteria
$minmax = [];
foreach ($criterias as $idk => $c) {
    if (isset($normal_basis[$idk])) {
        $minmax[$idk]["min"] = min($normal_basis[$idk]);
        $minmax[$idk]["max"] = max($normal_basis[$idk]);
    } else {
        $minmax[$idk]["min"] = 0;
        $minmax[$idk]["max"] = 0;
    }
}
?>

<!-- ========================= -->
<!--  TABEL MATRIKS KEPUTUSAN X -->
<!-- ========================= -->

<table class="table table-striped mb-0">
    <caption>Matriks Keputusan (X)</caption>
    <tr>
        <th>Alternatif</th>
        <?php foreach ($criterias as $c) echo "<th>{$c['name']}</th>"; ?>
        <th>Aksi</th>
    </tr>

<?php
if (empty($X)) {
    echo "<tr><td colspan='".($jumlah_kriteria+2)."' class='text-center'>Belum ada data</td></tr>";
} else {
    foreach ($X as $id_alt => $data) {
        echo "<tr class='center'>";
        echo "<th>{$data['name']}</th>";

        foreach ($criterias as $idk => $c) {
            $nilai = isset($data["values"][$idk]) ? $data["values"][$idk] : "-";
            echo "<td>" . (is_numeric($nilai) ? round($nilai,2) : $nilai) . "</td>";
        }

        echo "<td><a href='keputusan-hapus.php?id={$id_alt}' class='btn btn-danger btn-sm'>Hapus</a></td>";
        echo "</tr>";
    }
}
?>
</table>


<!-- ============================= -->
<!--  TABEL MATRIK TERNORMALISASI R -->
<!-- ============================= -->

<table class="table table-striped mt-4 mb-0">
    <caption>Matriks Ternormalisasi (R)</caption>
    <tr>
        <th>Alternatif</th>
        <?php foreach ($criterias as $c) echo "<th>{$c['name']}</th>"; ?>
    </tr>

<?php
if (empty($X)) {
    echo "<tr><td colspan='".($jumlah_kriteria+1)."' class='text-center'>Belum ada data</td></tr>";
} else {
    foreach ($X as $id_alt => $data) {
        echo "<tr class='center'>";
        echo "<th>{$data['name']}</th>";

        foreach ($criterias as $idk => $c) {
            $val = isset($data["values"][$idk]) ? $data["values"][$idk] : null;

            if ($val === null || $val == 0) {
                echo "<td>-</td>";
                continue;
            }

            if ($c["attribute"] == "benefit") {
                $r = $val / $minmax[$idk]["max"];
            } else {
                $r = $minmax[$idk]["min"] / $val;
            }

            echo "<td>" . round($r, 4) . "</td>";
        }

        echo "</tr>";
    }
}
?>
</table>

</div> <!-- end table responsive -->

</div>
</div>
</div>
</section>
</div>


<!-- ======================================================== -->
<!-- MODAL INPUT NILAI -->
<!-- ======================================================== -->
<div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
<div class="modal-content">

<div class="modal-header">
    <h4 class="modal-title">Isi Nilai Kandidat</h4>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <i data-feather="x"></i>
    </button>
</div>

<form action="matrik-simpan.php" method="POST">

<div class="modal-body">
<label>Nama Alternatif:</label>
<select class="form-control form-select" name="id_alternative" required>
<?php
$q = $db->query("SELECT * FROM saw_alternatives");
while ($r = $q->fetch_object()) {
    echo "<option value='{$r->id_alternative}'>{$r->name}</option>";
}
$q->free();
?>
</select>
</div>

<div class="modal-body">
<label>Kriteria:</label>
<select class="form-control form-select" name="id_criteria" required>
<?php
$q = $db->query("SELECT * FROM saw_criterias");
while ($r = $q->fetch_object()) {
    echo "<option value='{$r->id_criteria}'>{$r->criteria}</option>";
}
$q->free();
?>
</select>
</div>

<div class="modal-body">
<label>Value:</label>
<input type="number" step="0.01" name="value" class="form-control" required>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
</div>

</form>

</div>
</div>
</div>

<?php require "layout/footer.php"; ?>
<?php require "layout/js.php"; ?>

</div>
</div>
</body>
</html>
