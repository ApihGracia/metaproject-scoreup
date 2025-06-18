<div>
    <h2 class="text-xl font-bold mb-2">Match Results</h2>

    <table class="table-auto border-collapse w-full">
        <thead>
            <tr>
                <th class="border p-2">Match</th>
                <th class="border p-2">Team A Score</th>
                <th class="border p-2">Team B Score</th>
                <th class="border p-2">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
                <tr>
                    <td class="border p-2">{{ $result->match_name }}</td>
                    <td class="border p-2">{{ $result->team_a_score }}</td>
                    <td class="border p-2">{{ $result->team_b_score }}</td>
                    <td class="border p-2">{{ $result->created_at->format('d M Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
