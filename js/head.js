$(document).ready(function(){
    $(document).on('click','.daohang',function(){
       triggNav();
    });
    $(document).on('click','#search-button',function(){
        window.location.href='controller.php?getList=1&name='+$('#key-word').val();
    });

});
var triggNav=function(){
    if('none'==$('.head_nav').css('display')){
        $('.head_nav').css('display','block');
    }else{
        $('.head_nav').css('display','none');
    }

}