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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="bg-gray-100">
<div class="container">
    <div class="flex">
        <label class="flex justify-center items-center pl-2">{{\Illuminate\Support\Facades\Auth::user()->name}}</label>
        <div class="flex-auto text-end">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded"
                    style="padding: 10px;margin: 10px" onclick="logout()">
                Logout
            </button>

        </div>
    </div>
    <hr class="mb-2"/>

    <div class="row">
        <div class="form-group mb-0 col-md-3">
            <label class='f-14 text-dark-grey' for="customers">Customers</label>
            <select name="customer_selected" id="customer_selected" class="form-control select-picker" data-size="8">
                <option value="">--</option>
                @foreach($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-0 col-md-3">
            <label class='f-14 text-dark-grey' for="customers">Announcements</label>
            <select name="announcement_selected" id="announcement_selected" class="form-control select-picker"
                    data-size="8">
                <option value="">--</option>

                @foreach($announcementList as $item)
                    <option value="{{$item->id}}">{{$item->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-0 col-md-3 align-middle">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded"
                    style="padding: 10px;margin: 10px" onclick="submitReadAnnouncement()">
                Submit
            </button>
        </div>
    </div>

    <div class="card" style="margin-top: 10px">
        <div class="card-header">Announcement List</div>
        <div class="card-body">
            @foreach($announcements as $key=>$item)

                <div class="flex border-b last:border-b-0 p-5 hover:bg-gray-50 transition">

                    <div class="w-20 pr-4" style="text-align: center;  align-content: center">
                        <p class="text-lg font-big text-gray-600">{{ $item->id }}</p>
                    </div>

                    <div class="relative mr-4">
                        <div class="w-px bg-gray-300 h-full"></div>
                    </div>

                    <div class="w-20 text-right pr-4">
                        <p class="text-xs text-gray-400">Today</p>
                        <p class="text-sm font-medium text-gray-600">{{ $item->created_at->format('H:i') }}</p>
                    </div>

                    <div class="relative mr-4">
                        <div class="w-px bg-gray-300 h-full"></div>
                    </div>

                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800">
                            {{ $item->title }}
                        </h3>
                        <p class="text-gray-500 text-sm mt-1 line-clamp-2">
                            {{ $item->description }}
                        </p>
                    </div>

                    @if(is_null($item->read_at))
                        <div class="ml-3">
                            <span class="w-2 h-2 bg-blue-500 rounded-full inline-block"></span>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
    </div>

</div>

</body>

<script>
    function logout() {
        $.ajax({
            url: '{{route('logout')}}',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            type: "POST",
            success: function (data) {
                $.notify({
                    icon: 'fas fa-check',
                    title: 'Success',
                    message: 'Logout Successful'
                }, {
                    type: 'success',
                    delay: 500
                });
                window.location.href = data.url;
            }
        })
    }

    function submitReadAnnouncement() {
        var customer = $("#customer_selected").val();
        var annoucment = $("#announcement_selected").val();
        console.log(customer);
        console.log(annoucment);
        if (!customer || !annoucment) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please select customer and announcement to submit",
            });
        } else {
            var url = "{{route('announcements.update',':id')}}";
            url = url.replace(":id", annoucment);
            console.log(url);
            $.ajax({
                url: url,
                type:"PUT",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'customer_id': customer,
                    'announcement_id': annoucment
                },
                success: function (data) {
                    if(data.status == 200){
                        $.notify({
                            title: 'Success',
                            message: 'Update successful'
                        }, {
                            type: 'success',
                            delay: 500
                        });
                        window.setTimeout(refreshPage , 500);
                    }
                }
            });
        }
    }

    function refreshPage(){
        location.reload();
    }
</script>
</html>
