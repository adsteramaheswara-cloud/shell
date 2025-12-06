<?php
// ********** WARNING **********
// 1) Rename this file to something UNGUESSABLE (eg: x9d7f3b8a.php) before uploading.
// 2) Default is DRY-RUN. Add ?run=1 to actually change permissions.
// 3) Use with caution. Backup first.
// *****************************

// CONFIG: ubah jika perlu
$MAX_DEPTH = 50;                 // batasi rekursi
$DEFAULT_PATH = __DIR__;         // default target

// Helpers
function reply($data, $code = 200) {
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
    exit;
}

$path = $_REQUEST['path'] ?? $DEFAULT_PATH;
$run  = isset($_REQUEST['run']) && ($_REQUEST['run'] === '1' || $_REQUEST['run'] === 'true');
$dry  = !$run;
$maxDepth = isset($_REQUEST['max_depth']) ? (int)$_REQUEST['max_depth'] : $MAX_DEPTH;

$pathReal = realpath($path);
if ($pathReal === false || !file_exists($pathReal)) {
    reply(['ok'=>false,'error'=>'Path not found','path'=>$path],400);
}

// refuse root
$danger_roots = ['/', 'C:\\', 'C:'];
foreach ($danger_roots as $r) {
    if ($pathReal === realpath($r)) {
        reply(['ok'=>false,'error'=>'Refuse to run on filesystem root.'],400);
    }
}

$results = [
    'started_at'=>date('c'),
    'target'=>$pathReal,
    'dry_run'=>$dry,
    'file_changes'=>0,
    'dir_changes'=>0,
    'errors'=>[],
    'actions'=>[]
];

function safe_chmod($target, $mode, &$results, $dry) {
    $entry = ['target'=>$target,'mode'=>sprintf('%04o',$mode)];
    if ($dry) {
        $entry['status']='dry-run';
        $results['actions'][] = $entry;
        return true;
    }
    $ok = @chmod($target, $mode);
    $entry['status']=$ok? 'ok':'failed';
    if (!$ok) $entry['err'] = error_get_last();
    $results['actions'][] = $entry;
    if ($ok) return true;
    $results['errors'][] = "chmod failed: $target";
    return false;
}

try {
    $it = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($pathReal, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    $it->setMaxDepth($maxDepth);
} catch (Exception $e) {
    reply(['ok'=>false,'error'=>'Cannot open directory','exception'=>$e->getMessage()],500);
}

// set root dir first
if (is_dir($pathReal)) {
    if (safe_chmod($pathReal, 0755, $results, $dry)) $results['dir_changes']++;
}

foreach ($it as $info) {
    $full = $info->getPathname();
    if ($info->isDir()) {
        if (safe_chmod($full, 0755, $results, $dry)) $results['dir_changes']++;
    } else {
        if (safe_chmod($full, 0644, $results, $dry)) $results['file_changes']++;
    }
}

$results['finished_at'] = date('c');
$results['duration_seconds'] = (strtotime($results['finished_at']) - strtotime($results['started_at']));
reply(['ok'=>true,'summary'=>$results]);
