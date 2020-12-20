<div>
    <form method="POST" action="{{ route('dashboard.PTOPoints.update') }}">
        @method('PUT')
        @csrf
        <table class="table dashboard__table pr-3">
            {{ $table_head }}
            <tr>
                {{ $table_row }}
            </tr>
            </thead>
            <tbody class="dashboard__table__body">
                {{ $table_body }}
            </tbody>
        </table>
        {{ $table_button }}
    </form>
</div>
