<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Venturo tahap 2</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        td,
        th {
            font-size: 11px;
        }
    </style>
</head>

<body>
    {{-- all container --}}
    <div class="container-fluid">
        <div class="card" style="margin: 2rem 0rem;">
            {{-- card judul --}}
            <div class="card-header">
                Venturo - Laporan penjualan tahunan per menu
            </div>
            {{-- card header --}}
            <div class="card-body">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <select id="my-select" class="form-control" name="tahun">
                                    <option value="">Pilih Tahun</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">
                                Tampilkan
                            </button>
                            <a href="http://tes-web.landa.id/intermediate/menu" target="_blank" rel="Array Menu"
                                class="btn btn-secondary">
                                Json Menu
                            </a>
                            <a href="http://tes-web.landa.id/intermediate/transaksi?tahun=2021" target="_blank"
                                rel="Array Transaksi" class="btn btn-secondary">
                                Json Transaksi
                            </a>
                            <a href="https://tes-web.landa.id/intermediate/download?path=example.php" target="_blank"
                                rel="Array Transaksi" class="btn btn-secondary">
                                Download Example
                            </a>
                        </div>
                    </div>
                </form>
                <hr>
                {{-- main tabel --}}
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" style="margin: 0;">
                        <thead>
                            <tr class="table-dark">
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">Menu
                                </th>
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                                    // Periksa apakah tahun dipilih
                                    if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                                        echo '<th colspan="12" style="text-align: center;">Periode Pada ' . $_GET['tahun'] . '</th>';
                                    }
                                }
                                ?>
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total
                                </th>
                            </tr>
                            <tr class="table-dark">
                                <th style="text-align: center;width: 75px;">Jan</th>
                                <th style="text-align: center;width: 75px;">Feb</th>
                                <th style="text-align: center;width: 75px;">Mar</th>
                                <th style="text-align: center;width: 75px;">Apr</th>
                                <th style="text-align: center;width: 75px;">Mei</th>
                                <th style="text-align: center;width: 75px;">Jun</th>
                                <th style="text-align: center;width: 75px;">Jul</th>
                                <th style="text-align: center;width: 75px;">Ags</th>
                                <th style="text-align: center;width: 75px;">Sep</th>
                                <th style="text-align: center;width: 75px;">Okt</th>
                                <th style="text-align: center;width: 75px;">Nov</th>
                                <th style="text-align: center;width: 75px;">Des</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- makanan --}}
                            <tr>
                                <td class="table-secondary" colspan="14"><b>Makanan</b></td>
                            </tr>
                            <tr>
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                                    // Periksa apakah tahun dipilih
                                    if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                                        $selectedYear = $_GET['tahun'];
                                        $api_url = 'https://tes-web.landa.id/intermediate/transaksi?tahun=' . $selectedYear;
                                        $menu_url = 'https://tes-web.landa.id/intermediate/menu';
                                
                                        // Mengambil data menu
                                        $menu_data = file_get_contents($menu_url);
                                        $menu_data = json_decode($menu_data, true);
                                
                                        // Mengambil data transaksi
                                        $transaksi_data = file_get_contents($api_url);
                                        $transaksi_data = json_decode($transaksi_data, true);
                                
                                        $kategori = 'makanan';
                                
                                        $total = 0;
                                        foreach ($menu_data as $menu_item) {
                                            // Menyeleksi kategori menu yang ingin ditampilkan
                                            if ($menu_item['kategori'] !== $kategori) {
                                                continue;
                                            }
                                
                                            echo "<td>{$menu_item['menu']}</td>";
                                
                                            // Menghitung total per menu
                                            $total_menu = 0;
                                
                                            foreach ($transaksi_data as $transaksi_item) {
                                                if ($transaksi_item['menu'] === $menu_item['menu']) {
                                                    $total_menu += $transaksi_item['total'];
                                
                                                    // Menampilkan harga per transaksi
                                                    echo "<td style='text-align: right;'>{$transaksi_item['total']}</td>";
                                                }
                                            }
                                
                                            // Menampilkan total per menu
                                            echo "<td style='text-align: right;'><b>{$total_menu}</b></td>";
                                
                                            $total += $total_menu;
                                
                                            echo '</tr>';
                                        }
                                    } else {
                                        // echo '<p>Tidak ada data transaksi untuk tahun ini.</p>';
                                    }
                                } else {
                                    echo '<p>Silakan pilih tahun terlebih dahulu.</p>';
                                }
                                ?>

                                {{-- minuman --}}
                            <tr>
                                <td class="table-secondary" colspan="14"><b>Minuman</b></td>
                            </tr>
                            <tr>
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                                    // Periksa apakah tahun dipilih
                                    if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                                        $selectedYear = $_GET['tahun'];
                                        $api_url = 'https://tes-web.landa.id/intermediate/transaksi?tahun=' . $selectedYear;
                                        $menu_url = 'https://tes-web.landa.id/intermediate/menu';
                                
                                        // Mengambil data menu
                                        $menu_data = file_get_contents($menu_url);
                                        $menu_data = json_decode($menu_data, true);
                                
                                        // Mengambil data transaksi
                                        $transaksi_data = file_get_contents($api_url);
                                        $transaksi_data = json_decode($transaksi_data, true);
                                
                                        $kategori = 'minuman';
                                
                                        $total = 0;
                                        foreach ($menu_data as $menu_item) {
                                            // Menyeleksi kategori menu yang ingin ditampilkan
                                            if ($menu_item['kategori'] !== $kategori) {
                                                continue;
                                            }
                                
                                            echo "<td>{$menu_item['menu']}</td>";
                                
                                            // Menghitung total per menu
                                            $total_menu = 0;
                                
                                            foreach ($transaksi_data as $transaksi_item) {
                                                if ($transaksi_item['menu'] === $menu_item['menu']) {
                                                    $total_menu += $transaksi_item['total'];
                                
                                                    // Menampilkan harga per transaksi
                                                    echo "<td style='text-align: right;'>{$transaksi_item['total']}</td>";
                                                }
                                            }
                                
                                            // Menampilkan total per menu
                                            echo "<td style='text-align: right;'><b>{$total_menu}</b></td>";
                                
                                            $total += $total_menu;
                                
                                            echo '</tr>';
                                            // echo '<tr class="table-dark">';
                                            // echo '<td><b>Total</b></td>';
                                            // echo "<td style='text-align: right;'><b>{$total}</b></td>";
                                            // echo '</tr>';
                                        }
                                    } else {
                                        // echo '<p>Tidak ada data transaksi untuk tahun ini.</p>';
                                    }
                                } else {
                                    echo '<p>Silakan pilih tahun terlebih dahulu.</p>';
                                }
                                
                                ?>

                            </tr>
                            {{-- total --}}
                            <tr class="table-dark">
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                                    // Periksa apakah tahun dipilih
                                    if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                                        $selectedYear = $_GET['tahun'];
                                        $api_url = 'https://tes-web.landa.id/intermediate/transaksi?tahun=' . $selectedYear;
                                        $menu_url = 'https://tes-web.landa.id/intermediate/menu';
                                
                                        // Mengambil data menu
                                        $menu_data = file_get_contents($menu_url);
                                        $menu_data = json_decode($menu_data, true);
                                
                                        // Mengambil data transaksi
                                        $transaksi_data = file_get_contents($api_url);
                                        $transaksi_data = json_decode($transaksi_data, true);
                                
                                        echo '<td><b>Total</b></td>';
                                
                                        foreach ($transaksi_data as $transaksi_item) {
                                            if ($transaksi_item['menu'] === $menu_item['menu']) {
                                                $total_menu += $transaksi_item['total'];
                                
                                                // Menampilkan harga per transaksi
                                                echo "<td style='text-align: right;'><b>{$total}</b></td>";
                                            }
                                        }
                                        $total += $total_menu;
                                        echo "<td style='text-align: right;'><b>{$total}</b></td>";
                                    }
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if(isset($menu)){?>

            <div class="row m-3">
                <div class="col-6">
                    <h4>Isi Json Menu</h4>
                    <pre style="height: 400px; background:#eaeaea;"><?php var_dump($menu); ?></pre>
                </div>
                <div class="col-6">
                    <h4>Isi Json Transaksi</h4>
                    <pre style="height: 400px; background:#eaeaea;"><?php var_dump($transaksi); ?></pre>
                </div>
            </div>
            <?php }?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>
