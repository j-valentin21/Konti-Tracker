<div>
    <table class="table dashboard__table">
        <thead class="dashboard__table__head">
        <tr>
            {{ $table_head }}
        </tr>
        </thead>
        <tbody class="dashboard__table__body">
            {{ $slot }}
        </tbody>
    </table>
    <div class="text-center">
        <button type="submit" class="form__wizard__btn form__wizard__btn--orange mt-4">Update</button>
    </div>
</div>
