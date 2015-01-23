<?php

require (__DIR__ . '/Rule.class.php');
class Rewrite {
    private $_rules = array();
    private $_configDir;
    private $_configFileList = array();

    public function __construct($configDir) {
        $this->_configDir = $configDir;
    }

    public function addConfigFile($subpath) {
        array_push($this->_configFileList, $subpath);
    }

    public function addRule($type, $reg, $value) {
        array_push($this->_rules, new Rule($type, $reg, $value));
    }

    private function _parse() {
        foreach ($this->_configFileList as $subpath) {
            $file = $this->_configDir . '/' . $subpath;
            $realpath = realpath($file);
            Log::getLogger()->info('Rewrite config filepath: %s realpath: %s', $file, $realpath);
            if ($realpath) {
                $content = file_get_contents($realpath);
                $splitArr = explode("\n", $content);
                foreach($splitArr as $idx => $line) {
                    $line = trim($line);
                    if ($line === '') {
                        continue;
                    }
                    if ($line[0] === '#') {
                        Log::getLogger()->info('Rewrite._parse #%s is comment, content: %s', $idx + 1, $line);
                        continue;
                    }
                    Log::getLogger()->info('Rewrite._parse #%s, content: %s', $idx + 1, $line);
                    $ok = preg_match('/#.*$/', $line, $match); 
                    if ($ok) {
                        Log::getLogger()->info('Rewrite._parse earse comment: %s', $match[0]);
                        $line = preg_replace('/#.*$/', '', $line);
                    }
                    $splitLineArr = preg_split('/\s+/', $line);
                    $this->addRule($splitLineArr[0], '/' . $splitLineArr[1] . '/', $splitLineArr[2]);
                }
            }
        }
    }

    public function run($strUrl) {
        $url = $strUrl;
        if (isset($_SERVER['REQUIRE_URI'])) {
            $url = $_SERVER['REQUIRE_URI'];
        }
        $this->_parse();
        foreach ($this->_rules as $rule) {
            if ($rule->match($url)) {
                $target = $rule->fill($url);
                if ($rule->type === Rule::REWRITE) {
                    require(WWW_ROOT . '/' . $target);
                    exit();
                } else if ($rule->type === Rule::REDIRECT) {
                    header('Location: ' . $target);
                    exit();
                } else if ($rule->type === Rule::RENDER) {
                    //@TODO
                }
                break;
            }
        }
    }
}
