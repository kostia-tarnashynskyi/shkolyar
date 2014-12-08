$(document).ready(function () {

//---------------------------
// show filters
$('.show-filters').click(function(){
	
	if( $(this).find('span').hasClass('glyphicon-chevron-left') ){
		$(this).find('span').removeClass('glyphicon-chevron-left').addClass('glyphicon-chevron-right');
		$(this).parent().css({'width': '430px'});
		$('.search-text').css({'left': '155px', 'width':'235px'});
		$('.search-clas').css({'display': 'block'});
		$('.search-subject').css({'display': 'block'});
	} else {
		$(this).find('span').removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-left');
		$(this).parent().css({'width': '300px'});
		$('.search-text').css({'left': '25px', 'width':'235px'});
		$('.search-clas').css({'display': 'none'});
		$('.search-subject').css({'display': 'none'});
	}
});

// $('.search').focusin(function(){
// 	$('.show-filters').click();
// });

// $('.search').focusout(function(){
// 	$('.show-filters').click();
// });

//--------------------------------------
// scroll to top page
$(window).scroll(function() {
 
	if($(this).scrollTop() != 0) {
		$('#toTop').fadeIn();
	} else {
		$('#toTop').fadeOut();
	}
});
 
$('#toTop').click(function() {
	$('body,html').animate({scrollTop:0},100);
});

//-----------------------------------------
// TODO - переделать под url

$('li.textbook').hover(function(){
	$(this).css({'background-color':'#f5f5f5', 'z-index': '10'});
	$('.textbook-table').css({'display':'block'});
}, function(){ 
	$('li.textbook').css({'background-color':'', 'z-index': '1'});
	$('.textbook-table').css({'display':'none'});
} );

$('li.gdz').hover(function(){
	$(this).css({'background-color':'#f5f5f5', 'z-index': '10'});
	$('.gdz-table').css({'display':'block'});
}, function(){ 
	$('.gdz-table').css({'display':'none'});
	$('li.gdz').css({'background-color':'', 'z-index': '1'});
} );

//--------------------------------------
// toggle view-filter
$('.view-filter').click(function(){

	var oldActiveView = $(this).siblings('.active-filter').data('view');
	var newActiveView = $(this).data('view');

	console.log(oldActiveView);
	console.log(newActiveView);


	$('.view-filter').each(function(){
		$(this).removeClass('active-filter');

		console.log($('.'+oldActiveView));

		$('.'+oldActiveView).each(function(){
			$(this).removeClass(oldActiveView).addClass(newActiveView);
		});
	});

	$(this).addClass('active-filter');
});


//-----------------------------------------------
//show detail-breadcrumbs
// $('.sim-link').click(function(){
// 	console.log('sim');
// 	$('.detail-breadcrumbs').toggleClass('show');

// 	if( $(this).find('span').hasClass('glyphicon-chevron-down') ){
// 		$(this).find('span').removeClass('glyphicon-chevron-down');
// 		$(this).find('span').addClass('glyphicon-chevron-up');
// 	} else {
// 		$(this).find('span').removeClass('glyphicon-chevron-up');
// 		$(this).find('span').addClass('glyphicon-chevron-down');
// 	}
// });




var clas = $('.clas-active').find('a').text();
var clasActive = '.clas-active-'+clas;

var author=$('.task').find('span.author').data('author');
var title=$('.task').find('span.title').data('title');

// вешаем handler на все заданияна странице
$('.task-number').each(function(i,val){
	$(val).on('click',{'numb':$(val).data('url'), 'parent':val}, getTask);
});

// on('click',{'numb':this.text()},getTask);

/**
 * загрузка аяксом картинки задания
 * @param  obj e обьект задани
 */
function getTask(e){
	// alert(e.data.numb);
	
	// console.log(e.data.parent);
	// return;
	
	// var block = $('.panzoom-parent');


	// var url = location.href;
	// if( url.indexOf('#') > -1 ){
	// 	url = url.substr(0,window.location.href.indexOf('#'));
	// }
	
	// console.log(url);
	// return;
	
	// определяем урл задания
	var fullUrl = location.href;
	if(fullUrl.indexOf('#') != -1){
		var url = fullUrl.replace(/#.*/i,'') + '/'+e.data.numb;
	} else {
		var url = location.href + '/'+e.data.numb;
	}

	// console.log(url);

	// определяем ширину блока с заданиями
	
	// console.log(task);
	
	// var book = $('.task');
	var book = $('.panzoom-parent');

	$.ajax({
	  	type: "post",
	 	url: url,
	  	data: {'mode': ''},
	  	dataType: "html",
	  	success: function(data){

	  		// добавляем хэш тег задания
	  		window.location.hash = e.data.numb;
	  		
	  		// вставляем картинку
	  		$(book).html(data);

	  		// ширина картинки
	  		var imgWidth = $(data).data('width');
	  		var imgHeight = $(data).data('height');

	  		console.log(imgWidth);
	  		console.log(imgHeight);

	  		// console.log(imgWidth);
	  		var taskW = $('.task').width();
	
	  		$('.task-title').show();
	  		$('.task-separator').show();
	  		$('#inverted-contain').show();

	  		// если картинка решения больше блока
			if( imgWidth > taskW){
				console.log('img>');

				// пропорциональное изменение размеров
				resizeImage(imgWidth,imgHeight,taskW-10);
	  			
			} else {
				console.log('img<');
				$('.task').find('img').css({'height':imgHeight+'px', 'width':imgWidth+'px'});
			}
	  		

	  		// добавляем alt   altBook+' завдання '+ e.data.numb
	  		
			// $(data).attr('alt','qqq');
	  		// $('img.task-img').attr('alt','Готові домашні завдання '+clas+' клас '+ title +' ' + author+' завдання '+ e.data.numb)
	  		// .attr('title','Готові домашні завдання '+clas+' клас '+ title +' ' + author+' завдання '+ e.data.numb);

	  		// красим в цвет класса
	  		$('.task-r').each(function(){
	  			$(this).find('.task-active').removeClass('task-active')
		  		.find('p').removeClass('bold');
	  		});
	  			
	  		
	  		$(e.data.parent)
		  		.parents('.task-one')
		  		.addClass('task-active')
		  		.find('p')
		  		.addClass('bold');

	  		var img = $('.task-img');
	  		var task = $('.task').width();

	  		if( img.data('width') < task ){
	  			img.width( img.data('width') );
	  		}


	  		// показываем заголовок задания
	  		// $('.task-title').find('span').text(e.data.numb);
	  		$('.task-title').css({'display':'block'});

			panZoomInit();
	  		// window.location.hash = 'live'; 
	  		
	  		// определяем позицию блока с решениям
	  		// var pos = $('#target-el').position();
	  		// var of = $('#target-el').offset();


	  		// console.log($('#target-el'));
	  		// console.log(pos);
	  		// console.log(of);

	  		// скролит к заданию
	  		$('body,html').animate({scrollTop:480},200);
	  		// $('.task').animate({scrollTop: 0}, 400);

	  		
	  	}
	});

	
}


/**
 * [panZoomInit description]
 * @return {[type]} [description]
 */
function panZoomInit(){
	var $section = $('#inverted-contain');
	$section.find('.panzoom').panzoom({
	  $zoomIn: $section.find(".zoom-in"),
	  $zoomOut: $section.find(".zoom-out"),
	  $zoomRange: $section.find(".zoom-range"),
	  $reset: $section.find(".reset"),
	  startTransform: 'scale(0.9)',
	  increment: 0.1,
	  minScale: 1,
	  contain: 'invert'
	}).panzoom('zoom');
}

// пропорциональное изменение картинки до указанных размеров
function resizeImage(iW,iH,width)
{
    var ratio = width / iW;

    var w = Math.ceil(iW * ratio);
    var h = Math.ceil(iH * ratio);
    $('.task').find('img').css({'height': h +'px','width': w +'px'});
}


// одинаковая высота сайдбара и контента
// resizeContentBlock();

// function resizeContentBlock(){
// 	var contHeight = $('.content').outerHeight();
// 	var sidebarHeight = $('.sidebar').outerHeight();
// 	if(contHeight < sidebarHeight){
// 		$('.content').height(sidebarHeight);
// 	}
// }


//ротатор баннера адсенса
function rotate(){
	setInterval( function(){
		var src = $('.big_adsance').attr('src');
		if(src.indexOf('banner') != -1){
			$('.big_adsance').attr('src', '/images/big.jpeg');
		} else {
			$('.big_adsance').attr('src', '/images/banner.png');
		}
	}, 10000 );
}

rotate();


// модальное окно лайков фб
$('#fb-modal').modal('show');




});