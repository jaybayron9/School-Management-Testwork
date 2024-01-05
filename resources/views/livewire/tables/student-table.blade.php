<div> 
    <h3 class="text-lg font-semibold">Students</h3>
    <table class="text-sm">
        <thead>
            <tr>
                <th class="text-xs whitespace-nowrap text-center">ID</th>
                <th class="text-xs whitespace-nowrap text-center">NAME</th>
                <th class="text-xs whitespace-nowrap text-center">EMAIL</th>
                <th class="text-xs whitespace-nowrap text-center">DOB</th>
                <th class="text-xs whitespace-nowrap text-center">CREATED AT</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td class="text-xs text-center">{{ $student->id }}</td>
                    <td class="text-xs text-center">{{ $student->name }}</td>
                    <td class="text-xs text-center">{{ $student->email }}</td>
                    <td class="text-xs text-center">{{ $student->dob }}</td>
                    <td class="text-xs text-center">{{ date('Y/m/d', strtotime($student->created_at)) }}</td> 
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 