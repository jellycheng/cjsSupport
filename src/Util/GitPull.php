<?php
namespace CjsSupport\Util;

class GitPull {

    public function GitPullCode($dir) {
        $dirs = $this->getGitDirList($dir);
        foreach ($dirs as $subDir) {
            $cmd = <<<EOT
cd $subDir && pwd;
git pull;
EOT;
            echo $this->popenExec($cmd . PHP_EOL) . PHP_EOL;
        }
    }


    public function GitCheckoutAndPullCode($dir) {
        $dirs = $this->getGitDirList($dir);
        foreach ($dirs as $subDir) {
            $cmd = <<<EOT
cd $subDir && pwd;
git checkout -- . ;
git pull;
EOT;
            echo $this->popenExec($cmd . PHP_EOL) . PHP_EOL;
        }
    }

    //只返回所有一级目录
    public function getGitDirList($dir) {
        $ret = [];
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if($file == "." || $file == "..") {
                        continue;
                    }
                    $tmpDir = rtrim($dir, '/') . '/' . $file;
                    if(is_dir($tmpDir) && is_dir($tmpDir . '/.git')) {
                        $ret[] = $tmpDir;
                    }
                }
                closedir($dh);
            }
        }
        return $ret;
    }


    public function popenExec($cmd, $mode = 'r') {
        $content = '';
        if($cmd) {
            $handle = popen($cmd, $mode);
            while (!feof($handle)) {
                $content .= fread($handle, 2096);
            }
            pclose($handle);
        }
        return $content;
    }

}

