


<script type="text/javascript" src="features/community/js/faq.js" ></script>
<div id="playground">

    <form>
        <p>
        <form method="GET" action="home.php">
            <input type="hidden" name="feature" value="faq">
            <input id="keywords" size="24" type="text" name="search" value="<?php if( (isset($_GET['search'])) && (trim($_GET['search'] )!= "") ) { echo $_GET['search']; }?>">
            <button type="submit" class="btn btn-primary" > <i class="glyphicon glyphicon-search"></i> Search</button>
        </form>



        <button  style="float: right;" class="btn btn-primary" data-toggle="modal" data-target="#myModal"/>Ask Question</button><br/></p>
    </form>

    <p>
        <?php
        require_once 'features/community/dbconnect.php';
        require_once 'features/community/faqdb.php';

        $db = Connect::dbConnect();
        $mylist =  new Faq($db);



        if( (isset($_GET['action'])) && ($_GET['action'] == "LIKE") && (isset($_GET['id']) != "") && (is_numeric($_GET['id'])) ) {
            $mylist->Like($_GET['id']);

        }

        if( (isset($_GET['search'])) && (trim($_GET['search'] )!= "") ) {
            $search = $_GET['search'];
        } else {
            $search = false;
        }

        $lists = $mylist->listFaq($search);

        echo "<h1>Frequently asked Questions</h1>";

        if($lists) {
            foreach($lists as $list) {

                echo "

  <div class='panelContainer'>
  <h2 id='h21' style='font-size: 26px;height:55px;width:515px;border-radius:10px;background-color:#2dc3e8;padding:12px;'>$list->question
  </h2>
  
<p class='contentBox' style='width:515px;'>$list->answer
</br>

<a href='home.php?feature=faq&action=LIKE&id=".$list->id."' class='btn btn-submit'> $list->likes <i class='glyphicon glyphicon-thumbs-up'></i> Likes </a>


</p>

</div>

  
";
            }

        } else{
            echo "No Results Found";
        }

        ?>


    </p>

</div>

<script type="text/javascript" src="features/community/js/hilitor.js"></script>
<script type="text/javascript">

    var myHilitor2;

    document.addEventListener("DOMContentLoaded", function(e) {
        myHilitor2 = new Hilitor("playground");
        myHilitor2.setMatchType("left");
    }, false);

    document.getElementById("keywords").addEventListener("keyup", function(e) {
        myHilitor2.apply(this.value);
    }, false);

</script>





<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Another Question</h4>
            </div>
            <div class="modal-body">

                <?php

                if(isset($_POST['btnsubmit'])){
                    //var_dump($_POST);
                    $user_name = $_POST['user_name'];
                    $user_email = $_POST['user_email'];
                    $question = $_POST['question'];
                    $curdate = date("Y/m/d") ;

                    require_once 'features/community/database.php';
                    $query = "INSERT INTO users_questions(user_name,user_email,question,curdate) 
                  VALUES (:user_name,:user_email,:question,:curdate)";// var values
                    $pdostmt = $db->prepare($query);
                    $pdostmt->bindValue(':user_name',$user_name, PDO::PARAM_STR);
                    $pdostmt->bindValue(':user_email',$user_email, PDO::PARAM_STR);
                    $pdostmt->bindValue(':question',$question, PDO::PARAM_STR);
                    $pdostmt->bindValue(':curdate',$curdate, PDO::PARAM_STR);
                    $row = $pdostmt->execute();
                    header("Location: home.php?feature=faq");

                    echo "ThankYou! We will email Your answer soon";
                }
                ?>

                <form method="post" action="home.php?feature=faq">
                    <table>
                        <tr>
                            <td>Name</td>
                            <td><input type="text" name="user_name" value=""/></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="user_email" value=""/></td>
                        </tr>
                        <tr>
                            <td>Question</td>
                            <td><textarea name="question" value=""></textarea></td>
                        </tr>

                        <tr>
                            <td><input class="btn btn-primary" type="submit" name="btnsubmit" value="Submit" />
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></td>
                        </tr>
                    </table>
                </form>


            </div>

        </div>
    </div>
</div>






