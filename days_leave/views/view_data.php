<?php
$actual_link = getActualLink();
if (isset($GLOBALS['viewData'])) {
    foreach ($GLOBALS['viewData'] as $name => $value) {
        ${$name} = $value;
    }
}