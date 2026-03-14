<?php

function recursiveRemoveDirectory($directory) {
    if (file_exists($directory)) {
        $files = glob($directory . '/*');
        if ($files) {
            foreach ($files as $file) {
                if (is_dir($file)) {
                    recursiveRemoveDirectory($file);
                }
                else {
                    unlink($file);
                }
            }
        }
    }
}

recursiveRemoveDirectory('../temp/cache');

echo 'Cache smazána.';