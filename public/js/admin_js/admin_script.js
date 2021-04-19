$(document).ready(function(){
    //check Admin Password is Correct Or Not
    $("#current_pwd").keyup(function(){
        var current_pwd = $("#current_pwd").val();
        //alert(current_pwd);
        $.ajax({
            type:'post',
            url:'/admin/check-current-pwd',
            data:{current_pwd:current_pwd},
            success:function(resp){
                /* alert(resp); */
                if(resp=="false"){
                    $("#chkCurrentPwd").html("<font color=red> Current Password Is incurrect</font>");
                }else if(resp=="true"){
                    $("#chkCurrentPwd").html("<font color=green> Current Password Is currect</font>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
});