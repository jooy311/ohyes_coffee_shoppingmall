
(function($){

    $.fn.floatBanner = function(options) {
        options = $.extend({}, $.fn.floatBanner.defaults , options);

        return this.each(function() {
            var aPosition = $(this).position();
            var jbOffset = $(this).offset();
            var node = this;

            $(window).scroll(function() {
                var _top = $(document).scrollTop();
                _top = (aPosition.top < _top) ? _top : aPosition.top;

                setTimeout(function () {
                    var newinit = $(document).scrollTop();

                    if ( newinit > jbOffset.top ) {
                        _top -= jbOffset.top;
                        var container_height = $("#wrap").height();
                        var quick_height = $(node).height();
                        var cul = container_height - quick_height;
                        if(_top > cul){
                            _top = cul;
                        }
                    }else {
                        _top = 0;
                    }

                    $(node).stop().animate({top: _top}, options.animate);
                }, options.delay);
            });
        });
    };

    $.fn.floatBanner.defaults = {
        'animate'  : 500,
        'delay'    : 500
    };

})(jQuery);

/**
 * 臾몄꽌 援щ룞�썑 �떆�옉
 */
$(document).ready(function(){
    $('#banner:visible, #quick:visible').floatBanner();

    //placeholder
    $(".ePlaceholder input, .ePlaceholder textarea").each(function(i){
        var placeholderName = $(this).parents().attr('title');
        $(this).attr("placeholder", placeholderName);
    });
    /* placeholder ie8, ie9 */
    $.fn.extend({
        placeholder : function() {
            //IE 8 踰꾩쟾�뿉�뒗 hasPlaceholderSupport() 媛믪씠 false瑜� 由ы꽩
           if (hasPlaceholderSupport() === true) {
                return this;
            }
            //hasPlaceholderSupport() 媛믪씠 false �씪 寃쎌슦 �븘�옒 肄붾뱶瑜� �떎�뻾
            return this.each(function(){
                var findThis = $(this);
                var sPlaceholder = findThis.attr('placeholder');
                if ( ! sPlaceholder) {
                   return;
                }
                findThis.wrap('<label class="ePlaceholder" />');
                var sDisplayPlaceHolder = $(this).val() ? ' style="display:none;"' : '';
                findThis.before('<span' + sDisplayPlaceHolder + '>' + sPlaceholder + '</span>');
                this.onpropertychange = function(e){
                    e = event || e;
                    if (e.propertyName == 'value') {
                        $(this).trigger('focusout');
                    }
                };
                //怨듯넻 class
                var agent = navigator.userAgent.toLowerCase();
                if (agent.indexOf("msie") != -1) {
                    $(".ePlaceholder").css({"position":"relative"});
                    $(".ePlaceholder span").css({"position":"absolute", "padding":"0 4px", "color":"#878787"});
                    $(".ePlaceholder label").css({"padding":"0"});
                }
            });
        }
    });

    $(':input[placeholder]').placeholder(); //placeholder() �븿�닔瑜� �샇異�

    //�겢由��븯硫� placeholder �닲源�
    $('body').delegate('.ePlaceholder span', 'click', function(){
        $(this).hide();
    });

    //input李� �룷而ㅼ뒪 �씤 �씪�븣 placeholder �닲源�
    $('body').delegate('.ePlaceholder :input', 'focusin', function(){
        $(this).prev('span').hide();
    });

    //input李� �룷而ㅼ뒪 �븘�썐 �씪�븣 value 媛� true �씠硫� �닲源�, false �씠硫� 蹂댁뿬吏�
    $('body').delegate('.ePlaceholder :input', 'focusout', function(){
        if (this.value) {
            $(this).prev('span').hide();
        } else {
            $(this).prev('span').show();
        }
    });

    //input�뿉 placeholder媛� 吏��썝�씠 �릺硫� true瑜� �븞�릺硫� false瑜� 由ы꽩媛믪쑝濡� �뜕�졇以�
    function hasPlaceholderSupport() {
        if ('placeholder' in document.createElement('input')) {
            return true;
        } else {
            return false;
        }
    }
});

/**
 *  �뜽�꽕�씪 �씠誘몄� �뿊諛뺤씪寃쎌슦 湲곕낯媛� �꽕�젙
 */
