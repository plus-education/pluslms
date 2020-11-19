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
                <th>
                    {{ $activity->name }} pts. {{ $activity->score }}
                </th>
            @endforeach
            <th>
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
                        {{ $student->activityScore($activity->id) }}
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
