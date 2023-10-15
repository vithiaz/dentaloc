<div class="doctor-card">
    <div class="image-container">
        <img src="{{ asset('storage/'.$image) }}" alt="{{ $name }}-profile">
    </div>
    <div class="details-wrapper">
        <div class="col-wrapper">
            <span class="id">{{ $id }}</span>
            <span class="name">{{ $name }}</span>
        </div>
        <div class="col-wrapper">
            <span class="time-placeholder">jam praktek</span>
            <span class="time-content">{{ $timeStart }} - {{ $timeEnd }}</span>
        </div>
    </div>
</div>