$(document).ready(function () {
  loadDialedNumbers();
  var trigger = $('.hamburger'),
     isClosed = true;

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {
      if (isClosed == true) {    
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
        loadDialedNumbers();
      }
  }
  
  function loadDialedNumbers(){
      $.ajax({
        type     : 'GET',
        url      : 'api/getLastDialedNumbers',
        dataType : "json",
        beforeSend:function(){

        },
        success:function(response){
            $("#div_dialed_number").empty();
            $.each(response, function(key){
                $("#div_dialed_number").append('<a href="#">');
                $("#div_dialed_number").append('<div class="media-body">');
                $("#div_dialed_number").append('<div class="col-md-3">');
                $("#div_dialed_number").append('<img class="media-object img-circle" src="http://mysunrisetravel.com/wp-content/uploads/2015/07/placeholder-profile-male.jpg" style="width: 50px;height:50px;">');
                $("#div_dialed_number").append('</div>');
                $("#div_dialed_number").append('<div class="col-md-9">');
                $("#div_dialed_number").append('<h4 class="pull-left" style="margin-top:0px">'+response[key].number+'</h4><br>');
                $("#div_dialed_number").append('<h5 class="text-left"><span class="glyphicon glyphicon-earphone" style="color:#04ff00"></span><strong>&nbsp;&nbsp; Call</strong></h5>');
                $("#div_dialed_number").append('</div>');
                $("#div_dialed_number").append('</div>');
                $("#div_dialed_number").append('</a>');
            });
        },
        error:function(){

        }
    });
  }
  
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });  


  $("div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
  
});