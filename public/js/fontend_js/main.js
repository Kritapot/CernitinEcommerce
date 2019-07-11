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
			}

        }
    });

    $("#accountForm").validate({
		rules:{
			name:{
				required: true,
                minlength:2,
                accept:"[a-zA-Z]+"
			},
        },
        messages:{
            name:{
                required:"กรุณากรอกชื่อของคุณ",
                minlength:"ชื่อต้องมีความยาวมากกว่า 2 ตัวอักษรขึ้นไป!",
                accept:"ชื่อของคุณจะต้องเป็นตัวอักษรเท่านั้น !"
            },
        }
    });


    $("#login-form-user").validate({
		rules:{
            email:{
				required:true,
                email:true,
			},
			password:{
				required:true,
			},
        },
        messages:{
            email:{
                required:"กรุณากรอกอีเมล์ของคุณ",
                email:"Plese enter valid Email",
			},

            password:{
                required:"กรุณากรอกรหัสผ่าน",
			},
        }
    });


    $('#myPassword').passtrength({
        minChars: 4,
        passwordToggle: true,
        tooltip: true,
        eyeImg: '/images/fontend_images/eye.svg'
    });


    $('#current-pwd').keyup(function () {
        var currentPwd      =   $(this).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/check-user-pwd',
            data: {currentPwd:currentPwd},
            success:function(respon) {
                console.log(respon)
                if(respon == "False")
                {
                    $('#check-current-pwd').html("<font color = 'red'>รหัสผ่านไม่ถูกต้อง</font>")
                }else if(respon == "True") {
                    $('#check-current-pwd').html("<font color = 'green'>รหัสผ่านถูกต้อง</font>")
                }
            },
            error:function(e) {
                console.log('Eror:', e)
            }
        })
    });

    $("#passwordForm").validate({
		rules:{
            current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
            new_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
            confirm_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
    });


    $('#copy-address').change(function() {
        if(this.checked)
        {
            $('#ship_name').val($('#billing_name').val());
            $('#ship_address').val($('#billing_address').val());
            $('#ship_city').val($('#billing_city').val());
            $('#ship_state').val($('#billing_state').val());
            $('#ship_country').val($('#billing_country').val());
            $('#ship_pincode').val($('#billing_pincode').val());
            $('#ship_mobile').val($('#billing_mobile').val());

        }else {
            $('#ship_name').val("");
            $('#ship_address').val("");
            $('#ship_city').val("");
            $('#ship_state').val("");
            $('#ship_country').val("");
            $('#ship_pincode').val("");
            $('#ship_mobile').val("");
        }
    })

    $('#select-playment-method').on('click', function() {
        if($('#paypal').is(':checked') || $('#direct').is(':checked')) {
            console.log("checked")
        }else {
            alert("กรุณาเลือกวิธีการชำระเงิน")
            return false;
        }
    });



});

