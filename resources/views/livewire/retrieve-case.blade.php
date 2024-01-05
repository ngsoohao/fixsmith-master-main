
<div class="text-center">
    @if ($cases)
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="p-4 m-2 text-white border border-gray-300 bg-slate-600">Category</th>
                <th class="p-4 m-2 text-white border border-gray-300 bg-slate-600">Case Name</th>
                <th class="p-4 m-2 text-white border border-gray-300 bg-slate-600">Case Number</th>
                <th class="p-4 m-2 text-white border border-gray-300 bg-slate-600">Feedback</th>
                <th class="p-4 m-2 text-white border border-gray-300 bg-slate-600">Description</th>
                <th class="p-4 m-2 text-white border border-gray-300 bg-slate-600">Status</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($cases as $case)
                <tr class="border border-slate-600 ">
                    <td class="border border-slate-600">{{ $case->category }}</td>
                    <td class="max-w-xs break-words">{{ $case->title }}</td>
                    <td class="border border-slate-600" >{{ $case->caseID }}</td>
                    <td class="border border-slate-600" >{{ $case->feedback }}</td>
                    <td class="max-w-xs break-words border border-slate-600">{{ $case->description }}</td>
                    <td class="border border-slate-600">{{ $case->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p class="">No case found.</p> 
    @endif
</div>


