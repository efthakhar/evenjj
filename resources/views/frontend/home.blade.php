<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('common/css/bootstrap.css') }}">
</head>

<body>
    <div class="px-2 py-3">
        <section class="search-form-container container justify-content-center">
            <a href="/register" class="btn btn-dark">Register</a>
            <form action="" class="row flex-wrap mt-3  align-items-center">
                <div class="col-md-3 p-1">
                    <input type="text" name="title" class="form-control form-control-sm" placeholder="event name..">
                </div>
                <div class="col-md-3 p-1">
                    <select name="event_category_id" id="category" class="form-control form-control-sm">
                        <option value="">select category</option>
                        @foreach ($categories as $c)
                        <option value="{{$c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-sm btn-primary">Apply Filter</button>
                </div>
            </form>
        </section>
        <section class="container">
            <div class="row mt-3 align-items-center">
                <div class="col-md-6">
                    @foreach ($events as $e)
                    <div class="py-2">
                        <div class="border rounded shadow-sm  p-3">
                            <h2 class="h5"> {{ $e->title }}</h2>
                            <button class="reserve btn btn-sm btn-secondary" data-event-id={{ $e->id }}>reserve</button>
                        </div>
                    </div>
                    @endforeach
                    <div class="pagination-container">
                        {{ $events->links() }}
                    </div>
                </div>
            </div>
        </section>

    </div>
    <script src="{{ asset('common/js/jquery.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $(document).on("click", ".reserve", (e) => {
            let id = e.target.getAttribute('data-event-id')
            console.log(id)
            let url = window.location.origin + `/admin/events/reserve/${id}`;
            $.ajax({
                url: url,
                type: "POST",
                success: function(data) {
                    e.target.innerHTML = 'reserved';
                    e.target.classList.add('btn-success')
                },
                error: function(data){
                    console.log(data.status)
                    if(data.status==401){
                        alert('To Reserve Event Register First')
                    }
                }
            });
        });
    </script>
</body>

</html>