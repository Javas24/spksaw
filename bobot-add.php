<?php require "include/conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php require "layout/head.php"; ?>

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
                <h3>Tambah Kriteria</h3>
            </div>

            <div class="page-content">
                <section class="row">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Input Kriteria Baru</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <form action="bobot-add-act.php" method="POST">
                                        <div class="form-group">
                                            <label for="basicInput">Kriteria</label>
                                            <input type="text" class="form-control" name="criteria" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="basicInput">Weight</label>
                                            <input type="number" step="0.01" class="form-control" name="weight" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="basicInput">Attribute</label>
                                            <select class="form-control form-select" name="attribute" required>
                                                <option value="benefit">Benefit</option>
                                                <option value="cost">Cost</option>
                                            </select>
                                        </div>

                                        <div class="form-group mt-3">
                                            <input type="submit" class="btn btn-success btn-sm" value="Simpan">
                                            <a href="bobot.php" class="btn btn-secondary btn-sm">Kembali</a>
                                        </div>
                                    </form>
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
