$(function(){
    $('#chooseDeviceTab a').click(function (e) {
      e.preventDefault()
      $(this).tab('show');
      $('#tab-process a').removeClass('active');
      $(this).addClass('active');
    });

    $('#cart-drop .btn-cart').on('click',function(e){
    	e.preventDefault();
    	var parent = $(this).parents('#cart-drop');
    	if(parent.hasClass('show')){
    		parent.removeClass('show');
    	}
    	else{
    		parent.addClass('show');
    	}
    });

    $(".banner, section").on('click', function() {
        if ($('#cart-drop').hasClass('show')) {
            $('#cart-drop').removeClass('show');
        }

    });

    $('#cart-drop-mobile .btn-cart').on('click',function(e){
      e.preventDefault();
      var parent = $(this).parents('#cart-drop-mobile');
      if(parent.hasClass('show')){
        parent.removeClass('show');
        $('body').removeClass('no-scrollbar');
      }
      else{
        parent.addClass('show');
        $('body').addClass('no-scrollbar');
      }
    });

    $('.close-drop-con').on('click',function(e){
        e.preventDefault();
        $('#cart-drop-mobile .btn-cart').trigger('click');
    });

    var accordionOne    = $('#accordionOne');
    var accordionTwo    = $('#accordionTwo');
    var accordionThree  = $('#accordionThree');

    //Accordion One Logic
    accordionOne.on('hidden.bs.collapse', function () {
        onExpand(this);
    });

    accordionOne.on('shown.bs.collapse', function () {
        onCollapse(this);
    });

    //Accordion Two Logic
    accordionTwo.on('hidden.bs.collapse', function () {
        onExpand(this);
    });

    accordionTwo.on('shown.bs.collapse', function () {
        onCollapse(this);
    });

    //Accordion Three Logic
    accordionThree.on('hidden.bs.collapse', function () {
        onExpand(this);
    });

    accordionThree.on('shown.bs.collapse', function () {
        onCollapse(this);
    });



    function onExpand(e)
    {
        var collapseItem = $(e).find('a.collapsed');
        var panelTitle = collapseItem.parent('.panel-title');
        var panelTitle_ul = panelTitle.find('ul');
        var caret = panelTitle_ul.find('.fa-caret-down');
        caret.removeClass('fa-caret-down').addClass('fa-caret-right');
    }

    function onCollapse(e)
    {
        var collapseItem = $(e).find('a:not(.collapsed)');

        var panelTitle = collapseItem.parent('.panel-title');
        var panelTitle_ul = panelTitle.find('ul');
        var caret = panelTitle_ul.find('.fa-caret-right');
        caret.removeClass('fa-caret-right').addClass('fa-caret-down');
    }

    $('.checkout-section .customer-info-edit').on('click', function(e){
        e.preventDefault();
        var panelTitle = $(this).parents('.panel-title');
        var trigger = panelTitle.find('.collapse-trigger');
        var panel = $(this).parents('.panel');

        if( trigger.hasClass('collapsed') ) {
          trigger.trigger('click');
        }

        panel.find('.panel-body').addClass('editable');

    });

    $('.checkout-section').on('click', '.caret-btn', function(e){
        e.preventDefault();
        var panelTitle = $(this).parents('.panel-title');
        var trigger = panelTitle.find('.collapse-trigger');
        trigger.trigger('click');
    });

    // $('#exampleRadios1').on('change', function(e){
    //     if($(this).is(':checked')){
    //         $('.sim-selection').addClass('d-none');
    //     }
    // });
    $('#exampleRadios1').on('change', function(e){
        if($(this).is(':checked')){
            $('.sim-selection').removeClass('d-none');
        }
    });

    $('#exampleRadios2').on('change', function(e){
        if($(this).is(':checked')){
            $('.sim-selection').removeClass('d-none');
        }
    });

    $('.imageClicker').on('click', '.clicker', function(e){
        e.preventDefault();
        var $parent = $(this).parents('.imageClicker');
        var $previewHolder = $parent.find('.preview .img-wrap');
        var $dataImg = $(this).data('img');
        $parent.find('.active').removeClass('active');
        $(this).parents('li').addClass('active');
        $previewHolder.find('img').attr('src',$dataImg);
    });

    $('.usageHistory .close').on('click', function(e){
        e.preventDefault();
        $('.usageHistory').css('display','none');
    });

});
