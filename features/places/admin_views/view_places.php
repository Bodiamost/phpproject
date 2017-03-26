<div class="box">
	<h1 class="box-header">Places</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Approved</th>
            <th>Verified</th>
            <th>Uploaded</th>
            <th></th>
            <th></th>
        </tr>
        <?php $counter = 0; foreach ($places as $place) {?>
        <tr>
            <td>
                <a href='admin.php?feature=places&action=editplace&id=<?php echo($place->getId());?>'><?php echo(  $place->getTitle());?></a><br/>
            </td>
            <td>
                <?php echo $place->getApproved() ? "Yes":"No";?>
            </td>
            <td>
                <?php echo $place->getVerified()? "Yes":"No";?>
            </td>
            <td>
                <?php echo $place->getPosted();?>
            </td>
            <td>
                <a href='admin.php?feature=places&action=editplace&id=<?php echo($place->getId());?>'>Edit</a>
            </td>
            <td>
                <a href='admin.php?feature=places&action=deleteplace&id=<?php echo($place->getId());?>'>Delete</a>
            </td>       
        </tr>
        <?php };?>
    </table>
    <div class="box-footer">
        <a href="admin.php?feature=places&action=addplace">Add new place</a>
    </div>
</div>