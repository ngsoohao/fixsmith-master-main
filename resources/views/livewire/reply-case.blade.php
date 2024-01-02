<div class="flex h-screen">
    <div class="mr-5 border-r-2 w-1/7 border-slate-400">
        @include("nav.side-nav")
    </div>
    <div class="flex-grow w-6/7">
        <h1 class="text-xl font-bold">Manage Cases</h1>
        <table class="min-w-full ">
            <thead>
                <tr>
                    <th class="p-4 m-2 text-white border border-gray-300 bg-slate-700">Case ID</th>
                    <th class="p-4 m-2 text-white border border-gray-300 bg-slate-700">Title</th>
                    <th class="p-4 m-2 text-white border border-gray-300 bg-slate-700">Status</th>
                    <th class="p-4 m-2 text-white border border-gray-300 bg-slate-700">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($cases)
                    @foreach ($cases as $case)
                        <tr class="text-center">
                            <td class="border border-slate-600">{{ $case->caseID }}</td>
                            <td class="border border-slate-600">{{ $case->title }}</td>
                            <td class="border border-slate-600">{{ $case->status }}</td>
                            <td class="border border-slate-600">
                                <button class="p-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" onclick="toggleCaseDetails({{ $case->caseID }})">Details</button>
                            </td>
                        </tr>
                        <tr id="caseDetails{{ $case->caseID }}" style="display: none;">
                            <td colspan="4">
                                <strong>Description:</strong> {{ $case->description }}<br>
                                <strong>Feedback:</strong> {{ $case->feedback }}<br>
                                <textarea class="w-full"wire:model.defer="feedback.{{ $case->caseID }}"></textarea>
                                <button class="p-2 py-2 mt-3 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click='updateCase({{ $case->caseID }})'>Send Feedback</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<script>
    function toggleCaseDetails(caseID) {
        var caseDetails = document.getElementById('caseDetails' + caseID);
        caseDetails.style.display = (caseDetails.style.display === 'none' || caseDetails.style.display === '') ? 'table-row' : 'none';
    }
</script>
