<div class="box">
	<h1 class="box-header">Events</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Approved</th>
            <th>Verified</th>
            <th>Uploaded</th>
            <th></th>
            <th></th>
        </tr>
        <?php $counter = 0; foreach ($events as $event) {?>
        <tr>
            <td>
                <a href='admin.php?feature=events&action=editevent&id=<?php echo($event->getId());?>'><?php echo(  $event->getTitle());?></a><br/>
            </td>
            <td>
                <?php echo $event->getApproved() ? "Yes":"No";?>
            </td>
            <td>
                <?php echo $event->getVerified()? "Yes":"No";?>
            </td>
            <td>
                <?php echo $event->getPosted();?>
            </td>
            <td>
                <a href='admin.php?feature=events&action=editevent&id=<?php echo($event->getId());?>'>Edit</a>
            </td>
            <td>
                <a href='admin.php?feature=events&action=deleteevent&id=<?php echo($event->getId());?>'>Delete</a>
            </td>       
        </tr>
        <?php };?>
    </table>
    <div class="box-footer">
        <a href="admin.php?feature=events&action=addevent">Add new event</a>
    </div>
</div>