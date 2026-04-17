<?php
// Check if writable directory scan is requested
if (isset($_GET['scan_writable']) && $_GET['scan_writable'] == '1') {
    scanWritableDirectories();
    exit; // Stop execution after directory scan
}

echo "<h3>Advanced Security Scanner</h3><hr>";

// Navigation menu
echo "<div style='background:#f0f0f0;padding:10px;margin-bottom:20px;'>";
echo "<b>Menu:</b> ";
echo "<a href='?'>Shell Scanner</a> | ";
echo "<a href='?scan_writable=1'>Writable Directory Scanner</a>";
if (isset($_GET['scan_writable'])) {
    $currentPath = isset($_GET['path']) ? htmlspecialchars($_GET['path']) : '';
    echo " | <a href='?scan_writable=1&path=/GANTI PATH LU BROK/'>Scan /GANTI PATH LU BROK/</a>";
}
echo "</div>";

echo "<h3>Shell Scan Result</h3><hr>";

// Function to scan writable directories
function scanWritableDirectories() {
    // Set content type to plain text for better formatting
    header('Content-Type: text/plain');
    
    // Default path to document root, can be overridden
    $scanPath = isset($_GET['path']) ? realpath($_GET['path']) : realpath($_SERVER['DOCUMENT_ROOT']);
    
    if (!$scanPath || !is_dir($scanPath)) {
        echo "Error: Invalid path specified\n";
        return;
    }
    
    try {
        $rii = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($scanPath, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach ($rii as $file) {
            if ($file->isDir()) {
                $dirPath = $file->getPathname();
                
                // Check if directory is writable
                if (is_writable($dirPath)) {
                    echo $dirPath . PHP_EOL;
                }
            }
        }
        
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Root directory (samakan dengan Server.MapPath("/"))
$path = realpath($_SERVER['DOCUMENT_ROOT']);

// Pola regex untuk deteksi obfuscation / webshell
$pattern = '/(base64_decode|eval\s*\(|gzinflate|str_rot13|shell_exec|exec\s*\(|system\s*\(|passthru|assert\s*\(|preg_replace\s*\(.*\/e|ReflectionClass|\$_(GET|POST|REQUEST))/i';

// Ekstensi yang di-skip biar cepat
$skipExt = ['jpg', 'png', 'gif', 'css', 'js', 'ico'];

try {
    $rii = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)
    );

    foreach ($rii as $file) {
        if (!$file->isFile()) continue;

        $filePath = $file->getPathname();
        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        // Skip asset
        if (in_array($ext, $skipExt)) continue;

        // Baca isi file (batasi ukuran biar aman)
        if ($file->getSize() > 5 * 1024 * 1024) continue; // skip >5MB
        $content = @file_get_contents($filePath);
        if ($content === false) continue;

        // 1. Regex detection
        if (preg_match($pattern, $content)) {
            echo "<b style='color:red'>[DANGER]</b> {$filePath}<br>";
            continue;
        }

        // 2. File PHP kecil (dropper/backdoor)
        if (in_array($ext, ['php', 'phtml']) && $file->getSize() < 500) {
            echo "<b style='color:orange'>[SUSPICIOUS (Small Size)]</b> {$filePath}<br>";
        }

        // 3. Injected script (misal PHP di file non-php)
        if ($ext !== 'php' && stripos($content, '<?php') !== false) {
            echo "<b style='color:purple'>[INJECTED FILE]</b> {$filePath}<br>";
        }
    }
} catch (Exception $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>
