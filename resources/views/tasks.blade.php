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
            <h3 class="text-center mb-4">Drag and Drop Task </h3>

            <hr>
                @include('errors')

                <form method="post" action="{{ route('tasks.store') }}">
                    @csrf
                    <h4>Create a new Task</h4>
                    <input name="name" type="text" placeholder="task name">
                    <button type="submit" class="btn btn-primary">Create</button>

                </form>
            <hr>
            <table id="table" class="table table-bordered">
              <thead>
                <tr>
                  <th width="30px">#</th>
                  <th>Title</th>
                  <th>Created At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="tablecontents">
                @foreach($tasks as $task)
    	            <tr class="row1" data-id="{{ $task->id }}">
    	              <td class="pl-3"><i class="fa fa-sort"></i></td>
    	              <td>{{ $task->name }}</td>
    	              <td>{{ date('Y-m-d h:m:s',strtotime($task->updated_at)) }}</td>
                      <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline" onsubmit="alert('Are you sure you want to delete this task?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                      </td>
    	            </tr>
                @endforeach
              </tbody>
            </table>
            <hr>
            <h5>Drag and Drop the table rows and <button class="btn btn-success btn-sm" onclick="window.location.reload()">REFRESH</button> the page to check the Demo.</h5>
    	</div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <script type="text/javascript">
      $(function () {

        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer() {
          var order = [];

          var token = $('meta[name="csrf-token"]').attr('content');
          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });


          $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('update-priority') }}",
                data: {
              order: order,
              _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });
        }
      });
    </script>

@include('sweetalert::alert')

</body>
</html>
