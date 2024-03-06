$(document).ready(function() {
    $("#addPostForm" ).validate({
		rules: {
			title: {
				required: true,
				noSpace: true,
				rangelength:[3,30],
			},
			description: {
				required: true,
				rangelength:[3,50],
				noSpace: true,
			},
		},

		messages:
		{
			title: {
				required: "Title is required",
                rangelength: "Please enter a title between 3 and 30 characters long.",
			},
			description: {
				required: "Description is required",
                rangelength: "Please enter a description between 3 and 50 characters long.",

			},
		},
        submitHandler: function (form) {
            $('#addPostForm button[type="submit"]').attr(
                "disabled",
                true
            );
            form.submit();
        }
	});
    $('#add_post').on('hidden.bs.modal', function () {
        $("label.error").hide();
        $(".error").removeClass("error");
    });
    $( "#editPostForm" ).validate({
		rules: {
			title: {
				required: true,
				noSpace: true,
				rangelength:[3,30],
			},
			description: {
				required: true,
				noSpace: true,
				rangelength:[3,50],
			},
		},

		messages:
		{
			title: {
				required: "Title is required",
                rangelength: "Please enter a title between 3 and 30 characters long.",
			},
			description: {
				required: "Description is required",
                rangelength: "Please enter a description between 3 and 50 characters long.",

			},
		},
        submitHandler: function (form) {
            $('#editPostForm button[type="submit"]').attr(
                "disabled",
                true
            );
            form.submit();
        }
	});
    $( "#addCommentForm" ).validate({
		rules: {
			comment: {
				required: true,
				rangelength:[3,100],
				noSpace: true,
			},
		},
		messages:
		{
			comment: {
				required: "Comment is required",
                rangelength: "Please enter a comment between 3 and 100 characters long.",
			},
		},
        submitHandler: function (form) {
            $('#addCommentForm button[type="submit"]').attr(
                "disabled",
                true
            );
            form.submit();
        }
	});
    $(".comment-form").each(function () {
        $(this).validate({
            rules: {
                comment: {
                    required: true,
				    rangelength:[3,100],
                }
            },
            messages: {
                comment: {
                    required: "Comment reply is required",
                    rangelength: "Please enter a name between 3 and 100 characters long.",
                }
            },
            submitHandler: function (form) {
                $('.comment-form button[type="submit"]').attr(
                    "disabled",
                    true
                );
                form.submit();
            }
        });
    });
    
    $.validator.addMethod("noSpace", function(value, element) {
        return value.trim() !== "";
    }, "Spaces are not allowed");

    if ($('.alert-message').length > 0) {
        setTimeout(function() {
            $('.alert-message').fadeOut('slow');
        }, 3000);
    }
    $("#login_form").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required: "Please enter email",
                email: "Please enter valid email	"
            },
            password: {
                required: "Please enter password"
            }
        },
        submitHandler: function(form) {
            $('#login_form button[type="submit"]').attr("disabled", true);
            form.submit();
        }
    });
    $("#signup_form").validate({
        rules: {
            name: {
                required: true,
                noSpace: true,
            },
            email: {
                required: true,
                noSpace: true,
                email: true,
            },
            password: {
                required: true,
                noSpace: true,
                minlength: 8,
            },
            password_confirmation: {
                required: true,
                noSpace: true,
                equalTo: "#password"
            }
        },
        messages: {
            name: {
                required: "Please enter name",
            },
            email: {
                required: "Please enter email",
                email:"Please enter valid email"
            },
            password: {
                required: "Please enter password",
            },
            password_confirmation: {
                required: "Please enter confirm password",
                equalTo: "Confirm assword does not match with password"
            }
        },
        submitHandler: function(form) {
            $('#signup_form button[type="submit"]').attr("disabled", true);
            form.submit();
        }
    });
});