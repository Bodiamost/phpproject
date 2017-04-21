<?php 
//$action='view';
if(isset($_GET['action']))
{
  $action=filter_input(INPUT_GET, 'action');
} 
if ($_GET['action']==='view')
{
  require_once 'dispalbm.php';
}
else if ($_GET['action']==='upload')
{
    require_once 'upload.php';
}
else if ($_GET['action']==='pics')
{
    require_once 'dispics.php';
}
else if ($_GET['action']==='amadd')
{
    require_once 'album.php';
}
else echo "Content not found";
?>
