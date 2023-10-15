<div class="section-wrapper add-card-wrapper">
    <div class="wrapper-head">
        {{-- <span class="title">Tambah Dokter</span> --}}
        <div class="form-input-wrapper row doctor-search-input">
            <span class="form-title">Tambah Dokter</span>
            <div class="form-items">
                <input wire:model.live='search' class="form-input-default" type="text" placeholder="cari berdasarkan ID / nama ...">
            </div>
        </div>
    </div>
    <div class="wrapper-wrap">
        @forelse ($doctors as $index=>$doctor)
            {{-- Doctor Card --}}
            <livewire:admin.components.add-doctor.add-doctor-card :key="$index.'-'.$doctor->id" :$doctor />
        
        @empty
            <span>Tidak ada dokter</span>
        @endforelse
    </div>
    <div class="pagination-wrapper">
        {{ $doctors->links() }}
    </div>
</div>