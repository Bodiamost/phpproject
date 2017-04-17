foreach($dinos as $dino){

echo "<li><a href='listdino.php?id=". $dino->id . "' >" . $dino->name . "</a>
    <form action=\"deletedino.php\" method=\"post\">
        <input type=\"hidden\" value='" . $dino->id ."' name=\"id\">
        <input type=\"submit\" value=\"Delete\" name=\"delete\">
    </form>
</li>";

}
