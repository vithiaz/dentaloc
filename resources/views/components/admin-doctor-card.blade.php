<div class="doctor-card">
    <div class="image-container">
        <img src="{{ asset('storage/'.$doctor->image) }}" alt="">
    </div>
    <div class="details-wrapper">
        <div class="col-wrapper">
            <span class="id">{{ $doctor->id }}</span>
            <span class="name">{{ $doctor->name }}</span>
        </div>
        <div class="col-wrapper">
            <a href="{{ route('admin.edit-doctor', ['doctor' => $doctor]) }}" class="href-button">
                <button class="btn edit-button ico">
                    <i class="fa-solid fa-pen"></i>
                    <span>Edit</span>
                </button>
            </a>

        </div>
    </div>
</div>