<?php
// ==========================================
// 1. KONEKSI DATABASE
// ==========================================
// Matikan error reporting yang mengganggu tampilan jika di production
// Tapi hidupkan untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ganti sesuai settingan database kamu
$host = "localhost:3306";
$user = "byywsgym_pustakabbriau";
$pass = "po}0[l_F@EZj2020";
$db   = "byywsgym_pustakabbriau_s9";

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("<h3 style='color:red'>Koneksi Gagal: " . $mysqli->connect_error . "</h3>");
}

// ==========================================
// 2. FUNGSI BANTUAN
// ==========================================
function getPrimaryKey($mysqli, $table) {
    $table = $mysqli->real_escape_string($table);
    $q = $mysqli->query("SHOW KEYS FROM `$table` WHERE Key_name='PRIMARY'");
    if ($q && $r = $q->fetch_assoc()) {
        return $r['Column_name'];
    }
    return null;
}

// ==========================================
// 3. FITUR: LIST TABEL
// ==========================================
function showTables($mysqli) {
    $q = $mysqli->query("SHOW TABLES");
    echo "<h2>📂 Daftar Tabel</h2><ul>";
    while ($r = $q->fetch_row()) {
        echo "<li><a href='?table={$r[0]}'>{$r[0]}</a></li>";
    }
    echo "</ul>";
}

// ==========================================
// 4. FITUR: LIHAT DATA (READ)
// ==========================================
function showTableData($mysqli, $table) {
    $table = $mysqli->real_escape_string($table);
    $pk = getPrimaryKey($mysqli, $table);

    if (!$pk) return print("<div style='color:red;'>❌ Error: Tabel <b>$table</b> tidak memiliki Primary Key.</div>");

    echo "<h2>Tabel: $table</h2>";
    echo "<a href='?create=$table' style='background:green; color:white; padding:10px; text-decoration:none;'>➕ Tambah Data Baru</a><br><br>";

    $q = $mysqli->query("SELECT * FROM `$table` ORDER BY `$pk` DESC");
    
    echo "<table border='1' cellpadding='5' style='border-collapse:collapse; width:100%'>
            <tr style='background:#f2f2f2'>";
    
    // Header
    $fields = $q->fetch_fields();
    foreach ($fields as $f) echo "<th>{$f->name}</th>";
    echo "<th>Aksi</th></tr>";

    // Data
    while ($row = $q->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $v) {
            $tampil = htmlspecialchars($v);
            if (strlen($tampil) > 50) $tampil = substr($tampil, 0, 47) . "...";
            echo "<td>$tampil</td>";
        }

        $id = urlencode($row[$pk]);
        echo "<td style='white-space:nowrap'>
                <a href='?edit=$table&pk=$pk&id=$id' style='color:blue'>📝 Edit</a> | 
                <a href='?clone=$table&pk=$pk&id=$id' onclick=\"return confirm('Yakin ingin duplikat data ini?')\" style='color:orange'>©️ Clone</a>
              </td></tr>";
    }
    echo "</table><br><a href='?'>← Kembali ke Daftar Tabel</a>";
}

// ==========================================
// 5. FITUR: FORM TAMBAH (CREATE)
// ==========================================
function showCreateForm($mysqli, $table) {
    $table = $mysqli->real_escape_string($table);
    $pk = getPrimaryKey($mysqli, $table);

    $q = $mysqli->query("SHOW COLUMNS FROM `$table`");
    
    echo "<h2>➕ Tambah Data: $table</h2>";
    echo "<form method='POST' autocomplete='off'>";
    // Dummy input
    echo '<input type="text" style="display:none"><input type="password" style="display:none">';

    while ($col = $q->fetch_assoc()) {
        $field = $col['Field'];
        if ($field === $pk) continue; // Skip Auto Increment ID

        echo "<b>$field</b><br>";

        // ANTI-AUTOFILL: Ganti nama input password
        if (strpos($field, 'password') !== false) {
            $inputName = "hack_browser_" . $field; 
            echo "<input type='text' name='$inputName' style='width:400px; background:#e8f0fe' placeholder='Paste Hash disini...'>";
            echo "<br><small style='color:red'>* Input disamarkan (Anti-Autofill)</small>";
        } else {
            echo "<input type='text' name='$field' style='width:400px'>";
        }
        echo "<br><br>";
    }

    echo "<input type='hidden' name='table' value='$table'>
          <button name='insert' style='padding:10px 20px; cursor:pointer'>SIMPAN DATA BARU</button>
          </form>";
    echo "<br><a href='?table=$table'>← Batal</a>";
}

// ==========================================
// 6. PROSES INSERT
// ==========================================
function insertData($mysqli, $table, $data) {
    $table = $mysqli->real_escape_string($table);
    
    $cols = array();
    $vals = array();

    foreach ($data as $k => $v) {
        if (in_array($k, array('table', 'insert'))) continue;

        // Restore nama kolom asli
        $realCol = (strpos($k, 'hack_browser_') === 0) ? str_replace('hack_browser_', '', $k) : $k;

        $cols[] = "`$realCol`";
        $vals[] = "'" . $mysqli->real_escape_string(trim($v)) . "'";
    }

    $sql = "INSERT INTO `$table` (" . implode(",", $cols) . ") VALUES (" . implode(",", $vals) . ")";

    if ($mysqli->query($sql)) {
        echo "<h3>✅ Data Berhasil Ditambahkan!</h3>";
        echo "<a href='?table=$table'>Kembali ke Tabel</a>";
    } else {
        echo "<h3 style='color:red'>Gagal: " . $mysqli->error . "</h3>";
    }
}

