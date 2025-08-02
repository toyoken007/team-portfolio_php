
// window.onload = function () {
// 	let head = document.getElementsByClassName('header')[0].offsetHeight;
// 	let hp_main = document.getElementsByTagName('main')[0];


// 	// if( location.pathname === "/reserve/") {
// 	hp_main.style.marginTop = head + 'px';
// 	// }
// }

// ハンバーガーメニュー

$(function () {
	console.log('ハンバーガーメニューのスクリプトが読み込まれました。');
	
	const ham = $('#js_hamburger');
	const nav = $('#js_nav');
	const li = $(".nav li");


	ham.on('click', function () { //ハンバーガーメニューをクリックしたら
		ham.toggleClass('active'); // ハンバーガーメニューにactiveクラスを付け外し
		nav.toggleClass('active'); // ナビゲーションメニューにactiveクラスを付け外
		if (ham.hasClass('active') && nav.hasClass('active')) {
			$('body').addClass('scroll_non')
		} else {
			$('body').removeClass('scroll_non')
		}
	});
	li.on('click', function () { //ハンバーガーメニューをクリックしたら
		ham.toggleClass('active'); // ハンバーガーメニューにactiveクラスを付け外し
		nav.toggleClass('active'); // ナビゲーションメニューにactiveクラスを付け外
		$('body').toggleClass('scroll_non')
	});
});