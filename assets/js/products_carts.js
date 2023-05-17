/* JS Document */

/******************************

[Table of Contents]

1. Vars and Inits
2. Set Header
3. Init Menu
4. Init Thumbnail
5. Init Quantity
6. Init QuantityCart
7.Add cart
8. Init Star Rating
9. Init Favorite
10. Init Tabs



******************************/

jQuery(document).ready(function($)
{
	"use strict";

	/* 

	1. Vars and Inits

	*/

	var hamburger = $('.hamburger_container');
	var menu = $('.hamburger_menu');
	var menuActive = false;
	var hamburgerClose = $('.hamburger_close');
	var fsOverlay = $('.fs_menu_overlay');

	initMenu();
	initThumbnail();
	initQuantity();
	initStarRating();
	initFavorite();
	initTabs();
	initQuantityCart();
	addCart();

	
	
	/* 

	3. Init Menu

	*/

	function initMenu()
	{
		if(hamburger.length)
		{
			hamburger.on('click', function()
			{
				if(!menuActive)
				{
					openMenu();
				}
			});
		}

		if(fsOverlay.length)
		{
			fsOverlay.on('click', function()
			{
				if(menuActive)
				{
					closeMenu();
				}
			});
		}

		if(hamburgerClose.length)
		{
			hamburgerClose.on('click', function()
			{
				if(menuActive)
				{
					closeMenu();
				}
			});
		}

		if($('.menu_item').length)
		{
			var items = document.getElementsByClassName('menu_item');
			var i;

			for(i = 0; i < items.length; i++)
			{
				if(items[i].classList.contains("has-children"))
				{
					items[i].onclick = function()
					{
						this.classList.toggle("active");
						var panel = this.children[1];
					    if(panel.style.maxHeight)
					    {
					    	panel.style.maxHeight = null;
					    }
					    else
					    {
					    	panel.style.maxHeight = panel.scrollHeight + "px";
					    }
					}
				}	
			}
		}
	}

	function openMenu()
	{
		menu.addClass('active');
		// menu.css('right', "0");
		fsOverlay.css('pointer-events', "auto");
		menuActive = true;
	}

	function closeMenu()
	{
		menu.removeClass('active');
		fsOverlay.css('pointer-events', "none");
		menuActive = false;
	}

	/* 

	4. Init Thumbnail

	*/
	
	function initThumbnail()
	{
		if($('.product_color ul li').length)
		{
			
			var thumbs = $('.product_color ul li');
			var element = $('.product_color ul li')[0];
			element.classList.add("active");
			var id = document.getElementsByClassName("active")[1].id;
			var quantity = document.getElementById(id).getAttribute('data-myValue');
			thumbs.each(function()
			{
				var item = $(this);
				item.on('click', function()
				{
					thumbs.removeClass('active');
					item.addClass('active');
					var id = document.getElementsByClassName("active")[1].id;
					quantity = document.getElementById(id).getAttribute('data-myValue');
					if(quantity==0) document.getElementById("err-quantity").innerHTML = "* Hết hàng";else
					{
						document.getElementById("err-quantity").innerHTML = "";
						document.getElementById("quantity_value").innerText=1;
					} 
					var txt_quantity = document.getElementById("quantity_value").innerText;
					if(txt_quantity>quantity) document.getElementById("quantity_value").innerHTML = quantity;
				});
			});
		}	
	}

	/* 

	5. Init Quantity

	*/

	function initQuantity()
	{
		if($('.plus').length && $('.minus').length)
		{
			var plus = $('.plus');
			var minus = $('.minus');
			var value = $('#quantity_value');
			if(document.getElementsByClassName("active")[1]!=null){
				
				plus.on('click', function()
				{
					var x = parseInt(value.text());
					var id = document.getElementsByClassName("active")[1].id;
					if(document.getElementById(id)!=null){
						var quantity = document.getElementById(id).getAttribute('data-myValue');
					}
					if(x<quantity){
						value.text(x + 1);
					}
					if(x==quantity){
						$('.plus').add('disable');
					}
				});

				minus.on('click', function()
				{
					var x = parseInt(value.text());
					if(x > 1)
					{
						value.text(x - 1);
					}
				});
			}
			
		}
	}

	/* 

	6. Init Quantity

	*/

	function initQuantityCart()
	{
		if($('.plus').length && $('.minus').length)
		{
			var plus = $('.plus');
			var minus = $('.minus');
			var value = $('#quantity_value_cart');
			for(var i=0;i<plus.length;i++){
				plus.on('click', function()
				{
					if(plus=='plus_'+i){
						value=$('#quantity_value_cart_'+i);
					}
					var x = parseInt(value.text());
					value.text(x + 1);
				});
				
				minus.on('click', function()
				{
					var x = parseInt(value.text());
					if(x > 1)
					{
						value.text(x - 1);
					}
				});
			}
			
			
		}
	}
	/* 

	7. Add cart

	*/
	function addCart(){
		if($('#add_to_cart').length){
			var add_btn=$('#add_to_cart');
			add_btn.on('click', function()
			{
				var type_id = document.getElementsByClassName("active")[1].id;
				var x=document.getElementById("quantity_value").innerText;
				var href='index.php?controller=carts&action=createCartPost&type_id='+type_id+'&quantity='+x;
				if(x==0) href="#";
				document.getElementById("add_to_cart").setAttribute("href", href); 
			});
		}
	}
	/* 

	8. Init Star Rating

	*/

	function initStarRating()
	{
		if($('.user_star_rating li').length)
		{
			var stars = $('.user_star_rating li');

			stars.each(function()
			{
				var star = $(this);

				star.on('click', function()
				{
					var i = star.index();

					stars.find('i').each(function()
					{
						$(this).removeClass('fa-star');
						$(this).addClass('fa-star-o');
					});
					for(var x = 0; x <= i; x++)
					{
						$(stars[x]).find('i').removeClass('fa-star-o');
						$(stars[x]).find('i').addClass('fa-star');
					};
				});
			});
		}
	}

	/* 

	9. Init Favorite

	*/

	function initFavorite()
	{
		if($('.product_favorite').length)
		{
			var fav = $('.product_favorite');

			fav.on('click', function()
			{
				fav.toggleClass('active');
			});
		}
	}

	/* 

	10. Init Tabs

	*/

	function initTabs()
	{
		if($('.tabs').length)
		{
			var tabs = $('.tabs li');
			var tabContainers = $('.tab_container');

			tabs.each(function()
			{
				var tab = $(this);
				var tab_id = tab.data('active-tab');

				tab.on('click', function()
				{
					if(!tab.hasClass('active'))
					{
						tabs.removeClass('active');
						tabContainers.removeClass('active');
						tab.addClass('active');
						$('#' + tab_id).addClass('active');
					}
				});
			});
		}
	}				
});