// ==========================================
// 7. FITUR: FORM EDIT
// ==========================================
function showEditForm($mysqli, $table, $pk, $id) {
    $table = $mysqli->real_escape_string($table);
    $pk = $mysqli->real_escape_string($pk);
    $id_safe = $mysqli->real_escape_string($id);

    $q = $mysqli->query("SELECT * FROM `$table` WHERE `$pk`='$id_safe'");
    $row = $q->fetch_assoc();

    echo "<h2>✏️ Edit Data</h2><form method='POST' autocomplete='off'>";
    echo '<input type="text" style="display:none"><input type="password" style="display:none">';

    foreach ($row as $k => $v) {
        echo "<b>$k</b><br>";
        if ($k === $pk) {
            // Tampilkan primary key (bisa diubah)
            echo "<input type='text' name='$k' value='".htmlspecialchars($v)."' style='width:400px; background:#fff3cd'>";
            echo "<br><small style='color:orange'>* Primary Key (hati-hati saat mengubah)</small>";
        } elseif (strpos($k, 'password') !== false) {
            $inputName = "hack_browser_" . $k; 
            echo "<input type='text' name='$inputName' value='".htmlspecialchars($v)."' style='width:400px; background:#e8f0fe'>";
            echo "<br><small style='color:red'>* Input disamarkan (Anti-Autofill)</small>";
        } else {
            echo "<input type='text' name='$k' value='".htmlspecialchars($v)."' style='width:400px'>";
        }
        echo "<br><br>";
    }
    
    echo "<input type='hidden' name='table' value='$table'>
          <input type='hidden' name='pk' value='$pk'>
          <input type='hidden' name='id' value='".htmlspecialchars($id)."'>
          <button name='update' style='padding:10px 20px; cursor:pointer'>SIMPAN PERUBAHAN</button></form>";
    echo "<br><a href='?table=$table'>← Batal</a>";
}

// ==========================================
// 8. PROSES UPDATE
// ==========================================
function updateData($mysqli, $table, $pk, $id, $data) {
    $table = $mysqli->real_escape_string($table);
    $pk = $mysqli->real_escape_string($pk);
    $id_safe = $mysqli->real_escape_string($id);
    
    $set = array();
    foreach ($data as $k => $v) {
        if (in_array($k, array('table', 'pk', 'id', 'update'))) continue;

        $realCol = (strpos($k, 'hack_browser_') === 0) ? str_replace('hack_browser_', '', $k) : $k;
        $val = $mysqli->real_escape_string(trim($v));
        $set[] = "`$realCol`='$val'";
    }

    $sql = "UPDATE `$table` SET ".implode(", ", $set)." WHERE `$pk`='$id_safe'";

    echo "<div style='background:black; color:lime; padding:10px'>QUERY: $sql</div>";

    if ($mysqli->query($sql)) {
        echo "<h3>✅ Update Berhasil</h3>";
        if ($mysqli->affected_rows == 0) echo "⚠️ (Data tidak berubah / sama persis)";
        echo "<a href='?table=$table'>Kembali</a>";
    } else {
        echo "Error: " . $mysqli->error;
    }
}

// ==========================================
// 9. FITUR: CLONE (DUPLIKAT)
// ==========================================
function cloneData($mysqli, $table, $pk, $id) {
    $table = $mysqli->real_escape_string($table);
    $pk = $mysqli->real_escape_string($pk);
    $id_safe = $mysqli->real_escape_string($id);

    $q = $mysqli->query("SELECT * FROM `$table` WHERE `$pk`='$id_safe'");
    if ($q && $row = $q->fetch_assoc()) {
        unset($row[$pk]);

        // Menggunakan sintaks tradisional agar kompatibel PHP lama (tanpa arrow function)
        $cols = array_map(function($c) { return "`$c`"; }, array_keys($row));
        
        $vals = array();
        foreach($row as $val) {
             $vals[] = "'" . $mysqli->real_escape_string($val) . "'";
        }

        $sql = "INSERT INTO `$table` (".implode(",",$cols).") VALUES (".implode(",",$vals).")";

        if ($mysqli->query($sql)) {
            echo "<h3>✅ Clone Berhasil!</h3>";
            echo "<a href='?table=$table'>Kembali ke Tabel</a>";
        } else {
            echo "<h3>❌ Gagal Clone: " . $mysqli->error . "</h3>";
        }
    } else {
        echo "Data sumber tidak ditemukan.";
    }
}

// ==========================================
// MAIN ROUTER
// ==========================================
echo "<div style='font-family:sans-serif; padding:20px'>";

if (isset($_POST['update'])) {
    updateData($mysqli, $_POST['table'], $_POST['pk'], $_POST['id'], $_POST);
}
elseif (isset($_POST['insert'])) {
    insertData($mysqli, $_POST['table'], $_POST);
}
elseif (isset($_GET['clone'])) {
    cloneData($mysqli, $_GET['clone'], $_GET['pk'], $_GET['id']);
}
elseif (isset($_GET['create'])) {
    showCreateForm($mysqli, $_GET['create']);
}
elseif (isset($_GET['edit'])) {
    showEditForm($mysqli, $_GET['edit'], $_GET['pk'], $_GET['id']);
}
elseif (isset($_GET['table'])) {
    showTableData($mysqli, $_GET['table']);
}
else {
    showTables($mysqli);
}

echo "</div>";
?>
