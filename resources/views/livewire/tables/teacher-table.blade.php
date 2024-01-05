<div> 
    <h3 class="text-lg font-semibold">Teachers</h3>
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
            @foreach ($teachers as $teacher)
                <tr>
                    <td class="text-xs text-center">{{ $teacher->id }}</td>
                    <td class="text-xs text-center">{{ $teacher->name }}</td>
                    <td class="text-xs text-center">{{ $teacher->email }}</td>
                    <td class="text-xs text-center">{{ $teacher->dob }}</td>
                    <td class="text-xs text-center">{{ date('Y/m/d', strtotime($teacher->created_at)) }}</td> 
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 