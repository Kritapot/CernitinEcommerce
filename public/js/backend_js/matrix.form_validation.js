$(document).ready(function(){
    $('#current_pwd').keyup(function() {
        var current_pwd     =   $('#current_pwd').val();
        $.ajax({
            type:   'get',
            url:    '/admin/check-pwd',
            data:   {current_pwd : current_pwd},
            success:function(respon) {
                if(respon == "Failed") {
                    $('#password-check').html("<font color='red'>กรอกรหัสผ่านผิด กรุณากรอกใหม่</font>");
                }else if(respon == "True") {
                    $('#password-check').html("<font color='green'>รหัสผ่านถูกต้อง</font>")
                }
            },error:function(e) {
                console.log(e)
            }
        })
    });

	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();

	$('select').select2();

    // Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
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

    $("#add-category").validate({
		rules:{
			name:{
				required:true,
				name: true
			},
			description:{
				required:true,
				description: true
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

    $("#add-product").validate({
		rules:{
			name:{
				required:true,
				name: true
			},
			product_code:{
				required:true,
				product_code: true
            },
            price:{
				required:true,
				price: true
            },
            category_id:{
				required:true,
				category_id: true
            },
            image:{
				required:true,
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

    $("#edit-product").validate({
		rules:{
			name:{
				required:true,
				name: true
			},
			product_code:{
				required:true,
				product_code: true
            },
            price:{
				required:true,
				price: true
            },
            category_id:{
				required:true,
				category_id: true
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


    $("#edit-category").validate({
		rules:{
			name:{
				required:true,
				name: true
			},
			description:{
				required:true,
				description: true
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


	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
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

	$("#password_validate").validate({
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
			pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			pwd2:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#pwd"
			}
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

    $('.deleteCategory').click(function() {
        var id                  =   $(this).attr('rel');
        var deleteFunction      =   $(this).attr('rel1');

        Swal.fire({
            title: 'คุณแน่ใจที่จะลบประเภทสินค้า?',
            text: "คุณจะไม่สามารถกลับไปแก้ไขได้อีกถ้ากดปุ่มยืนยัน!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยันการลบประเภทสินค้า',
            cancelButtonText: 'ยกเลิการทำรายการ'
          }).then((result) => {
            if (result.value) {
              Swal.fire(
                'ลบประเภทสินค้า!',
                'ประเภทสินค้าถูกลบเรียบร้อยแล้ว',
                'success'
              )
              window.location.href="/admin/"+deleteFunction+"/"+id;
            }
          })
    });

    $('.deleteRecord').click(function() {
        var id                  =   $(this).attr('rel');
        var deleteFunction      =   $(this).attr('rel1');

        Swal.fire({
            title: 'คุณแน่ใจที่จะลบรายการสินค้า?',
            text: "คุณจะไม่สามารถกลับไปแก้ไขได้อีกถ้ากดปุ่มยืนยัน!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยันการลบรายการสินค้า',
            cancelButtonText: 'ยกเลิการทำรายการ'
          }).then((result) => {
            if (result.value) {
              Swal.fire(
                'ลบรายการสินค้า!',
                'รายการสินค้าถูกลบเรียบร้อยแล้ว',
                'success'
              )
              window.location.href="/admin/"+deleteFunction+"/"+id;
            }
          })

    });

});
