<?php

namespace Loopwork\Installer;
class Installer
{
    public static function run($targetDir)
    {
        $hps = __DIR__ . 'templates';
        $templateDir = str_replace("src", "", $hps);
        //$targetDir = getcwd();

        if (!$templateDir) {
            echo "Template directory not found: $hps\n";
            return;
        }

        echo "Creating index.php\n";

        // Salin index.php
        if (!file_exists($templateDir . '/index.php')) {
            echo "index.php is not available in: $templateDir\n";
            return;
        }

        if (!copy($templateDir . '/index.php', $targetDir . '/index.php')) {
            echo "Failed to Create index.php\n\n";
        } else {
            echo "index.php Successful\n\n";
        }

        echo "Creating .env\n";
        // Salin .env
        if (!file_exists($templateDir . '/.env')) {
            echo ".env is not available in: $templateDir\n";
            return;
        }

        if (!copy($templateDir . '/.env', $targetDir . '/.env')) {
            echo "Failed to Create .env\n\n";
        } else {
            echo ".env Successful\n\n";
        }

        echo "Creating a Utility Folder\n";
        // Salin folder utility
        $hpss = __DIR__ . 'utility';
        $utilitySource = str_replace("src", "", $hpss);
        $utilityDestination = $targetDir . '/utility'; // Folder tujuan

        if (!self::copyFolder($utilitySource, $utilityDestination)) {
            echo "Failed to Create Utility Folder\n\n";
        } else {
            echo "Utility Folder Successful\n\n";
        }

        echo "Installation Loopwork complete!\n\n";

        $runmanual = readline("Run Server? y/n: ");
        if($runmanual == "y"){
            $port = readline("Port? [1828]: ");
            if(isset($port)){
                exec("php -S localhost:".(int)$port);
            }
            else{
                exec("php -S localhost:1828");
            }
        }
        else{
            echo "";
        }
    }

    /**
     * Fungsi untuk menyalin folder beserta isinya
     */
    private static function copyFolder($source, $destination)
    {
        if (!is_dir($source)) {
            echo "Source directory does not exist: $source\n";
            return false;
        }

        if (!is_dir($destination)) {
            if (!mkdir($destination, 0777, true)) {
                echo "Failed to create destination directory: $destination\n";
                return false;
            }
        }

        $dir = opendir($source);
        if (!$dir) {
            echo "Failed to open source directory: $source\n";
            return false;
        }

        while (($file = readdir($dir)) !== false) {
            if ($file != '.' && $file != '..') {
                $sourcePath = $source . DIRECTORY_SEPARATOR . $file;
                $destinationPath = $destination . DIRECTORY_SEPARATOR . $file;

                if (is_dir($sourcePath)) {
                    if (!self::copyFolder($sourcePath, $destinationPath)) {
                        closedir($dir);
                        return false;
                    }
                } else {
                    if (!copy($sourcePath, $destinationPath)) {
                        echo "Failed to copy file: $sourcePath\n";
                        closedir($dir);
                        return false;
                    }
                }
            }
        }

        closedir($dir);
        return true;
    }
}