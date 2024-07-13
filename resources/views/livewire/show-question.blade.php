<div>
    <div>
        <div class="card card-statistics mb-30">
            <div class="card-body">
                <h5 class="card-title">{{ $data[0]->title }} ؟</h5>
                    @foreach (preg_split('/\r\n|\r|\n/', $data[0]->answers) as $index => $answer)
                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" name="customRadio" id="customRadio{{ $index }}" value="{{ $answer }}" class="custom-control-input">
                            <label for="customRadio{{ $index }}"class="custom-control-label">{{ $answer }}</label>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
</div>
