/**
 * Created by Sharanjeet Kaur on 2017-04-17.
 */

$( document ).ready(function() {





    $(".add").click(function(){
        var text = $(this).prev().val();
        var pid=$(this).next().html();
        var parent = $(this).parent().next();
        $.post('features/posts/addComments.php',{uid:12,psid:pid,cmnt:text},function (output) {
            parent.slideDown('slow').prepend("<div>" +
                                "<img src='features/log_signup/images/"+output['pic']+"'style='float:left;height:45px;width:45px'/><a href='#'>"+output['uname']+"</a><div style='background-color:lightcyan;'>"+output['cm']+"</div></div>"+"<br/> <hr/>").hide().fadeIn('slow');
        });
        //return false;
        //alert(pid);








    });


    /*var pid=$(".add").next().html();
    console.log(pid);
    var parent = $(".add").parent().next();
    $.post('getCmt.php',{psid:pid},function (output) {
        console.log(output);
        $.each(output,function (index,data) {
            //parent.prepend(data.cmnt+"<br/> <hr/><br/>").hide().fadeIn('slow');
            console.log(data.cmnt);
        });

    });*/


});