<?php
$templatefile = 'invoicepdf';
if (function_exists('PhoxCAVars')){
    $tplvars['templatefile'] = $templatefile ;
    $Phox = PhoxCAVars($tplvars);
}
if (isset($Phox['Phox']['pages'][$templatefile]) && file_exists($Phox['pages']['fullPath']))
    require ($Phox['Phox']['pages']['fullPath']);
else
    require ($Phox['Phox']['pages']['fullPathDefault']);
?>