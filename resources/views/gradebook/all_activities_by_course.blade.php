<style>
    table{
        width: 100%;
        font-size: 12px;
    }

    table, th, td {
        border: 1px solid black;
        text-align: center
    }

    th {
        background: #2a4365;
        color: #fff;
        word-wrap: break-word;
        width:50px;
    }

    th,td {
        padding: 0 10px;
    }

    img{
        width: 150px;
    }
</style>


<div>
    <img src="https://i2.wp.com/www.udeoberistain.edu.gt/wp-content/uploads/2020/11/1.png" alt="">
    <h3>{{ $course->name }} - {{ $course->group->name }}</h3>
</div>

<div>
    <table>
        <thead>
            <tr>
                <th>Alumno</th>
                @foreach($activities as $activity)
                    <th>{{ $activity->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($course->students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    @foreach($activities as $activity)
                        <td>{{ $student->activityScore($activity->id) }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div style="width:100%;
    text-align: center;
    margin-top: 100px;">
    ______________________________________ <br>
    <strong>Nombre y firma de Catedratico:</strong>
</div>