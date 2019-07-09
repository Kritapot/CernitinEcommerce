/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};

/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
    });

});

$(document).ready(function(){
    $('#select-size').change(function() {
        var size   = $(this).val();
        $.ajax({
            type:   'get',
            url:    '/get-product-size',
            data:   {size:size},
            success:function(respon) {
                var array   =   respon.split("#")
                $('#get-price').html("THB "+array[0]);
                $('#price-change').val(array[0]);
                if(array[1] == 0) {
                    $('#cartButton').hide();
                    $('#avibility').html('<h1 style="color: red;">ขออภัยสินค้าหมด stock</h1>');
                }else {
                    $('#cartButton').show();
                    $('#avibility').html('<h4 style="color: green;">สินค้าใน stock : </h4>'+array[1])
                }
            },error:function(e) {
                console.log(e)
            }
        })
    });

});

$(document).ready(function(){
    $('#ex1').zoom();
    $('#ex2').zoom({ on:'grab' });
    $('#ex3').zoom({ on:'click' });
    $('#ex4').zoom({ on:'toggle' });
});



$(document).ready(function(){
    $("#login-form").validate({
		rules:{
			name:{
				required: true,
                minlength:2,
                accept:"[a-zA-Z]+"
			},
			password:{
				required:true,
				minlength:6
			},
			email:{
				required:true,
                email:true,
                remote: '/check-email'
			}
        },
        messages:{
            name:{
                required:"กรุณากรอกชื่อของคุณ",
                minlength:"ชื่อต้องมีความยาวมากกว่า 2 ตัวอักษรขึ้นไป!",
                accept:"ชื่อของคุณจะต้องเป็นตัวอักษรเท่านั้น !"
            },
            password:{
                required:"กรุณากรอกรหัสผ่าน",
                minlength:"รหัสผ่านของคุณจะต้องมีความยาวไม่น้อยกว่า 6 ตัวอักษรขึ้นไป!",

			},
			email:{
                required:"กรุณากรอกอีเมล์ของคุณ",
                email:"Plese enter valid Email",
                remote: "ขออภัยอีเมล์นี้มีผู้ใช้งานแล้ว"
			}

        }
    });
});

