<div class="box">
	<h1 class="box-header">Restaurants</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Approved</th>
            <th>Verified</th>
            <th>Uploaded</th>
            <th></th>
            <th></th>
        </tr>
        <?php $counter = 0; foreach ($cafes as $cafe) {?>
        <tr>
            <td>
                <a href='admin.php?feature=cafes&action=editcafe&id=<?php echo($cafe->getId());?>'><?php echo(  $cafe->getTitle());?></a><br/>
            </td>
            <td>
                <?php echo $cafe->getApproved() ? "Yes":"No";?>
            </td>
            <td>
                <?php echo $cafe->getVerified()? "Yes":"No";?>
            </td>
            <td>
                <?php echo $cafe->getPosted();?>
            </td>
            <td>
                <a href='admin.php?feature=cafes&action=editcafe&id=<?php echo($cafe->getId());?>'>Edit</a>
            </td>
            <td>
                <a href='admin.php?feature=cafes&action=deletecafe&id=<?php echo($cafe->getId());?>'>Delete</a>
            </td>       
        </tr>
        <?php };?>
    </table>
    <div class="box-footer">
        <a href="admin.php?feature=cafes&action=addcafe">Add new cafe</a>
    </div>
</div>