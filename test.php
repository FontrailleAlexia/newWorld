<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="jquery.steps.min.js"></script>
<script type="text/javascript" src="jquery.steps.js"></script>
<link rel="stylesheet" href="/vendor/jquery.steps/css/jquery.steps.css">
<script src="/vendor/jquery.steps/js/jquery.steps.min.js"></script>
 
<style type="text/css">
    h3{
        display : inline-block ;
        position : relative;
        vertical-align : top ;
        width : 120px ;
        height : 50px ;
        background : white ;
        border-radius : 10px ;
        text-align : center ;
        line-height : 50px;
        cursor:  pointer ;
    }
        h3:hover{opacity: 0.6 ;}
         
    section{
        display : block ;
        position : absolute ;
        padding : 15px ;
        width : 550px ;
        height : 300px ;
        background : silver ;
        border : 1px solid black ;
        border-radius : 5px;
    }
    #profileForm .content {min-height: 100px;}
    #profileForm .content > .body {
      width: 100%;
      height: auto;
      padding: 15px;
      position: relative;
    }
    .wizard .content {
    min-height: 100px;
}
.wizard .content > .body {
    width: 100%;
    height: auto;
    padding: 15px;
    position: relative;
}
</style>
 
<form id="profileForm" method="post" class="form-horizontal" action="#"> <!-- remplace # par la page php que tu veux appeler -->
    <div style="position:relative;left:100px;">
        <h3 style="background:#81DAF5;">Titre 1</h3>  
        <section data-step="0">
        <div class="form-group">
            <label class="col-xs-3 control-label">Username</label>
            <div class="col-xs-5">
                <input type="text" class="form-control" name="username" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-3 control-label">Email</label>
            <div class="col-xs-5">
                <input type="text" class="form-control" name="email" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-3 control-label">Password</label>
            <div class="col-xs-5">
                <input type="password" class="form-control" name="password" />
            </div>
        </div>
        <div class="form-group">
         <label class="col-xs-3 control-label">Retype password</label>
          <div class="col-xs-5">
          <input type="password" class="form-control" name="confirmPassword" />
        </div>
    </div>
        </section>
        <h3>Titre 2</h3>
        <section data-step="1">
        <div class="form-group">
            <label class="col-xs-3 control-label">Full name</label>

            <div class="col-xs-4">
                <input type="text" class="form-control" name="firstName" placeholder="First name" />
            </div>

            <div class="col-xs-4">
                <input type="text" class="form-control" name="lastName" placeholder="Last name" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Gender</label>
            <div class="col-xs-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" value="male" /> Male
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" value="female" /> Female
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" value="other" /> Other
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Birthday</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="dob" placeholder="YYYY/MM/DD" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Bio</label>
            <div class="col-xs-9">
                <textarea rows="5" class="form-control" name="bio"></textarea>
            </div>
        </div>
        </section>
</form>
<div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Welcome</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Thanks for signing up</p>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(function($){
        $h3 = $('h3') ;
        $section = $('section') ;
        $zIndex = '4' ;
        $h3.on('click' , function(){ 
            $zIndex ++ ; 
            $h3.css('background','white');
            $(this).css('background','#81DAF5');
            $index = $h3.index(this);
            $('section:eq('+$index+')').css('zIndex', $zIndex);
            return $zIndex ;
        });
    });
</script>
<script>
$(document).ready(function() {
    function adjustIframeHeight() {
        var $body   = $('body'),
            $iframe = $body.data('iframe.fv');
        if ($iframe) {
            // Adjust the height of iframe
            $iframe.height($body.height());
        }
    }

    // IMPORTANT: You must call .steps() before calling .formValidation()
    $('#profileForm')
        .steps({
            headerTag: 'h2',
            bodyTag: 'section',
            onStepChanged: function(e, currentIndex, priorIndex) {
                // You don't need to care about it
                // It is for the specific demo
                adjustIframeHeight();
            },
            // Triggered when clicking the Previous/Next buttons
            onStepChanging: function(e, currentIndex, newIndex) {
                var fv         = $('#profileForm').data('formValidation'), // FormValidation instance
                    // The current step container
                    $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

                // Validate the container
                fv.validateContainer($container);

                var isValidStep = fv.isValidContainer($container);
                if (isValidStep === false || isValidStep === null) {
                    // Do not jump to the next step
                    return false;
                }

                return true;
            },
            // Triggered when clicking the Finish button
            onFinishing: function(e, currentIndex) {
                var fv         = $('#profileForm').data('formValidation'),
                    $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

                // Validate the last step container
                fv.validateContainer($container);

                var isValidStep = fv.isValidContainer($container);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }

                return true;
            },
            onFinished: function(e, currentIndex) {
                // Uncomment the following line to submit the form using the defaultSubmit() method
                // $('#profileForm').formValidation('defaultSubmit');

                // For testing purpose
                $('#welcomeModal').modal();
            }
        })
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            // This option will not ignore invisible fields which belong to inactive panels
            excluded: ':disabled',
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: 'The username is required'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The username must be more than 6 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'The username can only consist of alphabetical, number, dot and underscore'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        },
                        different: {
                            field: 'username',
                            message: 'The password cannot be the same as username'
                        }
                    }
                },
                confirmPassword: {
                    validators: {
                        notEmpty: {
                            message: 'The confirm password is required'
                        },
                        identical: {
                            field: 'password',
                            message: 'The confirm password must be the same as original one'
                        }
                    }
                },
                firstName: {
                    row: '.col-xs-4',
                    validators: {
                        notEmpty: {
                            message: 'The first name is required'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z\s]+$/,
                            message: 'The first name can only consist of alphabetical and space'
                        }
                    }
                },
                lastName: {
                    row: '.col-xs-4',
                    validators: {
                        notEmpty: {
                            message: 'The last name is required'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z\s]+$/,
                            message: 'The last name can only consist of alphabetical and space'
                        }
                    }
                },
                gender: {
                    validators: {
                        notEmpty: {
                            message: 'The gender is required'
                        }
                    }
                },
                dob: {
                    validators: {
                        notEmpty: {
                            message: 'The birthday is required'
                        },
                        date: {
                            format: 'YYYY/MM/DD',
                            message: 'The birthday is not valid'
                        }
                    }
                },
                bio: {
                    validators: {
                        stringLength: {
                            max: 200,
                            message: 'The bio must be less than 200 characters'
                        }
                    }
                }
            }
        });
});
</script>