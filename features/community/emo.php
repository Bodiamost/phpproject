<?php
function Smilify(&$subject)
{
$smilies = array(
':|'  => 'mellow',
':-|' => 'mellow',
':-o' => 'ohmy',
':-O' => 'ohmy',
':o'  => 'ohmy',
':O'  => 'ohmy',
';)'  => 'wink',
';-)' => 'wink',
':p'  => 'tongue',
':-p' => 'tongue',
':P'  => 'tongue',
':-P' => 'tongue',
':D'  => 'biggrin',
':-D' => 'biggrin',
'8)'  => 'cool',
'8-)' => 'cool',
':)'  => 'smile',
':-)' => 'smile',
':('  => 'sad',
':-(' => 'sad',
);

$sizes = array(
'biggrin' => 18,
'cool' => 20,
'haha' => 20,
'mellow' => 20,
'ohmy' => 20,
'sad' => 20,
'smile' => 18,
'tongue' => 20,
'wink' => 20,
);

$replace = array();
foreach ($smilies as $smiley => $imgName)
{
$size = $sizes[$imgName];
array_push($replace, '<img src="uploads/'.$imgName.'.gif" alt="'.$smiley.'" width="'.$size.'" height="'.$size.'" />');
}
$subject = str_replace(array_keys($smilies), $replace, $subject);
}
echo "$size[biggrin]";
?>