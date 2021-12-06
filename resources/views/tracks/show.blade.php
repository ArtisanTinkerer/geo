<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<body>

<br>

<div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading">Welcome to Tracks</div>
        <div class="panel-body">

            {{$track->name}}

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Lat</th>
                    <th scope="col">Long</th>
                    <th scope="col">Elev</th>
                </tr>
                </thead>
                <tbody>

                {{$track->points[0]}}

                {{--@foreach ($track->points as $point)
                    <tr>
                        <td>{{$point->position}}</td>
                        <td>{{$point->position}}</td>
                        <td>{{$point->position}}</td>


                    </tr>

                @endforeach--}}

                </tbody>
            </table>




        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>