$(window).load(function() {
    $("img.thumb,img.ThumbImage,img.BigImage").each(function($i,$item){
        var $img = new Image();
        $img.onerror = function () {
                $item.src="//img.echosting.cafe24.com/thumb/img_product_big.gif";
        }
        $img.src = this.src;
    });
});
//window popup script
function winPop(url) {
    window.open(url, "popup", "width=300,height=300,left=10,top=10,resizable=no,scrollbars=no");
}
/**
 * document.location.href split
 * return array Param
 */
function getQueryString(sKey)
{
    var sQueryString = document.location.search.substring(1);
    var aParam       = {};

    if (sQueryString) {
        var aFields = sQueryString.split("&");
        var aField  = [];
        for (var i=0; i<aFields.length; i++) {
            aField = aFields[i].split('=');
            aParam[aField[0]] = aField[1];
        }
    }

    aParam.page = aParam.page ? aParam.page : 1;
    return sKey ? aParam[sKey] : aParam;
};

$(document).ready(function(){
    // tab
    $.eTab = function(ul){
        $(ul).find('a').click(function(){
            var _li = $(this).parent('li').addClass('selected').siblings().removeClass('selected'),
                _target = $(this).attr('href'),
                _siblings = '.' + $(_target).attr('class');
            $(_target).show().siblings(_siblings).hide();
            return false
        });
    }
    if ( window.call_eTab ) {
        call_eTab();
    };
});
(function($){
$.fn.extend({
    center: function() {
        this.each(function() {
            var
                $this = $(this),
                $w = $(window);
            $this.css({
                position: "absolute",
                top: ~~(($w.height() - $this.outerHeight()) / 2) + $w.scrollTop() + "px",
                left: ~~(($w.width() - $this.outerWidth()) / 2) + $w.scrollLeft() + "px"
            });
        });
        return this;
    }
});
$(function() {
    var $container = function(){/*
<div id="modalContainer">
    <iframe id="modalContent" scroll="0" scrolling="no" frameBorder="0"></iframe>
</div>');
*/}.toString().slice(14,-3);
    $('body')
    .append($('<div id="modalBackpanel"></div>'))
    .append($($container));
    function closeModal () {
        $('#modalContainer').hide();
        $('#modalBackpanel').hide();
    }
    $('#modalBackpanel').click(closeModal);
    zoom = function ($piProductNo, $piCategoryNo, $piDisplayGroup) {
        var $url = '/product/image_zoom.html?product_no=' + $piProductNo + '&cate_no=' + $piCategoryNo + '&display_group=' + $piDisplayGroup;
        $('#modalContent').attr('src', $url);
        $('#modalContent').bind("load",function(){
            $(".header .close",this.contentWindow.document.body).bind("click", closeModal);
        });
        $('#modalBackpanel').css({width:$("body").width(),height:$("body").height(),opacity:.4}).show();
        $('#modalContainer').center().show();
    }
});
})(jQuery);
/**
 * 移댄뀒怨좊━ 留덉슦�뒪 �삤踰� �씠誘몄�
 * 移댄뀒怨좊━ �꽌釉� 硫붾돱 異쒕젰
 */

