<div class="doctor-card">

    <div class="image-container">
        <img src="{{ asset('storage/'.$doctor->image) }}" alt="">
    </div>
    <div class="details-container">
        <div class="name-wrapper">
            {{-- <span class="sip">SIP</span> --}}
            <span class="name">{{ $doctor->name }}</span>
        </div>
        <div class="hours-wrapper">
            <span class="label">ID</span>
            <span class="hours">{{ $doctor->id }}</span>
        </div>
    </div>
    <div class="form-container">
        <div class="form-input-wrapper">
            <span class="form-title">Mulai Praktek</span>
            <div class="form-items">
                <input wire:model='start_hours' class="form-input-default @error('start_hours') error @enderror" type="time">
            </div>
        </div>
        <div class="form-input-wrapper">
            <span class="form-title">Selesai Praktek</span>
            <div class="form-items">
                <input wire:model='end_hours' class="form-input-default @error('end_hours') error @enderror" type="time">
            </div>
        </div>
        <div class="button-container">
            <button wire:click='add_doctors' class="btn submit-button hovered">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah</span>
            </button>    
        </div>
    </div>
    {{-- <div class="button-container">
        <button class="btn delete-btn hovered">
            <i class="fa-solid fa-trash"></i>
            <span>Hapus</span>
        </button>
    </div> --}}
</div>