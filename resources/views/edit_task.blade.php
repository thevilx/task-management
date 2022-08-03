<html>
<head>
    <title>Create Drag and Droppable Datatables Using jQuery UI Sortable in Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body>
    <div class="row mt-5">
        <div class="col-md-10 offset-md-1">
            <h3 class="text-center mb-4">Edit Task</h3>

            @include('errors')

            <form method="post" action="{{ route('tasks.update' , $task->id) }}">
                @csrf
                @method('PUT')

                <input name="name" value="{{ old('name') ?? $task->name }}">

                <button type="submit" class="btn btn-primary">Update</button>
            </form>

    	</div>
    </div>

</body>
</html>