$(document).ready(function(){    
        
    var methods = {
        aCategory    : [],
        aSubCategory : {},

        get: function()
        {
             $.ajax({
                url : '/exec/front/Product/SubCategory',
                dataType: 'json',
                success: function(aData) {
                    var topMenuList = [];   
                    if (aData == null || aData == 'undefined') return;
                    var count = 0;
                    for (var i=0; i<aData.length; i++)
                    {
                        var sParentCateNo = aData[i].parent_cate_no;
                        if(sParentCateNo === 1){
                           topMenuList.push(aData[i] );
                        }
                        if (!methods.aSubCategory[sParentCateNo]) {
                            methods.aSubCategory[sParentCateNo] = [];
                        }
                        methods.aSubCategory[sParentCateNo].push( aData[i] );
                        count++;
                    }
                    if(count === aData.length){                        
                        var categoryHtml = [];                        
                        subCategoryList = methods.aSubCategory;
                        for(var i=0; i<topMenuList.length; i++){
                            var item = topMenuList[i];
                            if(subCategoryList[item.cate_no]){
                                var sbuCategoryHtml = '';
                                $(subCategoryList[item.cate_no]).each(function(index) {     
                                    var subItem = '<a href="'+this.link_product_list+'">'+this.name+'</a>';
                                    sbuCategoryHtml = sbuCategoryHtml + subItem;
                                    if(index+1 == subCategoryList[item.cate_no].length){
                                       var itemHtml =
                                            '<ul>' +
                                            '<li>' +
                                            '<h2><a href="'+item.link_product_list+'">'+item.name+'</a></h2>' +
                                            '<div><span>'+sbuCategoryHtml+'</span></div>' +
                                            '</li>' +
                                            '</ul>';
                                        categoryHtml.push(itemHtml);   
                                    }
                                });
                            }else{
                                var itemHtml = '<ul><li><h2><a href="'+item.link_product_list+'">'+item.name+'</a></h2></li></ul>';
                                categoryHtml.push(itemHtml);  
                            }                                                     
                        }         
                        var result = $('<div class="result-cate"></div>').append(categoryHtml.join(''));   
                        var allCategory = $('<div class="all-sub-category"></div>').append(result);         
                        
                        var getImg = $( "#allCategoryImg" ).html();
                        if(getImg){
                            allCategory.append(getImg);
                        }
                        $('#allCategory').append(allCategory);                        
                        $('.all-sub-category').hide();
                        
                    }
                }
            });
        },

        getParam: function(sUrl, sKey) {

            var aUrl         = sUrl.split('?');
            var sQueryString = aUrl[1];
            var aParam       = {};

            if (sQueryString) {
                var aFields = sQueryString.split("&");
                var aField  = [];
                for (var i=0; i<aFields.length; i++) {
                    aField = aFields[i].split('=');
                    aParam[aField[0]] = aField[1];
                }
            }
            return sKey ? aParam[sKey] : aParam;
        },

        getParamSeo: function(sUrl) {
            var aUrl         = sUrl.split('/');
            return aUrl[3] ? aUrl[3] : null;
        },

        show: function(overNode, iCateNo) {
            
           //if (methods.aSubCategory[iCateNo].length == 0) {
           //    return;
           //}         

            var aHtml = [];
            aHtml.push('<ul>');
            $(methods.aSubCategory[iCateNo]).each(function() {
                aHtml.push('<li><a href="'+this.link_product_list+'">'+this.name+'</a></li>');                
            });
            aHtml.push('</ul>');  
            
            var getEle = $( "#cate"+iCateNo ).html();                                                    
            if(getEle){
                aHtml.push(getEle);
            } 
            
            var offset = $(overNode).offset();
            
            var div = $('<div class="sub-category"></div>');
            if (!methods.aSubCategory[iCateNo]) {                
                div = $('<div class="sub-category none"></div>');
            }
                div.appendTo(overNode)
                .html(aHtml.join(''))
                .find('li').mouseover(function(e) {
                    $(this).addClass('over');
                }).mouseout(function(e) {
                    $(this).removeClass('over');
                });
        },

        close: function() {
            $('.sub-category').remove();
        }        
    };

    methods.get();
    
    $('li#allCategory').mouseenter(function(e) {        
        $('.all-sub-category').show();        
     }).mouseleave(function(e) {        
        $('.all-sub-category').hide();
     });
    
    $('.xans-layout-category li').mouseenter(function(e) {
        var $this = $(this).addClass('on'),
        iCateNo = Number(methods.getParam($this.find('a').attr('href'), 'cate_no'));

        if (!iCateNo) {
            iCateNo = Number(methods.getParamSeo($this.find('a').attr('href')));
        }

        if (!iCateNo) {
           return;
        }

        methods.show($this, iCateNo);
     }).mouseleave(function(e) {
        $(this).removeClass('on');

          methods.close();
     });
});
$(window).scroll(function() {
    if ($(this).scrollTop() > 110){  
        $('.main-header #allStoreHeader').addClass("sticky");
        $('#allStore_nav').addClass("sticky");
        $('body').addClass("paddingTopCss");
    }
    else{
        $('.main-header #allStoreHeader').removeClass("sticky");
        $('#allStore_nav').removeClass("sticky");
        $('body').removeClass("paddingTopCss");
    }
});
//goto top
    $('.allStore-goToTop').click(function(event) {
    event.preventDefault();
    $('html, body').animate({
        scrollTop: $("body").offset().top
    }, 500);
});	

