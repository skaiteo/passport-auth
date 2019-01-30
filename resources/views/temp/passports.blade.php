<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Passports</title>
</head>
<body>
    <style>
        h2 {
            text-align: center;
            margin-top: 10px;
        }

        .uper {
            margin-top: 40px;
        }
        
        thead, td {
            border: 1px solid;
            padding: 1px 7px 1px 7px;
        }

        table {
            margin-left: 5px;
        }
    </style>
    <h2>Passports</h2>
    <div class="uper">
        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>FirstName</td>
                    <td>LastName</td>
                    <td>Passport No</td>
                    <td>Country</td>
                    <td>DOB</td>
                    <td>Gender</td>
                    <td>Expiry Date</td>
                    <td>Created At</td>
                    <td>Updated At</td>
                </tr>
            </thead>
            <tbody>
                @foreach($passports as $passport)
                <tr>
                    <td>{{$passport->id}}</td>
                    <td>{{$passport->firstname}}</td>
                    <td>{{$passport->lastname}}</td>
                    <td>{{$passport->passport_num}}</td>
                    <td>{{$passport->country}}</td>
                    <td>{{$passport->d_o_b}}</td>
                    <td>{{$passport->gender}}</td>
                    <td>{{$passport->expiry_date}}</td>
                    <td>{{$passport->created_at}}</td>
                    <td>{{$passport->updated_at}}</td>
                    <td>
                    <form action="{{ '/passports/' . $passport->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>