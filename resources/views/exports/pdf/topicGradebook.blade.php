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
    }

    th,td {
        padding: 0 10px;
    }
</style>

<div>
    <h3>Curso: {{ $topic->course->name  }} </h3>
    <div><strong>Grupo: </strong>{{ $topic->course->group->name }}</div>
    <div><strong>Cuadro de notas modulo: </strong>{{ $topic->name  }}</div>
    <hr>
</div>

<div>
    <table>
        <thead>
            <tr>
                <th>Alumno</th>
                @foreach($activities as $activity)
                    <th width="200">
                        {{ $activity->name }} pts. {{ $activity->score }}
                    </th>
                @endforeach
                <th width="75">
                    Total
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                @foreach($activities as $activity)
                    <td>
                        {{ $student->activityScore($activity->id) }} / {{ $activity->score }}
                    </td>
                @endforeach
                <td>
                 {{ $student->scoreTopic($topic->id) }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
