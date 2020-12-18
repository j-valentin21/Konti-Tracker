<div>
    <form method="POST" action="{{ route('dashboard.PTOPoints.update') }}">
        @method('PUT')
        @csrf
        <table class="table dashboard__table pr-3">
            <thead class="dashboard__table__head">
            <tr>
                {{ $table_head }}
            </tr>
            </thead>
            <tbody class="dashboard__table__body">
                {{ $table_row }}
            </tbody>
        </table>
        {{ $table_button }}
    </form>
</div>
