<div class="content-body doctor-list-page">
    <div class="container">
        <div class="page-title">
            <h1>Daftar Dokter</h1>
        </div>

        <div class="page-content-card">
            <div class="doctor-card-wrapper">
                @foreach ($doctors as $doctor)
                    <x-admin-doctor-card :key='$doctor->id' :doctor='$doctor' />
                @endforeach
            </div>
            <div class="pagination-wrapper">
                {{ $doctors->links() }}
            </div>
        </div>

    </div>
</div>
