<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Announcements</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-notify@3.1.3/bootstrap-notify.min.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .table-bordered {
            text-align: center
        }

        .table-bordered thead {
            font-size: 20px;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight">Sign in to your account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
{{--        <form id="loginForm" name="loginForm">--}}
            <div class="form-group">
                <div>
                    <label for="email" class="block text-sm/6 font-medium">Email address</label>
                    <div class="mt-2">
                        <input
                            type="text"
                            class="form-control w-100 rounded text-black border-secondary mb-2"
                            placeholder="input your email"
                            id="email" name="email"
                        />
                    </div>
                </div>

                <div style="margin-top: 5px">
                    <lable>Password</lable>
                    <div class="mt-2" >
                        <input
                            type="password"
                            class="form-control w-100 rounded text-black border-secondary mb-2"
                            placeholder="input your password"
                            id="password" name="password"
                        />
                    </div>
                </div>

                <div>
                    <button type="submit"
                            onclick="processLogin()"
                            class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Sign in
                    </button>
                </div>
            </div>
{{--        </form>--}}
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <table class="col-md-12 table-bordered">
            <thead>
            <td style="text-align: center">Email</td>
            <td style="text-align: center">Password</td>
            </thead>
            <tr>
                <td> testCustomer_1@example.com</td>
                <td>password</td>
            </tr>
            <tr>
                <td>testCustomer_2@example.com</td>
                <td>password</td>
            </tr>
        </table>

    </div>

</div>

</body>

<script>
    function processLogin() {
        console.log("Hello World");
        var email = $('#email').val();
        var password = $('#password').val();

        var url = '{{route('login')}}';
        $.ajax({
            url:url,
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                'email':email,
                'password':password
            },
            success: function (data) {
                if(data.status == 200){
                    $.notify({
                        icon: 'fas fa-check',
                        title: 'Success',
                        message: 'Login successful'
                    },{
                        type: 'success',
                        delay: 500
                    });
                    window.location.href = data.url;

                }else{
                    $.notify('Login failed, please try again.', {type:'danger'});
                    $("#email").val('');
                    $("#password").val('');

                }
            }
        });




    }
</script>

</html>
