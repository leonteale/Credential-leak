<?php

$command = "ps aux | grep '/home/leon/.local/bin/h8mail' | grep -v grep";
$output = shell_exec($command);

if (trim($output) != "") {
    preg_match('/-t ([^\s]+)/', $output, $matches);
    $domain = $matches[1];
    echo "Search currently in progress for $domain";
} else {
    echo "Program free for wildcard search. Search <a href='javascript:void(0);' onclick='toggleSearch()'>here</a>";
}

?>